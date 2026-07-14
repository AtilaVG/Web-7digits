#!/usr/bin/env node
/**
 * 7DIGITS · Sincronización del catálogo desde WooCommerce
 * ────────────────────────────────────────────────────────
 * Lee los productos publicados de la tienda WooCommerce del cliente
 * (que sigue gestionándolos en su WordPress como siempre) y genera
 * assets/data/products.json con el formato que consume el front.
 *
 * Uso:
 *   WC_URL=https://www.7digits.es WC_KEY=ck_xxx WC_SECRET=cs_xxx node tools/sync-woocommerce.mjs
 *
 * Las claves se generan en: WordPress → WooCommerce → Ajustes →
 * Avanzado → REST API → "Añadir clave" (permisos de LECTURA bastan).
 *
 * En producción lo ejecuta .github/workflows/sync-catalog.yml cada noche.
 */

import { writeFileSync } from 'node:fs';

const { WC_URL, WC_KEY, WC_SECRET } = process.env;
if (!WC_URL || !WC_KEY || !WC_SECRET) {
  console.error('Faltan variables: WC_URL, WC_KEY y WC_SECRET son obligatorias.');
  process.exit(1);
}

/* La tienda real tiene ~24.000 productos: el front es un escaparate, no el
   catálogo completo. Se sincronizan los N más recientes en stock; el resto
   se consulta vía búsqueda/presupuesto. Ajustable con MAX_PRODUCTS. */
const MAX_PRODUCTS = parseInt(process.env.MAX_PRODUCTS || '120', 10);

/* Categorías reales de la tienda → filtro del front.
   (Almacenamiento 7212 · Componentes 6473 · Redes 3728 · Otros 3526 ·
    Servidores 2065 · Accesorios 593 · Software 259 · Consumibles 243 · Ordenadores 72) */
const CAT_MAP = [
  [/servidor|ordenador/i, 'server'],
  [/red|switch|router|comunicacion/i, 'network'],
  [/almacenamiento|cabina|disco|nas|san|storage/i, 'storage'],
  [/.*/, 'components'],
];

async function fetchAll() {
  const out = [];
  for (let page = 1; out.length < MAX_PRODUCTS; page++) {
    const url = `${WC_URL.replace(/\/$/, '')}/wp-json/wc/v3/products` +
      `?status=publish&stock_status=instock&orderby=date&order=desc&per_page=100&page=${page}` +
      `&consumer_key=${WC_KEY}&consumer_secret=${WC_SECRET}`;
    const res = await fetch(url);
    if (!res.ok) throw new Error(`WooCommerce respondió ${res.status} en la página ${page}`);
    const batch = await res.json();
    out.push(...batch);
    if (batch.length < 100) break;
  }
  return out.slice(0, MAX_PRODUCTS);
}

/* Los datos clave viven en meta_data, no en atributos WooCommerce ni ACF. */
function meta(p, ...keys) {
  for (const key of keys) {
    const m = (p.meta_data || []).find(x => x.key && x.key.toLowerCase() === key.toLowerCase());
    if (m && m.value && typeof m.value === 'string' && m.value.trim()) return m.value.trim();
  }
  return null;
}

function map(p) {
  const catSlugs = (p.categories || []).map(c => c.slug + ' ' + c.name).join(' ');
  const cat = CAT_MAP.find(([re]) => re.test(catSlugs))[1];
  const brand = meta(p, 'brand', 'marca') || p.name.split(' ')[0];
  const mpn = meta(p, 'MPN', 'mpn', '_mpn');
  /* La tienda no guarda grado (A–E); todo el catálogo es refurbished (sufijo .REF en SKU).
     No se inventa grado: grade queda a null y la tarjeta oculta la barra. */
  const isRef = /\.REF/i.test(p.sku || '');
  const specs = [];
  if (mpn) specs.push(['Part number', mpn.slice(0, 40)]);
  if (p.sku) specs.push(['Referencia', p.sku.slice(0, 40)]);
  return {
    t: p.name,
    b: brand,
    cat,
    type: (p.categories && p.categories[0] && p.categories[0].name) || 'Hardware',
    badge: isRef ? 'Refurbished' : (p.stock_status === 'instock' ? 'En stock' : 'Bajo pedido'),
    grade: null,
    specs,
    img: (p.images && p.images[0] && p.images[0].src) || null,
    url: p.permalink || null,
  };
}

const raw = await fetchAll();
const products = raw.filter(p => p.catalog_visibility !== 'hidden').map(map);
writeFileSync('assets/data/products.json', JSON.stringify(products, null, 1));
console.log(`Sincronizados ${products.length} productos desde ${WC_URL}`);
