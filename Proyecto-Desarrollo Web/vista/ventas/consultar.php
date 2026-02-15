<?php
include __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../controlador/VentasControlador.php';

// Paginación
$registrosPorPagina = 8;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $registrosPorPagina;

// Obtener todas las ventas
$todos = VentasControlador::obtenerTodos();
$totalVentas = count($todos);

// Cortar el array para esta página
$ventas = array_slice($todos, $inicio, $registrosPorPagina);

// Calcular número total de páginas
$totalPaginas = ceil($totalVentas / $registrosPorPagina);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="index.php?accion=menu" class="btn btn-secondary mb-3">
            ← Volver al Menú
        </a>
        <a href="index.php?accion=registrarVenta" class="btn btn-success mb-3">
            <i class="bi bi-plus-circle"></i> Nueva Venta
        </a>
    </div>

    <h3 class="text-center">Listado de Ventas</h3>

    <div class="d-flex justify-content-center mb-4">
        <button id="btnCargarVentas" class="btn btn-primary">
            <i class="bi bi-arrow-clockwise"></i> Cargar Ventas
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th class="text-center" style="width: 250px;">Acciones</th>
                </tr>
            </thead>

            <tbody id="tbodyVentas">
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Presiona "Cargar Ventas" para ver los datos
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <nav>
        <ul class="pagination justify-content-center">

            <?php if ($paginaActual > 1): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="?accion=consultarVenta&pagina=<?= $paginaActual - 1 ?>">
                        Anterior
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?= ($i == $paginaActual) ? 'active' : '' ?>">
                    <a class="page-link"
                        href="?accion=consultarVenta&pagina=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            <?php if ($paginaActual < $totalPaginas): ?>
                <li class="page-item">
                    <a class="page-link"
                        href="?accion=consultarVenta&pagina=<?= $paginaActual + 1 ?>">
                        Siguiente
                    </a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>

</div>

<?php
//muestra mensajes de exito o error

if (isset($_SESSION['mensaje'])) {
    $tipo = $_SESSION['tipo'] ?? 'info';
    $clase = 'mensaje mensaje-' . $tipo;
    echo "<div class='$clase'>" . $_SESSION['mensaje'] . "</div>";
    unset($_SESSION['mensaje']);
    unset($_SESSION['tipo']);
}
include __DIR__ . '/../layout/footer.php';
?>

<script src="js/consultarVentas.js"></script>