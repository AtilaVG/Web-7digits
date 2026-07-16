<?php get_header(); ?>
<main id="main">
<section class="phead"><div class="glow-a" aria-hidden="true"></div><div class="wrap">
<h1><?php the_title(); ?></h1></div></section>
<section class="sec"><div class="wrap"><div class="legal">
<?php while (have_posts()) { the_post(); the_content(); } ?>
</div></div></section>
</main>
<?php get_footer(); ?>
