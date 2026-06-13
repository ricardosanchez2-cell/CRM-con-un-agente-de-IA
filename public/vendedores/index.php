<?php
// ===== CONFIGURACIÓN =====
$base_url = '../';
$pagina_actual = 'vendedores';
$titulo_pagina = 'Vendedores - CRM';
$nombre_empresa = 'Nombre de la Empresa';

// ===== DATOS DE USUARIO =====
$usuario = ['nombre' => 'Juanito Perez', 'rol' => 'administrador'];

// ===== DATOS DE VENDEDORES (ejemplo) =====
$vendedores = [
    ['id' => 1, 'nombre' => 'Carlos López', 'email' => 'carlos@empresa.com', 'telefono' => '555-1234', 'ventas' => 45, 'estado' => 'activo'],
    ['id' => 2, 'nombre' => 'María García', 'email' => 'maria@empresa.com', 'telefono' => '555-5678', 'ventas' => 38, 'estado' => 'activo'],
    ['id' => 3, 'nombre' => 'Pedro Martínez', 'email' => 'pedro@empresa.com', 'telefono' => '555-9012', 'ventas' => 52, 'estado' => 'activo'],
    ['id' => 4, 'nombre' => 'Ana Rodríguez', 'email' => 'ana@empresa.com', 'telefono' => '555-3456', 'ventas' => 29, 'estado' => 'inactivo'],
];

// ===== INCLUIR HEADER =====
include '../includes/header.php';
?>

<!-- MODAL AGREGAR/EDITAR VENDEDOR -->
<div class="modal-overlay" id="vendedorModal">
  <div class="modal-box" style="min-width: 450px;">
    <h3 id="modalTitle">Agregar Vendedor</h3>
    <form id="vendedorForm">
      <input type="hidden" id="vendedorId" name="id">
      <div class="form-grid">
        <div class="form-group">
          <label>Nombre completo</label>
          <input type="text" id="vendedorNombre" name="nombre" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" id="vendedorEmail" name="email" required>
        </div>
        <div class="form-group">
          <label>Teléfono</label>
          <input type="text" id="vendedorTelefono" name="telefono">
        </div>
        <div class="form-group">
          <label>Estado</label>
          <select id="vendedorEstado" name="estado">
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
          </select>
        </div>
      </div>
      <div class="modal-btns" style="margin-top: 20px;">
        <button type="button" onclick="closeModal('vendedorModal')">Cancelar</button>
        <button type="submit" class="btn-confirm">Guardar</button>
      </div>
    </form>
  </div>
</div>

<!-- LAYOUT -->
<div class="layout" id="layout">

  <?php include '../includes/sidebar.php'; ?>

  <!-- MAIN -->
  <div class="main" id="main">

    <?php include '../includes/topbar.php'; ?>

    <!-- CONTENIDO VENDEDORES -->
    <section class="section active">
      <div class="content-inner">

        <!-- PAGE HEADER -->
        <div class="page-header">
          <h2><i class="fas fa-users"></i> Gestión de Vendedores</h2>
          <p>Administra tu equipo de ventas</p>
        </div>

        <!-- STATS -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-users"></i></div>
            <div class="stat-value"><?= count($vendedores) ?></div>
            <div class="stat-label">Total Vendedores</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-user-check"></i></div>
            <div class="stat-value"><?= count(array_filter($vendedores, fn($v) => $v['estado'] === 'activo')) ?></div>
            <div class="stat-label">Activos</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-chart-line"></i></div>
            <div class="stat-value"><?= array_sum(array_column($vendedores, 'ventas')) ?></div>
            <div class="stat-label">Ventas Totales</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon red"><i class="fas fa-user-xmark"></i></div>
            <div class="stat-value"><?= count(array_filter($vendedores, fn($v) => $v['estado'] === 'inactivo')) ?></div>
            <div class="stat-label">Inactivos</div>
          </div>
        </div>

        <!-- TOOLBAR -->
        <div class="toolbar">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar vendedor...">
          </div>
          <button class="btn btn-primary" onclick="openModal('vendedorModal')">
            <i class="fas fa-plus"></i> Agregar Vendedor
          </button>
        </div>

        <!-- TABLE -->
        <div class="card">
          <div class="data-table-wrapper">
            <table class="data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>Ventas</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($vendedores as $v): ?>
                <tr>
                  <td><?= $v['id'] ?></td>
                  <td><strong><?= htmlspecialchars($v['nombre']) ?></strong></td>
                  <td><?= htmlspecialchars($v['email']) ?></td>
                  <td><?= htmlspecialchars($v['telefono']) ?></td>
                  <td><?= $v['ventas'] ?></td>
                  <td>
                    <span class="badge badge-<?= $v['estado'] === 'activo' ? 'success' : 'danger' ?>">
                      <?= ucfirst($v['estado']) ?>
                    </span>
                  </td>
                  <td>
                    <div class="action-btns">
                      <button class="btn btn-secondary btn-sm" title="Editar">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-danger btn-sm" title="Eliminar">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
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

<?php include '../includes/footer.php'; ?>
