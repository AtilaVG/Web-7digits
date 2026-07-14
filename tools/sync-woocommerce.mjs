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

/* slug de categoría WooCommerce → filtro del front */
const CAT_MAP = [
  [/servidor/i, 'server'],
  [/red|switch|router|comunicacion/i, 'network'],
  [/almacenamiento|cabina|disco|nas|san|storage/i, 'storage'],
  [/.*/, 'components'],
];
const GRADE_LETTER = { A: 5, B: 4, C: 3, D: 2, E: 1 };

async function fetchAll() {
  const out = [];
  for (let page = 1; ; page++) {
    const url = `${WC_URL.replace(/\/$/, '')}/wp-json/wc/v3/products` +
      `?status=publish&per_page=100&page=${page}` +
      `&consumer_key=${WC_KEY}&consumer_secret=${WC_SECRET}`;
    const res = await fetch(url);
    if (!res.ok) throw new Error(`WooCommerce respondió ${res.status} en la página ${page}`);
    const batch = await res.json();
    out.push(...batch);
    if (batch.length < 100) break;
  }
  return out;
}

function attr(p, ...names) {
  for (const name of names) {
    const a = (p.attributes || []).find(x => x.name && x.name.toLowerCase() === name);
    if (a && a.options && a.options.length) return a.options[0];
  }
  return null;
}

function map(p) {
  const catSlugs = (p.categories || []).map(c => c.slug + ' ' + c.name).join(' ');
  const cat = CAT_MAP.find(([re]) => re.test(catSlugs))[1];
  const gradeRaw = (attr(p, 'grado', 'grade') || 'B').trim().toUpperCase()[0];
  const specs = (p.attributes || [])
    .filter(a => !/grado|grade|marca|brand/i.test(a.name) && a.options && a.options.length)
    .slice(0, 3)
    .map(a => [a.name, String(a.options[0]).slice(0, 40)]);
  return {
    t: p.name,
    b: attr(p, 'marca', 'brand') || p.name.split(' ')[0],
    cat,
    type: (p.categories && p.categories[0] && p.categories[0].name) || 'Hardware',
    badge: p.stock_status === 'instock' ? 'En stock' : 'Bajo pedido',
    grade: GRADE_LETTER[gradeRaw] ?? 4,
    specs,
    img: (p.images && p.images[0] && p.images[0].src) || null,
    url: p.permalink || null,
  };
}

const raw = await fetchAll();
const products = raw.filter(p => p.catalog_visibility !== 'hidden').map(map);
writeFileSync('assets/data/products.json', JSON.stringify(products, null, 1));
console.log(`Sincronizados ${products.length} productos desde ${WC_URL}`);
