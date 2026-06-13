// ===== TOGGLE SIDEBAR =====
document.addEventListener('DOMContentLoaded', function() {
  const btnToggle = document.getElementById('btnToggle');
  const layout = document.getElementById('layout');
  const toggleIcon = document.getElementById('toggleIcon');
  const toggleLabel = document.getElementById('toggleLabel');

  if (btnToggle) {
    btnToggle.addEventListener('click', function() {
      layout.classList.toggle('collapsed');
      
      if (layout.classList.contains('collapsed')) {
        toggleIcon.className = 'fas fa-arrow-right';
        toggleLabel.textContent = 'Mostrar menú';
      } else {
        toggleIcon.className = 'fas fa-arrow-left';
        toggleLabel.textContent = 'Ocultar menú';
      }
    });
  }

  // ===== TABS =====
  const tabs = document.querySelectorAll('.tab');
  tabs.forEach(tab => {
    tab.addEventListener('click', function() {
      tabs.forEach(t => t.classList.remove('active'));
      this.classList.add('active');
      // Aquí puedes agregar lógica para cambiar el contenido según el período
      const period = this.dataset.period;
      console.log('Período seleccionado:', period);
    });
  });

  // ===== CHECKBOX ITEMS =====
  const checkItems = document.querySelectorAll('.check-item');
  checkItems.forEach(item => {
    item.addEventListener('click', function(e) {
      if (e.target.tagName !== 'INPUT') {
        this.classList.toggle('checked');
        updateDonutChart();
      }
    });
  });

  // ===== DONUT CHART =====
  const donutCanvas = document.getElementById('donutChart');
  if (donutCanvas && typeof Chart !== 'undefined' && typeof PHP !== 'undefined') {
    const donutCtx = donutCanvas.getContext('2d');
    window.donutChart = new Chart(donutCtx, {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [PHP.checked, PHP.total - PHP.checked],
          backgroundColor: ['#22c55e', '#e2e8f0'],
          borderWidth: 0
        }]
      },
      options: {
        cutout: '70%',
        plugins: {
          legend: { display: false },
          tooltip: { enabled: false }
        }
      }
    });
  }

  // ===== BAR CHART =====
  const barCanvas = document.getElementById('barChart');
  if (barCanvas && typeof Chart !== 'undefined' && typeof PHP !== 'undefined') {
    const barCtx = barCanvas.getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['No Agendados', 'Agendados', 'Progreso Total'],
        datasets: [{
          data: [PHP.noAgendados, PHP.agendados, PHP.progreso],
          backgroundColor: ['#ef4444', '#22c55e', '#2563eb'],
          borderRadius: 8,
          barThickness: 40
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: { color: '#e2e8f0' }
          },
          x: {
            grid: { display: false }
          }
        }
      }
    });
  }

  // ===== SEARCH FUNCTIONALITY =====
  const searchInputs = document.querySelectorAll('.search-box input');
  searchInputs.forEach(input => {
    input.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      const tableRows = document.querySelectorAll('.data-table tbody tr');
      
      tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
      });
    });
  });
});

// ===== UPDATE DONUT CHART =====
function updateDonutChart() {
  const checkedCount = document.querySelectorAll('.check-item.checked').length;
  const totalCount = document.querySelectorAll('.check-item').length;
  
  if (window.donutChart) {
    window.donutChart.data.datasets[0].data = [checkedCount, totalCount - checkedCount];
    window.donutChart.update();
  }
  
  const donutNum = document.getElementById('donutNum');
  if (donutNum) {
    donutNum.textContent = totalCount;
  }
}

// ===== SEMÁFORO CONFIG =====
function guardarSemaforo() {
  const meta = document.getElementById('metaInput').value;
  const umbralVerde = document.getElementById('umbralVerde').value;
  const umbralAmarillo = document.getElementById('umbralAmarillo').value;
  
  console.log('Configuración guardada:', { meta, umbralVerde, umbralAmarillo });
  
  // Aquí puedes agregar lógica para guardar en el servidor
  document.getElementById('semaforoModal').classList.remove('show');
  
  // Mostrar mensaje de éxito
  alert('Configuración guardada correctamente');
}

// ===== MODAL HELPERS =====
function openModal(modalId) {
  document.getElementById(modalId).classList.add('show');
}

function closeModal(modalId) {
  document.getElementById(modalId).classList.remove('show');
}

// ===== CLOSE MODALS ON OVERLAY CLICK =====
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('modal-overlay')) {
    e.target.classList.remove('show');
  }
});

// ===== CLOSE MODALS ON ESC KEY =====
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('.modal-overlay.show').forEach(modal => {
      modal.classList.remove('show');
    });
  }
});
