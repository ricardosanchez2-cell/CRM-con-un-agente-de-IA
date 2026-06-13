<?php
// ===== CONFIGURACIÓN =====
$base_url = '../';
$pagina_actual = 'prospectos';
$titulo_pagina = 'Prospectos - CRM';
$nombre_empresa = 'Nombre de la Empresa';

// ===== DATOS DE USUARIO =====
$usuario = ['nombre' => 'Juanito Perez', 'rol' => 'administrador'];

// ===== DATOS DE PROSPECTOS (ejemplo) =====
$prospectos = [
    ['id' => 1, 'nombre' => 'Roberto Sánchez', 'email' => 'roberto@gmail.com', 'telefono' => '555-1111', 'origen' => 'Web', 'estado' => 'nuevo', 'fecha' => '2026-04-01'],
    ['id' => 2, 'nombre' => 'María González', 'email' => 'maria.g@gmail.com', 'telefono' => '555-2222', 'origen' => 'Referido', 'estado' => 'contactado', 'fecha' => '2026-04-02'],
    ['id' => 3, 'nombre' => 'Felipe Torres', 'email' => 'felipe.t@gmail.com', 'telefono' => '555-3333', 'origen' => 'Redes Sociales', 'estado' => 'calificado', 'fecha' => '2026-04-03'],
    ['id' => 4, 'nombre' => 'Ana Martínez', 'email' => 'ana.m@gmail.com', 'telefono' => '555-4444', 'origen' => 'Web', 'estado' => 'propuesta', 'fecha' => '2026-04-04'],
    ['id' => 5, 'nombre' => 'Luis Hernández', 'email' => 'luis.h@gmail.com', 'telefono' => '555-5555', 'origen' => 'Evento', 'estado' => 'nuevo', 'fecha' => '2026-04-05'],
];

// ===== INCLUIR HEADER =====
include '../includes/header.php';
?>

<!-- MODAL AGREGAR/EDITAR PROSPECTO -->
<div class="modal-overlay" id="prospectoModal">
  <div class="modal-box" style="min-width: 500px;">
    <h3 id="modalTitle">Agregar Prospecto</h3>
    <form id="prospectoForm">
      <input type="hidden" id="prospectoId" name="id">
      <div class="form-grid">
        <div class="form-group">
          <label>Nombre completo</label>
          <input type="text" id="prospectoNombre" name="nombre" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" id="prospectoEmail" name="email" required>
        </div>
        <div class="form-group">
          <label>Teléfono</label>
          <input type="text" id="prospectoTelefono" name="telefono">
        </div>
        <div class="form-group">
          <label>Origen</label>
          <select id="prospectoOrigen" name="origen">
            <option value="Web">Web</option>
            <option value="Referido">Referido</option>
            <option value="Redes Sociales">Redes Sociales</option>
            <option value="Evento">Evento</option>
            <option value="Llamada">Llamada</option>
          </select>
        </div>
        <div class="form-group">
          <label>Estado</label>
          <select id="prospectoEstado" name="estado">
            <option value="nuevo">Nuevo</option>
            <option value="contactado">Contactado</option>
            <option value="calificado">Calificado</option>
            <option value="propuesta">Propuesta</option>
            <option value="negociacion">Negociación</option>
          </select>
        </div>
        <div class="form-group">
          <label>Fecha de contacto</label>
          <input type="date" id="prospectoFecha" name="fecha">
        </div>
        <div class="form-group full-width">
          <label>Notas</label>
          <textarea id="prospectoNotas" name="notas" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-btns" style="margin-top: 20px;">
        <button type="button" onclick="closeModal('prospectoModal')">Cancelar</button>
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

    <!-- CONTENIDO PROSPECTOS -->
    <section class="section active">
      <div class="content-inner">

        <!-- PAGE HEADER -->
        <div class="page-header">
          <h2><i class="fas fa-users"></i> Gestión de Prospectos</h2>
          <p>Administra tus prospectos y oportunidades de venta</p>
        </div>

        <!-- STATS -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-user-plus"></i></div>
            <div class="stat-value"><?= count($prospectos) ?></div>
            <div class="stat-label">Total Prospectos</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-star"></i></div>
            <div class="stat-value"><?= count(array_filter($prospectos, fn($p) => $p['estado'] === 'nuevo')) ?></div>
            <div class="stat-label">Nuevos</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon yellow"><i class="fas fa-phone"></i></div>
            <div class="stat-value"><?= count(array_filter($prospectos, fn($p) => $p['estado'] === 'contactado')) ?></div>
            <div class="stat-label">Contactados</div>
          </div>
          <div class="stat-card">
            <div class="stat-icon red"><i class="fas fa-file-invoice"></i></div>
            <div class="stat-value"><?= count(array_filter($prospectos, fn($p) => $p['estado'] === 'propuesta')) ?></div>
            <div class="stat-label">En Propuesta</div>
          </div>
        </div>

        <!-- TOOLBAR -->
        <div class="toolbar">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar prospecto...">
          </div>
          <button class="btn btn-primary" onclick="openModal('prospectoModal')">
            <i class="fas fa-plus"></i> Agregar Prospecto
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
                  <th>Origen</th>
                  <th>Estado</th>
                  <th>Fecha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($prospectos as $p): ?>
                <tr>
                  <td><?= $p['id'] ?></td>
                  <td><strong><?= htmlspecialchars($p['nombre']) ?></strong></td>
                  <td><?= htmlspecialchars($p['email']) ?></td>
                  <td><?= htmlspecialchars($p['telefono']) ?></td>
                  <td><?= htmlspecialchars($p['origen']) ?></td>
                  <td>
                    <?php
                    $estadoClass = match($p['estado']) {
                      'nuevo' => 'info',
                      'contactado' => 'warning',
                      'calificado' => 'success',
                      'propuesta' => 'danger',
                      default => 'info'
                    };
                    ?>
                    <span class="badge badge-<?= $estadoClass ?>">
                      <?= ucfirst($p['estado']) ?>
                    </span>
                  </td>
                  <td><?= date('d/m/Y', strtotime($p['fecha'])) ?></td>
                  <td>
                    <div class="action-btns">
                      <button class="btn btn-secondary btn-sm" title="Ver">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="btn btn-secondary btn-sm" title="Editar">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button class="btn btn-success btn-sm" title="Convertir a Cliente">
                        <i class="fas fa-user-check"></i>
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
