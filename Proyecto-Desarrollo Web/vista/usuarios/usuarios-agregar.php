<?php
include __DIR__ . '/../layout/header.php';
?>

<div class="container mt-4">
    <a href="index.php?accion=menu" class="btn btn-secondary btn-sm mb-3">← Volver al Menú</a>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-3">
            <h4 class="text-center mb-4">Registrar Usuarios</h4>

            <form action="index.php?accion=guardarUsuario" method="POST">

                <div class="mb-2">
                    <label class="form-label">Nombre de usuario</label>
                    <input type="text" name="nombre" class="form-control form-control-sm" 
                           maxlength="50" 
                           pattern="[a-zA-Z0-9_]{3,50}" 
                           title="Solo letras, números y guión bajo. Mínimo 3 caracteres"
                           required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control form-control-sm" 
                           maxlength="50"
                           required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Clave</label>
                    <input type="password" name="clave" class="form-control form-control-sm" 
                           maxlength="50"
                           minlength="4"
                           title="Mínimo 4 caracteres"
                           required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Rol</label>
                    <select name="rol" class="form-select form-select-sm" required>
                        <option value="">Seleccione un rol</option>
                        <option value="admin">Administrador</option>
                        <option value="usuario">Usuario</option>
                        <option value="moderador">Moderador</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../layout/footer.php';
?>