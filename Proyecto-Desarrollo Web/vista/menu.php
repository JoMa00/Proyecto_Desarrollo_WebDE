<?php
include 'layout/header.php';
?>

<main>
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="m-0">Menú Principal</h2>
            <a href="../index.php?accion=logout" class="btn btn-danger">Cerrar sesión</a>
        </div>

        <p class="mb-4">
            Bienvenido,
            <strong>
                <?= isset($_SESSION['nombre']) ? strtoupper($_SESSION['nombre']) : 'Nombre' ?>
            </strong>
        </p>

        <div class="row g-4">

            <!-- PRODUCTOS -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-center h-100 border-primary">
                    <img src="assets/img/productos.png"
                        class="card-img-top img-fluid"
                        style="max-height:160px; object-fit:contain;">

                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="../index.php?accion=agregarProductos"
                                class="btn btn-outline-primary btn-sm">
                                Registrar
                            </a>

                            <a href="../index.php?accion=consultarProducto"
                                class="btn btn-outline-secondary btn-sm">
                                Consultar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PROVEEDORES -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-center h-100 border-success">
                    <img src="assets/img/provedor.png"
                        class="card-img-top img-fluid"
                        style="max-height:160px; object-fit:contain;">

                    <div class="card-body">
                        <h5 class="card-title">Proveedores</h5>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="../index.php?accion=registrarProveedor"
                                class="btn btn-outline-success btn-sm">
                                Registrar
                            </a>

                            <a href="../index.php?accion=consultarProveedores"
                                class="btn btn-outline-secondary btn-sm">
                                Consultar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- USUARIOS -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-center h-100 border-warning">
                    <img src="assets/img/users.png"
                        class="card-img-top img-fluid"
                        style="max-height:160px; object-fit:contain;">

                    <div class="card-body">
                        <h5 class="card-title">Usuarios</h5>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="../index.php?accion=agregarUsuario"
                                class="btn btn-outline-warning btn-sm">
                                Registrar
                            </a>

                            <a href="../index.php?accion=consultarUsuarios"
                                class="btn btn-outline-secondary btn-sm">
                                Consultar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VENTAS -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-center h-100 border-danger">
                    <img src="assets/img/ventas.png"
                        class="card-img-top img-fluid"
                        style="max-height:160px; object-fit:contain;">

                    <div class="card-body">
                        <h5 class="card-title">Ventas</h5>

                        <div class="d-flex justify-content-center gap-2">
                            <a href="../index.php?accion=registrarVenta"
                                class="btn btn-outline-danger btn-sm">
                                Registrar
                            </a>

                            <a href="../index.php?accion=consultarVenta"
                                class="btn btn-outline-secondary btn-sm">
                                Consultar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

<?php
include 'layout/footer.php';
?>