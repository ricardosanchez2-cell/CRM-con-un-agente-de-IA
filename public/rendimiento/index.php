<?php
// ===== CONFIGURACIÓN =====
$base_url = '../';
$pagina_actual = 'rendimiento';
$titulo_pagina = 'Rendimiento - CRM';
$nombre_empresa = 'Nombre de la Empresa';

// ===== DATOS DE USUARIO =====
$usuario = ['nombre' => 'Juanito Perez', 'rol' => 'administrador'];

// ===== DATOS DE RENDIMIENTO (ejemplo) =====
$rendimiento_vendedores = [
    ['nombre' => 'Carlos López', 'ventas' => 45, 'prospectos' => 120,  'ingresos' => 67500],
    ['nombre' => 'María García', 'ventas' => 38, 'prospectos' => 95,  'ingresos' => 57000],
    ['nombre' => 'Pedro Martínez', 'ventas' => 52, 'prospectos' => 140, 'ingresos' => 78000],
    ['nombre' => 'Ana Rodríguez', 'ventas' => 29, 'prospectos' => 85,  'ingresos' => 43500],
];

$metricas_mensuales = [
    ['mes' => 'Enero', 'ventas' => 85, 'ingresos' => 127500],
    ['mes' => 'Febrero', 'ventas' => 92, 'ingresos' => 138000],
    ['mes' => 'Marzo', 'ventas' => 78, 'ingresos' => 117000],
    ['mes' => 'Abril', 'ventas' => 105, 'ingresos' => 157500],
];

$total_ventas = array_sum(array_column($rendimiento_vendedores, 'ventas'));
$total_ingresos = array_sum(array_column($rendimiento_vendedores, 'ingresos'));


// ===== INCLUIR HEADER =====
include '../includes/header.php';
?>

<!-- LAYOUT -->
<div class="layout" id="layout">

  <?php include '../includes/sidebar.php'; ?>

  <!-- MAIN -->
  <div class="main" id="main">

    <?php include '../includes/topbar.php'; ?>

    <!-- CONTENIDO RENDIMIENTO -->
    <section class="section active">
      <div class="content-inner">

        <!-- PAGE HEADER -->
        <div class="page-header">
          <h2><i class="fas fa-chart-bar"></i> Panel de Rendimiento</h2>
          <p>Analiza el rendimiento de tu equipo de ventas</p>
        </div>

        <!-- TABS -->
        <div class="tabs">
          <button class="tab active" data-period="diarias">Este Mes</button>
          <button class="tab" data-period="semanales">Trimestre</button>
          <button class="tab" data-period="mensuales">Año</button>
        </div>

        <!-- STATS -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-shopping-cart"></i></div>
            <div class="stat-value"><?= $total_ventas ?></div>
            <div class="stat-label">Ventas Totales</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-value">$<?= number_format($total_ingresos) ?></div>
            <div class="stat-label">Ingresos Totales</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-percentage"></i></div>
        
            <div class="stat-label">Tasa Conversión</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon red"><i class="fas fa-trophy"></i></div>
            <div class="stat-value"><?= count($rendimiento_vendedores) ?></div>
            <div class="stat-label">Vendedores Activos</div>
          </div>
        </div>

        <!-- CHARTS ROW -->
        <div class="dash-grid">
          <!-- CHART VENTAS MENSUALES -->
          <div class="card">
            <div class="card-head">Ventas Mensuales</div>
            <div class="chart-box">
              <canvas id="ventasMensualesChart"></canvas>
            </div>
          </div>

          <!-- CHART INGRESOS -->
          <div class="card">
            <div class="card-head">Ingresos por Mes</div>
            <div class="chart-box">
              <canvas id="ingresosMensualesChart"></canvas>
            </div>
          </div>
        </div>

        <!-- TABLE RENDIMIENTO POR VENDEDOR -->
        <div class="card" style="margin-top: 24px;">
          <div class="card-head">Rendimiento por Vendedor</div>
          <div class="data-table-wrapper">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Vendedor</th>
                  <th>Ventas</th>
                  <th>Prospectos</th>
                  <th>Ingresos</th>
                  <th>Rendimiento</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $max_ventas = max(array_column($rendimiento_vendedores, 'ventas'));
                foreach($rendimiento_vendedores as $r): 
                  $rendimiento_pct = round(($r['ventas'] / $max_ventas) * 100);
                  if ($rendimiento_pct >= 80) {
                    $rendimiento_class = 'success';
                    $rendimiento_label = 'Excelente';
                  } elseif ($rendimiento_pct >= 60) {
                    $rendimiento_class = 'warning';
                    $rendimiento_label = 'Bueno';
                  } else {
                    $rendimiento_class = 'danger';
                    $rendimiento_label = 'Mejorar';
                  }
                ?>
                <tr>
                  <td><strong><?= htmlspecialchars($r['nombre']) ?></strong></td>
                  <td><?= $r['ventas'] ?></td>
                  <td><?= $r['prospectos'] ?></td>
                
                  <td>$<?= number_format($r['ingresos']) ?></td>
                  <td>
                    <span class="badge badge-<?= $rendimiento_class ?>">
                      <?= $rendimiento_label ?>
                    </span>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>

  </div><!-- /main -->
</div><!-- /layout -->

<script>
// Datos para gráficos
const meses = <?= json_encode(array_column($metricas_mensuales, 'mes')) ?>;
const ventasMes = <?= json_encode(array_column($metricas_mensuales, 'ventas')) ?>;
const ingresosMes = <?= json_encode(array_column($metricas_mensuales, 'ingresos')) ?>;

document.addEventListener('DOMContentLoaded', function() {
  // Chart Ventas Mensuales
  const ventasCtx = document.getElementById('ventasMensualesChart');
  if (ventasCtx) {
    new Chart(ventasCtx.getContext('2d'), {
      type: 'bar',
      data: {
        labels: meses,
        datasets: [{
          label: 'Ventas',
          data: ventasMes,
          backgroundColor: '#2563eb',
          borderRadius: 8,
          barThickness: 40
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { color: '#e2e8f0' } },
          x: { grid: { display: false } }
        }
      }
    });
  }

  // Chart Ingresos Mensuales
  const ingresosCtx = document.getElementById('ingresosMensualesChart');
  if (ingresosCtx) {
    new Chart(ingresosCtx.getContext('2d'), {
      type: 'line',
      data: {
        labels: meses,
        datasets: [{
          label: 'Ingresos',
          data: ingresosMes,
          borderColor: '#22c55e',
          backgroundColor: 'rgba(34, 197, 94, 0.1)',
          fill: true,
          tension: 0.4,
          pointRadius: 6,
          pointBackgroundColor: '#22c55e'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, grid: { color: '#e2e8f0' } },
          x: { grid: { display: false } }
        }
      }
    });
  }
});
</script>

<?php include '../includes/footer.php'; ?>
