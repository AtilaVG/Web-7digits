/* ═══ 7DIGITS · Destrucción de datos: pestañas de métodos ═══ */
'use strict';
(() => {

const { $, $$, reduceMotion, fmt, eur } = window.SD;

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

/* ══════ Scrollytelling: el viaje de un disco ══════ */
(() => {
  const sec = document.getElementById('viaje');
  if (!sec) return;
  if (reduceMotion) { sec.classList.add('static'); return; }
  const track = document.getElementById('ddTrack');
  const hdd = document.getElementById('hdd');
  const arm = document.getElementById('ddArm');
  const cellsBox = document.getElementById('ddCells');
  const passLabel = document.getElementById('ddPassLabel');
  const passBar = document.getElementById('ddPassBar');
  const prog = document.getElementById('ddProg');
  const steps = sec.querySelectorAll('.sstep');
  const callouts = sec.querySelectorAll('[data-r]');
  const scene = sec.querySelector('.story-scene');

  /* mapa de sectores: 12×8 celdas con "datos" aleatorios */
  const COLS = 12, ROWS = 8, N = COLS * ROWS;
  const kinds = [];
  for (let i = 0; i < N; i++) {
    const r = Math.random();
    kinds.push(r < .4 ? 'd1' : r < .7 ? 'd2' : 'd3');
    cellsBox.appendChild(document.createElement('i'));
  }
  const cells = cellsBox.children;

  const clamp = t => Math.min(Math.max(t, 0), 1);
  const seg = (p, a, b) => clamp((p - a) / (b - a));
  const lerp = (a, b, t) => a + (b - a) * t;
  const ease = t => t < .5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
  let fit = 1, ticking = false;
  function measure() {
    const r = scene.getBoundingClientRect();
    fit = Math.max(.4, Math.min(1, (r.width - 40) / 560, (r.height - 30) / 360));
  }
  measure();

  function frame() {
    ticking = false;
    const r = track.getBoundingClientRect();
    const total = r.height - innerHeight;
    if (total <= 0) return;
    const p = clamp(-r.top / total);

    /* disco: presentación y giro de inspección */
    const ry = lerp(-34, 8, ease(seg(p, 0, .3))) + lerp(0, -16, ease(seg(p, .8, 1)));
    const rx = 14 + lerp(0, 8, ease(seg(p, .25, .55)));
    hdd.style.transform = `scale(${fit}) rotateX(${rx}deg) rotateY(${ry}deg)`;

    /* brazo: barre el plato durante el análisis y el borrado */
    const sweepA = seg(p, .25, .5), sweepW = seg(p, .5, .82);
    const osc = sweepA > 0 && sweepA < 1 ? Math.abs(Math.sin(sweepA * Math.PI * 3)) :
                sweepW > 0 && sweepW < 1 ? Math.abs(Math.sin(sweepW * Math.PI * 6)) : 0;
    arm.style.transform = `rotate(${-24 + osc * 26}deg)`;

    /* fase 1: los sectores con datos van apareciendo */
    const shown = Math.floor(ease(seg(p, .02, .22)) * N);
    /* fase 3: barrido de sobrescritura en 3 pasadas */
    const g = seg(p, .5, .82) * 3;
    for (let i = 0; i < N; i++) {
      const col = i % COLS, f = col / COLS;
      const passes = Math.min(3, Math.max(0, Math.floor(g) + ((g % 1) > f ? 1 : 0)));
      cells[i].className = passes > 0 ? 'w' + passes : (i < shown ? kinds[i] : '');
    }
    const passNum = Math.min(3, Math.floor(g) + (g % 1 > 0 ? 1 : 0));
    passLabel.textContent = `Pasada ${passNum} / 3`;
    passBar.style.width = (clamp(g / 3) * 100) + '%';

    hdd.classList.toggle('ok', p > .82);
    const idx = p < .25 ? 0 : p < .5 ? 1 : p < .82 ? 2 : 3;
    steps.forEach((s, i) => s.classList.toggle('on', i === idx));
    callouts.forEach(c => {
      const [a, b] = c.dataset.r.split(',').map(Number);
      c.classList.toggle('on', p >= a && p <= b);
    });
    prog.style.height = (p * 100) + '%';
  }
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(frame); } }, { passive: true });
  addEventListener('resize', () => { measure(); frame(); }, { passive: true });
  frame();
})();

})();


/* ══════ Scrollytelling: el viaje de un disco ══════ */
(() => {
  const sec = document.getElementById('viaje');
  if (!sec) return;
  if (reduceMotion) { sec.classList.add('static'); return; }
  const track = document.getElementById('ddTrack');
  const hdd = document.getElementById('hdd');
  const arm = document.getElementById('ddArm');
  const cellsBox = document.getElementById('ddCells');
  const passLabel = document.getElementById('ddPassLabel');
  const passBar = document.getElementById('ddPassBar');
  const prog = document.getElementById('ddProg');
  const steps = sec.querySelectorAll('.sstep');
  const callouts = sec.querySelectorAll('[data-r]');
  const scene = sec.querySelector('.story-scene');

  /* mapa de sectores: 12×8 celdas con "datos" aleatorios */
  const COLS = 12, ROWS = 8, N = COLS * ROWS;
  const kinds = [];
  for (let i = 0; i < N; i++) {
    const r = Math.random();
    kinds.push(r < .4 ? 'd1' : r < .7 ? 'd2' : 'd3');
    cellsBox.appendChild(document.createElement('i'));
  }
  const cells = cellsBox.children;

  const clamp = t => Math.min(Math.max(t, 0), 1);
  const seg = (p, a, b) => clamp((p - a) / (b - a));
  const lerp = (a, b, t) => a + (b - a) * t;
  const ease = t => t < .5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
  let fit = 1, ticking = false;
  function measure() {
    const r = scene.getBoundingClientRect();
    fit = Math.max(.4, Math.min(1, (r.width - 40) / 560, (r.height - 30) / 360));
  }
  measure();

  function frame() {
    ticking = false;
    const r = track.getBoundingClientRect();
    const total = r.height - innerHeight;
    if (total <= 0) return;
    const p = clamp(-r.top / total);

    /* disco: presentación y giro de inspección */
    const ry = lerp(-34, 8, ease(seg(p, 0, .3))) + lerp(0, -16, ease(seg(p, .8, 1)));
    const rx = 14 + lerp(0, 8, ease(seg(p, .25, .55)));
    hdd.style.transform = `scale(${fit}) rotateX(${rx}deg) rotateY(${ry}deg)`;

    /* brazo: barre el plato durante el análisis y el borrado */
    const sweepA = seg(p, .25, .5), sweepW = seg(p, .5, .82);
    const osc = sweepA > 0 && sweepA < 1 ? Math.abs(Math.sin(sweepA * Math.PI * 3)) :
                sweepW > 0 && sweepW < 1 ? Math.abs(Math.sin(sweepW * Math.PI * 6)) : 0;
    arm.style.transform = `rotate(${-24 + osc * 26}deg)`;

    /* fase 1: los sectores con datos van apareciendo */
    const shown = Math.floor(ease(seg(p, .02, .22)) * N);
    /* fase 3: barrido de sobrescritura en 3 pasadas */
    const g = seg(p, .5, .82) * 3;
    for (let i = 0; i < N; i++) {
      const col = i % COLS, f = col / COLS;
      const passes = Math.min(3, Math.max(0, Math.floor(g) + ((g % 1) > f ? 1 : 0)));
      cells[i].className = passes > 0 ? 'w' + passes : (i < shown ? kinds[i] : '');
    }
    const passNum = Math.min(3, Math.floor(g) + (g % 1 > 0 ? 1 : 0));
    passLabel.textContent = `Pasada ${passNum} / 3`;
    passBar.style.width = (clamp(g / 3) * 100) + '%';

    hdd.classList.toggle('ok', p > .82);
    const idx = p < .25 ? 0 : p < .5 ? 1 : p < .82 ? 2 : 3;
    steps.forEach((s, i) => s.classList.toggle('on', i === idx));
    callouts.forEach(c => {
      const [a, b] = c.dataset.r.split(',').map(Number);
      c.classList.toggle('on', p >= a && p <= b);
    });
    prog.style.height = (p * 100) + '%';
  }
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(frame); } }, { passive: true });
  addEventListener('resize', () => { measure(); frame(); }, { passive: true });
  frame();
})();

})();
