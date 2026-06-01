<?php
$usuario = ['nombre' => 'Juanito Perez', 'rol' => 'Vendedor'];

$itinerario = [
    ['nombre' => 'Juana de Arco',  'fecha' => '10/04/2026', 'hora' => '12:00 PM'],
    ['nombre' => 'Ignacia Reyes',  'fecha' => '16/04/2026', 'hora' => '2:00 PM'],
];

$prospectos_lista = [
    ['nombre' => 'Roberto Sánchez', 'estado' => true],
    ['nombre' => 'María González',  'estado' => true],
    ['nombre' => 'Felipe Torres',   'estado' => true],
    ['nombre' => 'Ana Martínez',    'estado' => true],
];

$prospectos_hoy = ['no_agendados' => 8, 'agendados' => 12, 'progreso_total' => 20];
$citas_hoy = 5; $meta_citas = 5;
$porcentaje = $meta_citas > 0 ? round(($citas_hoy/$meta_citas)*100) : 0;
if ($porcentaje >= 80)     { $semaforo = 'verde';    $msg = '¡ERES EL MEJOR!'; }
elseif ($porcentaje >= 50) { $semaforo = 'amarillo'; $msg = '¡VAS BIEN, SIGUE!'; }
else                        { $semaforo = 'rojo';     $msg = 'NECESITAS MEJORAR'; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CRM Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- MODAL LOGOUT -->
<div class="modal-overlay" id="logoutModal">
  <div class="modal-box">
    <p>¿Deseas cerrar sesión?</p>
    <div class="modal-btns">
      <button onclick="document.getElementById('logoutModal').classList.remove('show')">Cancelar</button>
      <button class="btn-confirm" onclick="window.location.href='login.php'">Confirmar</button>
    </div>
  </div>
</div>

<!-- MODAL SEMÁFORO CONFIG -->
<div class="modal-overlay" id="semaforoModal">
  <div class="modal-box">
    <h3>Configurar Semáforo</h3>
    <label>Meta de citas diarias</label>
    <input type="number" id="metaInput" value="<?= $meta_citas ?>" min="1" max="50">
    <label style="margin-top:10px">Umbral verde (%)</label>
    <input type="number" id="umbralVerde" value="80" min="1" max="100">
    <label style="margin-top:10px">Umbral amarillo (%)</label>
    <input type="number" id="umbralAmarillo" value="50" min="1" max="100">
    <div class="modal-btns" style="margin-top:16px">
      <button onclick="document.getElementById('semaforoModal').classList.remove('show')">Cancelar</button>
      <button class="btn-confirm" onclick="guardarSemaforo()">Guardar</button>
    </div>
  </div>
</div>

<!-- LAYOUT -->
<div class="layout" id="layout">

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <div class="sb-avatar">
      <div class="avatar-img"><i class="fas fa-user"></i></div>
    </div>
    <div class="sb-welcome">
      ¡Bienvenido<br>
      <strong><?= htmlspecialchars($usuario['nombre']) ?>!</strong>
    </div>
    <div class="sb-role"><?= htmlspecialchars($usuario['rol']) ?></div>

    <nav class="sb-nav">
      <a href="#" class="sb-link active" data-section="dashboard">
        <i class="fas fa-th-large"></i> Menú
      </a>
      <a href="#" class="sb-link" data-section="prospectos">
        <i class="fas fa-users"></i> Prospectos
      </a>
      <a href="#" class="sb-link" data-section="clientes">
        <i class="fas fa-handshake"></i> Clientes
      </a>
      <a href="#" class="sb-link dark" data-section="rendimiento">
        <i class="fas fa-chart-bar"></i> Rendimiento
      </a>
    </nav>

    <div class="sb-logo">LOGO</div>
  </aside>

  <!-- MAIN -->
  <div class="main" id="main">

    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-l">
        <button class="btn-toggle" id="btnToggle">
          <i class="fas fa-arrow-left" id="toggleIcon"></i>
          <span id="toggleLabel">Ocultar menú</span>
        </button>
        <h1 class="company">Nombre de la Empresa</h1>
      </div>
      <button class="btn-logout" onclick="document.getElementById('logoutModal').classList.add('show')">
        Cerrar Sesión
      </button>
    </header>

    <!-- SECCIÓN DASHBOARD -->
    <section class="section active" id="sec-dashboard">
      <div class="content-inner">

        <!-- TABS -->
        <div class="tabs">
          <button class="tab active" data-period="diarias">Diarias</button>
          <button class="tab" data-period="semanales">Semanales</button>
          <button class="tab" data-period="mensuales">Mensuales</button>
        </div>

        <!-- GRID 2 COLUMNAS -->
        <div class="dash-grid">

          <!-- CARD PROSPECTOS -->
          <div class="card">
            <div class="card-head">Nombres Prospectos</div>
            <div class="prosp-wrap">
              <div class="donut-box">
                <canvas id="donutChart" width="140" height="140"></canvas>
                <div class="donut-center"><span id="donutNum"><?= count($prospectos_lista) ?></span></div>
              </div>
              <div class="check-list">
                <?php foreach($prospectos_lista as $i => $p): ?>
                <label class="check-item <?= $p['estado'] ? 'checked' : '' ?>" data-idx="<?= $i ?>">
                  <span class="chkbox"></span>
                  <input type="text" class="prosp-input" value="<?= htmlspecialchars($p['nombre']) ?>" placeholder="Nombre prospecto">
                </label>
                <?php endforeach; ?>
              </div>
            </div>
          </div>

          <!-- CARD ITINERARIO -->
          <div class="card card-itinerario">
            <div class="card-title-bar">
              <i class="fas fa-bars"></i>&nbsp; Itinerario/Agendados
            </div>
            <table class="itable">
              <?php foreach($itinerario as $c): ?>
              <tr>
                <td class="it-nom"><?= htmlspecialchars($c['nombre']) ?></td>
                <td class="it-fecha"><?= htmlspecialchars($c['fecha']) ?></td>
                <td class="it-hora"><?= htmlspecialchars($c['hora']) ?></td>
              </tr>
              <?php endforeach; ?>
            </table>
          </div>

          <!-- CARD CHART -->
          <div class="card">
            <div class="chart-label">Progreso prospectos de hoy</div>
            <div class="chart-box"><canvas id="barChart"></canvas></div>
          </div>

          <!-- CARD SEMÁFORO -->
          <div class="card card-sem">
            <button class="btn-cfg" onclick="document.getElementById('semaforoModal').classList.add('show')">
              Configurar Semáforo
            </button>
            <div class="sem-inner">
              <div class="traffic-light">
                <div class="tl rojo    <?= $semaforo==='rojo'     ? 'on':'' ?>"></div>
                <div class="tl amarillo <?= $semaforo==='amarillo' ? 'on':'' ?>"></div>
                <div class="tl verde   <?= $semaforo==='verde'    ? 'on':'' ?>"></div>
              </div>
              <div class="sem-msg <?= $semaforo ?>" id="semMsg">
                LLEVAS <?= $citas_hoy ?> DE <?= $meta_citas ?> CITAS HOY,<br><?= $msg ?>
              </div>
            </div>
          </div>

        </div><!-- /dash-grid -->
      </div>
    </section>

    <!-- SECCIÓN PROSPECTOS -->
    <section class="section" id="sec-prospectos">
      <div class="content-inner">
        <h2 class="section-title">Prospectos</h2>
        <div class="card" style="max-width:600px">
          <p style="color:#666;font-size:14px">Lista completa de prospectos. Conecta tu base de datos aquí.</p>
          <table class="itable" style="margin-top:16px">
            <?php foreach($prospectos_lista as $p): ?>
            <tr>
              <td class="it-nom"><?= htmlspecialchars($p['nombre']) ?></td>
              <td><span class="badge-status <?= $p['estado'] ? 'verde':'rojo' ?>"><?= $p['estado'] ? 'Agendado':'Pendiente' ?></span></td>
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
      </div>
    </section>

    <!-- SECCIÓN CLIENTES -->
    <section class="section" id="sec-clientes">
      <div class="content-inner">
        <h2 class="section-title">Clientes</h2>
        <div class="card" style="max-width:600px">
          <p style="color:#666;font-size:14px">Gestión de clientes activos. Conecta tu base de datos aquí.</p>
        </div>
      </div>
    </section>

    <!-- SECCIÓN RENDIMIENTO -->
    <section class="section" id="sec-rendimiento">
      <div class="content-inner">
        <h2 class="section-title">Rendimiento</h2>
        <div class="dash-grid">
          <div class="card">
            <div class="chart-label">Comparativa mensual</div>
            <div class="chart-box"><canvas id="rendChart"></canvas></div>
          </div>
          <div class="card">
            <div class="card-head">Resumen</div>
            <div class="stat-list">
              <div class="stat-row"><span>No Agendados</span><strong><?= $prospectos_hoy['no_agendados'] ?></strong></div>
              <div class="stat-row"><span>Agendados</span><strong><?= $prospectos_hoy['agendados'] ?></strong></div>
              <div class="stat-row"><span>Progreso Total</span><strong><?= $prospectos_hoy['progreso_total'] ?></strong></div>
              <div class="stat-row"><span>Meta del día</span><strong><?= $porcentaje ?>%</strong></div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div><!-- /main -->
</div><!-- /layout -->

<script src="assets/js/app.js"></script>
<script>
const PHP = {
  noAgendados: <?= $prospectos_hoy['no_agendados'] ?>,
  agendados:   <?= $prospectos_hoy['agendados'] ?>,
  progreso:    <?= $prospectos_hoy['progreso_total'] ?>,
  checked:     <?= count(array_filter($prospectos_lista, fn($p)=>$p['estado'])) ?>,
  total:       <?= count($prospectos_lista) ?>,
  citasHoy:    <?= $citas_hoy ?>,
  metaCitas:   <?= $meta_citas ?>,
  semaforo:    '<?= $semaforo ?>'
};
</script>
</body>
</html>
