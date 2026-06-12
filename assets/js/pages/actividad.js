/* ═══ 7DIGITS · Actividad: diagrama orbital ═══ */
'use strict';
(() => {

const { $, $$, reduceMotion, fmt, eur } = window.SD;

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



})();
