<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<main id="main">
<section class="phead">
  <div class="glow-a" aria-hidden="true"></div>
  <div class="wrap">
    <div class="crumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg><b><?php the_title(); ?></b></div>
    <h1><?php the_title(); ?></h1>
  </div>
</section>
<section class="sec"><div class="wrap"><div class="legal">
<?php while (have_posts()) { the_post(); the_content(); } ?>
</div></div></section>
</main>
<?php get_footer(); ?>
