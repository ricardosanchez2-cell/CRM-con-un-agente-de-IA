<?php
// ===== CONFIGURACIÓN =====
$base_url = '../';
$pagina_actual = 'historial';
$titulo_pagina = 'Historial de Precios - CRM';
$nombre_empresa = 'Nombre de la Empresa';

// ===== DATOS DE USUARIO =====
$usuario = ['nombre' => 'Juanito Perez', 'rol' => 'administrador'];

// ===== DATOS DE HISTORIAL (ejemplo) =====
$historial = [
    ['id' => 1, 'producto' => 'Servicio Básico', 'precio_anterior' => 450, 'precio_nuevo' => 500, 'fecha' => '2026-04-01', 'usuario' => 'Admin'],
    ['id' => 2, 'producto' => 'Servicio Premium', 'precio_anterior' => 1200, 'precio_nuevo' => 1500, 'fecha' => '2026-03-15', 'usuario' => 'Admin'],
    ['id' => 3, 'producto' => 'Producto A', 'precio_anterior' => 280, 'precio_nuevo' => 250, 'fecha' => '2026-03-10', 'usuario' => 'Carlos López'],
    ['id' => 4, 'producto' => 'Producto B', 'precio_anterior' => 350, 'precio_nuevo' => 380, 'fecha' => '2026-02-28', 'usuario' => 'Admin'],
    ['id' => 5, 'producto' => 'Consultoría', 'precio_anterior' => 1800, 'precio_nuevo' => 2000, 'fecha' => '2026-02-15', 'usuario' => 'María García'],
];

// ===== INCLUIR HEADER =====
include '../includes/header.php';
?>

<!-- LAYOUT -->
<div class="layout" id="layout">

  <?php include '../includes/sidebar.php'; ?>

  <!-- MAIN -->
  <div class="main" id="main">

    <?php include '../includes/topbar.php'; ?>

    <!-- CONTENIDO HISTORIAL -->
    <section class="section active">
      <div class="content-inner">

        <!-- PAGE HEADER -->
        <div class="page-header">
          <h2><i class="fas fa-clock-rotate-left"></i> Historial de Precios</h2>
          <p>Consulta el historial de cambios de precios</p>
        </div>

        <!-- STATS -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-list"></i></div>
            <div class="stat-value"><?= count($historial) ?></div>
            <div class="stat-label">Total Cambios</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-arrow-up"></i></div>
            <div class="stat-value"><?= count(array_filter($historial, fn($h) => $h['precio_nuevo'] > $h['precio_anterior'])) ?></div>
            <div class="stat-label">Aumentos</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon red"><i class="fas fa-arrow-down"></i></div>
            <div class="stat-value"><?= count(array_filter($historial, fn($h) => $h['precio_nuevo'] < $h['precio_anterior'])) ?></div>
            <div class="stat-label">Reducciones</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-calendar"></i></div>
            <div class="stat-value"><?= date('M Y') ?></div>
            <div class="stat-label">Período Actual</div>
          </div>
        </div>

        <!-- FILTERS -->
        <div class="toolbar">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar por producto...">
          </div>
          <div style="display: flex; gap: 12px;">
            <select class="btn btn-secondary" style="padding: 10px 16px;">
              <option value="">Todos los productos</option>
              <option value="Servicio Básico">Servicio Básico</option>
              <option value="Servicio Premium">Servicio Premium</option>
              <option value="Producto A">Producto A</option>
              <option value="Producto B">Producto B</option>
            </select>
            <input type="date" class="btn btn-secondary" style="padding: 10px 16px;">
          </div>
        </div>

        <!-- TABLE -->
        <div class="card">
          <div class="data-table-wrapper">
            <table class="data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Producto/Servicio</th>
                  <th>Precio Anterior</th>
                  <th>Precio Nuevo</th>
                  <th>Variación</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($historial as $h): 
                  $variacion = $h['precio_nuevo'] - $h['precio_anterior'];
                  $porcentaje = $h['precio_anterior'] > 0 ? round(($variacion / $h['precio_anterior']) * 100, 1) : 0;
                  $esAumento = $variacion > 0;
                ?>
                <tr>
                  <td><?= $h['id'] ?></td>
                  <td><strong><?= htmlspecialchars($h['producto']) ?></strong></td>
                  <td>$<?= number_format($h['precio_anterior'], 2) ?></td>
                  <td>$<?= number_format($h['precio_nuevo'], 2) ?></td>
                  <td>
                    <span class="badge badge-<?= $esAumento ? 'success' : 'danger' ?>">
                      <i class="fas fa-arrow-<?= $esAumento ? 'up' : 'down' ?>"></i>
                      <?= $esAumento ? '+' : '' ?><?= $porcentaje ?>%
                    </span>
                  </td>
                  <td><?= date('d/m/Y', strtotime($h['fecha'])) ?></td>
                  <td><?= htmlspecialchars($h['usuario']) ?></td>
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

<?php include '../includes/footer.php'; ?>
