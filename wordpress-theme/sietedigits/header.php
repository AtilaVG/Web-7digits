<?php if (!defined('ABSPATH')) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#16233f">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-contact="<?php echo esc_url(home_url('/contacto/')); ?>">
<?php wp_body_open(); ?>


<a class="skip" href="#main">Saltar al contenido</a>
<div class="progress" id="progress"></div>

<svg width="0" height="0" style="position:absolute" aria-hidden="true"><defs>
<g id="mark7d">
  <path d="M14 4 L26 4 L20 40 L8 40 Z" fill="#1c2c4c"/>
  <path d="M22 4 L34 4 L29 30 L17 30 Z" fill="#5fae27"/>
  <path d="M30 4 L40 4 L36 22 L26 22 Z" fill="#8cc63f"/>
  <path d="M16 22 L34 22 L29 40 L11 40 Z" fill="#3aa0db"/>
  <path d="M30 6 L40 6 L37 16 L27 16 Z" fill="#aab4c2"/>
</g>
<g id="i-check"><path d="M5 12l4 4 10-11" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></g>
<g id="i-arrow"><path d="M5 12h14M13 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></g>
<g id="i-shield"><path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M9 12l2 2 4-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></g>
<g id="i-server"><rect x="3" y="4" width="18" height="5" rx="1" fill="none" stroke="currentColor" stroke-width="1.7"/><rect x="3" y="11" width="18" height="5" rx="1" fill="none" stroke="currentColor" stroke-width="1.7"/><circle cx="7" cy="6.5" r=".7" fill="currentColor"/><circle cx="7" cy="13.5" r=".7" fill="currentColor"/><path d="M7 19.5h10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></g>
</defs></svg>

<div class="topbar">
  <div class="wrap">
    <div class="ti">
      <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><i id="today" style="font-style:normal"></i></span>
      <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3-8.6A2 2 0 014.1 2h3a2 2 0 012 1.7c.1.9.3 1.8.6 2.6a2 2 0 01-.4 2.1L8 9.5a16 16 0 006 6l1.1-1.1a2 2 0 012.1-.4c.8.3 1.7.5 2.6.6a2 2 0 011.7 2z"/></svg><a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', sd_opt('telefono', '+34915458992'))); ?>"><?php echo esc_html(sd_opt('telefono', '+34 91 545 89 92')); ?></a><span class="sched">&nbsp;· <?php echo esc_html(sd_opt('horario', 'De 9:00h a 19:00h')); ?></span></span>
      <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg><a href="mailto:<?php echo esc_attr(sd_opt('email', 'info@7digits.es')); ?>"><?php echo esc_html(sd_opt('email', 'info@7digits.es')); ?></a></span>
    </div>
    <div class="soc">
      <a href="<?php echo esc_url(sd_opt('facebook', 'https://www.facebook.com/7DSpain/')); ?>" target="_blank" rel="noopener" aria-label="Facebook (se abre en pestaña nueva)"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 9h3V5h-3c-2.2 0-4 1.8-4 4v2H7v4h3v6h4v-6h3l1-4h-4V9c0-.6.4-1 1-1z"/></svg></a>
      <a href="<?php echo esc_url(sd_opt('linkedin', '#')); ?>" target="_blank" rel="noopener" aria-label="LinkedIn (se abre en pestaña nueva)"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M6 9v9H3V9h3zM4.5 3.5A1.5 1.5 0 114.5 6.5 1.5 1.5 0 014.5 3.5zM9 9h3v1.4c.5-.9 1.6-1.6 3-1.6 2.3 0 3 1.5 3 3.7V18h-3v-4.8c0-1.1-.4-1.7-1.3-1.7-1 0-1.7.7-1.7 2V18H9V9z"/></svg></a>
    </div>
  </div>
</div>

<header id="hdr">
  <div class="wrap">
    <nav aria-label="Principal">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" aria-label="7Digits — Inicio">
        <svg class="mark" viewBox="0 0 48 44"><use href="#mark7d"/></svg>
        <div class="wm">7<span class="d">Di</span>GITS<small>ICT remarketing</small></div>
      </a>
      <div class="nav-links">
        <a href="<?php echo esc_url(home_url('/')); ?>"<?php if (is_front_page()) echo ' class="active" aria-current="page"'; ?>>Inicio</a>
        <a href="<?php echo esc_url(home_url('/actividad/')); ?>"<?php if (is_page('actividad')) echo ' class="active" aria-current="page"'; ?>>Actividad</a>
        <a href="<?php echo esc_url(home_url('/compramos-servidores/')); ?>"<?php if (is_page('compramos-servidores')) echo ' class="active" aria-current="page"'; ?>>Compras</a>
        <a href="<?php echo esc_url(home_url('/productos/')); ?>"<?php if (is_page('productos')) echo ' class="active" aria-current="page"'; ?>>Productos</a>
        <a href="<?php echo esc_url(home_url('/destruccion-de-datos/')); ?>"<?php if (is_page('destruccion-de-datos')) echo ' class="active" aria-current="page"'; ?>>Destrucción de datos</a>
        <a href="<?php echo esc_url(home_url('/medio-ambiente/')); ?>"<?php if (is_page('medio-ambiente')) echo ' class="active" aria-current="page"'; ?>>Medio ambiente</a>
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>"<?php if (is_page('contacto')) echo ' class="active" aria-current="page"'; ?>>Contacto</a>
      </div>
      <div class="nav-r">
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-primary">Solicitar presupuesto</a>
        <button class="burger" id="burger" aria-label="Abrir menú" aria-expanded="false"><span></span><span></span><span></span></button>
      </div>
    </nav>
  </div>
</header>
<div class="overlay" id="overlay"></div>
<div class="mobile-menu" id="mmenu" aria-label="Menú móvil">
  <button class="mm-close" id="mmClose" aria-label="Cerrar menú"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M6 6l12 12M18 6L6 18"/></svg></button>
  <a href="<?php echo esc_url(home_url('/')); ?>"<?php if (is_front_page()) echo ' class="active" aria-current="page"'; ?>>Inicio</a><a href="<?php echo esc_url(home_url('/actividad/')); ?>"<?php if (is_page('actividad')) echo ' class="active" aria-current="page"'; ?>>Actividad</a><a href="<?php echo esc_url(home_url('/compramos-servidores/')); ?>"<?php if (is_page('compramos-servidores')) echo ' class="active" aria-current="page"'; ?>>Compras</a><a href="<?php echo esc_url(home_url('/productos/')); ?>"<?php if (is_page('productos')) echo ' class="active" aria-current="page"'; ?>>Productos</a><a href="<?php echo esc_url(home_url('/destruccion-de-datos/')); ?>"<?php if (is_page('destruccion-de-datos')) echo ' class="active" aria-current="page"'; ?>>Destrucción de datos</a><a href="<?php echo esc_url(home_url('/medio-ambiente/')); ?>"<?php if (is_page('medio-ambiente')) echo ' class="active" aria-current="page"'; ?>>Medio ambiente</a><a href="<?php echo esc_url(home_url('/contacto/')); ?>"<?php if (is_page('contacto')) echo ' class="active" aria-current="page"'; ?>>Contacto</a>
  <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-primary">Solicitar presupuesto</a>
</div>

