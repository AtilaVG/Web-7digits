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

})();
