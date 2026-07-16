# Auditoría visual y MVP de rediseño — 7Digits

- **Fecha:** 2026-07-06
- **Rama:** `claude/7digits-design-mvp` (creada desde `e1cb86f`, la última versión de `claude/7digits-redesign-idej3x`)
- **Servidor local:** `python -m http.server 4173` → `http://127.0.0.1:4173`
- **Capturas:** Chrome headless (puppeteer-core sobre el Chrome instalado), viewports exactos 375×812, 768×1024, 1440×900, página completa.

## Nota de re-baseline (importante)
Una primera versión de este MVP se construyó por error sobre una copia local **12 commits desfasada**. Al detectarlo,
se descartó ese trabajo y **se rehízo sobre la última versión**, que ya incluía: corrección de la topbar móvil y botón de
cierre del menú, *scrollytelling* (parallax hero + destrucción de datos), transiciones de página (View Transitions),
catálogo headless (`products.json` + sync WooCommerce) y páginas nuevas (**Compras**, **Medio ambiente**,
**Servidores refurbished**). Por tanto, las mejoras que ya estaban hechas upstream (p. ej. topbar móvil) **no se
reimplementan**; el MVP se limita a defectos que **siguen presentes** en la versión actual.

## Alcance y páginas analizadas
Sitio estático multipágina (HTML/CSS/JS sin frameworks). 12 páginas: Inicio, Actividad, Compras, Productos,
Destrucción de datos, Renting, Medio ambiente, Servidores refurbished, Contacto, Aviso legal, Privacidad, 404.

## Limitaciones (declaradas)
- Pantalla física del entorno = 1280×720: las capturas **interactivas** reales no pueden llegar a 1440×900. Las capturas
  a 1440×900 se generan en **headless** (viewport exacto). Reveals forzados visibles para evidencia determinista.
- No se compara pixel a pixel con la web real ni con GitHub Pages; la fuente de verdad es el repositorio.
- El formulario funciona en **modo demo** (sin `data-endpoint`), por diseño. El mapa usa el iframe público de Google.
- No se ha inventado ningún dato, sello, cifra ni contenido corporativo.

## Estado de partida
El rediseño ya es de **alta calidad** (tokens CSS, `:focus-visible`, skip link, `prefers-reduced-motion`, datos
estructurados, catálogo con filtros/orden, simulador, scrollytelling). El MVP son **refinamientos de precisión**,
no un rediseño.

## QA automatizado en Chrome — resultado
- **0 errores de consola** y **0 recursos 4xx** propios en las 12 páginas (scrollytelling y View Transitions incluidos).
- Flujos correctos: catálogo (filtros/orden/estado vacío), simulador (cuota + CTA con parámetros), formulario
  (validación + éxito demo + prerelleno), valorador de Compras, menú móvil (Escape + botón de cierre).

## Hallazgos que SIGUEN presentes en la versión actual → MVP

| # | Hallazgo | Evidencia (antes) | Archivo |
|---|----------|-------------------|---------|
| H1 | **Menú móvil no scrollable**: con 8 enlaces + CTA, en pantallas ≤~636px de alto la CTA "Solicitar presupuesto" queda cortada e **inalcanzable** (`overflow-y:visible`, scrollHeight 636 > 568) | medición a 375×568: `ctaVisible:false` | `layout.css .mobile-menu` |
| H2 | **Cabecera fija tapa el destino de anclaje 87px** al prerellenar (catálogo/simulador → `#contact-form`) y en el skip link | `scrollMarginTop=0`, oculta 87px | `base.css` |
| H3 | **Overflow horizontal de 8px a 768px** en 6 páginas por `reveal.rv-l/.rv-r translateX(±36px)` > padding | `scrollWidth 776 > 768` | `components.css .reveal` |
| H4 | **Mapa de contacto sin *fallback***: fondo transparente → hueco si el iframe falla; sin enlace directo "cómo llegar" | `.map` background transparente | `contacto.css`, `contacto.html` |

## MVP implementado (4 mejoras, tema: *acabado listo para cliente — móvil, flujo y consistencia*)

| Mejora | Archivo | Impacto visual | Comercial | Reunión | Esfuerzo | Riesgo |
|--------|---------|---------------:|----------:|--------:|---------:|-------:|
| M1 Menú móvil scrollable (H1) | `layout.css` | 3 | 4 | 4 | 1 | 1 |
| M2 Offset de anclaje cabecera fija (H2) | `base.css` | 2 | 4 | 3 | 1 | 1 |
| M3 Reveal sin desplazamiento lateral en ≤980px (H3) | `components.css` | 2 | 2 | 3 | 1 | 1 |
| M4 Mapa con *fallback* + enlace "Cómo llegar" (H4) | `contacto.css` + `contacto.html` | 3 | 4 | 4 | 2 | 1 |

Descartadas por estar **ya resueltas upstream**: topbar móvil y botón de cierre del menú.

### Justificación UX/UI y comercial
- **M1** garantiza que en cualquier móvil la CTA principal del menú (el paso a conversión) sea alcanzable; antes se
  perdía en pantallas bajas. **M2** evita que el titular del formulario quede bajo la cabecera justo al llegar con
  intención de contactar. **M3** elimina un microdefecto responsive que resta percepción de calidad técnica. **M4**
  convierte un posible hueco blanco en un bloque de confianza (ubicación real + "Cómo llegar").

## Validación (localhost + Chrome headless)
- **Overflow:** ok en 375/768/1440 en las 12 páginas (antes: 8px a 768px en 6 páginas → corregido).
- **Menú móvil:** `overflow-y:auto`; a 375×568 la CTA se alcanza tras scroll (`reachable:true`). Sin regresión del botón de cierre ni de Escape.
- **Anclaje:** `scroll-margin-top:104px`; el título del formulario pasa de oculto 87px a 17px por debajo de la cabecera.
- **Mapa:** fondo `linear-gradient` navy + placeholder "Mapa de situación" + enlace "Cómo llegar"; el iframe carga encima con red.
- **Sin regresiones:** 0 errores de consola, 0 4xx, scrollytelling/parallax/View Transitions y todos los flujos intactos.

## Segunda ronda — Tier A (seguras) + Tier B (contraste WCAG AA) + Tier C (accesibilidad técnica)

Tras los 4 arreglos base se abrió una segunda ronda de mejoras, seleccionada explícitamente por el cliente
(«Tier A + B + C»), con foco en **defendibilidad ante cliente**, **contraste AA** y **accesibilidad técnica**.
No se inventó ningún dato: los contadores muestran las mismas cifras que ya existían y se marca como *estimación
orientativa a confirmar* la única métrica no verificable (CO₂ evitado).

### Tier A — Mejoras seguras (sin riesgo visual)
| # | Cambio | Archivos | Beneficio |
|---|--------|----------|-----------|
| A1 | Footer: se retira «Prototipo de rediseño — 7digits.es» → «Gestión responsable del fin de vida del hardware empresarial.» | 12 HTML | Elimina la etiqueta de «prototipo» que restaba credibilidad ante el cliente |
| A2 | Contadores con el valor real ya escrito en el HTML (fallback si falla JS) y animación que arranca de 0 | `core.js`, index/actividad/medio-ambiente | Si JS falla, se ven **10.000 / 24 / 100…** en vez de «0»; sin dato inventado |
| A3 | Enlace «Medio ambiente» que faltaba en la navegación de Contacto (nav + menú móvil) | `contacto.html` | Navegación consistente (8 enlaces en todas las páginas) |
| A4 | Nota al pie del asterisco «CO₂ evitado*»: estimación orientativa a confirmar | actividad/medio-ambiente + `.stat-note` | Honestidad de datos: no se presenta como cifra propia verificada |
| A5 | CTA de cada producto pasa de icono 44×44 a botón con texto «Pedir presupuesto» | `productos.js` + `productos.css` | CTA reconocible y accesible; mejora conversión del catálogo |
| A6 | Nota de privacidad junto al botón de envío del formulario | `contacto.html` + `contacto.css` | Cumplimiento/transparencia; enlace a política de privacidad |

### Tier B — Contraste WCAG AA (verificado por cálculo de ratio)
| # | Cambio | Antes → Después | Ratio |
|---|--------|-----------------|------:|
| B1 | Texto de `.btn-primary` (verde) pasa de blanco a `navy-2` | 2.05 (FAIL) → **5.00–6.78** | PASS AA |
| B2 | Token `--green-text #3d7d18` para verde sobre blanco (`.tag`, `.prod .brand`); `.num` a `blue-deep`; overrides lime/sky en secciones oscuras | 2.77 (FAIL) → **5.07** | PASS AA |
| B3 | Banda `.cta`: overlay navy al 34% sobre el degradado verde→azul | 2.77 (FAIL) → **5.18–7.12** | PASS AA |

Verificación: script de contraste (fórmula WCAG 2.x). **Todos los pares AA-normal ≥ 4.5.**

### Tier C — Accesibilidad técnica
| # | Cambio | Archivos |
|---|--------|----------|
| C1 | Menú móvil = `role="dialog"` + `aria-modal`, **trampa de foco** (foco al abrir, Tab cíclico, Escape devuelve el foco al botón) | `core.js` |
| C2 | `aria-pressed` en los grupos de botones toggle (filtros de catálogo, periodicidad de renting, antigüedad de compras) | `productos.js`, `renting.js`, `compras.js` |
| C3 | Orden de encabezados: footer `h5`→`h2`, tarjetas de producto `h4`→`h3`, `h2` de catálogo para lectores de pantalla | 12 HTML, `productos.js/.css`, `layout.css` |
| C4 | Prerelleno del formulario también con `tipo=compra` y `tipo=renting` sin parámetros extra | `contacto.js` |

### Validación de la segunda ronda (localhost + Chrome headless)
- **Consola/red:** 0 errores y 0 recursos 4xx en las 12 páginas; **sin overflow** en 375/768/1440.
- **Contraste:** los 8 pares nuevos + la banda CTA pasan **AA-normal (≥4.5)** por cálculo de ratio.
- **Accesibilidad runtime:** `aria-pressed` conmuta correctamente; menú con `role=dialog`, foco al abrir en el botón de
  cierre, Tab cíclico dentro del panel y Escape que **devuelve el foco al botón**; contadores animan desde 0 con la cifra
  real como *fallback*.
- **Conversión:** el prerelleno de Contacto responde a `tipo=compra`/`tipo=renting`; el CTA de producto muestra texto.
- **Sin regresiones:** scrollytelling, parallax y View Transitions intactos.

### Puntuación MVP (sobre 100) — tras Tier A+B+C
| Categoría | Puntos | Nota |
|-----------|-------:|------|
| Jerarquía visual y coherencia | 19/20 | Orden de encabezados corregido; sistema de color más disciplinado |
| Confianza y percepción B2B | 19/20 | Sin etiqueta de «prototipo»; datos honestos; nota de privacidad |
| Conversión y claridad de CTAs | 19/20 | CTA de producto con texto; prerelleno más completo |
| Responsive y accesibilidad | 19/20 | Contraste AA + trampa de foco + `aria-pressed` + jerarquía de headings |
| Calidad técnica y mantenibilidad | 19/20 | Cambios pequeños, tokenizados y sin dependencias |
| **Total** | **95/100** |

**MVP SUPERADO**: ≥80/100, ninguna categoría <15, 0 errores de consola, 0 flujos rotos, validado en móvil/tablet/escritorio,
sin regresiones, contraste AA verificado y dirección de diseño coherente.

> Nota histórica: la primera ronda (4 arreglos base) puntuó **90/100**. La segunda ronda (Tier A+B+C) la eleva a **95/100**.

## Mejoras futuras (Fase 2)
1. Revisión editorial del bloque *intro* de la portada. 2. Uso más disciplinado del degradado verde en el sistema de color.
3. Imágenes reales de instalaciones/equipo (cliente). 4. Prueba social real (logos/casos) **solo si el cliente los facilita**.
5. Endpoint real del formulario + enlace al tratamiento de datos junto al botón de envío.

## Preguntas reales para el cliente
1. ¿Podéis facilitar **logotipos de clientes, casos o testimonios reales** para prueba social? (No se inventarán.)
2. ¿A qué **endpoint/servicio** debe enviar el formulario (email, CRM, servicio de formularios)?
3. ¿Qué **perfiles sociales** existen y sus URLs? (Facebook y LinkedIn ya enlazan; ¿alguno más?)
4. ¿Disponéis de **certificaciones oficiales** (p. ej. ISO 27001 emitida) para mostrarlas como sello verificable?
5. ¿Los **precios/stock del catálogo** (ahora vía `products.json`/WooCommerce) son definitivos para producción?
6. ¿Confirmáis dirección, teléfono, horario y CIF como datos definitivos?
