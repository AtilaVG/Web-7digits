<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<main id="main">
<section class="phead">
  <div class="glow-a" aria-hidden="true"></div>
  <div class="wrap">
    <div class="crumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg><b>Contacto</b></div>
    <h1>Solicita tu <span class="gword">presupuesto</span></h1>
    <p class="lead">Compra, venta, retirada o destrucción de datos: cuéntanos qué necesitas y un técnico te responderá en menos de 24 horas laborables.</p>
  </div>
</section>

<section class="sec" id="contact-form">
  <div class="wrap">
    <div class="contact-grid">
      <div class="reveal rv-l">
        <div class="ci"><div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
          <div><div class="lab">Instalaciones</div><div class="v"><?php echo esc_html(sd_opt('direccion1', '')); ?></div><div class="v sm"><?php echo esc_html(sd_opt('direccion2', '')); ?></div></div></div>
        <div class="ci"><div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M22 16.9v3a2 2 0 01-2.2 2 19.8 19.8 0 01-8.6-3 19.5 19.5 0 01-6-6 19.8 19.8 0 01-3-8.6A2 2 0 014.1 2h3a2 2 0 012 1.7c.1.9.3 1.8.6 2.6a2 2 0 01-.4 2.1L8 9.5a16 16 0 006 6l1.1-1.1a2 2 0 012.1-.4c.8.3 1.7.5 2.6.6a2 2 0 011.7 2z"/></svg></div>
          <div><div class="lab">Teléfono</div><div class="v"><a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', sd_opt('telefono', ''))); ?>"><?php echo esc_html(sd_opt('telefono', '')); ?></a></div><div class="v sm"><?php echo esc_html(sd_opt('horario', '')); ?></div></div></div>
        <div class="ci"><div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></div>
          <div><div class="lab">Email</div><div class="v"><a href="mailto:<?php echo esc_attr(sd_opt('email', '')); ?>"><?php echo esc_html(sd_opt('email', '')); ?></a></div></div></div>
        <div class="ci" style="border:0"><div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
          <div><div class="lab">Respuesta</div><div class="v">&lt; 24 h laborables</div></div></div>
      </div>
      <form id="quoteForm" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" data-native="1" novalidate class="reveal rv-r">
        <input type="hidden" name="action" value="sd_contact">
        <?php wp_nonce_field('sd_contact', 'sd_nonce'); ?>
        <input type="text" name="sd_hp" value="" style="position:absolute;left:-9999px" tabindex="-1" aria-hidden="true" autocomplete="off">
        <div id="formFields"<?php if (isset($_GET['enviado'])) echo ' style="display:none"'; ?>>
          <div class="fgrid">
            <div class="fg"><label for="f-nombre">Nombre*</label><input id="f-nombre" type="text" name="nombre" placeholder="Tu nombre" autocomplete="name"><span class="msg">Indica tu nombre</span></div>
            <div class="fg"><label for="f-empresa">Empresa</label><input id="f-empresa" type="text" name="empresa" placeholder="Tu empresa" autocomplete="organization"></div>
          </div>
          <div class="fgrid">
            <div class="fg"><label for="f-email">Email*</label><input id="f-email" type="email" name="email" placeholder="correo@empresa.com" autocomplete="email"><span class="msg">Email no válido</span></div>
            <div class="fg"><label for="f-tel">Teléfono</label><input id="f-tel" type="tel" name="tel" placeholder="+34 ..." autocomplete="tel"></div>
          </div>
          <div class="fg"><label for="f-tipo">Tipo de solicitud*</label>
            <select id="f-tipo" name="tipo"><option value="">Selecciona una opción</option><option>Compra de hardware</option><option>Venta / retirada de hardware</option><option>Destrucción de datos</option><option>Otro</option></select>
            <span class="msg">Selecciona un tipo</span></div>
          <div class="fg full"><label for="f-msg">Mensaje</label><textarea id="f-msg" name="msg" placeholder="Cuéntanos qué necesitas..."></textarea></div>
          <button type="submit" class="btn btn-primary">Enviar solicitud
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4z"/></svg></button>
          <p class="form-note">Al enviar aceptas nuestra <a href="<?php echo esc_url(home_url('/privacidad/')); ?>">política de privacidad</a>. No compartimos tus datos con terceros.</p>
        </div>
        <div class="form-ok<?php if (isset($_GET['enviado'])) echo ' show'; ?>" id="formOk">
          <div class="ring"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6"><path d="M20 6L9 17l-5-5"/></svg></div>
          <h3>¡Solicitud recibida!</h3><p>Un técnico de 7Digits te responderá en menos de 24 h laborables.</p>
        </div>
      </form>
    </div>
    <div class="map reveal">
      <iframe title="Mapa: 7Digits, C/ Euclides 11, Alcalá de Henares"
        src="https://www.google.com/maps?q=C%2F%20Euclides%2011%2C%2028806%20Alcal%C3%A1%20de%20Henares&output=embed"
        loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
    </div>
    <p class="map-note reveal">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="M21 10c0 6-9 12-9 12s-9-6-9-12a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
      C/ Euclides, 11 — Módulo 1, Nave 4 · 28806 Alcalá de Henares (Madrid).
      <a href="https://www.google.com/maps/dir/?api=1&amp;destination=C%2F%20Euclides%2011%2C%2028806%20Alcal%C3%A1%20de%20Henares" target="_blank" rel="noopener">Cómo llegar</a>
    </p>
  </div>
</section>
</main>
<?php get_footer(); ?>
