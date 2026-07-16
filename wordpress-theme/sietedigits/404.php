<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<main id="main">
<section class="phead" style="min-height:46vh;display:flex;align-items:center">
  <div class="glow-a" aria-hidden="true"></div>
  <div class="wrap">
    <div class="crumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg><b>Error 404</b></div>
    <h1>Página <span class="gword">no encontrada</span></h1>
    <p class="lead">La página que buscas no existe o ha cambiado de dirección.</p>
    <p style="margin-top:28px;display:flex;gap:14px;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Ir al inicio</a>
      <a href="<?php echo esc_url(home_url('/productos/')); ?>" class="btn btn-out">Ver productos</a>
    </p>
  </div>
</section>
</main>
<?php get_footer(); ?>
