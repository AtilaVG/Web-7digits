# 7Digits · ICT Remarketing — Rediseño web

Rediseño multipágina de [7digits.es](https://www.7digits.es/): venta de servidores y componentes
refurbished, destrucción certificada de datos, logística inversa (ITAD) y renting tecnológico.

## Estructura

```
├── index.html                  Inicio (hero con rack 3D, marcas, claves, teaser de servicios)
├── actividad.html              Actividad: servicios + economía circular (RAEE/WEEE)
├── productos.html              Catálogo con filtros, búsqueda y ordenación
├── destruccion-de-datos.html   Métodos de borrado, proceso paso a paso y certificado
├── renting.html                Simulador de cuota de renting
├── contacto.html               Formulario de presupuesto + datos de contacto
└── assets/
    ├── css/style.css           Hoja de estilos global (design system completo)
    └── js/main.js              JavaScript global (cada módulo se autoactiva por página)
```

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
- SEO: JSON-LD (LocalBusiness), Open Graph, títulos y descripciones únicos por página.
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

- **Colores y tipografías**: variables CSS en `:root` al inicio de `assets/css/style.css`.
- **Catálogo**: array `PRODUCTS` en `assets/js/main.js` (hasta integrar el e-commerce real).
- **Datos de contacto**: aparecen en topbar, página de contacto y footer de cada página.
