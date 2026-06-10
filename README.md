# 7Digits · ICT Remarketing — Rediseño web

Rediseño multipágina de [7digits.es](https://www.7digits.es/): venta de servidores y componentes
refurbished, destrucción certificada de datos, logística inversa (ITAD) y renting tecnológico.

## Estructura

```
├── index.html                    Inicio (hero con rack 3D, marcas, claves, teaser de servicios)
├── 404.html                      Página de error personalizada
├── sitemap.xml · robots.txt      SEO técnico
├── pages/
│   ├── actividad.html            Actividad: servicios + economía circular (RAEE/WEEE)
│   ├── productos.html            Catálogo con filtros, búsqueda y ordenación
│   ├── destruccion-de-datos.html Métodos de borrado, proceso paso a paso y certificado
│   ├── renting.html              Simulador de cuota de renting
│   ├── contacto.html             Formulario de presupuesto + datos + mapa
│   ├── aviso-legal.html          Aviso legal y condiciones (noindex)
│   └── privacidad.html           Política de privacidad RGPD (noindex)
└── assets/
    ├── css/
    │   ├── base.css              Tokens de diseño, reset, tipografía, botones, utilidades
    │   ├── layout.css            Topbar, cabecera/nav, page-header, footer, menú móvil
    │   ├── components.css        Secciones, FAQ, CTA, animaciones de aparición
    │   └── pages/                Estilos exclusivos de cada página
    │       ├── home.css          ├── actividad.css   ├── productos.css
    │       ├── destruccion.css   ├── renting.css     └── contacto.css
    └── js/
        ├── core.js               Núcleo común: nav, progreso, menú, FAQ, reveals, contadores
        └── pages/                Módulo exclusivo de cada página
            ├── home.js           ├── actividad.js    ├── productos.js
            ├── destruccion.js    ├── renting.js      └── contacto.js
```

Cada página carga solo 4 hojas de estilo (3 comunes + la suya) y 2 scripts (núcleo + el suyo):
los archivos comunes quedan cacheados por el navegador y el peso por página es mínimo.

Sitio 100% estático: se puede desplegar en cualquier hosting, CDN o servidor
(Netlify, Vercel, Cloudflare Pages, Apache, Nginx...) sin proceso de build.

## Características

- **Rack de servidores 3D** en la portada (CSS 3D puro, sin dependencias) con parallax de ratón,
  LEDs animados y luz de escaneo; fondo de red de partículas en canvas.
- **Catálogo interactivo** con filtros por categoría, búsqueda y ordenación por precio/grado.
  Cada producto enlaza a `contacto.html?tipo=compra&producto=...`, que **pre-rellena el
  formulario** — sin cookies ni almacenamiento en el navegador, con URLs compartibles.
- **Simulador de renting** cuyo CTA traslada la simulación al formulario por parámetros de URL.
- Animaciones de aparición, contadores, acordeones FAQ, marquee de marcas, micro-interacciones.
- SEO: JSON-LD (LocalBusiness, FAQPage por página, BreadcrumbList), Open Graph, canonical,
  sitemap.xml y robots.txt, títulos y descripciones únicos por página.
- Accesibilidad: skip-link, ARIA, foco visible y soporte completo de `prefers-reduced-motion`.

## Conectar el formulario

El formulario de `contacto.html` funciona en modo demostración hasta que se le indique un
endpoint. Para activarlo, añadir la URL del servicio (backend propio, Formspree, Brevo,
HubSpot Forms, etc.) en el atributo `data-endpoint` del `<form>`:

```html
<form id="quoteForm" method="post" data-endpoint="https://tu-endpoint-de-formularios" ...>
```

El JS enviará los campos por `POST` (`FormData`) y mostrará el estado de éxito o error.

## Personalización rápida

- **Colores y tipografías**: variables CSS en `:root` al inicio de `assets/css/base.css`.
- **Catálogo**: array `PRODUCTS` en `assets/js/pages/productos.js` (hasta integrar el e-commerce real).
- **Datos de contacto**: aparecen en topbar, página de contacto y footer de cada página.

## Pendiente antes de publicar

- **Textos legales**: `aviso-legal.html` y `privacidad.html` son plantillas redactadas con los
  datos de la empresa; deben revisarse por un asesor legal antes de publicar.
- **Formulario**: configurar `data-endpoint` (ver sección anterior).
- **Imagen Open Graph**: añadir una imagen `og:image` (1200×630 px) cuando haya fotografía corporativa.
- **Fotografías reales**: el diseño está preparado para incorporar fotos del almacén/instalaciones.
