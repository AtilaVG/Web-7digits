/* ═══════════════════════════════════════════════════════
   7DIGITS · ICT REMARKETING — JavaScript global
   Cada módulo comprueba si sus elementos existen, por lo
   que este único archivo sirve para todas las páginas.
   ═══════════════════════════════════════════════════════ */
'use strict';
(() => {

const $  = s => document.querySelector(s);
const $$ = s => document.querySelectorAll(s);
const reduceMotion = matchMedia('(prefers-reduced-motion: reduce)').matches;
const fmt = n => new Intl.NumberFormat('es-ES').format(Math.round(n));
const eur = n => fmt(n) + ' €';

/* ══════ Fecha y año ══════ */
const today = $('#today');
if (today) today.textContent = new Date().toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' });
const year = $('#year');
if (year) year.textContent = new Date().getFullYear();

/* ══════ Barra de progreso · header sticky · volver arriba ══════ */
const hdr = $('#hdr'), progress = $('#progress'), totop = $('#totop');
addEventListener('scroll', () => {
  const max = document.documentElement.scrollHeight - innerHeight;
  if (progress) progress.style.width = (max > 0 ? scrollY / max * 100 : 0) + '%';
  if (hdr) hdr.classList.toggle('shrink', scrollY > 30);
  if (totop) totop.classList.toggle('show', scrollY > 600);
}, { passive: true });
if (totop) totop.addEventListener('click', () => scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' }));

/* ══════ Menú móvil ══════ */
const mm = $('#mmenu'), ov = $('#overlay'), burger = $('#burger');
function setMenu(open) {
  if (!mm) return;
  mm.classList.toggle('open', open);
  burger.classList.toggle('open', open);
  burger.setAttribute('aria-expanded', open);
  ov.classList.toggle('open', open);
}
if (burger) {
  burger.addEventListener('click', () => setMenu(!mm.classList.contains('open')));
  mm.querySelectorAll('a').forEach(a => a.addEventListener('click', () => setMenu(false)));
  ov.addEventListener('click', () => setMenu(false));
  addEventListener('keydown', e => { if (e.key === 'Escape') setMenu(false); });
}

/* ══════ Marquee de marcas (duplicado para bucle continuo) ══════ */
const mtrack = $('#mtrack');
if (mtrack) mtrack.innerHTML += mtrack.innerHTML;

/* ══════ Hero: red de partículas en canvas ══════ */
(() => {
  const cv = $('#net');
  if (!cv || reduceMotion) return;
  const ctx = cv.getContext('2d');
  let W, H, pts = [], raf, visible = true;
  function size() {
    const r = cv.parentElement.getBoundingClientRect();
    W = cv.width = r.width; H = cv.height = r.height;
    const n = Math.min(75, Math.floor(W * H / 22000));
    pts = Array.from({ length: n }, () => ({
      x: Math.random() * W, y: Math.random() * H,
      vx: (Math.random() - .5) * .35, vy: (Math.random() - .5) * .35,
      g: Math.random() > .5
    }));
  }
  function tick() {
    ctx.clearRect(0, 0, W, H);
    for (const p of pts) {
      p.x += p.vx; p.y += p.vy;
      if (p.x < 0 || p.x > W) p.vx *= -1;
      if (p.y < 0 || p.y > H) p.vy *= -1;
    }
    for (let i = 0; i < pts.length; i++) {
      const a = pts[i];
      for (let j = i + 1; j < pts.length; j++) {
        const b = pts[j], dx = a.x - b.x, dy = a.y - b.y, d = dx * dx + dy * dy;
        if (d < 16900) {
          ctx.strokeStyle = `rgba(${a.g ? '140,198,63' : '58,160,219'},${(1 - d / 16900) * .16})`;
          ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y); ctx.stroke();
        }
      }
      ctx.fillStyle = a.g ? 'rgba(140,198,63,.5)' : 'rgba(58,160,219,.5)';
      ctx.beginPath(); ctx.arc(a.x, a.y, 1.4, 0, 7); ctx.fill();
    }
    if (visible) raf = requestAnimationFrame(tick);
  }
  size(); tick();
  addEventListener('resize', size, { passive: true });
  new IntersectionObserver(es => {
    visible = es[0].isIntersecting;
    cancelAnimationFrame(raf);
    if (visible) tick();
  }).observe(cv);
})();

/* ══════ Hero: rack 3D que sigue al ratón ══════ */
(() => {
  const stage = $('#stage'), rack = $('#rack'), hero = $('.hero');
  if (!stage || !rack || !hero || reduceMotion) return;
  let tx = -24, ty = 8, cx = -24, cy = 8, raf = null;
  function lerp() {
    cx += (tx - cx) * .08; cy += (ty - cy) * .08;
    rack.style.transform = `rotateX(${cy}deg) rotateY(${cx}deg)`;
    if (Math.abs(tx - cx) > .05 || Math.abs(ty - cy) > .05) raf = requestAnimationFrame(lerp);
    else raf = null;
  }
  hero.addEventListener('mousemove', e => {
    const r = hero.getBoundingClientRect();
    const dx = (e.clientX - r.left) / r.width - .5;
    const dy = (e.clientY - r.top) / r.height - .5;
    tx = -24 + dx * 16; ty = 8 - dy * 10;
    if (!raf) raf = requestAnimationFrame(lerp);
  });
  hero.addEventListener('mouseleave', () => { tx = -24; ty = 8; if (!raf) raf = requestAnimationFrame(lerp); });
})();

/* ══════ Tarjetas con brillo que sigue al cursor ══════ */
$$('.glowcard').forEach(c => c.addEventListener('mousemove', e => {
  const r = c.getBoundingClientRect();
  c.style.setProperty('--mx', (e.clientX - r.left) + 'px');
  c.style.setProperty('--my', (e.clientY - r.top) + 'px');
}));

/* ══════ Diagrama orbital (economía circular) ══════ */
(() => {
  const orbit = $('#orbit');
  if (!orbit) return;
  function place() {
    const r = orbit.getBoundingClientRect().width / 2;
    orbit.querySelectorAll('.onode').forEach(n => {
      const a = parseFloat(n.style.getPropertyValue('--a')) * Math.PI / 180;
      n.style.left = (r + Math.cos(a) * r) + 'px';
      n.style.top  = (r + Math.sin(a) * r) + 'px';
    });
  }
  place();
  addEventListener('resize', place, { passive: true });
})();

/* ══════ Catálogo de productos ══════ */
(() => {
  const grid = $('#products');
  if (!grid) return;
  const PRODUCTS = [
    { t: 'PowerEdge R740', b: 'Dell', cat: 'server', type: 'Servidor 2U', badge: 'Refurbished', grade: 4, price: 1890, specs: [['CPU', '2× Xeon Gold 6130'], ['RAM', '128 GB DDR4'], ['Discos', '8× 1.2TB SAS']] },
    { t: 'ProLiant DL380 Gen10', b: 'HPE', cat: 'server', type: 'Servidor 2U', badge: 'Refurbished', grade: 5, price: 2350, specs: [['CPU', '2× Xeon Silver 4210'], ['RAM', '192 GB DDR4'], ['Discos', 'Sin discos']] },
    { t: 'Catalyst 9300 48P', b: 'Cisco', cat: 'network', type: 'Switch L3', badge: 'Refurbished', grade: 5, price: 1450, specs: [['Puertos', '48× 1G PoE+'], ['Uplink', '4× 10G SFP+'], ['Stack', '480 Gbps']] },
    { t: 'Nexus 9336C-FX2', b: 'Cisco', cat: 'network', type: 'Switch Spine', badge: 'Refurbished', grade: 4, price: 3200, specs: [['Puertos', '36× 100G'], ['Latencia', '< 1 µs'], ['Throughput', '7.2 Tbps']] },
    { t: 'PowerVault ME4024', b: 'Dell', cat: 'storage', type: 'Cabina SAN', badge: 'Refurbished', grade: 4, price: 2780, specs: [['Bahías', '24× 2.5"'], ['Conexión', '16G FC'], ['Controladoras', 'Dual']] },
    { t: 'G620 SAN Switch', b: 'Brocade', cat: 'network', type: 'Switch FC', badge: 'Refurbished', grade: 5, price: 1120, specs: [['Puertos', '64× 32G FC'], ['Latencia', '700 ns'], ['Agregado', '2 Tbps']] },
    { t: 'DGS-3630-28PC', b: 'D-Link', cat: 'network', type: 'Switch L3', badge: 'Refurbished', grade: 4, price: 690, specs: [['Puertos', '24× 1G PoE'], ['Uplink', '4× 10G'], ['PoE', '370 W']] },
    { t: '32GB RDIMM DDR4', b: 'Samsung', cat: 'components', type: 'Memoria', badge: 'Testado', grade: 5, price: 78, specs: [['Capacidad', '32 GB'], ['Velocidad', '2933 MHz'], ['ECC', 'Registered']] },
    { t: '1.92TB SSD SAS', b: 'Intel', cat: 'components', type: 'Almacenamiento', badge: 'Refurbished', grade: 4, price: 215, specs: [['Capacidad', '1.92 TB'], ['Interfaz', '12G SAS'], ['Formato', '2.5"']] },
    { t: 'Xeon Gold 6248R', b: 'Intel', cat: 'components', type: 'Procesador', badge: 'Refurbished', grade: 5, price: 460, specs: [['Núcleos', '24c / 48t'], ['Frecuencia', '3.0 GHz'], ['TDP', '205 W']] },
    { t: 'StoreEver MSL2024', b: 'HPE', cat: 'storage', type: 'Librería LTO', badge: 'Refurbished', grade: 3, price: 1340, specs: [['Tipo', 'LTO-8'], ['Slots', '24'], ['Capacidad', '720 TB']] },
    { t: 'UCS C220 M5', b: 'Cisco', cat: 'server', type: 'Servidor 1U', badge: 'Refurbished', grade: 4, price: 1680, specs: [['CPU', '2× Xeon Gold 5118'], ['RAM', '96 GB DDR4'], ['Discos', '4× 960GB SSD']] },
  ];
  const gradeName = ['', 'E', 'D', 'C', 'B', 'A'];
  let activeFilter = 'all', searchTerm = '', sortMode = 'rel';
  const gradeBar = g => {
    let h = '';
    for (let i = 1; i <= 5; i++) h += `<i class="${i <= g ? 'fill' : ''}"></i>`;
    return `<div class="grade">${h}<em>Grado ${gradeName[g]}</em></div>`;
  };
  function render() {
    let f = PRODUCTS.filter(p =>
      (activeFilter === 'all' || p.cat === activeFilter) &&
      (p.t + ' ' + p.b).toLowerCase().includes(searchTerm.toLowerCase()));
    if (sortMode === 'asc')   f = [...f].sort((a, b) => a.price - b.price);
    if (sortMode === 'desc')  f = [...f].sort((a, b) => b.price - a.price);
    if (sortMode === 'grade') f = [...f].sort((a, b) => b.grade - a.grade);
    if (!f.length) {
      grid.innerHTML = `<div class="empty">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4M8 11h6"/></svg>
        Sin resultados para tu búsqueda.<br>Localizamos cualquier <i>part number</i>: <a href="contacto.html" style="color:var(--blue);font-weight:700">pídenos presupuesto</a>.</div>`;
      return;
    }
    grid.innerHTML = f.map((p, i) => `<article class="prod" style="animation-delay:${Math.min(i * 45, 400)}ms">
      <div class="top"><span class="ptype">${p.type}</span><span class="badge">${p.badge}</span></div>
      <h4>${p.t}</h4><div class="brand">${p.b}</div>
      ${gradeBar(p.grade)}
      <div class="specs">${p.specs.map(s => `<div><span>${s[0]}</span><b>${s[1]}</b></div>`).join('')}</div>
      <div class="pfoot"><div class="price"><b>${eur(p.price)}</b><span>+ IVA · refurbished</span></div>
        <a class="add" href="contacto.html?tipo=compra&producto=${encodeURIComponent(p.t + ' (' + p.b + ')')}"
           aria-label="Pedir presupuesto de ${p.t}" title="Pedir presupuesto">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4z"/></svg></a></div>
    </article>`).join('');
  }
  render();
  $('#filters').addEventListener('click', e => {
    if (!e.target.classList.contains('filter')) return;
    $$('.filter').forEach(b => b.classList.remove('active'));
    e.target.classList.add('active');
    activeFilter = e.target.dataset.f;
    render();
  });
  $('#search').addEventListener('input', e => { searchTerm = e.target.value; render(); });
  $('#sortSel').addEventListener('change', e => { sortMode = e.target.value; render(); });
})();

/* ══════ Destrucción de datos: pestañas ══════ */
(() => {
  const tabs = $('#dtabs');
  if (!tabs) return;
  const DDATA = [
    { title: 'Borrado por software', desc: 'Sobreescritura certificada conforme a estándares internacionales. Ideal para equipos destinados a reventa o reutilización.', method: 'Overwrite multipaso', reuse: 'Sí — apto para segunda vida', norm: 'ISO 27001 / NIST 800-88' },
    { title: 'Destrucción física', desc: 'Trituración mecánica del soporte. Elimina cualquier posibilidad de recuperación. Para información de máxima sensibilidad.', method: 'Trituración / shredding', reuse: 'No — soporte destruido', norm: 'ISO 27001 · RAEE' },
    { title: 'Desmagnetización', desc: 'Campo magnético de alta intensidad (degaussing) que destruye irreversiblemente la estructura de datos magnéticos.', method: 'Degaussing', reuse: 'No — soporte inutilizado', norm: 'ISO 27001' },
  ];
  tabs.addEventListener('click', e => {
    const t = e.target.closest('.dtab');
    if (!t) return;
    $$('.dtab').forEach(x => x.classList.remove('active'));
    t.classList.add('active');
    const d = DDATA[+t.dataset.d];
    ['title', 'desc', 'method', 'reuse', 'norm'].forEach(k => { $('#d-' + k).textContent = d[k]; });
    $('.dpanel .doc').animate(
      [{ opacity: .3, transform: 'translateY(8px)' }, { opacity: 1, transform: 'none' }],
      { duration: 360, easing: 'cubic-bezier(.22,1,.36,1)' });
  });
})();

/* ══════ Calculadora de renting ══════ */
(() => {
  const amount = $('#amount'), term = $('#term');
  if (!amount) return;
  let freq = 1;
  const fillTrack = el => {
    el.style.setProperty('--fill', (el.value - el.min) / (el.max - el.min) * 100 + '%');
  };
  function calc() {
    const a = +amount.value, t = +term.value;
    const total = a * (1 + (0.05 + t * 0.0025));
    const payment = total / t * freq;
    $('#amtVal').textContent = eur(a);
    $('#termVal').textContent = t + ' meses';
    $('#quota').textContent = fmt(payment);
    $('#freqLabel').textContent = freq === 1 ? '/mes' : '/trim';
    $('#bAmount').textContent = eur(a);
    $('#bTerm').textContent = t + ' meses';
    $('#bTotal').textContent = eur(total);
    fillTrack(amount); fillTrack(term);
    /* el CTA lleva la simulación a la página de contacto vía URL */
    const cta = $('#rentCta');
    if (cta) cta.href = `contacto.html?tipo=renting&importe=${a}&plazo=${t}&cuota=${Math.round(payment)}${freq === 3 ? '&periodicidad=trimestral' : ''}`;
  }
  amount.addEventListener('input', calc);
  term.addEventListener('input', calc);
  $('#freq').addEventListener('click', e => {
    if (e.target.tagName !== 'BUTTON') return;
    $$('#freq button').forEach(b => b.classList.remove('active'));
    e.target.classList.add('active');
    freq = +e.target.dataset.q;
    calc();
  });
  calc();
})();

/* ══════ FAQ acordeón ══════ */
$$('.faq').forEach(f => {
  const btn = f.querySelector('button'), body = f.querySelector('.body');
  btn.addEventListener('click', () => {
    const open = f.classList.contains('open');
    $$('.faq.open').forEach(o => {
      o.classList.remove('open');
      o.querySelector('.body').style.maxHeight = 0;
      o.querySelector('button').setAttribute('aria-expanded', 'false');
    });
    if (!open) {
      f.classList.add('open');
      body.style.maxHeight = body.scrollHeight + 'px';
      btn.setAttribute('aria-expanded', 'true');
    }
  });
});

/* ══════ Formulario de contacto ══════ */
(() => {
  const form = $('#quoteForm');
  if (!form) return;

  /* Pre-relleno vía parámetros de URL (sin almacenamiento en el navegador):
     contacto.html?tipo=compra&producto=...        → desde el catálogo
     contacto.html?tipo=renting&importe=&plazo=&cuota= → desde la calculadora */
  const qs = new URLSearchParams(location.search);
  const msg = form.querySelector('[name="msg"]'), tipo = form.querySelector('[name="tipo"]');
  if (qs.get('producto')) {
    tipo.value = 'Compra de hardware';
    msg.value = `Solicito presupuesto del siguiente artículo:\n· ${qs.get('producto')}\n\nUnidades: `;
  } else if (qs.get('tipo') === 'renting' && qs.get('importe')) {
    tipo.value = 'Renting de equipos';
    msg.value = `Solicito estudio de renting:\n· Importe: ${fmt(+qs.get('importe'))} €\n· Plazo: ${qs.get('plazo')} meses\n· Cuota estimada: ${fmt(+qs.get('cuota'))} €${qs.get('periodicidad') === 'trimestral' ? '/trimestre' : '/mes'}`;
  } else if (qs.get('tipo') === 'retirada') {
    tipo.value = 'Venta / retirada de hardware';
  } else if (qs.get('tipo') === 'datos') {
    tipo.value = 'Destrucción de datos';
  }
  if ([...qs.keys()].length) {
    document.getElementById('contact-form')?.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth' });
  }

  form.addEventListener('submit', async e => {
    e.preventDefault();
    let ok = true;
    const v = n => form.querySelector(`[name="${n}"]`).value.trim();
    const check = (n, t) => {
      const fg = form.querySelector(`[name="${n}"]`).closest('.fg');
      fg.classList.toggle('err', !t);
      if (!t) ok = false;
    };
    check('nombre', v('nombre').length > 1);
    check('email', /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v('email')));
    check('tipo', v('tipo') !== '');
    if (!ok) { form.querySelector('.fg.err input,.fg.err select')?.focus(); return; }

    /* Endpoint configurable: poner la URL del backend / servicio de formularios
       en el atributo data-endpoint del <form>. Sin endpoint → modo demo. */
    const endpoint = form.dataset.endpoint;
    if (endpoint) {
      const btn = form.querySelector('[type=submit]');
      btn.disabled = true;
      try {
        const res = await fetch(endpoint, {
          method: 'POST',
          headers: { 'Accept': 'application/json' },
          body: new FormData(form)
        });
        if (!res.ok) throw new Error(res.status);
      } catch (err) {
        btn.disabled = false;
        alert('No se pudo enviar la solicitud. Inténtalo de nuevo o escríbenos a info@7digits.es');
        return;
      }
    }
    document.getElementById('formFields').style.display = 'none';
    document.getElementById('formOk').classList.add('show');
  });
  form.querySelectorAll('input,select').forEach(el =>
    el.addEventListener('input', () => el.closest('.fg').classList.remove('err')));
})();

/* ══════ Animaciones de aparición ══════ */
const io = new IntersectionObserver(es => es.forEach(en => {
  if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); }
}), { threshold: .12 });
$$('.reveal').forEach((el, i) => {
  el.style.transitionDelay = (i % 4 * 0.07) + 's';
  io.observe(el);
});

/* ══════ Contadores animados ══════ */
const cio = new IntersectionObserver(es => es.forEach(en => {
  if (!en.isIntersecting) return;
  cio.unobserve(en.target);
  const el = en.target, target = +el.dataset.count;
  if (reduceMotion) { el.textContent = fmt(target); return; }
  const dur = 1400, t0 = performance.now();
  (function tick(now) {
    const p = Math.min(((now || performance.now()) - t0) / dur, 1);
    el.textContent = fmt(target * (p === 1 ? 1 : 1 - Math.pow(2, -10 * p)));
    if (p < 1) requestAnimationFrame(tick);
  })();
}), { threshold: .5 });
$$('[data-count]').forEach(el => cio.observe(el));

})();
