<?php if (!defined('ABSPATH')) exit; get_header(); ?>
<main id="main">
<section class="phead">
  <div class="glow-a" aria-hidden="true"></div>
  <div class="wrap">
    <div class="crumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M9 6l6 6-6 6"/></svg><b>Compras</b></div>
    <h1>Compramos tu <span class="gword">hardware</span></h1>
    <p class="lead">Servidores, componentes, redes, almacenamiento y racks completos: si ya no lo necesitas, te hacemos la mejor oferta del mercado y nos encargamos de todo.</p>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="shead reveal">
      <span class="tag"><span class="num">01</span> Qué compramos</span>
      <h2>Todo el material TIC de tu empresa</h2>
      <p>De cualquier marca y en cualquier estado: lo valoramos, lo retiramos y borramos tus datos de forma certificada.</p>
    </div>
    <div class="svc-grid">
      <div class="svc reveal rv-l">
        <div class="ic"><svg viewBox="0 0 24 24"><use href="#i-server"/></svg></div>
        <div><h3>Servidores y racks completos</h3><p>Servidores HP, IBM, Dell y demás marcas, en rack o torre, y armarios completos con su contenido.</p>
          <ul><li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Cualquier generación y configuración</li><li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Racks completos con cableado</li></ul></div>
      </div>
      <div class="svc reveal rv-r">
        <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><rect x="2" y="7" width="20" height="10" rx="2"/><circle cx="6.5" cy="12" r="1"/><circle cx="10" cy="12" r="1"/><path d="M14 11h5M14 13h5"/></svg></div>
        <div><h3>Componentes</h3><p>Procesadores, memoria RAM, discos duros y SSD, controladoras, fuentes, cables y raíles.</p>
          <ul><li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Lotes grandes y pequeños</li><li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>También material sin testear</li></ul></div>
      </div>
      <div class="svc reveal rv-l">
        <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="5" r="2.2"/><circle cx="5" cy="19" r="2.2"/><circle cx="19" cy="19" r="2.2"/><path d="M12 7.2V13M12 13l-5.5 4.2M12 13l5.5 4.2"/></svg></div>
        <div><h3>Redes y comunicaciones</h3><p>Switches, routers, firewalls y electrónica de red de Cisco, Brocade, 3COM, D-Link y otras marcas.</p>
          <ul><li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Switching de campus y datacenter</li><li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Óptica y transceivers</li></ul></div>
      </div>
      <div class="svc reveal rv-r">
        <div class="ic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"><ellipse cx="12" cy="6" rx="8" ry="3"/><path d="M4 6v6c0 1.7 3.6 3 8 3s8-1.3 8-3V6"/><path d="M4 12v6c0 1.7 3.6 3 8 3s8-1.3 8-3v-6"/></svg></div>
        <div><h3>Almacenamiento</h3><p>Cabinas SAN y NAS, librerías de cintas, bandejas de discos y almacenamiento de cualquier fabricante.</p>
          <ul><li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Con o sin discos</li><li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Borrado certificado incluido</li></ul></div>
      </div>
    </div>
  </div>
</section>


<!-- ════════ VALORADOR DE RETIRADA ════════ -->
<section class="sec">
  <div class="wrap">
    <div class="shead reveal">
      <span class="tag"><span class="num">02</span> Valora tu material</span>
      <h2>¿Renuevas tu CPD? Tu material antiguo tiene valor</h2>
      <p>Cuéntanos qué tienes y te enviamos una oferta económica en menos de 24 horas. La retirada, en la mayoría de los casos, es gratuita.</p>
    </div>
    <div class="sell-wrap">
      <div class="sell reveal rv-l">
        <div class="fg"><label for="s-tipo">Tipo de material</label>
          <select id="s-tipo">
            <option>Servidores</option><option>Equipos de red (switching, routing)</option>
            <option>Almacenamiento (cabinas, discos)</option><option>Racks completos</option>
            <option>Equipos de usuario</option><option>Material mixto / lote completo</option>
          </select></div>
        <div class="fg"><label for="s-uds">Unidades aproximadas</label>
          <select id="s-uds"><option>1 – 10</option><option>10 – 50</option><option>50 – 200</option><option>Más de 200</option></select></div>
        <div class="fg" style="margin-bottom:0"><label>Antigüedad aproximada</label>
          <div class="opts" id="s-edad">
            <button class="active" data-v="Menos de 3 años">&lt; 3 años</button>
            <button data-v="Entre 3 y 6 años">3 – 6 años</button>
            <button data-v="Más de 6 años">&gt; 6 años</button>
          </div></div>
      </div>
      <div class="sell-out reveal rv-r">
        <span class="tag">Valoración orientativa</span>
        <h3 id="s-title">Tu material puede tener valor de recompra</h3>
        <p class="msg" id="s-msg">Los equipos de menos de 3 años suelen conservar un valor de reventa significativo: te haremos una oferta económica por ellos.</p>
        <ul>
          <li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Retirada gratuita en la mayoría de los casos</li>
          <li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Borrado certificado de datos incluido</li>
          <li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Oferta económica en menos de 24 h</li>
          <li><svg viewBox="0 0 24 24"><use href="#i-check"/></svg>Reciclaje RAEE de lo no reutilizable</li>
        </ul>
        <a href="<?php echo esc_url(home_url('/contacto/')); ?>?tipo=retirada" id="s-cta" class="btn btn-primary" style="width:100%">Recibir oferta sin compromiso
          <svg viewBox="0 0 24 24"><use href="#i-arrow"/></svg></a>
      </div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="shead center reveal">
      <span class="tag"><span class="num">03</span> Cómo funciona</span>
      <h2>De tu inventario a la oferta, en horas</h2>
      <p>Envíanos el listado de material a <a href="mailto:compras@7digits.es" style="color:var(--blue);font-weight:700">compras@7digits.es</a> o usa el formulario, y te respondemos el mismo día laborable.</p>
    </div>
    <div class="impact" style="grid-template-columns:repeat(3,1fr)">
      <div class="imp reveal"><b>01</b><span class="u">Envía tu inventario</span><span class="d">Listado de equipos por email o formulario; valen fotos del rack.</span></div>
      <div class="imp reveal"><b>02</b><span class="u">Recibe la oferta</span><span class="d">Valoración económica en horas, sin compromiso.</span></div>
      <div class="imp reveal"><b>03</b><span class="u">Retirada y certificado</span><span class="d">Recogemos el material y borramos tus datos con certificado por unidad.</span></div>
    </div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="shead center reveal">
      <span class="tag"><span class="num">04</span> Preguntas frecuentes</span>
      <h2>Dudas sobre la retirada de hardware</h2>
      <p>Lo que nos preguntan los responsables de IT antes de encargarnos su material.</p>
    </div>
    <div class="faq-grid">
      <div class="faq reveal">
        <button aria-expanded="false">¿La retirada de mi hardware tiene coste?<span class="chev"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M6 9l6 6 6-6"/></svg></span></button>
        <div class="body"><p>En la mayoría de los casos la retirada es <b>gratuita</b>, y si tu material conserva valor de mercado te hacemos una <b>oferta económica</b> por él. Nuestros técnicos se desplazan a tu empresa o CPD y gestionan todo el proceso.</p></div>
      </div>
      <div class="faq reveal">
        <button aria-expanded="false">¿Qué pasa con el material que no se puede reutilizar?<span class="chev"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M6 9l6 6 6-6"/></svg></span></button>
        <div class="body"><p>Se gestiona con <b>recicladores autorizados</b> conforme a la directiva RAEE/WEEE, con la documentación correspondiente para tu empresa.</p></div>
      </div>
      <div class="faq reveal">
        <button aria-expanded="false">¿Borráis los datos antes de tratar los equipos?<span class="chev"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M6 9l6 6 6-6"/></svg></span></button>
        <div class="body"><p>Siempre. Cada soporte pasa por un proceso de <b>destrucción certificada de datos</b> antes de cualquier tratamiento, con certificado individual por número de serie.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="sec cta">
  <div class="wrap">
    <h2 class="reveal">¿Renovando tu CPD?</h2>
    <p class="reveal">No dejes que tu hardware antiguo pierda valor en un almacén. Pide tu oferta hoy: respuesta en menos de 24 horas.</p>
    <div class="acts reveal">
      <a href="<?php echo esc_url(home_url('/contacto/')); ?>?tipo=retirada" class="btn btn-white">Pedir oferta ahora</a>
      <a href="mailto:compras@7digits.es" class="btn btn-out">compras@7digits.es</a>
    </div>
  </div>
</section>
</main>
<?php get_footer(); ?>
