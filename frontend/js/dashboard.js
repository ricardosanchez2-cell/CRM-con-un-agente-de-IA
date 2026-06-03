/* ============================================================
   dashboard.js  — CRM Dashboard
   ============================================================ */

// ── SIDEBAR TOGGLE ──────────────────────────────────────────
const sidebar  = document.getElementById('sidebar');
const main     = document.getElementById('main');
const btnToggle = document.getElementById('btnToggle');
const toggleIcon  = document.getElementById('toggleIcon');
const toggleLabel = document.getElementById('toggleLabel');
let sidebarOpen = true;

btnToggle.addEventListener('click', () => {
  if (window.innerWidth <= 540) {
    sidebar.classList.toggle('show-mobile');
    return;
  }
  sidebarOpen = !sidebarOpen;
  sidebar.classList.toggle('hidden', !sidebarOpen);
  main.classList.toggle('full', !sidebarOpen);
  toggleIcon.className  = sidebarOpen ? 'fas fa-arrow-left' : 'fas fa-arrow-right';
  toggleLabel.textContent = sidebarOpen ? 'Ocultar menú' : 'Mostrar menú';
});

// ── NAVEGACIÓN SIDEBAR ────────────────────────────────────
const links = document.querySelectorAll('.sb-link');
links.forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();
    links.forEach(l => l.classList.remove('active'));
    link.classList.add('active');
    const sec = link.dataset.section;
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    const target = document.getElementById('sec-' + sec);
    if (target) target.classList.add('active');
    // Inicializar chart de rendimiento cuando se activa //
    if (sec === 'rendimiento' && !rendChartInit) initRendChart();
  });
});

// ── PERIOD TABS ───────────────────────────────────────────
const tabSets = {
  diarias:   [PHP.noAgendados, PHP.agendados, PHP.progreso],
  semanales: [Math.round(PHP.noAgendados*5), Math.round(PHP.agendados*5), Math.round(PHP.progreso*5)],
  mensuales: [Math.round(PHP.noAgendados*21), Math.round(PHP.agendados*20), Math.round(PHP.progreso*20)]
};

document.querySelectorAll('.tab').forEach(tab => {
  tab.addEventListener('click', () => {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    tab.classList.add('active');
    if (barChart) {
      barChart.data.datasets[0].data = tabSets[tab.dataset.period];
      barChart.update();
    }
  });
});

// ── DONUT CHART ───────────────────────────────────────────
let checkedCount = PHP.checked;

const donutChart = new Chart(
  document.getElementById('donutChart').getContext('2d'), {
  type: 'doughnut',
  data: {
    labels: ['Contactados','Pendientes'],
    datasets: [{
      data: [checkedCount, PHP.total - checkedCount],
      backgroundColor: ['#2e6b2e','rgba(0,0,0,0.1)'],
      borderColor:     ['#1e4a1e','rgba(0,0,0,0.06)'],
      borderWidth: 2,
      hoverOffset: 4
    }]
  },
  options: {
    cutout: '70%',
    plugins: { legend: { display: false } },
    animation: { duration: 600 }
  }
});

function updateDonut() {
  const rows = document.querySelectorAll('.check-item');
  checkedCount = [...rows].filter(r => r.classList.contains('checked')).length;
  donutChart.data.datasets[0].data = [checkedCount, rows.length - checkedCount];
  donutChart.update();
  document.getElementById('donutNum').textContent = rows.length;
}

// ── CHECKBOXES PROSPECTOS ─────────────────────────────────
document.querySelectorAll('.check-item').forEach(item => {
  item.querySelector('.chkbox').addEventListener('click', () => {
    item.classList.toggle('checked');
    updateDonut();
  });
});

// ── BAR CHART ─────────────────────────────────────────────
const barChart = new Chart(
  document.getElementById('barChart').getContext('2d'), {
  type: 'bar',
  data: {
    labels: ['No Agendados','Agendados','Progreso Prospectos'],
    datasets: [{
      data: tabSets.diarias,
      backgroundColor: ['rgba(155,32,32,0.85)','rgba(184,144,0,0.85)','rgba(46,107,46,0.9)'],
      borderColor:     ['#6b1010','#8b6a00','#1e4a1e'],
      borderWidth: 1,
      borderRadius: 6,
      borderSkipped: false
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: { display: false },
      tooltip: {
        backgroundColor: '#2a2a2a',
        titleColor: '#fff',
        bodyColor: '#ccc',
        padding: 10,
        cornerRadius: 8,
        borderColor: '#555',
        borderWidth: 1
      }
    },
    scales: {
      x: {
        grid: { display: false },
        ticks: { color: '#666', font: { family: 'Nunito', size: 12, weight: '700' } },
        border: { color: '#bbb' }
      },
      y: {
        grid: { color: 'rgba(0,0,0,0.07)' },
        ticks: { color: '#888', font: { family: 'Nunito', size: 11 } },
        border: { color: '#bbb', dash: [4,4] }
      }
    },
    animation: { duration: 500 }
  }
});

// ── CHART RENDIMIENTO ─────────────────────────────────────
let rendChartInit = false;
function initRendChart() {
  rendChartInit = true;
  const ctx = document.getElementById('rendChart');
  if (!ctx) return;
  new Chart(ctx.getContext('2d'), {
    type: 'line',
    data: {
      labels: ['Ene','Feb','Mar','Abr','May','Jun'],
      datasets: [
        {
          label: 'Agendados',
          data: [8,14,11,17,12,20],
          borderColor: '#2e6b2e',
          backgroundColor: 'rgba(46,107,46,0.12)',
          tension: 0.35, fill: true, pointRadius: 4
        },
        {
          label: 'No Agendados',
          data: [12,9,14,8,10,8],
          borderColor: '#9b2020',
          backgroundColor: 'rgba(155,32,32,0.08)',
          tension: 0.35, fill: true, pointRadius: 4
        }
      ]
    },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: {
        legend: { labels: { font: { family: 'Nunito', weight: '700' }, color: '#444' } },
        tooltip: {
          backgroundColor: '#2a2a2a', titleColor: '#fff', bodyColor: '#ccc',
          cornerRadius: 8, padding: 10
        }
      },
      scales: {
        x: { ticks: { color: '#666', font: { family: 'Nunito' } }, border: { color: '#bbb' }, grid: { display: false } },
        y: { ticks: { color: '#888', font: { family: 'Nunito' } }, border: { color: '#bbb', dash: [4,4] }, grid: { color: 'rgba(0,0,0,0.07)' } }
      }
    }
  });
}

// ── SEMÁFORO CONFIG ───────────────────────────────────────
function guardarSemaforo() {
  const meta     = parseInt(document.getElementById('metaInput').value)      || 5;
  const umbVerde = parseInt(document.getElementById('umbralVerde').value)    || 80;
  const umbAma   = parseInt(document.getElementById('umbralAmarillo').value) || 50;
  const porcentaje = Math.round((PHP.citasHoy / meta) * 100);

  let estado, msg;
  if (porcentaje >= umbVerde)      { estado = 'verde';    msg = '¡ERES EL MEJOR!'; }
  else if (porcentaje >= umbAma)   { estado = 'amarillo'; msg = '¡VAS BIEN, SIGUE!'; }
  else                              { estado = 'rojo';     msg = 'NECESITAS MEJORAR'; }

  // Actualizar luces
  document.querySelectorAll('.tl').forEach(l => l.classList.remove('on'));
  document.querySelector('.tl.' + estado).classList.add('on');

  // Actualizar mensaje
  const msgEl = document.getElementById('semMsg');
  msgEl.className = 'sem-msg ' + estado;
  msgEl.innerHTML = `LLEVAS ${PHP.citasHoy} DE ${meta} CITAS HOY,<br>${msg}`;

  document.getElementById('semaforoModal').classList.remove('show');
}

// ── SEMÁFORO PULSO ────────────────────────────────────────
const onLight = document.querySelector('.tl.on');
if (onLight) {
  let dim = false;
  setInterval(() => {
    dim = !dim;
    onLight.style.opacity = dim ? '0.55' : '1';
  }, 1100);
}

// ── CERRAR MODALES AL CLICK FUERA ────────────────────────
document.querySelectorAll('.modal-overlay').forEach(overlay => {
  overlay.addEventListener('click', e => {
    if (e.target === overlay) overlay.classList.remove('show');
  });
});
