# Migración SEO · 7digits.es → nuevo front

> Datos confirmados por auditoría del wp-admin (junio 2026): **Yoast SEO**, plugin
> **301 Redirects** instalado, permalinks `/%category%/%postname%/` para entradas/páginas
> y `/tienda/%product_cat%/` para productos. ~24.000 productos en modo catálogo.
> El dominio posiciona desde 2015: conservar URLs es la prioridad número uno.

## ✅ Coincidencias espejo (ya posicionan con NUESTRO slug)

Cuatro páginas del front tienen el **mismo slug** que la URL que ya posiciona. Sirviéndolas
en esa ruta, **Google no percibe cambio de plataforma** — misma URL, contenido renovado:

| URL que ya posiciona | Página del front | Acción |
|---|---|---|
| `/actividad/` | `pages/actividad.html` | servir como `/actividad/index.html` |
| `/compramos-servidores/` | `pages/compramos-servidores.html` | servir como `/compramos-servidores/index.html` |
| `/medio-ambiente/` | `pages/medio-ambiente.html` | servir como `/medio-ambiente/index.html` |
| `/destruccion-de-datos/` | `pages/destruccion-de-datos.html` | servir como `/destruccion-de-datos/index.html` |
| `/` | `index.html` | raíz |

`/servidores/servidores-refurbished/` es una **entrada** existente (no producto) → sirve
`pages/servidores-refurbished.html` en esa ruta y conservas ese posicionamiento también.

## Redirecciones 301 — el resto de URLs reales del sitemap

### Netlify / Cloudflare Pages (`_redirects`)

```
# Tienda y catálogo → página de productos del front
/tienda/                          /pages/productos.html      301
/servidores-y-componentes/        /pages/productos.html      301
/stock-actualizado/               /pages/productos.html      301
/tienda/*                         /pages/productos.html      301
/categoria-producto/*             /pages/productos.html      301

# Todos los slugs de contacto/presupuesto que existen hoy → contacto
/contacto-7digits/                /pages/contacto.html       301
/presupuesto/                     /pages/contacto.html       301
/presupuesto-2/                   /pages/contacto.html       301
/quote-request/                   /pages/contacto.html       301
/request-a-quote/                 /pages/contacto.html       301
/request-quote/                   /pages/contacto.html       301
/contact-list/                    /pages/contacto.html       301

# Legales y checkout obsoleto (WooCommerce ya no vende online)
/ley-de-cookies/                  /pages/privacidad.html     301
/carro/                           /pages/productos.html      301
/finalizar-comprar/               /pages/productos.html      301
/mi-cuenta/                       /pages/contacto.html       301

# Blog técnico 2015-2016 (33 entradas, muchas /servidores/…)
# Ver decisión abajo antes de aplicar este catch-all:
/servidores/*                     /pages/servidores-refurbished.html  301
/ofertas/*                        /pages/productos.html      301
```

### Apache (`.htaccess`) — equivalente

```apache
Redirect 301 /tienda/ /pages/productos.html
Redirect 301 /servidores-y-componentes/ /pages/productos.html
Redirect 301 /stock-actualizado/ /pages/productos.html
Redirect 301 /contacto-7digits/ /pages/contacto.html
Redirect 301 /presupuesto/ /pages/contacto.html
Redirect 301 /ley-de-cookies/ /pages/privacidad.html
RedirectMatch 301 ^/tienda/.*$ /pages/productos.html
RedirectMatch 301 ^/categoria-producto/.*$ /pages/productos.html
RedirectMatch 301 ^/ofertas/.*$ /pages/productos.html
# (contacto: replicar las 7 variantes de slug del bloque Netlify)
```

## ⚠️ Decisión pendiente — las 33 entradas del blog

Son de 2015-2016, técnicas y muchas bajo `/servidores/…` (guías de HP ProLiant, IBM
BladeCenter, virtualización…). **Antes de aplicar el catch-all `/servidores/*` de arriba**:

1. Mirar en **Search Console → Rendimiento** qué entradas reciben clics reales hoy.
2. Las que traigan tráfico → **conservarlas** como páginas estáticas individuales (tienen
   valor SEO ganado); el resto → 301 a la guía `servidores-refurbished`.
3. Es el único punto donde un catch-all agresivo podría *perder* posiciones. Merece los
   10 minutos de revisión en Search Console.

## Estructura real confirmada (para el sync del catálogo)

- **Marca** → meta `brand` (no atributos, no ACF). La taxonomía "Marcas" existe pero está vacía.
- **Part number** → meta `MPN`. **Referencia** → SKU (sufijo `.REF` = refurbished).
- **Sin campo de grado** → el front NO inventa grado en productos sincronizados (barra oculta).
- **Precio** → 0 (modo catálogo). Coincide con "Precio bajo consulta" del front.
- **Permalink producto** → `/tienda/%product_cat%/…` (la API lo devuelve completo en `permalink`).
- La **REST API responde 200** con la clave de lectura; Really Simple Security no la bloquea. ✅

## Checklist de ejecución

1. [ ] Regenerar la clave API (la anterior quedó expuesta) y guardarla SOLO en GitHub Secrets.
2. [ ] Exportar el `sitemap_index.xml` completo para el inventario 1:1 final.
3. [ ] Revisar Search Console para la decisión de las 33 entradas.
4. [ ] Aplicar espejo + 301 en el hosting elegido.
5. [ ] Enviar el nuevo `sitemap.xml` desde Search Console y vigilar cobertura 2-3 semanas.
6. [ ] Actualizar el claim "+10.000 productos" → "+20.000 referencias" (hay ~24.000).
