# Evidencia visual de la auditoría (7Digits MVP)

Capturas a página completa con **Chrome headless** (viewport exacto), servidor local `http://127.0.0.1:4173`,
sobre la **última versión** del sitio (rama base `e1cb86f`). Nota de entorno: la pantalla física es 1280×720, por lo
que las capturas de escritorio a 1440×900 se generan en headless. Las animaciones `reveal` se fuerzan visibles para
obtener evidencia determinista.

## Estructura
- `before/` — estado de partida (versión actual antes del MVP): inicio (móvil/escritorio), productos, renting,
  contacto (móvil), destrucción, compras, medio ambiente.
- `final/` — set completo tras el MVP, incluidas las páginas nuevas y el menú móvil abierto y scrollable.

## Mejoras visibles / verificadas (before → final)
1. **Menú móvil scrollable**: con 8 enlaces + CTA, antes la CTA quedaba cortada en pantallas bajas; ahora el panel
   hace scroll y la CTA "Solicitar presupuesto" es siempre alcanzable (`final/inicio-mobile-menu-open-375x640`).
2. **Contacto**: el mapa pasa de fondo transparente (riesgo de hueco blanco) a panel azul marino de marca
   ("Mapa de situación") + pie "Cómo llegar" con la dirección real (`final/contacto-mobile`).
3. **Responsive**: eliminado el scroll horizontal accidental de 8px a 768px (reveal sin desplazamiento lateral en ≤980px).
4. **Flujo de conversión**: los anclajes (prerelleno catálogo/simulador → formulario, skip link) ya no quedan bajo la cabecera fija.

Nota: la topbar móvil y el botón de cierre del menú **ya estaban corregidos** en la versión base; no forman parte de este MVP.

## Segunda ronda (Tier A+B+C) — visible en el set `final/` regenerado
5. **CTA de producto con texto**: cada tarjeta del catálogo pasa de un icono 44×44 a un botón «Pedir presupuesto»
   con texto e icono (`final/productos-desktop`, `final/productos-mobile`).
6. **Contraste WCAG AA**: texto de botón primario en `navy-2`, verde de marca a `--green-text` sobre blanco y banda
   `.cta` con overlay navy al 34% (todos los pares ≥4.5 por cálculo de ratio).
7. **Confianza/honestidad**: footer sin la etiqueta «Prototipo», contadores con la cifra real como *fallback*, nota de
   privacidad junto al envío y asterisco del CO₂ aclarado como estimación (`final/contacto-mobile`, `final/medioambiente-mobile`).
8. **Accesibilidad técnica** (no siempre visible en captura): menú `role="dialog"` con trampa de foco, `aria-pressed` en
   toggles y orden de encabezados corregido.
