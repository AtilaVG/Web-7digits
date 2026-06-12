/* ═══ 7DIGITS · Portada: partículas, rack 3D y tarjetas glow ═══ */
'use strict';
(() => {

const { $, $$, reduceMotion, fmt, eur } = window.SD;

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

/* ══════ Scrollytelling: así renace un servidor ══════ */
(() => {
  const sec = document.getElementById('proceso');
  if (!sec) return;
  if (reduceMotion) { sec.classList.add('static'); return; }
  const track = document.getElementById('storyTrack');
  const srv = document.getElementById('srv3d');
  const lid = document.getElementById('sLid');
  const inside = document.getElementById('sInside');
  const prog = document.getElementById('sProg');
  const steps = sec.querySelectorAll('.sstep');
  const callouts = sec.querySelectorAll('[data-r]');
  const clamp = t => Math.min(Math.max(t, 0), 1);
  const seg = (p, a, b) => clamp((p - a) / (b - a));
  const lerp = (a, b, t) => a + (b - a) * t;
  const ease = t => t < .5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
  let ticking = false;

  function frame() {
    ticking = false;
    const r = track.getBoundingClientRect();
    const total = r.height - innerHeight;
    if (total <= 0) return;
    const p = clamp(-r.top / total);

    /* rotación: presentación → giro de inspección → vuelta al frente */
    const ry = lerp(-34, 16, ease(seg(p, 0, .3))) + lerp(0, -50, ease(seg(p, .72, .98)));
    const rx = 16 + lerp(0, 9, ease(seg(p, .2, .45))) - lerp(0, 9, ease(seg(p, .72, .95)));
    /* la tapa se eleva durante el diagnóstico y se cierra al final */
    const open = ease(seg(p, .22, .42)) * (1 - ease(seg(p, .72, .92)));
    const scale = matchMedia('(max-width: 980px)').matches ? (matchMedia('(max-width: 760px)').matches ? .48 : .72) : 1;
    srv.style.transform = `scale(${scale}) rotateX(${rx}deg) rotateY(${ry}deg)`;
    lid.style.transform = `translateY(${-130 * open}px) rotateX(90deg) translateZ(48px)`;
    lid.style.opacity = 1 - .3 * open;
    inside.style.opacity = .25 + .75 * open;

    /* LEDs verdes desde el test de carga */
    srv.classList.toggle('ok', p > .52);

    /* pasos y callouts */
    const idx = p < .25 ? 0 : p < .5 ? 1 : p < .75 ? 2 : 3;
    steps.forEach((s, i) => s.classList.toggle('on', i === idx));
    callouts.forEach(c => {
      const [a, b] = c.dataset.r.split(',').map(Number);
      c.classList.toggle('on', p >= a && p <= b);
    });
    prog.style.height = (p * 100) + '%';
  }
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(frame); } }, { passive: true });
  addEventListener('resize', frame, { passive: true });
  frame();
})();

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

/* ══════ Scrollytelling: así renace un servidor ══════ */
(() => {
  const sec = document.getElementById('proceso');
  if (!sec) return;
  if (reduceMotion) { sec.classList.add('static'); return; }
  const track = document.getElementById('storyTrack');
  const srv = document.getElementById('srv3d');
  const lid = document.getElementById('sLid');
  const inside = document.getElementById('sInside');
  const prog = document.getElementById('sProg');
  const steps = sec.querySelectorAll('.sstep');
  const callouts = sec.querySelectorAll('[data-r]');
  const clamp = t => Math.min(Math.max(t, 0), 1);
  const seg = (p, a, b) => clamp((p - a) / (b - a));
  const lerp = (a, b, t) => a + (b - a) * t;
  const ease = t => t < .5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
  let ticking = false;

  function frame() {
    ticking = false;
    const r = track.getBoundingClientRect();
    const total = r.height - innerHeight;
    if (total <= 0) return;
    const p = clamp(-r.top / total);

    /* rotación: presentación → giro de inspección → vuelta al frente */
    const ry = lerp(-34, 16, ease(seg(p, 0, .3))) + lerp(0, -50, ease(seg(p, .72, .98)));
    const rx = 16 + lerp(0, 9, ease(seg(p, .2, .45))) - lerp(0, 9, ease(seg(p, .72, .95)));
    /* la tapa se eleva durante el diagnóstico y se cierra al final */
    const open = ease(seg(p, .22, .42)) * (1 - ease(seg(p, .72, .92)));
    const scale = matchMedia('(max-width: 980px)').matches ? (matchMedia('(max-width: 760px)').matches ? .48 : .72) : 1;
    srv.style.transform = `scale(${scale}) rotateX(${rx}deg) rotateY(${ry}deg)`;
    lid.style.transform = `translateY(${-130 * open}px) rotateX(90deg) translateZ(48px)`;
    lid.style.opacity = 1 - .3 * open;
    inside.style.opacity = .25 + .75 * open;

    /* LEDs verdes desde el test de carga */
    srv.classList.toggle('ok', p > .52);

    /* pasos y callouts */
    const idx = p < .25 ? 0 : p < .5 ? 1 : p < .75 ? 2 : 3;
    steps.forEach((s, i) => s.classList.toggle('on', i === idx));
    callouts.forEach(c => {
      const [a, b] = c.dataset.r.split(',').map(Number);
      c.classList.toggle('on', p >= a && p <= b);
    });
    prog.style.height = (p * 100) + '%';
  }
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(frame); } }, { passive: true });
  addEventListener('resize', frame, { passive: true });
  frame();
})();

})();

/* ══════ Tarjetas con brillo que sigue al cursor ══════ */
$$('.glowcard').forEach(c => c.addEventListener('mousemove', e => {
  const r = c.getBoundingClientRect();
  c.style.setProperty('--mx', (e.clientX - r.left) + 'px');
  c.style.setProperty('--my', (e.clientY - r.top) + 'px');
}));


/* ══════ Scrollytelling: así renace un servidor ══════ */
(() => {
  const sec = document.getElementById('proceso');
  if (!sec) return;
  if (reduceMotion) { sec.classList.add('static'); return; }
  const track = document.getElementById('storyTrack');
  const srv = document.getElementById('srv3d');
  const lid = document.getElementById('sLid');
  const inside = document.getElementById('sInside');
  const prog = document.getElementById('sProg');
  const steps = sec.querySelectorAll('.sstep');
  const callouts = sec.querySelectorAll('[data-r]');
  const clamp = t => Math.min(Math.max(t, 0), 1);
  const seg = (p, a, b) => clamp((p - a) / (b - a));
  const lerp = (a, b, t) => a + (b - a) * t;
  const ease = t => t < .5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
  let ticking = false;

  function frame() {
    ticking = false;
    const r = track.getBoundingClientRect();
    const total = r.height - innerHeight;
    if (total <= 0) return;
    const p = clamp(-r.top / total);

    /* rotación: presentación → giro de inspección → vuelta al frente */
    const ry = lerp(-34, 16, ease(seg(p, 0, .3))) + lerp(0, -50, ease(seg(p, .72, .98)));
    const rx = 16 + lerp(0, 9, ease(seg(p, .2, .45))) - lerp(0, 9, ease(seg(p, .72, .95)));
    /* la tapa se eleva durante el diagnóstico y se cierra al final */
    const open = ease(seg(p, .22, .42)) * (1 - ease(seg(p, .72, .92)));
    const scale = matchMedia('(max-width: 980px)').matches ? (matchMedia('(max-width: 760px)').matches ? .48 : .72) : 1;
    srv.style.transform = `scale(${scale}) rotateX(${rx}deg) rotateY(${ry}deg)`;
    lid.style.transform = `translateY(${-130 * open}px) rotateX(90deg) translateZ(48px)`;
    lid.style.opacity = 1 - .3 * open;
    inside.style.opacity = .25 + .75 * open;

    /* LEDs verdes desde el test de carga */
    srv.classList.toggle('ok', p > .52);

    /* pasos y callouts */
    const idx = p < .25 ? 0 : p < .5 ? 1 : p < .75 ? 2 : 3;
    steps.forEach((s, i) => s.classList.toggle('on', i === idx));
    callouts.forEach(c => {
      const [a, b] = c.dataset.r.split(',').map(Number);
      c.classList.toggle('on', p >= a && p <= b);
    });
    prog.style.height = (p * 100) + '%';
  }
  addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(frame); } }, { passive: true });
  addEventListener('resize', frame, { passive: true });
  frame();
})();

})();
