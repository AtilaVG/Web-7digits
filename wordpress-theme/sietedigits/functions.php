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
        wp_redirect(home_url($map[$first]), 301);
        exit;
    }
}, 1);

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
