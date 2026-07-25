<?php
/**
 * Siete Digits — funciones del tema.
 */
if (!defined('ABSPATH')) exit;

require get_template_directory() . '/inc/customizer.php';

/* Texto editable con valor por defecto (Personalizador). */
function sd_opt($key, $default = '') {
    $v = get_theme_mod('sd_' . $key, $default);
    return $v === '' ? $default : $v;
}

/* ── Redirecciones 301 de URLs antiguas (Jupiter/WPBakery) a las páginas nuevas ──
   Doble función: implementa la migración SEO (docs/migracion-seo.md) Y evita que las
   páginas viejas del constructor lleguen a renderizarse (causa de los fatales de Jupiter),
   porque template_redirect actúa antes de cargar la plantilla y el contenido. */
add_action('template_redirect', function () {
    if (is_admin()) return;
    $map = [
        'presupuesto'              => '/contacto/',
        'presupuesto-2'            => '/contacto/',
        'contacto-7digits'         => '/contacto/',
        'quote-request'            => '/contacto/',
        'request-a-quote'          => '/contacto/',
        'request-quote'            => '/contacto/',
        'contact-list'             => '/contacto/',
        'servidores-y-componentes' => '/productos/',
        'stock-actualizado'        => '/productos/',
        'ley-de-cookies'           => '/privacidad/',
    ];
    $path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
    $first = strtolower(explode('/', $path)[0]);
    if (isset($map[$first])) {
        $target_slug = trim($map[$first], '/');
        // Guarda anti-bucle: solo redirige si el destino es una página distinta
        // y ya existe publicada. Evita el loop cuando el destino aún no se ha
        // creado (p. ej. en vista previa antes de activar el tema).
        if ($first !== $target_slug && get_page_by_path($target_slug)) {
            wp_redirect(home_url($map[$first]), 301);
            exit;
        }
    }
}, 1);

/* ── SEO: metadatos de Yoast por página (título, descripción, frase clave) ──
   Las páginas del tema no llevan contenido en el editor (el diseño vive en las
   plantillas), así que Yoast no tenía nada que analizar y puntuaba en rojo, y
   —lo importante— la meta descripción y el título SEO quedaban sin definir.
   Aquí se fijan valores óptimos por página. Se re-aplica al actualizar el tema. */
function sd_seo_data() {
    return [
        ''                       => [
            'kw'    => 'servidores refurbished',
            'title' => '7Digits · Servidores y componentes refurbished en Madrid | Envío 24h',
            'desc'  => 'Venta de servidores y hardware refurbished de las marcas líderes. Más de 20.000 productos en stock, destrucción certificada de datos y economía circular TIC. Envío en 24h.',
        ],
        'productos'              => [
            'kw'    => 'servidores y componentes refurbished',
            'title' => 'Productos: servidores, redes y componentes refurbished | 7Digits',
            'desc'  => 'Catálogo de servidores, switches, almacenamiento y componentes refurbished de Cisco, HPE, Dell y más. Stock real con envío en 24 horas y presupuesto en menos de 24h.',
        ],
        'compramos-servidores'   => [
            'kw'    => 'compramos servidores',
            'title' => 'Compramos servidores y material TIC que ya no uses | 7Digits',
            'desc'  => 'Compramos servidores, componentes, redes, almacenamiento y racks completos. Envía tu inventario y recibe una oferta económica en menos de 24 horas. Retirada y borrado incluidos.',
        ],
        'destruccion-de-datos'   => [
            'kw'    => 'destrucción certificada de datos',
            'title' => 'Destrucción certificada de datos · Borrado seguro de soportes | 7Digits',
            'desc'  => 'Borrado por software, destrucción física y desmagnetización con certificado por unidad y trazabilidad por número de serie. On-site o en nuestras instalaciones de Madrid.',
        ],
        'medio-ambiente'         => [
            'kw'    => 'economía circular TIC',
            'title' => 'Medio ambiente · Economía circular TIC y escalera de Lansink | 7Digits',
            'desc'  => 'Priorizamos la reutilización del hardware siguiendo la escalera de Lansink y gestionamos lo no reutilizable con recicladores autorizados conforme a la directiva RAEE/WEEE.',
        ],
        'actividad'              => [
            'kw'    => 'logística inversa TIC',
            'title' => 'Actividad: hardware refurbished, ITAD y economía circular | 7Digits',
            'desc'  => 'Compra y venta de hardware refurbished, logística inversa, destrucción certificada de datos y localización de piezas. Tratamos el hardware de centros de datos y empresas.',
        ],
        'servidores-refurbished' => [
            'kw'    => 'servidores refurbished',
            'title' => '¿Qué son los servidores refurbished? Guía completa | 7Digits',
            'desc'  => 'Qué es un servidor refurbished, cómo se reacondiciona, qué garantía tiene y cuánto ahorras frente a comprar nuevo. Guía de 7Digits, especialistas en hardware reacondicionado.',
        ],
        'contacto'               => [
            'kw'    => 'presupuesto servidores refurbished',
            'title' => 'Contacto · Solicita tu presupuesto | 7Digits España',
            'desc'  => 'Solicita presupuesto de compra, venta, retirada de hardware o destrucción de datos. C/ Euclides 11, Alcalá de Henares (Madrid). Respuesta en menos de 24 horas laborables.',
        ],
    ];
}

/* Contenido introductorio real (editable e indexable) para cada página.
   Da a Yoast texto que analizar y al cliente algo que editar; se renderiza
   con sd_page_intro() en cada plantilla. */
function sd_intro_content() {
    return [
        'productos' => '<p>En <strong>7Digits</strong> encontrarás <strong>servidores y componentes refurbished</strong> de las marcas líderes —Cisco, HPE, Dell, Brocade, D-Link e Intel— con stock real y envío en menos de 24 horas a toda España. Todo nuestro material está revisado, testado y con garantía. Filtra por categoría o busca por marca y modelo, y si no encuentras una pieza concreta te la localizamos por su <em>part number</em>.</p>',
        'compramos-servidores' => '<p><strong>Compramos servidores</strong> y todo tipo de material TIC que tu empresa ya no necesite: componentes, equipos de red, almacenamiento y racks completos, de cualquier marca. Envíanos tu inventario y recibirás una oferta económica en menos de 24 horas, con retirada y borrado certificado de datos incluidos. Damos una segunda vida a tu hardware dentro de la economía circular.</p>',
        'destruccion-de-datos' => '<p>La <strong>destrucción certificada de datos</strong> de 7Digits garantiza que tu información no vuelve: borrado por software, destrucción física o desmagnetización, con un certificado nominal por cada unidad y trazabilidad por número de serie. Realizamos el proceso on-site en tu empresa o en nuestras instalaciones de Alcalá de Henares, según el nivel de sensibilidad de tus soportes.</p>',
        'medio-ambiente' => '<p>Nuestra actividad se apoya en la <strong>economía circular TIC</strong>: siguiendo la escalera de Lansink, priorizamos la reutilización del hardware para alargar su vida útil y gestionamos lo no reutilizable con recicladores autorizados, conforme a la directiva <strong>RAEE/WEEE</strong>. Cada equipo que reutilizamos es un equipo que no hay que fabricar, con el ahorro de materias primas y energía que ello supone.</p>',
        'actividad' => '<p>7Digits es una empresa especializada en <strong>logística inversa TIC</strong>: tratamos el hardware de centros de datos y empresas de principio a fin. Vendemos servidores y componentes refurbished, compramos y retiramos material en desuso, realizamos destrucción certificada de datos y localizamos piezas concretas. Un único partner para todo el ciclo de vida de tu equipamiento informático.</p>',
        'contacto' => '<p>¿Necesitas un <strong>presupuesto de servidores refurbished</strong>, vender tu hardware o destruir datos de forma certificada? Escríbenos y un técnico de 7Digits te responderá en menos de 24 horas laborables. Estamos en C/ Euclides 11, Alcalá de Henares (Madrid).</p>',
    ];
}

/* Renderiza el contenido del editor (si lo hay) como sección introductoria. */
function sd_page_intro() {
    $id = get_queried_object_id();
    $raw = $id ? get_post_field('post_content', $id) : '';
    if (!trim($raw)) return;
    echo '<section class="sec"><div class="wrap"><div class="sd-intro">'
       . apply_filters('the_content', $raw)
       . '</div></div></section>';
}

function sd_apply_seo_meta() {
    foreach (sd_seo_data() as $slug => $d) {
        $page = $slug === '' ? get_page_on_front_id() : get_page_by_path($slug);
        $id = is_object($page) ? $page->ID : (int) $page;
        if (!$id) continue;
        // No pisar valores que el cliente haya personalizado a mano (solo rellenar vacíos).
        if (!get_post_meta($id, '_yoast_wpseo_focuskw', true))  update_post_meta($id, '_yoast_wpseo_focuskw', $d['kw']);
        if (!get_post_meta($id, '_yoast_wpseo_title', true))    update_post_meta($id, '_yoast_wpseo_title', $d['title'] . ' %%sep%% %%sitename%%');
        if (!get_post_meta($id, '_yoast_wpseo_metadesc', true)) update_post_meta($id, '_yoast_wpseo_metadesc', $d['desc']);
    }
    // Contenido introductorio: rellenar si está vacío o contiene shortcodes del constructor viejo.
    foreach (sd_intro_content() as $slug => $html) {
        $page = get_page_by_path($slug);
        if (!$page) continue;
        $cur = (string) $page->post_content;
        if (trim($cur) === '' || strpos($cur, '[vc_') !== false || strpos($cur, '[mk_') !== false) {
            wp_update_post(['ID' => $page->ID, 'post_content' => $html]);
        }
    }
}
function get_page_on_front_id() { return (int) get_option('page_on_front'); }

/* Ejecutar al activar el tema y una sola vez tras cada actualización de versión. */
add_action('after_switch_theme', 'sd_apply_seo_meta');
add_action('admin_init', function () {
    $v = wp_get_theme()->get('Version');
    if (get_option('sd_seo_applied_v') !== $v) {
        sd_apply_seo_meta();
        update_option('sd_seo_applied_v', $v);
    }
});

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
});

/* ── Carga de estilos y scripts (solo lo que usa cada plantilla) ── */
add_action('wp_enqueue_scripts', function () {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    $css = function ($h, $p) use ($dir, $uri) {
        wp_enqueue_style("sd-$h", "$uri/assets/css/$p", [], @filemtime("$dir/assets/css/$p"));
    };
    $js = function ($h, $p) use ($dir, $uri) {
        wp_enqueue_script("sd-$h", "$uri/assets/js/$p", [], @filemtime("$dir/assets/js/$p"), true);
    };
    foreach (['fonts', 'base', 'layout', 'components'] as $c) $css($c, "$c.css");
    $js('core', 'core.js');

    if (is_front_page()) {
        $css('scrolly', 'scrolly.css'); $css('home', 'pages/home.css'); $js('home', 'pages/home.js');
    } elseif (is_page('productos')) {
        $css('productos', 'pages/productos.css'); $js('productos', 'productos-wp.js');
    } elseif (is_page('compramos-servidores')) {
        $css('actividad', 'pages/actividad.css'); $js('compras', 'pages/compras.js');
    } elseif (is_page('actividad')) {
        $css('actividad', 'pages/actividad.css'); $js('actividad', 'pages/actividad.js');
    } elseif (is_page('destruccion-de-datos')) {
        $css('scrolly', 'scrolly.css'); $css('destruccion', 'pages/destruccion.css'); $js('destruccion', 'pages/destruccion.js');
    } elseif (is_page('medio-ambiente')) {
        $css('actividad', 'pages/actividad.css'); $css('medioambiente', 'pages/medioambiente.css');
    } elseif (is_page('contacto')) {
        $css('contacto', 'pages/contacto.css'); $js('contacto', 'pages/contacto.js');
    }
});

/* ── Páginas del sitio: se crean solas al activar el tema ── */
add_action('after_switch_theme', function () {
    $pages = [
        'actividad'             => 'Actividad',
        'compramos-servidores'  => 'Compramos servidores',
        'productos'             => 'Productos disponibles',
        'destruccion-de-datos'  => 'Destrucción de datos',
        'medio-ambiente'        => 'Medio ambiente',
        'servidores-refurbished'=> '¿Qué son los servidores refurbished?',
        'contacto'              => 'Contacto',
        'aviso-legal'           => 'Aviso legal',
        'privacidad'            => 'Política de privacidad',
    ];
    foreach ($pages as $slug => $title) {
        if (!get_page_by_path($slug)) {
            wp_insert_post(['post_type' => 'page', 'post_status' => 'publish',
                'post_name' => $slug, 'post_title' => $title]);
        }
    }
});

/* ── Formulario de contacto: envío por wp_mail (usa el WP Mail SMTP existente) ── */
function sd_contact_handler() {
    if (!isset($_POST['sd_nonce']) || !wp_verify_nonce($_POST['sd_nonce'], 'sd_contact')) wp_die('Sesión caducada, vuelve atrás e inténtalo de nuevo.');
    if (!empty($_POST['sd_hp'])) { wp_safe_redirect(home_url('/contacto/')); exit; } // honeypot anti-spam

    $nombre  = sanitize_text_field($_POST['nombre'] ?? '');
    $empresa = sanitize_text_field($_POST['empresa'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $tel     = sanitize_text_field($_POST['tel'] ?? '');
    $tipo    = sanitize_text_field($_POST['tipo'] ?? '');
    $msg     = sanitize_textarea_field($_POST['msg'] ?? '');
    if (!$nombre || !is_email($email) || !$tipo) { wp_safe_redirect(add_query_arg('error', '1', wp_get_referer() ?: home_url('/contacto/'))); exit; }

    $to   = sd_opt('email', 'info@7digits.es');
    $body = "Nueva solicitud desde la web:\n\nNombre: $nombre\nEmpresa: $empresa\nEmail: $email\nTeléfono: $tel\nTipo: $tipo\n\nMensaje:\n$msg";
    wp_mail($to, "[Web] Solicitud de presupuesto — $tipo", $body, ["Reply-To: $nombre <$email>"]);
    wp_safe_redirect(add_query_arg('enviado', '1', home_url('/contacto/'))); exit;
}
add_action('admin_post_sd_contact', 'sd_contact_handler');
add_action('admin_post_nopriv_sd_contact', 'sd_contact_handler');
