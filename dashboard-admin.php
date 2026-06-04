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
<a href="vendedores-admin.php" class="sb-link">
    <i class="fas fa-user-tie"></i>
    Vendedor
</a>

            <a href="#" class="sb-link">
                <i class="fas fa-handshake"></i>
                Clientes
            </a>

            <a href="#" class="sb-link" onclick="mostrarProductos()">
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
            
            <!-- SECCIÓN PRODUCTOS -->
<div id="productosSection" class="section">

    <h2 class="section-title">
        Productos / Servicios
    </h2>

    <div class="card">

        <div class="productos-top">

            <input
                type="text"
                id="buscarProducto"
                placeholder="Buscar por nombre">

            <button class="btn-logout" onclick="mostrarCrearProducto()">
                Crear Producto / Servicio
            </button>

        </div>

        <div class="productos-filtros">

            <button class="btn-logout" onclick="filtrarProductos('todos')">
                Todos
            </button>

            <button class="btn-logout" onclick="filtrarProductos('activos')">
                Activos
            </button>

            <button class="btn-logout" onclick="filtrarProductos('inactivos')">
                No Activos
            </button>

        </div>

        <table class="tabla-productos">

    <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Valor</th>
            <th>Tipo</th>
            <th>Estado</th>
        </tr>
    </thead>

    <tbody id="productosBody">
    </tbody>

</table>

<div class="acciones-productos">

    <button class="btn-logout">
        Editar
    </button>

    <button class="btn-logout">
        Activar
    </button>

    <button class="btn-logout">
        Desactivar
    </button>

    <button class="btn-logout">
        Eliminar
    </button>

</div>

    </div>

</div>
<div id="crearProductoSection" class="section">

    <h2 class="section-title">
        Crear Producto / Servicio
    </h2>

    <div class="card">

        <div class="form-producto">

            <input
                type="text"
                id="nombreProducto"
                placeholder="Nombre">

            <textarea
                id="descripcionProducto"
                placeholder="Descripción"></textarea>

            <input
                type="number"
                id="valorProducto"
                placeholder="Valor">

            <select id="tipoProducto">

                <option value="Producto">
                    Producto
                </option>

                <option value="Servicio">
                    Servicio
                </option>

            </select>

            <div class="modal-btns">

                <button onclick="volverProductos()">
                    Cancelar
                </button>

                <button class="btn-confirm"
                        onclick="agregarProducto()">
                    Agregar
                </button>

            </div>

        </div>

    </div>

</div>

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
                        Metas semáforo de vendedores
                    </div>
                    <div class="barra-semaforo">

    

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
                            <button class="btn-logout" onclick="abrirSemaforo()">
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
<script>

function abrirSemaforo(){
    document
        .getElementById("semaforoModal")
        .classList.add("show");
}

function cerrarSemaforo(){
    document
        .getElementById("semaforoModal")
        .classList.remove("show");
}

function aplicarSemaforo(){

    const rojo =
        parseInt(document.getElementById("valorRojo").value);

    const amarillo =
        parseInt(document.getElementById("valorAmarillo").value);

    const verde =
        parseInt(document.getElementById("valorVerde").value);

    document.getElementById("rojoBar").style.width =
        rojo + "%";

    document.getElementById("amarilloBar").style.width =
        amarillo + "%";

    document.getElementById("verdeBar").style.width =
        verde + "%";

    document.getElementById("rojoBar").innerText = rojo;
    document.getElementById("amarilloBar").innerText = amarillo;
    document.getElementById("verdeBar").innerText = verde;

    cerrarSemaforo();
}

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

let chart;

const metas = {
    minima: 20,
    media: 50,
    alta: 80
};

const ctx = document.getElementById('barChart');

chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            'Meta mínima',
            'Meta media',
            'Meta alta'
        ],
        datasets: [{
            data: [
                metas.minima,
                metas.media,
                metas.alta
            ],
            backgroundColor: [
                '#9b2020',
                '#b89000',
                '#2e6b2e'
            ],
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,

        plugins: {
            legend: {
                display: false
            }
        },

        scales: {
            y: {
                beginAtZero: true,
                max: 100
            }
        }
    }
});

function aplicarSemaforo(){

    metas.minima =
        parseInt(document.getElementById("valorRojo").value);

    metas.media =
        parseInt(document.getElementById("valorAmarillo").value);

    metas.alta =
        parseInt(document.getElementById("valorVerde").value);

    chart.data.datasets[0].data = [
        metas.minima,
        metas.media,
        metas.alta
    ];

    chart.update();

    cerrarSemaforo();
}

</script>
<div class="modal-overlay" id="semaforoModal">

    <div class="modal-box semaforo-box">

        <h3>Configurar Semáforo</h3>

        <label>Meta mínima</label>
        <input type="number" id="valorRojo" value="20">

        <label>Meta media</label>
        <input type="number" id="valorAmarillo" value="50">

        <label>Meta alta</label>
        <input type="number" id="valorVerde" value="80">

        <div class="modal-btns">

            <button onclick="cerrarSemaforo()">
                Cancelar
            </button>

            <button class="btn-confirm" onclick="aplicarSemaforo()">
                Aplicar
            </button>

        </div>

    </div>

</div>
<script>

const productos = [

{
    id:1,
    nombre:"Preparación y Traslado",
    descripcion:"Servicio de transporte",
    valor:1300000,
    tipo:"Servicio",
    activo:true
}

];

function mostrarProductos(){

    document.querySelector(".dash-grid").style.display = "none";

    document.querySelectorAll(".section").forEach(s => {
        s.classList.remove("active");
    });

    document.getElementById("productosSection").classList.add("active");

    renderProductos();
}

function renderProductos(){

    const body =
    document.getElementById("productosBody");

    body.innerHTML="";

    productos.forEach(producto=>{

        body.innerHTML += `
<tr>

    <td>
        <input type="radio"
               name="productoSeleccionado"
               value="${producto.id}">
    </td>

    <td>${producto.nombre}</td>

    <td>${producto.descripcion}</td>

    <td>$${producto.valor}</td>

    <td>${producto.tipo}</td>

    <td>
        <span class="${
            producto.activo
            ? 'estado-activo'
            : 'estado-inactivo'
        }">

            ${producto.activo ? 'Activo' : 'Inactivo'}

        </span>
    </td>

</tr>
`;

    });

}

function mostrarCrearProducto(){

    document.querySelectorAll(".section").forEach(s => {
        s.classList.remove("active");
    });

    document.getElementById("crearProductoSection").classList.add("active");
}

function volverProductos(){

    document.querySelectorAll(".section").forEach(s => {
        s.classList.remove("active");
    });

    document.getElementById("productosSection").classList.add("active");
}

function agregarProducto(){

    productos.push({

        id:Date.now(),

        nombre:
        document.getElementById(
            "nombreProducto"
        ).value,

        descripcion:
        document.getElementById(
            "descripcionProducto"
        ).value,

        valor:
        document.getElementById(
            "valorProducto"
        ).value,

        tipo:
        document.getElementById(
            "tipoProducto"
        ).value,

        activo:true

    });

    volverProductos();

    renderProductos();
}

</script>
</body>
</html>
```
