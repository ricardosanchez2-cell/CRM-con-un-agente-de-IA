<?php
// ===== CONFIGURACIÓN =====
$base_url = './';
$pagina_actual = 'dashboard';
$titulo_pagina = 'CRM Dashboard';
$nombre_empresa = 'Nombre de la Empresa';

// ===== DATOS DE USUARIO =====
$usuario = ['nombre' => 'Juanito Perez', 'rol' => 'administrador'];

// ===== DATOS DEL DASHBOARD =====
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
$citas_hoy = 5;
$meta_citas = 5;
$porcentaje = $meta_citas > 0 ? round(($citas_hoy/$meta_citas)*100) : 0;

if ($porcentaje >= 80) {
    $semaforo = 'verde';
    $msg = '¡ERES EL MEJOR!';
} elseif ($porcentaje >= 50) {
    $semaforo = 'amarillo';
    $msg = '¡VAS BIEN, SIGUE!';
} else {
    $semaforo = 'rojo';
    $msg = 'NECESITAS MEJORAR';
}

// ===== INCLUIR HEADER =====
include 'includes/header.php';
?>

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

  <?php include 'includes/sidebar.php'; ?>

  <!-- MAIN -->
  <div class="main" id="main">

    <?php include 'includes/topbar.php'; ?>

    <!-- CONTENIDO DASHBOARD -->
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

  </div><!-- /main -->
</div><!-- /layout -->

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

<?php include 'includes/footer.php'; ?>
