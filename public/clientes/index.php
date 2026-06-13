<?php
// ===== CONFIGURACIÓN =====
$base_url = '../';
$pagina_actual = 'clientes';
$titulo_pagina = 'Clientes - CRM';
$nombre_empresa = 'Nombre de la Empresa';

// ===== DATOS DE USUARIO =====
$usuario = ['nombre' => 'Juanito Perez', 'rol' => 'administrador'];

// ===== DATOS DE CLIENTES (ejemplo) =====
$clientes = [
    ['id' => 1, 'nombre' => 'Empresa ABC', 'contacto' => 'Juan Pérez', 'email' => 'juan@abc.com', 'telefono' => '555-0001', 'compras' => 15000, 'estado' => 'activo', 'desde' => '2025-01-15'],
    ['id' => 2, 'nombre' => 'Tech Solutions', 'contacto' => 'María López', 'email' => 'maria@tech.com', 'telefono' => '555-0002', 'compras' => 28500, 'estado' => 'activo', 'desde' => '2024-06-20'],
    ['id' => 3, 'nombre' => 'Global Services', 'contacto' => 'Carlos Ruiz', 'email' => 'carlos@global.com', 'telefono' => '555-0003', 'compras' => 42000, 'estado' => 'activo', 'desde' => '2024-03-10'],
    ['id' => 4, 'nombre' => 'StartUp Inc', 'contacto' => 'Ana García', 'email' => 'ana@startup.com', 'telefono' => '555-0004', 'compras' => 8500, 'estado' => 'inactivo', 'desde' => '2025-02-28'],
];

// ===== INCLUIR HEADER =====
include '../includes/header.php';
?>

<!-- MODAL AGREGAR/EDITAR CLIENTE -->
<div class="modal-overlay" id="clienteModal">
  <div class="modal-box" style="min-width: 500px;">
    <h3 id="modalTitle">Agregar Cliente</h3>
    <form id="clienteForm">
      <input type="hidden" id="clienteId" name="id">
      <div class="form-grid">
        <div class="form-group">
          <label>Nombre / Empresa</label>
          <input type="text" id="clienteNombre" name="nombre" required>
        </div>
        <div class="form-group">
          <label>Persona de contacto</label>
          <input type="text" id="clienteContacto" name="contacto">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" id="clienteEmail" name="email" required>
        </div>
        <div class="form-group">
          <label>Teléfono</label>
          <input type="text" id="clienteTelefono" name="telefono">
        </div>
        <div class="form-group">
          <label>Estado</label>
          <select id="clienteEstado" name="estado">
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
          </select>
        </div>
        <div class="form-group">
          <label>Cliente desde</label>
          <input type="date" id="clienteDesde" name="desde">
        </div>
        <div class="form-group full-width">
          <label>Dirección</label>
          <textarea id="clienteDireccion" name="direccion" rows="2"></textarea>
        </div>
      </div>
      <div class="modal-btns" style="margin-top: 20px;">
        <button type="button" onclick="closeModal('clienteModal')">Cancelar</button>
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

    <!-- CONTENIDO CLIENTES -->
    <section class="section active">
      <div class="content-inner">

        <!-- PAGE HEADER -->
        <div class="page-header">
          <h2><i class="fas fa-handshake"></i> Gestión de Clientes</h2>
          <p>Administra tu cartera de clientes</p>
        </div>

        <!-- STATS -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-building"></i></div>
            <div class="stat-value"><?= count($clientes) ?></div>
            <div class="stat-label">Total Clientes</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-user-check"></i></div>
            <div class="stat-value"><?= count(array_filter($clientes, fn($c) => $c['estado'] === 'activo')) ?></div>
            <div class="stat-label">Activos</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-dollar-sign"></i></div>
            <div class="stat-value">$<?= number_format(array_sum(array_column($clientes, 'compras'))) ?></div>
            <div class="stat-label">Ventas Totales</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon red"><i class="fas fa-chart-line"></i></div>
            <div class="stat-value">$<?= number_format(array_sum(array_column($clientes, 'compras')) / count($clientes)) ?></div>
            <div class="stat-label">Promedio por Cliente</div>
          </div>
        </div>

        <!-- TOOLBAR -->
        <div class="toolbar">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar cliente...">
          </div>
          <button class="btn btn-primary" onclick="openModal('clienteModal')">
            <i class="fas fa-plus"></i> Agregar Cliente
          </button>
        </div>

        <!-- TABLE -->
        <div class="card">
          <div class="data-table-wrapper">
            <table class="data-table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Empresa</th>
                  <th>Contacto</th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>Compras</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($clientes as $c): ?>
                <tr>
                  <td><?= $c['id'] ?></td>
                  <td><strong><?= htmlspecialchars($c['nombre']) ?></strong></td>
                  <td><?= htmlspecialchars($c['contacto']) ?></td>
                  <td><?= htmlspecialchars($c['email']) ?></td>
                  <td><?= htmlspecialchars($c['telefono']) ?></td>
                  <td>$<?= number_format($c['compras']) ?></td>
                  <td>
                    <span class="badge badge-<?= $c['estado'] === 'activo' ? 'success' : 'danger' ?>">
                      <?= ucfirst($c['estado']) ?>
                    </span>
                  </td>
                  <td>
                    <div class="action-btns">
                      <button class="btn btn-secondary btn-sm" title="Ver historial">
                        <i class="fas fa-history"></i>
                      </button>
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
