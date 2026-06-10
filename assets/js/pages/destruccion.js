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
})();

})();
