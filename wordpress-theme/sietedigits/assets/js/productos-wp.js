/* ═══ 7DIGITS · Productos (WordPress): filtro, búsqueda y paginación sobre el DOM ═══ */
'use strict';
(() => {
  const grid = document.getElementById('products');
  if (!grid) return;
  const cards = [...grid.querySelectorAll('.prod')];
  const moreBtn = document.getElementById('loadMore');
  const search = document.getElementById('search');
  const PAGE_SIZE = 12;
  let visible = PAGE_SIZE, filter = 'all', term = '';

  function apply() {
    const match = cards.filter(c =>
      (filter === 'all' || c.dataset.cat === filter) &&
      c.dataset.name.includes(term));
    cards.forEach(c => { c.style.display = 'none'; });
    match.slice(0, visible).forEach(c => { c.style.display = ''; });
    if (moreBtn) {
      const rest = match.length - Math.min(visible, match.length);
      moreBtn.style.display = rest > 0 ? '' : 'none';
      moreBtn.querySelector('span').textContent = `Cargar más (${rest} restantes)`;
    }
  }
  document.getElementById('filters')?.addEventListener('click', e => {
    if (!e.target.classList.contains('filter')) return;
    document.querySelectorAll('.filter').forEach(b => b.classList.remove('active'));
    e.target.classList.add('active');
    filter = e.target.dataset.f; visible = PAGE_SIZE; apply();
  });
  search?.addEventListener('input', e => { term = e.target.value.toLowerCase(); visible = PAGE_SIZE; apply(); });
  moreBtn?.addEventListener('click', () => { visible += PAGE_SIZE; apply(); });
  apply();
})();
