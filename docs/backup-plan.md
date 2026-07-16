# Plan de copia de seguridad · WordPress de 7digits.es

> La auditoría reveló que el sitio (WordPress + WooCommerce, ~24.000 productos) **no tiene
> ningún plugin de backup** ni copia verificable. Con un WordPress desactualizado y con avisos
> de seguridad, es una prioridad. Este documento describe los dos niveles y quién ejecuta cada uno.

## Dos niveles de copia

| Nivel | Qué respalda | Cómo | Quién |
|---|---|---|---|
| **1. Sitio completo** | Base de datos (productos, páginas, usuarios, ajustes) + archivos (media, tema, plugins) | Plugin de backup en el wp-admin | Alex / Claude navegador |
| **2. Catálogo** | Solo los datos de producto (CSV) | `tools/backup-catalog.mjs` con la clave API de lectura | Nosotros, automatizable |

El Nivel 2 **no sustituye** al Nivel 1: no incluye páginas, media, configuración ni usuarios.
Es una red de seguridad extra del activo más valioso e irreemplazable (los 24k productos).

## Nivel 1 — Backup completo (recomendado: UpdraftPlus a Google Drive)

UpdraftPlus es gratuito, estándar y guarda la copia **fuera del servidor** (si el hosting cae,
la copia sobrevive). Pasos:

1. wp-admin → Plugins → Añadir nuevo → buscar **UpdraftPlus** → Instalar → Activar.
2. Ajustes → UpdraftPlus → pestaña **Ajustes**:
   - Almacenamiento remoto: **Google Drive** (autorizar con la cuenta del cliente), o Dropbox.
   - Programación: **Archivos = diario**, **Base de datos = diario**, retener **7 copias**.
3. Pestaña **Copia de seguridad / Restaurar** → botón **"Copia de seguridad ahora"** →
   marcar base de datos + archivos + subir a almacenamiento remoto.
4. Esperar a que termine (con 24k productos + media puede tardar) y **verificar** que aparece
   en Google Drive y en la lista de copias existentes.

> Alternativa sin plugin: si el hosting tiene cPanel/Plesk, exportar la base de datos por
> phpMyAdmin + descargar `/wp-content/` por FTP. Requiere credenciales del hosting.

### Prompt para el Claude del navegador (Nivel 1)

```
Estás en el wp-admin de 7digits.es con mi sesión autorizada. Objetivo: dejar una copia de
seguridad completa y verificada, sin tocar nada más. Reglas: no actualices, borres ni
configures nada fuera de lo indicado; si algo falla, PARA y anótalo.

1. Plugins → Añadir nuevo → busca "UpdraftPlus" (el de UpdraftPlus.Com Ltd) → Instálalo y
   actívalo. Confirma que aparece activo.
2. Ajustes → UpdraftPlus Backups → pestaña Ajustes. Configura almacenamiento remoto en
   Google Drive: pulsa autenticar y PÁRATE cuando pida iniciar sesión de Google — avísame
   para que yo complete el login (no introduzcas credenciales tú). Si prefiero hacerlo luego,
   deja el almacenamiento en "None" por ahora y continúa con copia local.
3. Pestaña "Copia de seguridad / Restaurar" → "Copia de seguridad ahora" → marca
   "Incluir la base de datos" e "Incluir los archivos" → lánzala.
4. Espera a que el log diga "The backup apparently succeeded and is now complete".
   Verifica que aparece una entrada nueva en "Copias de seguridad existentes" con archivos
   de BD y de contenido. Anota fecha, tamaño y destino.
5. Informe: plugin instalado (sí/no), destino configurado, resultado de la copia, tamaño,
   y cualquier error. No restaures nada.
```

## Nivel 2 — Copia del catálogo (ejecutable por nosotros)

```
WC_URL=https://www.7digits.es WC_KEY=ck_nueva WC_SECRET=cs_nueva \
  node tools/backup-catalog.mjs > backups/catalogo-$(date +%F).csv
```

Exporta los ~24.000 productos a CSV (marca, MPN, SKU, categorías, precio, stock, enlace,
imagen). Los CSV se guardan en `backups/` (ignorada por git: contiene datos y no debe
publicarse). Automatizable con un workflow semanal si se desea.

## ⚠️ Antes de asumir el backup como servicio

- **Responsabilidad**: al hacernos cargo del backup, asumimos responsabilidad. Debe quedar
  por escrito en el acuerdo con el cliente (alcance, frecuencia, dónde se guarda, qué NO cubre).
- **RGPD**: un backup completo incluye datos personales (usuarios, y en el futuro clientes/
  pedidos). Si lo custodiamos nosotros, hace falta un **acuerdo de encargo de tratamiento**
  y guardarlo cifrado. Lo más limpio: que la copia se guarde en **el Drive del propio cliente**,
  no en el nuestro — así los datos no salen de su control.
- **Primer backup = red antes de tocar nada**: este backup verificado es justo la condición
  que faltaba para poder ejecutar el mantenimiento del Bloque B (actualizaciones/limpieza).
- **No es sustituto de su obligación**: recomendar además que el hosting tenga sus propias
  copias. Cuantas más capas, mejor.
