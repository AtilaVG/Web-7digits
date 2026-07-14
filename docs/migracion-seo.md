# Migración SEO · 7digits.es → nuevo front

> Cliente con **Yoast SEO** activo, permalinks tipo `/%postname%/`, plugin **301 Redirects**
> instalado y ~24.000 productos WooCommerce en modo catálogo (plugin *Catalog for WooCommerce*,
> sin venta online). El dominio lleva posicionando desde ~2015: conservar las URLs es prioridad.

## Estrategia recomendada: URLs espejo (Opción A)

En el despliegue de producción, servir cada página del front en **la misma URL que ya posiciona**,
en lugar de redirigir. Se consigue publicando cada página como carpeta con `index.html`:

| URL actual (posicionada) | Archivo a servir |
|---|---|
| `/` | `index.html` |
| `/actividad/` | `pages/actividad.html` → publicar como `/actividad/index.html` |
| `/compramos-servidores/` | `pages/compramos-servidores.html` → `/compramos-servidores/index.html` |
| `/medio-ambiente/` | `pages/medio-ambiente.html` → `/medio-ambiente/index.html` |
| `/servidores/servidores-refurbished/` | `pages/servidores-refurbished.html` → misma ruta |
| `/contacto/` (verificar slug real) | `pages/contacto.html` → `/contacto/index.html` |

Con URLs espejo, **Google no nota el cambio de plataforma**: misma URL, contenido renovado.
Solo requiere un pequeño script de build que copie `pages/*.html` a sus carpetas (5 líneas,
lo preparo cuando se confirme el hosting).

## Redirecciones 301 (Opción B / complemento)

Para las URL que no tengan página equivalente. El cliente ya tiene el plugin **301 Redirects**
(si WordPress queda vivo en un subdominio) o se aplican en el servidor del front:

### Apache (.htaccess)

```apache
Redirect 301 /tienda/ /pages/productos.html
Redirect 301 /servidores-y-componentes/ /pages/productos.html
Redirect 301 /presupuesto/ /pages/contacto.html
Redirect 301 /servidores-refurbished/ /pages/contacto.html
Redirect 301 /servidores/componentes-refurbished/ /pages/servidores-refurbished.html
RedirectMatch 301 ^/categoria-producto/.* /pages/productos.html
RedirectMatch 301 ^/portfolio-posts/.* /pages/productos.html
RedirectMatch 301 ^/portfolio_category/.* /pages/productos.html
RedirectMatch 301 ^/producto/.* /pages/productos.html
```

### Netlify / Cloudflare Pages (_redirects)

```
/tienda/                          /pages/productos.html            301
/servidores-y-componentes/        /pages/productos.html            301
/presupuesto/                     /pages/contacto.html             301
/servidores-refurbished/          /pages/contacto.html             301
/servidores/componentes-refurbished/ /pages/servidores-refurbished.html 301
/categoria-producto/*             /pages/productos.html            301
/portfolio-posts/*                /pages/productos.html            301
/portfolio_category/*             /pages/productos.html            301
/producto/*                       /pages/productos.html            301
```

## Pendiente antes de ejecutar

1. **Exportar el sitemap de Yoast** (`/sitemap_index.xml`) para el inventario completo de URLs:
   26 páginas + 32 entradas + categorías de producto. Con él se cierra el mapa 1:1.
2. **Las 32 entradas del blog (2015-2016)**: decidir destino — redirigir a la guía
   `/servidores-refurbished` las temáticas y a portada el resto, o conservarlas como
   archivo estático si alguna sigue trayendo tráfico (verificar en Search Console).
3. **Search Console**: comprobar qué URLs reciben clics reales antes de decidir
   qué fichas de producto merecen redirección específica.
4. Tras el despliegue: enviar el nuevo `sitemap.xml` desde Search Console y vigilar
   cobertura 2-3 semanas.

## Notas de la auditoría que afectan al SEO

- La **API REST "no responde bien"** según Salud del sitio → probar `wp-json/wc/v3` con las
  claves antes de confiar en la sincronización nocturna (puede ser culpa de *Remove XMLRPC
  Pingback* o de *Really Simple Security*; ajuste de 1 minuto).
- **MonsterInsights/Analytics roto (403)**: el cliente lleva tiempo sin datos de tráfico.
  Proponer analítica sin cookies en el front nuevo (Plausible/Matomo) — sin banner y con datos desde el día 1.
- El claim público "más de 10.000 productos" se queda **corto**: hay ~24.000. Confirmar con
  el cliente si quieren publicar "más de 20.000 referencias" (mejor claim, misma verdad).
