<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <a href="index.php?accion=consultarUsuarios" class="btn btn-secondary btn-sm mb-3">← Volver</a>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-3">
            <h4 class="mb-3 text-center">Editar Usuarios</h4>

            <form action="index.php?accion=actualizarUsuario" method="POST">
                <input type="hidden" name="id" value="<?= $usuario->id ?>">

                <div class="mb-2">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control form-control-sm" 
                           value="<?= htmlspecialchars($usuario->nombre) ?>" 
                           maxlength="50"
                           pattern="[a-zA-Z0-9_]{3,50}"
                           title="Solo letras, números y guión bajo. Mínimo 3 caracteres"
                           required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Correo</label>
                    <input type="email" name="correo" class="form-control form-control-sm" 
                           value="<?= htmlspecialchars($usuario->correo) ?>" 
                           maxlength="50"
                           required>
                </div>

                <div class="mb-2">
                    <label class="form-label">Rol</label>
                    <select name="rol" class="form-select form-select-sm" required>
                        <option value="">Seleccione un rol</option>
                        <option value="admin" <?= $usuario->rol == 'admin' ? 'selected' : '' ?>>Administrador</option>
                        <option value="usuario" <?= $usuario->rol == 'usuario' ? 'selected' : '' ?>>Usuario</option>
                        <option value="moderador" <?= $usuario->rol == 'moderador' ? 'selected' : '' ?>>Moderador</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>