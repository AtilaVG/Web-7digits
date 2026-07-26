<?php
/**
 * Productos — catálogo WooCommerce con paginación numerada (100 por página).
 * Consulta el catálogo completo en el servidor; filtros por macro-categoría y
 * búsqueda por nombre funcionan sobre TODOS los productos, no solo los cargados.
 * Parámetros de URL: ?f=server|network|storage|components  ?q=texto  ?pg=N
 */
if (!defined('ABSPATH')) exit;

$per_page = 100;
$paged = max(1, (int) ($_GET['pg'] ?? 1));
$f     = sanitize_key($_GET['f'] ?? 'all');
$q     = sanitize_text_field($_GET['q'] ?? '');
$allowed_f = ['all', 'server', 'network', 'storage', 'components'];
if (!in_array($f, $allowed_f, true)) $f = 'all';

$args = [
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => $per_page,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_query'     => [['key' => '_stock_status', 'value' => 'instock']],
];
if ($q) $args['s'] = $q;
if ($f !== 'all') {
    $slugs = sd_macro_cat_slugs($f);
    if ($slugs) $args['tax_query'] = [['taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => $slugs]];
}
$query = new WP_Query($args);

/* URL base para conservar filtro y búsqueda al paginar y cambiar de filtro. */
$keep = array_filter(['f' => $f !== 'all' ? $f : null, 'q' => $q !== '' ? $q : null]);
$filter_url = function ($ff) use ($q) {
    return esc_url(add_query_arg(array_filter(['f' => $ff !== 'all' ? $ff : null, 'q' => $q !== '' ? $q : null]), home_url('/productos/')));
};

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
<?php sd_page_intro(); ?>

<section class="sec soft-bg">
  <div class="wrap">
    <div class="cat-bar reveal">
      <div class="filters" role="group" aria-label="Filtros de categoría">
        <a class="filter<?php echo $f === 'all' ? ' active' : ''; ?>" href="<?php echo $filter_url('all'); ?>">Todo</a>
        <a class="filter<?php echo $f === 'server' ? ' active' : ''; ?>" href="<?php echo $filter_url('server'); ?>">Servidores</a>
        <a class="filter<?php echo $f === 'network' ? ' active' : ''; ?>" href="<?php echo $filter_url('network'); ?>">Redes</a>
        <a class="filter<?php echo $f === 'storage' ? ' active' : ''; ?>" href="<?php echo $filter_url('storage'); ?>">Almacenamiento</a>
        <a class="filter<?php echo $f === 'components' ? ' active' : ''; ?>" href="<?php echo $filter_url('components'); ?>">Componentes</a>
      </div>
      <form class="cat-tools" method="get" action="<?php echo esc_url(home_url('/productos/')); ?>">
        <?php if ($f !== 'all') : ?><input type="hidden" name="f" value="<?php echo esc_attr($f); ?>"><?php endif; ?>
        <div class="search">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
          <input type="text" name="q" value="<?php echo esc_attr($q); ?>" placeholder="Buscar marca o modelo..." aria-label="Buscar producto">
        </div>
      </form>
    </div>

    <?php if ($query->have_posts()) : ?>
    <p class="cat-count reveal"><?php echo number_format_i18n($query->found_posts); ?> productos<?php echo $q ? ' para «' . esc_html($q) . '»' : ''; ?> · página <?php echo $paged; ?> de <?php echo (int) $query->max_num_pages; ?></p>
    <div class="products">
    <?php while ($query->have_posts()) : $query->the_post();
        $p = wc_get_product(get_the_ID());
        if (!$p) continue;
        $cats  = wp_get_post_terms(get_the_ID(), 'product_cat', ['fields' => 'names']);
        $brand = get_post_meta(get_the_ID(), 'brand', true) ?: strtok($p->get_name(), ' ');
        $mpn   = get_post_meta(get_the_ID(), 'MPN', true);
        $sku   = $p->get_sku();
        $img   = wp_get_attachment_image_url($p->get_image_id(), 'medium');
        $badge = ($sku && stripos($sku, '.REF') !== false) ? 'Refurbished' : 'En stock';
    ?>
      <article class="prod">
        <?php if ($img) : ?><div class="pimg"><img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($p->get_name()); ?>" loading="lazy"></div><?php endif; ?>
        <div class="top"><span class="ptype"><?php echo esc_html($cats[0] ?? 'Hardware'); ?></span><span class="badge"><?php echo esc_html($badge); ?></span></div>
        <h4><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($p->get_name()); ?></a></h4>
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
    <?php endwhile; ?>
    </div>

    <?php
    $links = paginate_links([
        'total'     => (int) $query->max_num_pages,
        'current'   => $paged,
        'base'      => home_url('/productos/') . '%_%',
        'format'    => '?pg=%#%',
        'add_args'  => $keep,
        'prev_text' => '‹ Anterior',
        'next_text' => 'Siguiente ›',
        'mid_size'  => 2,
        'end_size'  => 1,
    ]);
    if ($links) echo '<nav class="pager" aria-label="Paginación de productos">' . $links . '</nav>';
    ?>

    <?php else : ?>
    <div class="empty">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4M8 11h6"/></svg>
      Sin resultados<?php echo $q ? ' para «' . esc_html($q) . '»' : ''; ?>.<br>
      Localizamos cualquier <i>part number</i>: <a href="<?php echo esc_url(home_url('/contacto/')); ?>" style="color:var(--blue);font-weight:700">pídenos presupuesto</a>.
    </div>
    <?php endif; wp_reset_postdata(); ?>

    <p class="cat-note reveal">¿No encuentras lo que buscas? Localizamos el <i>part number</i> o la pieza que necesites. <a href="<?php echo esc_url(home_url('/contacto/')); ?>">Pídenos presupuesto</a>.</p>
  </div>
</section>
</main>
<?php get_footer(); ?>
