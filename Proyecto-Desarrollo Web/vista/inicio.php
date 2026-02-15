<?php include __DIR__ . '/layout/header.php'; ?>
<main>
    <style>
        .img-carrusel {
            max-height: 300px;
            object-fit: contain;
        }
    </style>

    <div class="container mt-5 text-center">
        <h2>Bienvenido al Sistema de Gestión Académica</h2>
        <p class="lead">Gestiona alumnos, docentes y cursos de forma eficiente y centralizada.</p>

        <a href="index.php?accion=login" class="btn btn-primary mt-3 mb-5">Iniciar Sesión</a>

        <!-- Carrusel de información -->
        <div id="infoCarrusel" class="carousel slide" data-bs-ride="carousel" style="max-width: 700px; margin: auto;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/carrusel1.jpg" class="d-block w-100 rounded img-carrusel" alt="Gestión de Alumnos">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                        <h5>Gestión de Productos</h5>
                        <p>Registra, consulta y organiza la información de los productos.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/carrusel2.webp" class="d-block w-100 rounded img-carrusel" alt="Gestión de Docentes">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                        <h5>Control de proveedores</h5>
                        <p>Administra asignaciones y seguimiento de los proveedores.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/carrusel3.png" class="d-block w-100 rounded img-carrusel" alt="Reportes del Sistema">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                        <h5>Reporte de ventas</h5>
                        <p>Consulta las ventas realizadas en el sistema.</p>
                    </div>
                </div>
            </div>

            <!-- Controles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#infoCarrusel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#infoCarrusel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</main>
<?php include __DIR__ . '/layout/footer.php'; ?>