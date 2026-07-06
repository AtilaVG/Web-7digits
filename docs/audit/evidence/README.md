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
