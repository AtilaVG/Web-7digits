<?php
/**
 * Productos — catálogo nativo WooCommerce (sin sincronización: tiempo real).
 * Renderiza los 48 más recientes en stock; el JS muestra 12 y pagina con
 * "Cargar más". El catálogo completo sigue en /tienda/.
 */
if (!defined('ABSPATH')) exit;

function sd_cat_filter($cats) {
    $s = strtolower(implode(' ', $cats));
    if (preg_match('/servidor|ordenador/', $s)) return 'server';
    if (preg_match('/red|switch|router|comunicacion/', $s)) return 'network';
    if (preg_match('/almacenamiento|cabina|disco|nas|san|storage/', $s)) return 'storage';
    return 'components';
}

$productos = function_exists('wc_get_products') ? wc_get_products([
    'status' => 'publish', 'stock_status' => 'instock',
    'limit' => 48, 'orderby' => 'date', 'order' => 'DESC',
]) : [];

get_header(); ?>
<main id="main">
<section class="phead">
  <div class="glow-a" aria-hidden="true"></div>
  <div class="wrap">
    <div class="crumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg><b>Productos</b></div>
    <h1>Productos <span class="gword">disponibles</span></h1>
    <p class="lead">Stock real, listo para enviar en menos de 24 horas. Filtra por categoría o busca por marca y modelo.</p>
  </div>
</section>

<section class="sec soft-bg">
  <div class="wrap">
    <div class="cat-bar reveal">
      <div class="filters" id="filters" role="group" aria-label="Filtros de categoría">
        <button class="filter active" data-f="all">Todo</button>
        <button class="filter" data-f="server">Servidores</button>
        <button class="filter" data-f="network">Redes</button>
        <button class="filter" data-f="storage">Almacenamiento</button>
        <button class="filter" data-f="components">Componentes</button>
      </div>
      <div class="cat-tools">
        <div class="search">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
          <input type="text" id="search" placeholder="Buscar marca o modelo..." aria-label="Buscar producto">
        </div>
      </div>
    </div>

    <div class="products" id="products">
    <?php foreach ($productos as $p) :
        $cats  = wp_get_post_terms($p->get_id(), 'product_cat', ['fields' => 'names']);
        $brand = get_post_meta($p->get_id(), 'brand', true) ?: strtok($p->get_name(), ' ');
        $mpn   = get_post_meta($p->get_id(), 'MPN', true);
        $sku   = $p->get_sku();
        $img   = wp_get_attachment_image_url($p->get_image_id(), 'medium');
        $fkey  = sd_cat_filter($cats);
        $badge = ($sku && stripos($sku, '.REF') !== false) ? 'Refurbished' : 'En stock';
    ?>
      <article class="prod" data-cat="<?php echo esc_attr($fkey); ?>" data-name="<?php echo esc_attr(strtolower($p->get_name() . ' ' . $brand)); ?>">
        <?php if ($img) : ?><div class="pimg"><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($p->get_name()); ?>" loading="lazy"></div><?php endif; ?>
        <div class="top"><span class="ptype"><?php echo esc_html($cats[0] ?? 'Hardware'); ?></span><span class="badge"><?php echo esc_html($badge); ?></span></div>
        <h4><a href="<?php echo esc_url(get_permalink($p->get_id())); ?>"><?php echo esc_html($p->get_name()); ?></a></h4>
        <div class="brand"><?php echo esc_html($brand); ?></div>
        <div class="specs">
          <?php if ($mpn) : ?><div><span>Part number</span><b><?php echo esc_html($mpn); ?></b></div><?php endif; ?>
          <?php if ($sku) : ?><div><span>Referencia</span><b><?php echo esc_html($sku); ?></b></div><?php endif; ?>
        </div>
        <div class="pfoot"><div class="price"><b class="ask">Precio bajo consulta</b><span>presupuesto en &lt; 24 h</span></div>
          <a class="add" href="<?php echo esc_url(add_query_arg(['tipo' => 'compra', 'producto' => rawurlencode($p->get_name() . ' (' . $brand . ')')], home_url('/contacto/'))); ?>"
             aria-label="Pedir presupuesto de <?php echo esc_attr($p->get_name()); ?>" title="Pedir presupuesto">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4z"/></svg></a></div>
      </article>
    <?php endforeach; ?>
    </div>

    <div class="loadmore-wrap"><button class="btn btn-ghost" id="loadMore" style="display:none"><span>Cargar más</span>
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" style="transform:rotate(90deg)"><use href="#i-arrow"/></svg></button></div>

    <p class="cat-note reveal">Este es nuestro stock más reciente. Catálogo completo en <a href="<?php echo esc_url(home_url('/tienda/')); ?>">la tienda</a>, o pídenos el <i>part number</i> que necesites en <a href="<?php echo esc_url(home_url('/contacto/')); ?>">contacto</a>.</p>
  </div>
</section>
</main>
<?php get_footer(); ?>
