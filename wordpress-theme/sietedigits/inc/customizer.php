<?php
/**
 * Personalizador: los textos que el cliente edita desde wp-admin
 * (Apariencia → Personalizar). Cada campo tiene el texto actual por defecto.
 */
if (!defined('ABSPATH')) exit;

add_action('customize_register', function ($wp) {

    $add = function ($section, $key, $label, $default, $type = 'text') use ($wp) {
        $wp->add_setting("sd_$key", ['default' => $default, 'sanitize_callback' => $type === 'html' ? 'wp_kses_post' : 'sanitize_text_field']);
        $wp->add_control("sd_$key", ['label' => $label, 'section' => $section, 'type' => $type === 'textarea' || $type === 'html' ? 'textarea' : $type]);
    };

    /* ─ Datos de contacto (aparecen en topbar, contacto y footer) ─ */
    $wp->add_section('sd_contacto', ['title' => '7Digits · Datos de contacto', 'priority' => 20]);
    $add('sd_contacto', 'telefono',   'Teléfono', '+34 91 545 89 92');
    $add('sd_contacto', 'horario',    'Horario', 'De 9:00h a 19:00h');
    $add('sd_contacto', 'email',      'Email de contacto (recibe el formulario)', 'info@7digits.es');
    $add('sd_contacto', 'direccion1', 'Dirección — línea 1', 'C/ Euclides, 11 — Módulo 1, Nave 4');
    $add('sd_contacto', 'direccion2', 'Dirección — línea 2', '28806 Alcalá de Henares · Madrid · España');
    $add('sd_contacto', 'facebook',   'URL de Facebook', 'https://www.facebook.com/7DSpain/');
    $add('sd_contacto', 'linkedin',   'URL de LinkedIn', 'https://es.linkedin.com/company/7digits-espa%C3%B1a');

    /* ─ Portada ─ */
    $wp->add_section('sd_portada', ['title' => '7Digits · Portada', 'priority' => 21]);
    $add('sd_portada', 'hero_badge',  'Etiqueta superior del hero', 'Logística inversa TIC · ITAD certificado');
    $add('sd_portada', 'hero_titulo', 'Título del hero (admite HTML)', 'Venta de servidores y <span class="gword">componentes</span> refurbished', 'html');
    $add('sd_portada', 'hero_sub',    'Subtítulo del hero', 'Servidores, redes y almacenamiento refurbished de las marcas líderes. Más de 10.000 productos en stock con envío en menos de 24 horas a toda España.', 'textarea');
    $add('sd_portada', 'stat1_num',   'Dato 1 — número', '10000');
    $add('sd_portada', 'stat1_txt',   'Dato 1 — etiqueta', 'Productos en stock');
    $add('sd_portada', 'stat2_num',   'Dato 2 — número', '24');
    $add('sd_portada', 'stat2_txt',   'Dato 2 — etiqueta', 'Envío express');
    $add('sd_portada', 'stat3_num',   'Dato 3 — número', '100');
    $add('sd_portada', 'stat3_txt',   'Dato 3 — etiqueta', 'Borrado certificado');
    $add('sd_portada', 'cta_titulo',  'CTA final — título', '¿Tienes hardware que ya no usas?');
    $add('sd_portada', 'cta_texto',   'CTA final — texto', 'Lo retiramos, borramos tus datos de forma certificada y te hacemos la mejor oferta del mercado. Respuesta en menos de 24 horas.', 'textarea');

    /* ─ Textos generales ─ */
    $wp->add_section('sd_general', ['title' => '7Digits · Textos generales', 'priority' => 22]);
    $add('sd_general', 'footer_desc', 'Descripción del footer', 'Logística inversa de componentes informáticos. Hardware empresarial refurbished, destrucción certificada de datos y economía circular TIC.', 'textarea');
    $add('sd_general', 'nota_legal',  'Nota de propiedad (footer)', 'Todos los logos, gráficos, textos, imágenes y marcas que aparecen en este sitio web pertenecen a sus propietarios.', 'textarea');
});
