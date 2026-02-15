<?php
include __DIR__ . '/../layout/header.php';
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="index.php?accion=menu" class="btn btn-secondary mb-3">← Volver al Menú</a>
    </div>

    <h3>Listado de Usuarios</h3>

    <!-- Contenedor para mensajes de éxito/error -->
    <div id="mensaje-container"></div>

    <!-- Indicador de carga -->
    <div id="cargando" class="text-center my-4" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
        <p class="mt-2">Cargando usuarios...</p>
    </div>

    <!-- Tabla de usuarios -->
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th style="width: 250px;">Acciones</th>
            </tr>
        </thead>
        <tbody id="tabla-usuarios-body">
            <!-- Los datos se cargarán dinámicamente con JavaScript -->
            <tr>
                <td colspan="5" class="text-center">Cargando datos...</td>
            </tr>
        </tbody>
    </table>

    <!-- Contenedor de paginación -->
    <nav id="paginacion">
        <!-- La paginación se generará dinámicamente con JavaScript -->
    </nav>

</div>

<!-- Incluir el archivo JavaScript -->
<script src="js/usuarios.js"></script>

<?php
include __DIR__ . '/../layout/footer.php';
?>