/* ═══ 7DIGITS · Productos: catálogo con filtros, búsqueda y ordenación ═══ */
'use strict';
(() => {

const { $, $$, reduceMotion, fmt, eur } = window.SD;

/* ══════ Catálogo de productos ══════ */
(() => {
  const grid = $('#products');
  if (!grid) return;
  const PRODUCTS = [
    { t: 'PowerEdge R740', b: 'Dell', cat: 'server', type: 'Servidor 2U', badge: 'Refurbished', grade: 4, price: 1890, specs: [['CPU', '2× Xeon Gold 6130'], ['RAM', '128 GB DDR4'], ['Discos', '8× 1.2TB SAS']] },
    { t: 'ProLiant DL380 Gen10', b: 'HPE', cat: 'server', type: 'Servidor 2U', badge: 'Refurbished', grade: 5, price: 2350, specs: [['CPU', '2× Xeon Silver 4210'], ['RAM', '192 GB DDR4'], ['Discos', 'Sin discos']] },
    { t: 'Catalyst 9300 48P', b: 'Cisco', cat: 'network', type: 'Switch L3', badge: 'Refurbished', grade: 5, price: 1450, specs: [['Puertos', '48× 1G PoE+'], ['Uplink', '4× 10G SFP+'], ['Stack', '480 Gbps']] },
    { t: 'Nexus 9336C-FX2', b: 'Cisco', cat: 'network', type: 'Switch Spine', badge: 'Refurbished', grade: 4, price: 3200, specs: [['Puertos', '36× 100G'], ['Latencia', '< 1 µs'], ['Throughput', '7.2 Tbps']] },
    { t: 'PowerVault ME4024', b: 'Dell', cat: 'storage', type: 'Cabina SAN', badge: 'Refurbished', grade: 4, price: 2780, specs: [['Bahías', '24× 2.5"'], ['Conexión', '16G FC'], ['Controladoras', 'Dual']] },
    { t: 'G620 SAN Switch', b: 'Brocade', cat: 'network', type: 'Switch FC', badge: 'Refurbished', grade: 5, price: 1120, specs: [['Puertos', '64× 32G FC'], ['Latencia', '700 ns'], ['Agregado', '2 Tbps']] },
    { t: 'DGS-3630-28PC', b: 'D-Link', cat: 'network', type: 'Switch L3', badge: 'Refurbished', grade: 4, price: 690, specs: [['Puertos', '24× 1G PoE'], ['Uplink', '4× 10G'], ['PoE', '370 W']] },
    { t: '32GB RDIMM DDR4', b: 'Samsung', cat: 'components', type: 'Memoria', badge: 'Testado', grade: 5, price: 78, specs: [['Capacidad', '32 GB'], ['Velocidad', '2933 MHz'], ['ECC', 'Registered']] },
    { t: '1.92TB SSD SAS', b: 'Intel', cat: 'components', type: 'Almacenamiento', badge: 'Refurbished', grade: 4, price: 215, specs: [['Capacidad', '1.92 TB'], ['Interfaz', '12G SAS'], ['Formato', '2.5"']] },
    { t: 'Xeon Gold 6248R', b: 'Intel', cat: 'components', type: 'Procesador', badge: 'Refurbished', grade: 5, price: 460, specs: [['Núcleos', '24c / 48t'], ['Frecuencia', '3.0 GHz'], ['TDP', '205 W']] },
    { t: 'StoreEver MSL2024', b: 'HPE', cat: 'storage', type: 'Librería LTO', badge: 'Refurbished', grade: 3, price: 1340, specs: [['Tipo', 'LTO-8'], ['Slots', '24'], ['Capacidad', '720 TB']] },
    { t: 'UCS C220 M5', b: 'Cisco', cat: 'server', type: 'Servidor 1U', badge: 'Refurbished', grade: 4, price: 1680, specs: [['CPU', '2× Xeon Gold 5118'], ['RAM', '96 GB DDR4'], ['Discos', '4× 960GB SSD']] },
  ];
  const gradeName = ['', 'E', 'D', 'C', 'B', 'A'];
  let activeFilter = 'all', searchTerm = '', sortMode = 'rel';
  const gradeBar = g => {
    let h = '';
    for (let i = 1; i <= 5; i++) h += `<i class="${i <= g ? 'fill' : ''}"></i>`;
    return `<div class="grade">${h}<em>Grado ${gradeName[g]}</em></div>`;
  };
  function render() {
    let f = PRODUCTS.filter(p =>
      (activeFilter === 'all' || p.cat === activeFilter) &&
      (p.t + ' ' + p.b).toLowerCase().includes(searchTerm.toLowerCase()));
    if (sortMode === 'asc')   f = [...f].sort((a, b) => a.price - b.price);
    if (sortMode === 'desc')  f = [...f].sort((a, b) => b.price - a.price);
    if (sortMode === 'grade') f = [...f].sort((a, b) => b.grade - a.grade);
    if (!f.length) {
      grid.innerHTML = `<div class="empty">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4M8 11h6"/></svg>
        Sin resultados para tu búsqueda.<br>Localizamos cualquier <i>part number</i>: <a href="contacto.html" style="color:var(--blue);font-weight:700">pídenos presupuesto</a>.</div>`;
      return;
    }
    grid.innerHTML = f.map((p, i) => `<article class="prod" style="animation-delay:${Math.min(i * 45, 400)}ms">
      <div class="top"><span class="ptype">${p.type}</span><span class="badge">${p.badge}</span></div>
      <h4>${p.t}</h4><div class="brand">${p.b}</div>
      ${gradeBar(p.grade)}
      <div class="specs">${p.specs.map(s => `<div><span>${s[0]}</span><b>${s[1]}</b></div>`).join('')}</div>
      <div class="pfoot"><div class="price"><b>${eur(p.price)}</b><span>+ IVA · refurbished</span></div>
        <a class="add" href="contacto.html?tipo=compra&producto=${encodeURIComponent(p.t + ' (' + p.b + ')')}"
           aria-label="Pedir presupuesto de ${p.t}" title="Pedir presupuesto">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4z"/></svg></a></div>
    </article>`).join('');
  }
  render();
  $('#filters').addEventListener('click', e => {
    if (!e.target.classList.contains('filter')) return;
    $$('.filter').forEach(b => b.classList.remove('active'));
    e.target.classList.add('active');
    activeFilter = e.target.dataset.f;
    render();
  });
  $('#search').addEventListener('input', e => { searchTerm = e.target.value; render(); });
  $('#sortSel').addEventListener('change', e => { sortMode = e.target.value; render(); });
})();

})();
