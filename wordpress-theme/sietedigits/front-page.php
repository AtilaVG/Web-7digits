<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<main id="main">

<!-- ════════ HERO ════════ -->
<section class="hero">
  <canvas id="net" aria-hidden="true"></canvas>
  <div class="grid-lines" aria-hidden="true"></div>
  <div class="glow-a" aria-hidden="true"></div><div class="glow-b" aria-hidden="true"></div>
  <div class="wrap">
    <div class="hero-grid">
      <div class="hero-in">
        <span class="badge-tag"><span class="pulse"></span><?php echo esc_html(sd_opt('hero_badge', 'Logística inversa TIC · ITAD certificado')); ?></span>
        <h1><?php echo wp_kses_post(sd_opt('hero_titulo', 'Venta de servidores y <span class="gword">componentes</span> refurbished')); ?></h1>
        <p class="sub"><?php echo esc_html(sd_opt('hero_sub', 'Servidores, redes y almacenamiento refurbished de las marcas líderes.')); ?></p>
        <div class="acts">
          <a href="<?php echo esc_url(home_url('/productos/')); ?>" class="btn btn-primary">Ver productos disponibles
            <svg viewBox="0 0 24 24"><use href="#i-arrow"/></svg></a>
          <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-out">Pedir presupuesto</a>
        </div>
        <div class="quick">
          <div class="q"><b><span data-count="10000">10.000</span><em>+</em></b><span><?php echo esc_html(sd_opt('stat1_txt', 'Productos en stock')); ?></span></div>
          <div class="q"><b><span data-count="24">24</span><em>h</em></b><span><?php echo esc_html(sd_opt('stat2_txt', 'Envío express')); ?></span></div>
          <div class="q"><b><span data-count="100">100</span><em>%</em></b><span><?php echo esc_html(sd_opt('stat3_txt', 'Borrado certificado')); ?></span></div>
        </div>
      </div>

      <!-- 3D RACK -->
      <div class="stage" id="stage" aria-hidden="true">
        <div class="rack3d" id="rack">
          <div class="face back"></div>
          <div class="face right"></div>
          <div class="face top"></div>
          <div class="face front">
            <div class="scan"></div>
            <div class="srv tall"><span class="leds"><i class="g"></i><i class="b"></i><i></i></span><span class="vents"></span><span class="tagchip">2U · Srv</span></div>
            <div class="srv"><span class="leds"><i class="g"></i><i class="o"></i></span><span class="bays"><i></i><i></i><i></i><i></i></span><span class="vents"></span></div>
            <div class="srv"><span class="leds"><i class="b"></i><i class="g"></i></span><span class="vents"></span><span class="tagchip">SW · 48p</span></div>
            <div class="srv tall"><span class="leds"><i class="g"></i><i class="g"></i><i class="b"></i></span><span class="bays"><i></i><i></i><i></i><i></i><i></i></span><span class="vents"></span></div>
            <div class="srv"><span class="leds"><i class="o"></i><i class="g"></i></span><span class="vents"></span><span class="tagchip">SAN</span></div>
            <div class="srv"><span class="leds"><i class="g"></i><i class="b"></i></span><span class="vents"></span></div>
            <div class="srv tall"><span class="leds"><i class="b"></i><i class="g"></i><i class="g"></i></span><span class="bays"><i></i><i></i><i></i><i></i></span><span class="vents"></span></div>
          </div>
        </div>
        <div class="rack-shadow"></div>
        <div class="fchip f1"><svg viewBox="0 0 24 24"><use href="#i-shield"/></svg><span>Borrado <b>certificado</b> de datos</span></div>
        <div class="fchip f2"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="6" width="14" height="11" rx="1"/><path d="M15 9h4l3 3v5h-7z"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="18" r="2"/></svg><span>Envío <b>&lt; 24 h</b></span></div>
        <div class="fchip f3"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 12a9 9 0 11-3-6.7"/><path d="M21 4v5h-5"/></svg><span><b>+10.000</b> refs testadas</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ════════ BRANDS MARQUEE ════════ -->
<div class="brands" aria-label="Marcas disponibles">
  <div class="inner">
    <span class="lab">Marcas top en stock</span>
    <div class="marquee">
      <div class="mtrack" id="mtrack">
        <span class="b">CISCO</span><span class="sep">◆</span><span class="b">HPE</span><span class="sep">◆</span>
        <span class="b">DELL</span><span class="sep">◆</span><span class="b">Brocade</span><span class="sep">◆</span>
        <span class="b">3COM</span><span class="sep">◆</span><span class="b">D-Link</span><span class="sep">◆</span>
        <span class="b">Intel</span><span class="sep">◆</span><span class="b">Samsung</span><span class="sep">◆</span>
        <span class="b">Lenovo</span><span class="sep">◆</span><span class="b">Juniper</span><span class="sep">◆</span>
      </div>
    </div>
  </div>
</div>

<!-- ════════ INTRO ════════ -->
<section class="sec intro">
  <div class="wrap">
    <span class="bignum" aria-hidden="true">7D</span>
    <p class="reveal">Si busca una web especializada en la venta de servidores y componentes, <b>7Digits España es el portal que estaba buscando</b>. Con <span class="hl">más de 10.000 productos en stock</span> y envío en menos de 24 horas, somos una de las mejores empresas de comercialización de servidores y componentes de España. Disponemos de material <b>refurbished</b> de las marcas top —Cisco, 3COM, Brocade, D-Link—, cabinas de almacenamiento, discos duros, memoria RAM, procesadores, baterías, raíles y fuentes de alimentación. <span class="hl">Localizamos el part number o la pieza que necesite</span>.</p>
  </div>
</section>

<!-- ════════ WHY ════════ -->
<section class="sec why">
  <div class="wrap">
    <div class="shead center reveal">
      <span class="tag"><span class="num">01</span> Por qué elegir a 7Digits</span>
      <h2>Especialistas en el ciclo de vida del hardware</h2>
      <p>Más de una década dando segunda vida al material TIC empresarial, con la fiabilidad que exige un centro de datos.</p>
    </div>
    <div class="why-grid">
      <div class="why-card reveal glowcard"><span class="idx">01</span><div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M13 2L3 14h7l-1 8 10-12h-7z"/></svg></div><h4>Rendimiento</h4><p>Equipos revisados y testados, listos para producción desde el primer día.</p></div>
      <div class="why-card reveal glowcard"><span class="idx">02</span><div class="ic"><svg viewBox="0 0 24 24"><use href="#i-shield"/></svg></div><h4>Profesionalidad</h4><p>Técnicos especializados en CPD y trazabilidad documental completa.</p></div>
      <div class="why-card reveal glowcard"><span class="idx">03</span><div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M9 12l2 2 4-4"/></svg></div><h4>Garantía</h4><p>Todo el material con garantía y soporte técnico postventa.</p></div>
      <div class="why-card reveal glowcard"><span class="idx">04</span><div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="1" y="6" width="14" height="11" rx="1"/><path d="M15 9h4l3 3v5h-7z"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="18" r="2"/></svg></div><h4>Envío en 24h</h4><p>Stock real propio y envío express a toda España en menos de 24 horas.</p></div>
    </div>
  </div>
</section>


<!-- ════════ SCROLLYTELLING: PROCESO REFURBISHED ════════ -->
<section class="story" id="proceso">
  <div class="wrap">
    <div class="shead center reveal" style="margin-bottom:0">
      <span class="tag"><span class="num">02</span> Ingeniería refurbished</span>
      <h2>Así renace un servidor</h2>
      <p>Sigue desplazándote y mira lo que le ocurre a cada equipo antes de entrar en nuestro stock.</p>
    </div>
  </div>
  <div class="story-track" id="storyTrack">
    <div class="story-sticky">
      <div class="wrap story-grid">
        <div class="story-scene" aria-hidden="true">
          <div class="srv3d" id="srv3d">
            <div class="f s-back"></div>
            <div class="f s-bottom"></div>
            <div class="f s-left"></div>
            <div class="f s-right"></div>
            <div class="s-inside" id="sInside">
              <span class="s-cpu a"></span><span class="s-cpu b"></span>
              <span class="s-ram"></span><span class="s-ram"></span><span class="s-ram"></span><span class="s-ram"></span>
              <span class="s-fan a"></span><span class="s-fan b"></span><span class="s-fan c"></span>
              <span class="s-drives"><i></i><i></i><i></i><i></i></span>
            </div>
            <div class="f s-front">
              <div class="pwr"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 3v8"/><path d="M6.3 6.3a8 8 0 1011.4 0"/></svg></div>
              <div class="bays"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
              <div class="ledcol"><i></i><i></i><i></i></div>
            </div>
            <div class="f s-lid" id="sLid"></div>
          </div>
          <div class="s-shadow"></div>
          <div class="callout co-1" data-r="0.02,0.26"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg><span>Borrado <b>certificado</b> por nº de serie</span></div>
          <div class="callout co-2" data-r="0.28,0.52"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg><span><b>2× CPU</b> testadas con herramientas del fabricante</span></div>
          <div class="callout co-3" data-r="0.33,0.52"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg><span><b>RAM</b> verificada módulo a módulo</span></div>
          <div class="callout co-4" data-r="0.38,0.52"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg><span><b>Discos</b>: borrado + test de superficie</span></div>
          <div class="callout co-5" data-r="0.55,0.78"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg><span><b>Test de carga</b> superado · listo para producción</span></div>
          <div class="gstamp" data-r="0.56,1"><b>A</b><span>GRADO</span></div>
        </div>
        <div class="story-steps">
          <div class="sprog" aria-hidden="true"><i id="sProg"></i></div>
          <div class="sstep on"><span>PASO 01</span><h3>Recepción y borrado seguro</h3><p>Cada equipo llega de un CPD real. Antes de tocar nada, destruimos su información con borrado certificado y trazabilidad por número de serie.</p></div>
          <div class="sstep"><span>PASO 02</span><h3>Diagnóstico por componente</h3><p>Abrimos el equipo y testeamos CPU, memoria, discos, fuentes y ventilación con las herramientas del propio fabricante. Lo que no supera el test, se sustituye.</p></div>
          <div class="sstep"><span>PASO 03</span><h3>Test de carga y clasificación</h3><p>Horas de estrés controlado antes de aprobar la unidad. Cada equipo recibe su grado de estado (A–E) verificado.</p></div>
          <div class="sstep"><span>PASO 04</span><h3>Listo para enviar en 24 h</h3><p>Firmware actualizado, limpieza profunda y embalaje profesional. Al stock — y de ahí a tu CPD en menos de 24 horas.</p></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════════ SERVICES TEASER ════════ -->
<section class="sec">
  <div class="wrap">
    <div class="shead reveal">
      <span class="tag"><span class="num">03</span> Nuestra actividad</span>
      <h2>Un único partner para todo tu hardware</h2>
      <p>Desde la retirada de tu CPD hasta la reventa o el reciclaje certificado.</p>
    </div>
    <div class="tease-grid bento">
      <a class="tease feat reveal" href="<?php echo esc_url(home_url('/productos/')); ?>">
        <div class="ic"><svg viewBox="0 0 24 24"><use href="#i-server"/></svg></div>
        <h3>Hardware refurbished</h3>
        <p>Servidores, switching, almacenamiento y componentes de las marcas líderes, revisados, testados y listos para producción desde el primer día.</p>
        <div class="chips">
          <span><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>+10.000 referencias</span>
          <span><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Envío &lt; 24 h</span>
          <span><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Garantía incluida</span>
          <span><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Grado verificado</span>
        </div>
        <div class="minibrands">CISCO · HPE · DELL · BROCADE · D-LINK · INTEL</div>
        <span class="more">Ver catálogo <svg viewBox="0 0 24 24"><use href="#i-arrow"/></svg></span>
      </a>
      <a class="tease reveal" href="<?php echo esc_url(home_url('/destruccion-de-datos/')); ?>">
        <div class="ic"><svg viewBox="0 0 24 24"><use href="#i-shield"/></svg></div>
        <h3>Destrucción de datos</h3>
        <p>Borrado certificado en cualquier soporte, con trazabilidad por nº de serie.</p>
        <span class="more">Cómo funciona <svg viewBox="0 0 24 24"><use href="#i-arrow"/></svg></span>
      </a>
      <a class="tease reveal" href="<?php echo esc_url(home_url('/actividad/')); ?>">
        <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M21 12a9 9 0 11-3-6.7"/><path d="M21 4v5h-5"/></svg></div>
        <h3>Logística inversa &amp; ITAD</h3>
        <p>Retiramos tu hardware obsoleto, en la mayoría de los casos gratis.</p>
        <span class="more">Nuestra actividad <svg viewBox="0 0 24 24"><use href="#i-arrow"/></svg></span>
      </a>
      <a class="tease wide reveal" href="<?php echo esc_url(home_url('/compramos-servidores/')); ?>">
        <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><path d="M21 12a9 9 0 11-3-6.7"/><path d="M21 4v5h-5"/></svg></div>
        <div>
          <h3>Compramos tu hardware</h3>
          <p>¿Renuevas tu CPD? Valoramos tu material antiguo, lo retiramos y borramos tus datos de forma certificada.</p>
          <span class="more">Valorar mi material <svg viewBox="0 0 24 24"><use href="#i-arrow"/></svg></span>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- ════════ CÓMO TRABAJAMOS ════════ -->
<section class="sec soft-bg">
  <div class="wrap">
    <div class="shead center reveal">
      <span class="tag"><span class="num">04</span> Cómo trabajamos</span>
      <h2>De tu solicitud al envío, en tres pasos</h2>
      <p>Sin formularios eternos ni esperas: un técnico revisa cada solicitud personalmente.</p>
    </div>
    <div class="steps">
      <div class="stepc reveal">
        <span class="arr"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg></span>
        <span class="n">01</span>
        <h3>Cuéntanos qué necesitas</h3>
        <p>Compra, retirada o destrucción de datos. Por formulario, teléfono o email — como prefieras.</p>
      </div>
      <div class="stepc reveal">
        <span class="arr"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
        <span class="n">02</span>
        <h3>Propuesta en &lt; 24 h</h3>
        <p>Un técnico valora tu caso y te envía presupuesto u oferta económica por tu material en menos de un día laborable.</p>
      </div>
      <div class="stepc reveal">
        <span class="arr"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="6" width="14" height="11" rx="1"/><path d="M15 9h4l3 3v5h-7z"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="18" r="2"/></svg></span>
        <span class="n">03</span>
        <h3>Envío o retirada</h3>
        <p>Material en stock enviado en 24 h, o retirada en tu CPD con técnicos especializados y certificado de borrado.</p>
      </div>
    </div>
  </div>
</section>

<!-- ════════ CTA ════════ -->
<section class="sec cta">
  <div class="wrap">
    <h2 class="reveal"><?php echo esc_html(sd_opt('cta_titulo', '¿Tienes hardware que ya no usas?')); ?></h2>
    <p class="reveal"><?php echo esc_html(sd_opt('cta_texto', '')); ?></p>
    <div class="acts reveal">
      <a href="<?php echo esc_url(home_url('/contacto/')); ?>?tipo=retirada" class="btn btn-white">Hablar con un técnico</a>
      <a href="tel:+34915458992" class="btn btn-out">Llamar ahora</a>
    </div>
  </div>
</section>

</main>
<?php get_footer(); ?>
