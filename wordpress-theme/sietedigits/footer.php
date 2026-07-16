<footer>
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <div class="logo"><svg class="mark" viewBox="0 0 48 44"><use href="#mark7d"/></svg><div class="wm">7<span class="d">Di</span>GITS<small>ICT remarketing</small></div></div>
        <p><?php echo esc_html(sd_opt('footer_desc', 'Logística inversa de componentes informáticos.')); ?></p>
        <div class="foot-soc">
          <a href="<?php echo esc_url(sd_opt('facebook', '#')); ?>" target="_blank" rel="noopener" aria-label="Facebook (se abre en pestaña nueva)"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 9h3V5h-3c-2.2 0-4 1.8-4 4v2H7v4h3v6h4v-6h3l1-4h-4V9c0-.6.4-1 1-1z"/></svg></a>
          <a href="<?php echo esc_url(sd_opt('linkedin', '#')); ?>" target="_blank" rel="noopener" aria-label="LinkedIn (se abre en pestaña nueva)"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M6 9v9H3V9h3zM4.5 3.5A1.5 1.5 0 114.5 6.5 1.5 1.5 0 014.5 3.5zM9 9h3v1.4c.5-.9 1.6-1.6 3-1.6 2.3 0 3 1.5 3 3.7V18h-3v-4.8c0-1.1-.4-1.7-1.3-1.7-1 0-1.7.7-1.7 2V18H9V9z"/></svg></a>
        </div>
      </div>
      <div class="foot-col"><h2>Información interesante</h2>
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg>Contacto</a>
        <a href="<?php echo esc_url(home_url('/servidores-refurbished/')); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg>¿Qué son los servidores refurbished?</a>
        <a href="<?php echo esc_url(home_url('/productos/')); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg>Servidores, redes y componentes</a>
        <a href="<?php echo esc_url(home_url('/compramos-servidores/')); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg>Compramos servidores y componentes</a>
        <a href="<?php echo esc_url(home_url('/medio-ambiente/')); ?>"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg>Medio ambiente</a>
      </div>
      <div class="foot-col"><h2>Contacta con 7Digits</h2>
        <a href="<?php echo esc_url(home_url('/')); ?>">7Digits España</a>
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>"><?php echo esc_html(sd_opt('direccion1', 'C/ Euclides, 11')); ?></a>
        <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', sd_opt('telefono', '+34915458992'))); ?>"><?php echo esc_html(sd_opt('telefono', '+34 91 545 89 92')); ?></a>
        <a href="mailto:<?php echo esc_attr(sd_opt('email', 'info@7digits.es')); ?>"><?php echo esc_html(sd_opt('email', 'info@7digits.es')); ?></a>
        <a href="https://www.7digits.es">www.7digits.es</a>
      </div>
      <div class="foot-col"><h2>Legal</h2>
        <p class="foot-note"><?php echo esc_html(sd_opt('nota_legal', '')); ?></p>
        <a href="<?php echo esc_url(home_url('/aviso-legal/')); ?>" style="margin-top:10px">Aviso legal y condiciones</a>
        <a href="<?php echo esc_url(home_url('/privacidad/')); ?>">Política de privacidad</a>
      </div>
    </div>
    <div class="foot-bot">
      <p>© <span id="year"><?php echo date('Y'); ?></span> Siete Dígitos Servicios B2B S.L. · CIF B86897022 · Alcalá de Henares, Madrid</p>
      <p>Gestión responsable del fin de vida del hardware empresarial.</p>
    </div>
  </div>
</footer>

<button class="totop" id="totop" aria-label="Volver arriba"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 19V5M5 12l7-7 7 7"/></svg></button>
<?php wp_footer(); ?>
</body>
</html>
