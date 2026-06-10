/* ═══ 7DIGITS · Renting: calculadora de cuota ═══ */
'use strict';
(() => {

const { $, $$, reduceMotion, fmt, eur } = window.SD;

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

})();
