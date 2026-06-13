<?php
// ===== CONFIGURACIÓN =====
$base_url = '../';
$pagina_actual = 'productos';
$titulo_pagina = 'Productos/Servicios - CRM';
$nombre_empresa = 'Nombre de la Empresa';

// ===== DATOS DE USUARIO =====
$usuario = ['nombre' => 'Juanito Perez', 'rol' => 'administrador'];

// ===== DATOS DE PRODUCTOS (ejemplo) =====
$productos = [
    ['id' => 1, 'codigo' => 'PROD-001', 'nombre' => 'Servicio Básico', 'categoria' => 'Servicio', 'precio' => 500, 'stock' => null, 'estado' => 'activo'],
    ['id' => 2, 'codigo' => 'PROD-002', 'nombre' => 'Servicio Premium', 'categoria' => 'Servicio', 'precio' => 1500, 'stock' => null, 'estado' => 'activo'],
    ['id' => 3, 'codigo' => 'PROD-003', 'nombre' => 'Producto A', 'categoria' => 'Producto', 'precio' => 250, 'stock' => 150, 'estado' => 'activo'],
    ['id' => 4, 'codigo' => 'PROD-004', 'nombre' => 'Producto B', 'categoria' => 'Producto', 'precio' => 380, 'stock' => 85, 'estado' => 'activo'],
    ['id' => 5, 'codigo' => 'PROD-005', 'nombre' => 'Consultoría', 'categoria' => 'Servicio', 'precio' => 2000, 'stock' => null, 'estado' => 'inactivo'],
];

// ===== INCLUIR HEADER =====
include '../includes/header.php';
?>

<!-- MODAL AGREGAR/EDITAR PRODUCTO -->
<div class="modal-overlay" id="productoModal">
  <div class="modal-box" style="min-width: 500px;">
    <h3 id="modalTitle">Agregar Producto/Servicio</h3>
    <form id="productoForm">
      <input type="hidden" id="productoId" name="id">
      <div class="form-grid">
        <div class="form-group">
          <label>Código</label>
          <input type="text" id="productoCodigo" name="codigo" required>
        </div>
        <div class="form-group">
          <label>Nombre</label>
          <input type="text" id="productoNombre" name="nombre" required>
        </div>
        <div class="form-group">
          <label>Categoría</label>
          <select id="productoCategoria" name="categoria">
            <option value="Producto">Producto</option>
            <option value="Servicio">Servicio</option>
          </select>
        </div>
        <div class="form-group">
          <label>Precio</label>
          <input type="number" id="productoPrecio" name="precio" min="0" step="0.01" required>
        </div>
        <div class="form-group">
          <label>Stock (solo productos)</label>
          <input type="number" id="productoStock" name="stock" min="0">
        </div>
        <div class="form-group">
          <label>Estado</label>
          <select id="productoEstado" name="estado">
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
          </select>
        </div>
        <div class="form-group full-width">
          <label>Descripción</label>
          <textarea id="productoDescripcion" name="descripcion" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-btns" style="margin-top: 20px;">
        <button type="button" onclick="closeModal('productoModal')">Cancelar</button>
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

    <!-- CONTENIDO PRODUCTOS -->
    <section class="section active">
      <div class="content-inner">

        <!-- PAGE HEADER -->
        <div class="page-header">
          <h2><i class="fas fa-box"></i> Productos y Servicios</h2>
          <p>Administra tu catálogo de productos y servicios</p>
        </div>

        <!-- STATS -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-boxes-stacked"></i></div>
            <div class="stat-value"><?= count($productos) ?></div>
            <div class="stat-label">Total Items</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-box"></i></div>
            <div class="stat-value"><?= count(array_filter($productos, fn($p) => $p['categoria'] === 'Producto')) ?></div>
            <div class="stat-label">Productos</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-concierge-bell"></i></div>
            <div class="stat-value"><?= count(array_filter($productos, fn($p) => $p['categoria'] === 'Servicio')) ?></div>
            <div class="stat-label">Servicios</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon red"><i class="fas fa-check-circle"></i></div>
            <div class="stat-value"><?= count(array_filter($productos, fn($p) => $p['estado'] === 'activo')) ?></div>
            <div class="stat-label">Activos</div>
          </div>
        </div>

        <!-- TOOLBAR -->
        <div class="toolbar">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar producto o servicio...">
          </div>
          <button class="btn btn-primary" onclick="openModal('productoModal')">
            <i class="fas fa-plus"></i> Agregar Nuevo
          </button>
        </div>

        <!-- TABLE -->
        <div class="card">
          <div class="data-table-wrapper">
            <table class="data-table">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Categoría</th>
                  <th>Precio</th>
                  <th>Stock</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($productos as $p): ?>
                <tr>
                  <td><code><?= htmlspecialchars($p['codigo']) ?></code></td>
                  <td><strong><?= htmlspecialchars($p['nombre']) ?></strong></td>
                  <td>
                    <span class="badge badge-<?= $p['categoria'] === 'Producto' ? 'info' : 'warning' ?>">
                      <?= $p['categoria'] ?>
                    </span>
                  </td>
                  <td>$<?= number_format($p['precio'], 2) ?></td>
                  <td><?= $p['stock'] !== null ? $p['stock'] : 'N/A' ?></td>
                  <td>
                    <span class="badge badge-<?= $p['estado'] === 'activo' ? 'success' : 'danger' ?>">
                      <?= ucfirst($p['estado']) ?>
                    </span>
                  </td>
                  <td>
                    <div class="action-btns">
                      <button class="btn btn-secondary btn-sm" title="Ver historial precios">
                        <i class="fas fa-chart-line"></i>
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
