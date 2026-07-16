<?php
/**
 * Envoltorio para todas las vistas de WooCommerce (tienda, categorías y las
 * ~24.000 fichas de producto ya indexadas): conservan su URL y contenido,
 * servidas con la cabecera y pie del nuevo diseño.
 */
if (!defined('ABSPATH')) exit;
get_header(); ?>
<main id="main">
<section class="phead">
  <div class="glow-a" aria-hidden="true"></div>
  <div class="wrap">
    <div class="crumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg><b><?php echo function_exists('woocommerce_page_title') ? esc_html(woocommerce_page_title(false)) : 'Tienda'; ?></b></div>
    <h1><?php echo function_exists('woocommerce_page_title') ? esc_html(woocommerce_page_title(false)) : 'Tienda'; ?></h1>
  </div>
</section>
<section class="sec"><div class="wrap"><?php woocommerce_content(); ?></div></section>
</main>
<?php get_footer(); ?>
