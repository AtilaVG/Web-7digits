<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<main id="main">
<section class="phead">
  <div class="glow-a" aria-hidden="true"></div>
  <div class="wrap">
    <div class="crumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg><b>Destrucción de datos</b></div>
    <h1>Destrucción <span class="gword">certificada</span> de datos</h1>
    <p class="lead">Tres métodos para garantizar que tu información no vuelve: borrado por software, destrucción física y desmagnetización. Siempre con certificado nominal y trazabilidad completa.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="shead reveal">
      <span class="tag"><span class="num">01</span> Métodos</span>
      <h2>Tres formas de garantizar que tus datos no vuelven</h2>
      <p>Cada proceso genera un certificado nominal con trazabilidad completa por número de serie.</p>
    </div>
    <div class="data-wrap">
      <div class="dtabs reveal rv-l" id="dtabs">
        <button class="dtab active" data-d="0"><div class="dt-h"><span class="dt-n">SW</span><h4>Borrado por software</h4></div><p>Sobreescritura de todos los sectores según estándares reconocidos. El soporte queda reutilizable.</p></button>
        <button class="dtab" data-d="1"><div class="dt-h"><span class="dt-n">HW</span><h4>Destrucción física</h4></div><p>Trituración del soporte cuando no debe reutilizarse. Imposibilita cualquier recuperación.</p></button>
        <button class="dtab" data-d="2"><div class="dt-h"><span class="dt-n">EM</span><h4>Desmagnetización</h4></div><p>Campo magnético de alta intensidad que destruye la estructura de datos de forma irreversible.</p></button>
      </div>
      <div class="dpanel reveal rv-r">
        <div class="doc">
          <span class="doc-tag">CERTIFICADO</span>
          <h3 id="d-title">Borrado por software</h3>
          <p class="pd" id="d-desc">Sobreescritura certificada conforme a estándares internacionales. Ideal para equipos destinados a reventa o reutilización.</p>
          <div class="drow"><span>Método</span><b id="d-method">Overwrite multipaso</b></div>
          <div class="drow"><span>Reutilizable</span><b id="d-reuse">Sí — apto para segunda vida</b></div>
          <div class="drow"><span>Documentación entregada</span><b id="d-norm">Certificado de borrado por unidad</b></div>
          <div class="drow"><span>Trazabilidad por nº de serie</span><b>Sí</b></div>
          <div class="stamp"><svg viewBox="0 0 24 24"><use href="#i-shield"/></svg>Certificado de destrucción emitido</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ════════ SCROLLYTELLING: EL VIAJE DE UN DISCO ════════ -->
<section class="story dd" id="viaje">
  <div class="wrap">
    <div class="shead center reveal" style="margin-bottom:0">
      <span class="tag"><span class="num">02</span> El proceso, en directo</span>
      <h2>El viaje de un disco con datos</h2>
      <p>Sigue desplazándote: esto es lo que le ocurre a cada soporte desde que llega hasta que emitimos su certificado.</p>
    </div>
  </div>
  <div class="story-track" id="ddTrack">
    <div class="story-sticky">
      <div class="wrap story-grid">
        <div class="story-scene" aria-hidden="true">
          <div class="ddrig">
            <div class="hdd3d" id="hdd">
              <div class="hdd-body">
                <i class="scr s1"></i><i class="scr s2"></i><i class="scr s3"></i><i class="scr s4"></i>
                <div class="platter"><span class="shine"></span><span class="hub"></span></div>
                <div class="arm" id="ddArm"><span class="head"></span></div>
                <span class="hdd-led"></span>
                <span class="hdd-tag">SAS 12G · 1.92 TB · SN WX41-0093</span>
              </div>
            </div>
            <div class="hud map"><b>Mapa de sectores</b><div class="cells" id="ddCells"></div></div>
            <div class="hud pass"><b>Sobrescritura</b><span id="ddPassLabel">Pasada 0 / 3</span><div class="pbar"><i id="ddPassBar"></i></div></div>
            <div class="ddcert" id="ddCert" data-r="0.84,1">
              <span class="doc-tag">CERTIFICADO</span>
              <h4>Borrado verificado</h4>
              <div><span>Soporte</span><b>SAS 12G · SN WX41-0093</b></div>
              <div><span>Método</span><b>Sobrescritura · 3 pasadas</b></div>
              <div><span>Estado</span><b class="okk">DATOS DESTRUIDOS · VERIFICADO</b></div>
            </div>
          </div>
          <div class="callout co-1" data-r="0.02,0.2"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg><span>Inventariado por <b>nº de serie</b></span></div>
          <div class="callout co-2" data-r="0.26,0.48"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg><span>Análisis <b>SMART</b> y mapa completo del soporte</span></div>
          <div class="callout co-5" data-r="0.54,0.8"><svg viewBox="0 0 24 24"><use href="#i-check"/></svg><span><b>Sobrescritura multipaso</b> de cada sector</span></div>
        </div>
        <div class="story-steps">
          <div class="sprog" aria-hidden="true"><i id="ddProg"></i></div>
          <div class="sstep on"><span>PASO 01</span><h3>Recepción e inventariado</h3><p>Cada soporte se registra individualmente por número de serie. Desde este momento, todo el proceso queda trazado.</p></div>
          <div class="sstep"><span>PASO 02</span><h3>Análisis del soporte</h3><p>Lectura SMART y mapeo completo de sectores para elegir el tratamiento adecuado y documentar el estado de partida.</p></div>
          <div class="sstep"><span>PASO 03</span><h3>Sobrescritura multipaso</h3><p>Sobrescritura completa de cada sector del disco, en varias pasadas y con verificación posterior.</p></div>
          <div class="sstep"><span>PASO 04</span><h3>Verificación y certificado</h3><p>Lectura de comprobación final y emisión del certificado nominal: soporte, método, fecha y número de serie.</p></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="shead center reveal">
      <span class="tag"><span class="num">03</span> Preguntas frecuentes</span>
      <h2>Dudas sobre la destrucción de datos</h2>
      <p>Las preguntas que más nos hacen los responsables de seguridad.</p>
    </div>
    <div class="faq-grid">
      <div class="faq reveal">
        <button aria-expanded="false">¿Cómo se certifica la destrucción de datos?<span class="chev"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M6 9l6 6 6-6"/></svg></span></button>
        <div class="body"><p>Emitimos un <b>certificado nominal por cada unidad</b>, con la trazabilidad por número de serie, el método empleado y la fecha del proceso. Puede realizarse on-site o en nuestras instalaciones.</p></div>
      </div>
      <div class="faq reveal">
        <button aria-expanded="false">¿Qué método me conviene?<span class="chev"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M6 9l6 6 6-6"/></svg></span></button>
        <div class="body"><p>Si los equipos van a <b>reutilizarse o venderse</b>, el borrado por software deja el soporte operativo. Si la información es de <b>máxima sensibilidad</b> o el soporte está dañado, la destrucción física o la desmagnetización lo inutilizan de forma irreversible.</p></div>
      </div>
      <div class="faq reveal">
        <button aria-expanded="false">¿Podéis hacerlo en nuestras oficinas?<span class="chev"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M6 9l6 6 6-6"/></svg></span></button>
        <div class="body"><p>Sí. Realizamos el proceso <b>on-site</b> en tu empresa o CPD para que los soportes no salgan de tus instalaciones con datos, o lo hacemos en nuestras instalaciones con traslado custodiado.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="sec cta">
  <div class="wrap">
    <h2 class="reveal">¿Soportes con información sensible?</h2>
    <p class="reveal">Te asesoramos sin compromiso sobre el método más adecuado y te enviamos una propuesta en menos de 24 horas.</p>
    <div class="acts reveal">
      <a href="<?php echo esc_url(home_url('/contacto/')); ?>?tipo=datos" class="btn btn-white">Solicitar asesoramiento</a>
      <a href="tel:+34915458992" class="btn btn-out">Llamar ahora</a>
    </div>
  </div>
</section>
</main>
<?php get_footer(); ?>
