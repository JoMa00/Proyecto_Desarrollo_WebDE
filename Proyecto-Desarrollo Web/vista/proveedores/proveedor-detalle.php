<?php
// vista/proveedores/proveedor-detalle.php
include __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../controlador/ProveedorControlador.php';

// Paginación como en ventas
$registrosPorPagina = 8;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $registrosPorPagina;

// Obtener todos los proveedores
$todos = ProveedorControlador::obtenerTodos();
$totalProveedores = count($todos);

// Cortar el array para esta página
$proveedores = array_slice($todos, $inicio, $registrosPorPagina);

// Calcular número total de páginas
$totalPaginas = ceil($totalProveedores / $registrosPorPagina);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="index.php?accion=menu" class="btn btn-secondary mb-3">
            ← Volver al Menú
        </a>
        <a href="index.php?accion=registrarProveedor" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle"></i> Nuevo Proveedor
        </a>
    </div>

    <h3 class="text-center">Listado de Proveedores</h3>

    <div class="d-flex justify-content-center mb-4">
        <button id="btnCargarProveedores" class="btn btn-primary">
            <i class="bi bi-arrow-clockwise"></i> Cargar Proveedores
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Empresa</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th class="text-center" style="width: 250px;">Acciones</th>
                </tr>
            </thead>

            <tbody id="tbodyProveedores">
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Presiona "Cargar Proveedores" para ver los datos
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Paginación con PHP como en ventas -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($paginaActual > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?accion=consultarProveedores&pagina=<?= $paginaActual - 1 ?>">
                        Anterior
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?= ($i == $paginaActual) ? 'active' : '' ?>">
                    <a class="page-link" href="?accion=consultarProveedores&pagina=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($paginaActual < $totalPaginas): ?>
                <li class="page-item">
                    <a class="page-link" href="?accion=consultarProveedores&pagina=<?= $paginaActual + 1 ?>">
                        Siguiente
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<script src="js/proveedores.js"></script>

<?php
// Mostrar mensajes de sesión como en ventas
if (isset($_SESSION['mensaje'])) {
    echo "<script>alert('" . $_SESSION['mensaje'] . "');</script>";
    unset($_SESSION['mensaje']);
}
include __DIR__ . '/../layout/footer.php';
?>