<?php
/**
 * Sidebar Component
 * 
 * Variables esperadas:
 * - $usuario: array con 'nombre' y 'rol'
 * - $pagina_actual: string con el nombre de la página actual
 */

$pagina_actual = $pagina_actual ?? 'dashboard';
?>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
  <div class="sb-avatar">
    <div class="avatar-img"><i class="fas fa-user"></i></div>
  </div>
  <div class="sb-welcome">
    ¡Bienvenido<br>
    <strong><?= htmlspecialchars($usuario['nombre'] ?? 'Usuario') ?>!</strong>
  </div>
  <div class="sb-role"><?= htmlspecialchars($usuario['rol'] ?? 'usuario') ?></div>

  <nav class="sb-nav">
    <a href="<?= $base_url ?>index.php" class="sb-link <?= $pagina_actual === 'dashboard' ? 'active' : '' ?>">
      <i class="fas fa-th-large"></i> Menú
    </a>
    <a href="<?= $base_url ?>vendedores/index.php" class="sb-link <?= $pagina_actual === 'vendedores' ? 'active' : '' ?>">
      <i class="fas fa-users"></i> Vendedores
    </a>
    <a href="<?= $base_url ?>prospectos/index.php" class="sb-link <?= $pagina_actual === 'prospectos' ? 'active' : '' ?>">
      <i class="fas fa-users"></i> Prospectos
    </a>
    <a href="<?= $base_url ?>clientes/index.php" class="sb-link <?= $pagina_actual === 'clientes' ? 'active' : '' ?>">
      <i class="fas fa-handshake"></i> Clientes
    </a>
    <a href="<?= $base_url ?>productos-servicios/index.php" class="sb-link <?= $pagina_actual === 'productos' ? 'active' : '' ?>">
      <i class="fas fa-box"></i> Productos/Servicios
    </a>
    <a href="<?= $base_url ?>historial-precios/index.php" class="sb-link <?= $pagina_actual === 'historial' ? 'active' : '' ?>">
      <i class="fas fa-clock-rotate-left"></i> Historial de precios
    </a>
    <a href="<?= $base_url ?>rendimiento/index.php" class="sb-link dark <?= $pagina_actual === 'rendimiento' ? 'active' : '' ?>">
      <i class="fas fa-chart-bar"></i> Rendimiento
    </a>
  </nav>

  <div class="sb-logo">LOGO</div>
</aside>
