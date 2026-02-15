<?php
include __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../../controlador/ProductosControlador.php';

// Obtener todos los productos
$productos = ProductosControlador::obtenerTodos();
?>

<div class="container mt-4">
    <a href="index.php?accion=menu" class="btn btn-secondary btn-sm mb-3">← Volver al Menú</a>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <h4 class="text-center mb-4">Registrar Venta</h4>

            <form action="index.php?accion=guardarVenta" method="POST" id="formVenta">
                <div class="mb-2">
                    <label class="form-label">Producto</label>
                    <select name="productoId" id="producto" class="form-control form-control-sm" required>
                        <option value="">Seleccionar producto...</option>
                        <?php foreach ($productos as $pr): ?>
                            <option value="<?= $pr['id'] ?>" data-precio="<?= $pr['precioUnitario'] ?>" data-stock="<?= $pr['stock'] ?>">
                                <?= $pr['nombre'] ?> (Stock: <?= $pr['stock'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" class="form-control form-control-sm" min="1" required>
                    <small id="stockError" class="text-danger" style="display:none;"></small>
                </div>
                <div class="mb-2">
                    <label class="form-label">Precio Unitario</label>
                    <input type="number" id="precioUnitario" step="0.01" name="precioUnitario" min="0.05" max="200" class="form-control form-control-sm" readonly>
                </div>
                <div class="mb-2">
                    <label class="form-label">Total</label>
                    <input type="number" id="total" step="0.01" name="total" class="form-control form-control-sm" readonly>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-sm" id="btnGuardar">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<script>
    const productoSelect = document.getElementById('producto');
    const cantidadInput = document.getElementById('cantidad');
    const precioInput = document.getElementById('precioUnitario');
    const totalInput = document.getElementById('total');
    const stockError = document.getElementById('stockError');
    const btnGuardar = document.getElementById('btnGuardar');
    const formVenta = document.getElementById('formVenta');

    // Al seleccionar un producto, cargar su precio
    productoSelect.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        const precio = option.dataset.precio;
        precioInput.value = precio || '';
        calcularTotal();
        validarStock();
    });

    function validarStock() {
        const option = productoSelect.options[productoSelect.selectedIndex];
        const stock = parseInt(option.dataset.stock) || 0;
        const cantidad = parseInt(cantidadInput.value) || 0;

        if (cantidad > stock) {
            stockError.textContent = `Stock insuficiente. Disponible: ${stock}`;
            stockError.style.display = 'block';
            btnGuardar.disabled = true;
        } else {
            stockError.textContent = '';
            stockError.style.display = 'none';
            btnGuardar.disabled = false;
        }
    }

    function calcularTotal() {
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const precio = parseFloat(precioInput.value) || 0;
        const total = cantidad * precio;
        totalInput.value = total.toFixed(2);
    }

    cantidadInput.addEventListener('input', function() {
        calcularTotal();
        validarStock();
    });

    // Validar antes de enviar
    formVenta.addEventListener('submit', function(e) {
        const option = productoSelect.options[productoSelect.selectedIndex];
        const stock = parseInt(option.dataset.stock) || 0;
        const cantidad = parseInt(cantidadInput.value) || 0;

        if (cantidad > stock) {
            e.preventDefault();
            alert('Stock insuficiente');
        }
    });
</script>