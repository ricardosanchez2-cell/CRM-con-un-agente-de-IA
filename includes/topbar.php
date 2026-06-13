<?php
/**
 * Topbar Component
 */
?>

<!-- TOPBAR -->
<header class="topbar">
  <div class="topbar-l">
    <button class="btn-toggle" id="btnToggle">
      <i class="fas fa-arrow-left" id="toggleIcon"></i>
      <span id="toggleLabel">Ocultar menú</span>
    </button>
    <h1 class="company"><?= htmlspecialchars($nombre_empresa ?? 'Nombre de la Empresa') ?></h1>
  </div>
  <button class="btn-logout" onclick="document.getElementById('logoutModal').classList.add('show')">
    Cerrar Sesión
  </button>
</header>

<!-- MODAL LOGOUT -->
<div class="modal-overlay" id="logoutModal">
  <div class="modal-box">
    <p>¿Deseas cerrar sesión?</p>
    <div class="modal-btns">
      <button onclick="document.getElementById('logoutModal').classList.remove('show')">Cancelar</button>
      <button class="btn-confirm" onclick="window.location.href='<?= $base_url ?>user/index.php'">Confirmar</button>
    </div>
  </div>
</div>
