/* ═══ 7DIGITS · Contacto: pre-relleno por URL y envío del formulario ═══ */
'use strict';
(() => {

const { $, $$, reduceMotion, fmt, eur } = window.SD;

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
  } else if (qs.get('tipo') === 'retirada') {
    tipo.value = 'Venta / retirada de hardware';
    if (qs.get('material')) {
      msg.value = `Solicito oferta por retirada de hardware:\n· Material: ${qs.get('material')}\n· Unidades: ${qs.get('unidades')}\n· Antigüedad: ${qs.get('antiguedad')}`;
    }
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
    if (form.dataset.native) { form.submit(); return; }

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

})();
