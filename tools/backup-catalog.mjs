#!/usr/bin/env node
/**
 * 7DIGITS · Copia de seguridad del catálogo completo desde WooCommerce
 * ────────────────────────────────────────────────────────────────────
 * Exporta LOS ~24.000 productos (no solo los del escaparate) a un CSV
 * de respaldo. Es una red de seguridad del activo más valioso e
 * irreemplazable del cliente, ejecutable con la clave de SOLO LECTURA.
 *
 * NO sustituye a un backup completo del sitio (base de datos + archivos +
 * media), que debe hacerse con un plugin en el propio WordPress (ver
 * docs/backup-plan.md). Esto respalda ÚNICAMENTE los datos de producto.
 *
 * Uso:
 *   WC_URL=https://www.7digits.es WC_KEY=ck_... WC_SECRET=cs_... \
 *     node tools/backup-catalog.mjs > backups/catalogo-AAAA-MM-DD.csv
 */

import { stdout } from 'node:process';

const { WC_URL, WC_KEY, WC_SECRET } = process.env;
if (!WC_URL || !WC_KEY || !WC_SECRET) {
  console.error('Faltan variables: WC_URL, WC_KEY y WC_SECRET son obligatorias.');
  process.exit(1);
}

const meta = (p, ...keys) => {
  for (const key of keys) {
    const m = (p.meta_data || []).find(x => x.key && x.key.toLowerCase() === key.toLowerCase());
    if (m && m.value && typeof m.value === 'string' && m.value.trim()) return m.value.trim();
  }
  return '';
};
const csv = v => `"${String(v ?? '').replace(/"/g, '""')}"`;

const COLS = ['id', 'sku', 'nombre', 'marca', 'mpn', 'categorias', 'precio',
  'stock_status', 'permalink', 'imagen', 'fecha_creacion'];

async function main() {
  stdout.write('﻿' + COLS.join(';') + '\n');   // BOM para Excel + cabecera
  let total = 0;
  for (let page = 1; ; page++) {
    const url = `${WC_URL.replace(/\/$/, '')}/wp-json/wc/v3/products` +
      `?status=any&per_page=100&page=${page}` +
      `&consumer_key=${WC_KEY}&consumer_secret=${WC_SECRET}`;
    const res = await fetch(url);
    if (!res.ok) throw new Error(`WooCommerce respondió ${res.status} en la página ${page}`);
    const batch = await res.json();
    if (!batch.length) break;
    for (const p of batch) {
      stdout.write([
        p.id, p.sku, p.name, meta(p, 'brand', 'marca'), meta(p, 'MPN', 'mpn'),
        (p.categories || []).map(c => c.name).join(' > '),
        p.price, p.stock_status, p.permalink,
        (p.images && p.images[0] && p.images[0].src) || '',
        p.date_created,
      ].map(csv).join(';') + '\n');
    }
    total += batch.length;
    console.error(`  ${total} productos exportados…`);
    if (batch.length < 100) break;
  }
  console.error(`✓ Copia de catálogo completada: ${total} productos.`);
}

main().catch(e => { console.error('Error:', e.message); process.exit(1); });
