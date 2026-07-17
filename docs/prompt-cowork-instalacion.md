# Prompt de traspaso · Instalación del tema "Siete Digits" (automática con paradas de seguridad)

**Antes de pegar el prompt**, en el equipo de la sesión del navegador debe estar:
1. `sietedigits.zip` descargado (en Descargas).
2. La sesión de wp-admin de 7digits.es abierta como administrador.

---

```
Estás en el wp-admin de 7digits.es con mi sesión autorizada. Misión: instalar y verificar el
tema "Siete Digits" de principio a fin. Ejecuta las fases EN ORDEN. Hay 3 momentos donde debes
PARAR y pedirme intervención (login de Google, selector de archivo, y GO final de activación).

REGLAS GLOBALES (toda la sesión):
- No actualices, borres ni configures NADA fuera de lo aquí indicado.
- No toques productos, menús, entradas ni otros plugins.
- Si algo da error o aparece algo inesperado: PARA, captura el estado y repórtalo.
- Anota todo para el informe final.

═══ FASE 0 — BACKUP (condición para todo lo demás) ═══
1. Plugins → Añadir nuevo → busca "UpdraftPlus" (de UpdraftPlus.Com Ltd) → Instalar → Activar.
2. Ajustes → UpdraftPlus Backups → pestaña Ajustes → almacenamiento remoto Google Drive →
   pulsa autenticar y PÁRATE cuando pida login de Google: aviso #1, lo completo yo.
   (Si te digo "salta el Drive", continúa con copia local.)
3. "Copia de seguridad ahora" con base de datos + archivos. Espera a "backup succeeded /
   complete" y verifica que aparece en "Copias existentes". Anota fecha y tamaño.
   SIN BACKUP COMPLETADO NO PASES DE AQUÍ.

═══ FASE 1 — VISTA PREVIA SEGURA ═══
4. Plugins → Añadir nuevo → busca "Theme Switcha" (de Jeff Starr / Plugin Planet) →
   Instalar → Activar. En Ajustes → Theme Switcha: habilita "Enable theme switching"
   solo para administradores. Guarda.

═══ FASE 2 — SUBIR EL TEMA ═══
5. Apariencia → Temas → Añadir nuevo → Subir tema → pulsa "Elegir archivo" y PÁRATE:
   aviso #2, yo selecciono sietedigits.zip en el diálogo. Cuando el archivo aparezca
   seleccionado, pulsa "Instalar ahora". NO pulses "Activar" al terminar: vuelve a la
   lista de temas y confirma que "Siete Digits" aparece instalado (inactivo).

═══ FASE 3 — VERIFICACIÓN EN PREVIEW (el público sigue viendo Jupiter) ═══
6. Con Theme Switcha, previsualiza "Siete Digits" y comprueba UNA A UNA, anotando ✓/✗:
   a. Portada: hero con animación del servidor, secciones completas, menú con 7 ítems.
   b. /productos/: rejilla con productos reales, 12 visibles, botón "Cargar más" funciona,
      filtros y buscador filtran, "Precio bajo consulta" en las tarjetas.
   c. Una ficha de producto real de /tienda/...: carga con la cabecera/pie nuevos.
   d. /tienda/: el listado carga.
   e. /contacto/: el formulario se ve; NO lo envíes aún.
   f. /actividad/, /compramos-servidores/, /medio-ambiente/, /destruccion-de-datos/: cargan
      con el diseño nuevo (las páginas las crea el tema al activarse; en preview alguna
      puede dar 404 — anótalo, es esperado hasta la activación).
   g. Consola del navegador en portada: sin errores JS rojos.
   Si a–e tienen fallos GRAVES (página en blanco, error PHP): PARA y repórtame antes de seguir.

═══ FASE 4 — INFORME Y GO ═══
7. PÁRATE (aviso #3): mándame el checklist de la Fase 3 y espera mi "GO" explícito.
   NO actives el tema sin mi GO.

═══ FASE 5 — ACTIVACIÓN (solo tras mi GO) ═══
8. Apariencia → Temas → Activar "Siete Digits".
9. Verificación pública inmediata (en ventana de incógnito):
   - Portada pública carga con el diseño nuevo.
   - /productos/ y una ficha de /tienda/ cargan.
   - Envía UN mensaje de prueba real por /contacto/ (nombre "Prueba instalación",
     tu email de pruebas) y confirma la pantalla de éxito.
   - Revisa 2-3 páginas más del menú.
10. Si CUALQUIER cosa crítica falla en el sitio público: reactiva inmediatamente el tema
    Jupiter (Apariencia → Temas → Activar Jupiter) y repórtame. Eso es el rollback y
    tarda 5 segundos.

═══ INFORME FINAL ═══
Backup (fecha/tamaño/destino) · checklist de preview · hora de activación · resultado de las
verificaciones públicas · el mensaje de prueba del formulario (¿llegó al email?) · cualquier
anomalía. Recuérdame al final: revisar textos en Apariencia → Personalizar → secciones
"7Digits", y que el email que recibe el formulario se configura ahí.
```
