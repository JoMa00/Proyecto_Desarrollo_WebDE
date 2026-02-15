<?php
// Paginación
$registrosPorPagina = 8;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $registrosPorPagina;

$todos = ProductosControlador::obtenerTodos();
$totalProductos = count($todos);
$productos = array_slice($todos, $inicio, $registrosPorPagina);
$totalPaginas = ceil($totalProductos / $registrosPorPagina);

include __DIR__ . '/../layout/header.php';
?>

<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <a href="index.php?accion=menu" class="btn btn-secondary mb-3">← Volver al Menú</a>
  </div>

  <h3>Listado de Productos</h3>

  <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'editado'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>¡Éxito!</strong> El producto fue editado correctamente.
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <table class="table table-bordered mt-3">
    <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoria</th>
        <th>Stock</th>
        <th>Precio</th>
        <th style="width: 250px;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($productos as $pr): ?>
        <tr data-id="<?= $pr['id'] ?>">
          <td><?= $pr['id'] ?></td>
          <td><?= $pr['nombre'] ?></td>
          <td><?= $pr['categoria'] ?></td>
          <td><?= $pr['stock'] ?></td>
          <td><?= $pr['precioUnitario'] ?></td>
          <td class="text-center">
            <a href="index.php?accion=editarProducto&id=<?= $pr['id'] ?>"
              class="btn btn-warning btn-sm me-2">
              <i class="bi bi-pencil"></i> Editar
            </a>
            <button onclick="eliminarProducto(<?= $pr['id'] ?>)"
              class="btn btn-danger btn-sm">
              <i class="bi bi-trash"></i> Eliminar
            </button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- Paginación normal -->
  <nav>
    <ul class="pagination justify-content-center">
      <?php if ($paginaActual > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?accion=consultarProducto&pagina=<?= $paginaActual - 1 ?>">Anterior</a>
        </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
        <li class="page-item <?= ($i == $paginaActual) ? 'active' : '' ?>">
          <a class="page-link" href="?accion=consultarProducto&pagina=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($paginaActual < $totalPaginas): ?>
        <li class="page-item">
          <a class="page-link" href="?accion=consultarProducto&pagina=<?= $paginaActual + 1 ?>">Siguiente</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</div>

<script src="js/productos.js"></script>

<?php
include __DIR__ . '/../layout/footer.php';
?>