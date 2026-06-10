/* ═══ 7DIGITS · Núcleo común: nav, progreso, menú, FAQ, reveals y contadores ═══ */
'use strict';
(() => {

/* Espacio de nombres compartido entre módulos */
window.SD = (() => {
  const $  = s => document.querySelector(s);
  const $$ = s => document.querySelectorAll(s);
  const reduceMotion = matchMedia('(prefers-reduced-motion: reduce)').matches;
  const fmt = n => new Intl.NumberFormat('es-ES').format(Math.round(n));
  const eur = n => fmt(n) + ' €';
  return { $, $$, reduceMotion, fmt, eur };
})();

const { $, $$, reduceMotion, fmt, eur } = window.SD;
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
