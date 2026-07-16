# Instalación del tema "Siete Digits" en el WordPress del cliente

> El tema convierte el rediseño completo en plantillas nativas de WordPress: el catálogo
> lee WooCommerce **en tiempo real** (sin sincronización), el formulario envía por el
> WP Mail SMTP ya configurado, y los textos clave se editan desde **Apariencia → Personalizar**.

## ⚠️ Antes de activar — imprescindible

1. **Backup completo verificado** (ver `docs/backup-plan.md`). Activar un tema es reversible
   en un clic, pero nunca se toca producción sin red.
2. Activar el tema **cambia el aspecto de TODO el sitio al instante**, incluidas la tienda
   `/tienda/` y las ~24.000 fichas de producto (pasan a servirse con `woocommerce.php`:
   misma URL y contenido, cabecera/pie nuevos). Hacerlo en horario de poco tráfico.
3. Ideal: probar antes con el plugin **Theme Switcha** (permite ver el tema solo tú,
   con el sitio público intacto) o en un staging del hosting.

## Instalación (5 minutos)

1. Comprimir la carpeta `wordpress-theme/sietedigits` en `sietedigits.zip`
   (o usar el zip ya generado).
2. wp-admin → **Apariencia → Temas → Añadir nuevo → Subir tema** → elegir el zip → Instalar.
3. **Activar**. Al activarse, el tema crea automáticamente las páginas que falten
   (actividad, compramos-servidores, productos, destruccion-de-datos, medio-ambiente,
   servidores-refurbished, contacto, aviso-legal, privacidad). Las que ya existan con ese
   slug (p. ej. `/actividad/`, `/medio-ambiente/`) adoptan la plantilla nueva sin más.
4. **Ajustes → Lectura**: si "Tu página de inicio muestra" no está en "Una página estática",
   dejarlo como esté — `front-page.php` toma el control de la portada igualmente.
5. **Apariencia → Personalizar** → secciones "7Digits · …": revisar teléfono, email
   (es el buzón que recibe el formulario), textos del hero y CTA.
6. Probar: portada, productos (filtros + cargar más), una ficha de producto de la tienda,
   y enviar el formulario de contacto (llega al email configurado; el remitente responde
   con Reply-To del solicitante).

## Qué edita el cliente y desde dónde

| Qué | Dónde |
|---|---|
| Productos (altas, fotos, stock) | Como siempre: su feed XML / WooCommerce — el catálogo lo refleja al momento |
| Teléfono, horario, email, dirección, redes | Personalizar → 7Digits · Datos de contacto |
| Hero de portada (título, subtítulo, cifras) | Personalizar → 7Digits · Portada |
| CTA final y textos del footer | Personalizar → Portada / Textos generales |
| Aviso legal y privacidad | Páginas → editar (contenido normal de WordPress) |
| Cuerpo de las páginas de servicios | v1: en plantilla (cambios vía desarrollador); ampliable a campos en v2 |

## Notas técnicas

- **SEO**: las URLs no cambian (mismos slugs). Yoast sigue gestionando titles/metas.
  Las páginas de checkout/carrito antiguas pueden despublicarse cuando se confirme
  que nada las usa (la tienda es catálogo sin venta).
- El formulario usa `admin-post` + nonce + honeypot; el envío sale por WP Mail SMTP.
- El tema no toca plugins ni datos: **desactivarlo devuelve el sitio exactamente a Jupiter**.
- Requisitos: WooCommerce activo (ya lo está) y PHP ≥ 7.4 (tienen 8.1). El aviso de
  "plantillas WooCommerce obsoletas" del tema Jupiter desaparece con este tema.
