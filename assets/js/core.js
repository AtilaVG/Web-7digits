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

/* ══════ Menú móvil (con trampa de foco accesible) ══════ */
const mm = $('#mmenu'), ov = $('#overlay'), burger = $('#burger');
if (mm) { mm.setAttribute('role', 'dialog'); mm.setAttribute('aria-modal', 'true'); }
const mmFocusables = () => mm ? [...mm.querySelectorAll('a[href],button:not([disabled])')].filter(el => el.offsetParent !== null) : [];
function setMenu(open) {
  if (!mm) return;
  mm.classList.toggle('open', open);
  burger.classList.toggle('open', open);
  burger.setAttribute('aria-expanded', open);
  ov.classList.toggle('open', open);
  if (open) {
    /* El panel entra deslizándose (translateX); hasta que no termina la
       transición no es enfocable de forma fiable. Enfocamos al cerrar la
       animación (instantáneo si el usuario pide movimiento reducido). */
    const focusFirst = () => { const f = mmFocusables(); if (f.length) f[0].focus(); };
    if (reduceMotion) requestAnimationFrame(focusFirst);
    else setTimeout(focusFirst, 400);
  } else if (document.activeElement && mm.contains(document.activeElement)) {
    burger.focus();      /* devuelve el foco al botón al cerrar desde dentro */
  }
}
if (burger) {
  burger.addEventListener('click', () => setMenu(!mm.classList.contains('open')));
  mm.querySelectorAll('a').forEach(a => a.addEventListener('click', () => setMenu(false)));
  ov.addEventListener('click', () => setMenu(false));
  const mmClose = $('#mmClose');
  if (mmClose) mmClose.addEventListener('click', () => setMenu(false));
  addEventListener('keydown', e => {
    if (e.key === 'Escape') { setMenu(false); return; }
    if (e.key !== 'Tab' || !mm.classList.contains('open')) return;
    const f = mmFocusables();
    if (!f.length) return;
    const first = f[0], last = f[f.length - 1];
    if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
    else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
  });
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
  el.textContent = '0';               /* parte de 0 al animar; el HTML ya trae el valor real como fallback si falla JS */
  const dur = 1400, t0 = performance.now();
  (function tick(now) {
    const p = Math.min(((now || performance.now()) - t0) / dur, 1);
    el.textContent = fmt(target * (p === 1 ? 1 : 1 - Math.pow(2, -10 * p)));
    if (p < 1) requestAnimationFrame(tick);
  })();
}), { threshold: .5 });
if (reduceMotion) $$('[data-count]').forEach(el => { el.textContent = fmt(+el.dataset.count); });
else $$('[data-count]').forEach(el => cio.observe(el));

})();
