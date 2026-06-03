```html
<?php
$usuario = [
    'nombre' => 'Sebastian Rodriguez',
    'rol' => 'Administrador'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Administrador</title>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="dashboard-admin.css">
</head>

<body>

<div class="modal-overlay" id="logoutModal">

    <div class="modal-box">

        <p>¿Deseas cerrar sesión?</p>

        <div class="modal-btns">

            <button onclick="cerrarModal()">
                Cancelar
            </button>

            <button class="btn-confirm" onclick="window.location.href='login.php'">
    Confirmar
</button>

        </div>

    </div>

</div>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sb-avatar">
            <div class="avatar-img">
                <i class="fas fa-user"></i>
            </div>
        </div>

        <div class="sb-welcome">
            ¡Bienvenido!<br>
            <strong><?= $usuario['nombre'] ?></strong>
        </div>

        <div class="sb-role">
            <?= $usuario['rol'] ?>
        </div>

        <nav class="sb-nav">

            <a href="#" class="sb-link active">
                <i class="fas fa-th-large"></i>
                Menú
            </a>

            <a href="prospectos-admin.php" class="sb-link">
    <i class="fas fa-users"></i>
    Prospectos
</a>

            <a href="#" class="sb-link">
                <i class="fas fa-handshake"></i>
                Clientes
            </a>

            <a href="#" class="sb-link">
                <i class="fas fa-box"></i>
                Productos / Servicios
            </a>

            <a href="#" class="sb-link">
                <i class="fas fa-money-bill-wave"></i>
                Historial Ventas
            </a>

            <a href="#" class="sb-link">
                <i class="fas fa-bullseye"></i>
                Metas Corporativas
            </a>

            <a href="#" class="sb-link dark">
                <i class="fas fa-chart-bar"></i>
                Rendimiento
            </a>

        </nav>

        <div class="sb-logo">
            LOGO
        </div>

    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <button class="btn-toggle" id="btnToggle">
    <i class="fas fa-arrow-left" id="toggleIcon"></i>
    <span id="toggleLabel">Ocultar menú</span>
</button>
<h1 style="color:red;font-size:50px;">
PRUEBAAAAA
</h1>
            <div class="topbar-l">
                <h1 class="company">
                    NOMBRE DE LA EMPRESA
                </h1>
            </div>

            <button class="btn-logout" onclick="abrirModal()">
    Cerrar Sesión
</button>

        </header>

        <!-- CONTENIDO -->
        <div class="content-inner">

            <div class="dash-grid">

                <!-- CARD PROSPECTOS -->
                <div class="card">

                    <div class="card-head">
                        Nombres Prospectos
                    </div>

                    <div class="prosp-wrap">

                        <div class="donut-box">

                            <canvas width="140" height="140"></canvas>

                            <div class="donut-center">
                                <span>4</span>
                            </div>

                        </div>

                        <div class="check-list">

                            <label class="check-item checked">
                                <span class="chkbox"></span>
                                <input type="text" class="prosp-input" value="Roberto Sánchez">
                            </label>

                            <label class="check-item checked">
                                <span class="chkbox"></span>
                                <input type="text" class="prosp-input" value="María González">
                            </label>

                            <label class="check-item checked">
                                <span class="chkbox"></span>
                                <input type="text" class="prosp-input" value="Felipe Torres">
                            </label>

                            <label class="check-item checked">
                                <span class="chkbox"></span>
                                <input type="text" class="prosp-input" value="Ana Martínez">
                            </label>

                        </div>

                    </div>

                </div>

                <!-- CARD ITINERARIO -->
                <div class="card">

                    <div class="card-title-bar">
                        <i class="fas fa-bars"></i>
                        &nbsp;Itinerario / Agendados
                    </div>

                    <table class="itable">

                        <tr>
                            <td class="it-nom">JUANA DE ARCO</td>
                            <td class="it-fecha">10/04/2026</td>
                            <td class="it-hora">12:00 PM</td>
                        </tr>

                        <tr>
                            <td class="it-nom">IGNACIA REYES</td>
                            <td class="it-fecha">16/04/2026</td>
                            <td class="it-hora">2:00 PM</td>
                        </tr>

                    </table>

                </div>

                <!-- CARD GRÁFICO -->
                <div class="card">

                    <div class="chart-label">
                        Progreso prospectos de hoy
                    </div>

                    <div class="chart-box">
                        <canvas id="barChart"></canvas>
                    </div>

                </div>

                <!-- CARD ADMINISTRADOR -->
                <div class="card">

                    <div class="card-head">
                        Configuración Administrador
                    </div>

                    <div class="stat-list">

                        <div class="stat-row">
                            <span>Semáforo de vendedores</span>
                            <button class="btn-logout">
                                Configurar
                            </button>
                        </div>

                        <div class="stat-row">
                            <span>Mensaje motivacional</span>
                            <button class="btn-logout">
                                Configurar
                            </button>
                        </div>

                        <div class="stat-row">
                            <span>Metas corporativas</span>
                            <button class="btn-logout">
                                Administrar
                            </button>
                        </div>

                        <div class="stat-row">
                            <span>Productos / Servicios</span>
                            <button class="btn-logout">
                                Gestionar
                            </button>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<script>
const btnToggle = document.getElementById("btnToggle");
const sidebar = document.querySelector(".sidebar");
const main = document.querySelector(".main");

btnToggle.addEventListener("click", () => {

    sidebar.classList.toggle("hidden");
    main.classList.toggle("full");

    const hidden = sidebar.classList.contains("hidden");

    document.getElementById("toggleLabel").textContent =
        hidden ? "Mostrar menú" : "Ocultar menú";

    document.getElementById("toggleIcon").className =
        hidden ? "fas fa-arrow-right" : "fas fa-arrow-left";
});
</script>
<script>
function abrirModal() {
    document.getElementById("logoutModal").classList.add("show");
}

function cerrarModal() {
    document.getElementById("logoutModal").classList.remove("show");
}
</script>
</body>
</html>
```
