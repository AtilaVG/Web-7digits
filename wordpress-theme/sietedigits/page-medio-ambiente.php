<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<main id="main">
<section class="phead">
  <div class="glow-a" aria-hidden="true"></div>
  <div class="wrap">
    <div class="crumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg><b>Medio ambiente</b></div>
    <h1>Cuidamos el <span class="gword">medio ambiente</span></h1>
    <p class="lead">Cada equipo que reutilizamos es un equipo que no hay que fabricar. Nuestra actividad sigue la escalera de Lansink: priorizar siempre el tratamiento de menor impacto ambiental.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="shead center reveal">
      <span class="tag"><span class="num">01</span> Escalera de Lansink</span>
      <h2>De más a menos deseable</h2>
      <p>Este protocolo ordena los tratamientos de residuos según su impacto. Nuestro trabajo se concentra en los peldaños más altos.</p>
    </div>
    <div class="lansink">
      <div class="lstep good reveal"><span class="ln">A</span><div><h3>Prevención</h3><p>Alargamos la vida útil de tus equipos actualizándolos con componentes disponibles, evitando residuos antes de que existan.</p></div><span class="tagok">Nuestro foco</span></div>
      <div class="lstep good reveal"><span class="ln">B</span><div><h3>Reutilización</h3><p>Reacondicionamos servidores y componentes para reintroducirlos en el mercado con garantía: el corazón de 7Digits.</p></div><span class="tagok">Nuestro foco</span></div>
      <div class="lstep good reveal"><span class="ln">C</span><div><h3>Reciclaje</h3><p>Lo no reutilizable se separa por materiales y se entrega a recicladores autorizados (RAEE).</p></div><span class="tagok">Con gestores autorizados</span></div>
      <div class="lstep bad reveal"><span class="ln">D</span><div><h3>Valorización energética</h3><p>Recuperación de energía de los residuos no reciclables.</p></div><span class="tagok">Último recurso</span></div>
      <div class="lstep bad reveal"><span class="ln">E</span><div><h3>Incineración</h3><p>Quema sin recuperación de energía.</p></div><span class="tagok">Evitado</span></div>
      <div class="lstep bad reveal"><span class="ln">F</span><div><h3>Vertido</h3><p>Depósito en vertedero, el mayor impacto ambiental.</p></div><span class="tagok">Evitado</span></div>
    </div>
  </div>
</section>

<section class="sec soft-bg">
  <div class="wrap">
    <div class="shead reveal">
      <span class="tag"><span class="num">02</span> Nuestro impacto</span>
      <h2>La segunda vida del hardware, en cifras</h2>
      <p>Reutilizar un servidor evita la huella de fabricar uno nuevo: materias primas, energía y transporte.</p>
    </div>
    <div class="circle-wrap">
      <div class="reveal rv-l">
        <div class="impact">
          <div class="imp"><b><span data-count="10000">10.000</span>+</b><span class="u">equipos / año</span><span class="d">reintroducidos en el mercado</span></div>
          <div class="imp"><b><span data-count="320">320</span>t</b><span class="u">CO₂ evitado</span><span class="d">frente a fabricar nuevo*</span></div>
          <div class="imp"><b><span data-count="85">85</span>%</b><span class="u">tasa de reutilización</span><span class="d">del material recibido</span></div>
          <div class="imp"><b><span data-count="100">100</span>%</b><span class="u">RAEE</span><span class="d">del resto, con gestores autorizados</span></div>
        </div>
        <p class="stat-note">* Estimación orientativa según medias del sector; pendiente de confirmar con datos propios de 7Digits.</p>
        <div class="weee">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M7 19l-4-7 4-7h10l4 7-4 7z"/><path d="M9.5 12l1.8 1.8 3.5-3.6"/></svg>
          <p><b>Cumplimiento normativo RAEE / WEEE.</b> Nuestros procesos se ajustan estrictamente a la Directiva sobre Residuos de Aparatos Eléctricos y Electrónicos de la Comunidad Europea.</p>
        </div>
      </div>
      <div class="reveal rv-r">
        <div class="shead" style="margin-bottom:22px"><h2 style="font-size:1.6rem">Qué significa para tu empresa</h2></div>
        <div class="svc" style="margin-bottom:16px"><div><h3 style="font-size:1.15rem">Informe de sostenibilidad</h3><p style="margin:0">La retirada con 7Digits documenta el destino de cada equipo: un dato real para tu memoria RSC o informe ESG.</p></div></div>
        <div class="svc" style="margin-bottom:16px"><div><h3 style="font-size:1.15rem">Ahorro con sentido</h3><p style="margin:0">Comprar refurbished reduce el coste un 50–80% y tu huella de carbono al mismo tiempo.</p></div></div>
        <div class="svc"><div><h3 style="font-size:1.15rem">Cero complicaciones</h3><p style="margin:0">Nos encargamos de la logística, el borrado certificado y la gestión RAEE de principio a fin.</p></div></div>
      </div>
    </div>
  </div>
</section>

<section class="sec cta">
  <div class="wrap">
    <h2 class="reveal">Dale una segunda vida a tu hardware</h2>
    <p class="reveal">Retirada, borrado certificado y la mejor valoración del mercado — con la tranquilidad de un destino documentado para cada equipo.</p>
    <div class="acts reveal">
      <a href="<?php echo esc_url(home_url('/compramos-servidores/')); ?>" class="btn btn-white">Valorar mi material</a>
      <a href="<?php echo esc_url(home_url('/contacto/')); ?>" class="btn btn-out">Hablar con un técnico</a>
    </div>
  </div>
</section>
</main>
<?php get_footer(); ?>
