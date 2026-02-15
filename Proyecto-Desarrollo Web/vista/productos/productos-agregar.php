<?php

include __DIR__ . '/../layout/header.php';
?>

<main>


    <div class="container mt-4">
        <a href="index.php?accion=menu" class="btn btn-secondary btn-sm mb-3">← Volver al Menú</a>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <h4 class="text-center mb-4">Registrar Productos</h4>

                <form action="index.php?accion=registrarProducto" method="POST">

                    <div class="mb-2">
                        <label class="form-label">Nombre del producto</label>
                        <input type="text" name="nombre" class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Precio del Producto</label>
                        <input type="number" name="precio" step="0.01" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Categoria</label>
                        <input type="text" name="categoria" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control form-control-sm" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php

include __DIR__ . '/../layout/footer.php';
?>