/* ═══ 7DIGITS · Compras: valorador de retirada ═══ */
'use strict';
(() => {

const { $, $$, reduceMotion, fmt, eur } = window.SD;

/* ══════ Valorador de retirada ══════ */
(() => {
  const tipo = $('#s-tipo');
  if (!tipo) return;
  const uds = $('#s-uds'), cta = $('#s-cta');
  let edad = 'Menos de 3 años';
  const MSG = {
    'Menos de 3 años': ['Tu material puede tener valor de recompra',
      'Los equipos de menos de 3 años suelen conservar un valor de reventa significativo: te haremos una oferta económica por ellos.'],
    'Entre 3 y 6 años': ['Buen candidato para segunda vida',
      'Gran parte del material de 3 a 6 años es apto para reacondicionado. Valoramos cada lote y te enviamos la mejor oferta del mercado.'],
    'Más de 6 años': ['Nos encargamos de todo, sin coste',
      'Aunque el valor de reventa sea menor, gestionamos la retirada, el borrado certificado y el reciclaje RAEE sin complicaciones para tu equipo.'],
  };
  function update() {
    const [t, m] = MSG[edad];
    $('#s-title').textContent = t;
    $('#s-msg').textContent = m;
    cta.href = (document.body.dataset.contact || 'contacto.html') + '?tipo=retirada'
      + '&material=' + encodeURIComponent(tipo.value)
      + '&unidades=' + encodeURIComponent(uds.value)
      + '&antiguedad=' + encodeURIComponent(edad);
  }
  $('#s-edad').addEventListener('click', e => {
    if (e.target.tagName !== 'BUTTON') return;
    $$('#s-edad button').forEach(b => b.classList.remove('active'));
    e.target.classList.add('active');
    edad = e.target.dataset.v;
    update();
  });
  tipo.addEventListener('change', update);
  uds.addEventListener('change', update);
  update();
})();

})();
