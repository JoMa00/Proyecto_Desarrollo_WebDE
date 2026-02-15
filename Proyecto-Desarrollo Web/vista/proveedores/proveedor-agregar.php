<?php include __DIR__ . '/../layout/header.php'; ?>

<main>
    <div class="container mt-4">
        <a href="index.php?accion=consultarProveedores" class="btn btn-secondary btn-sm mb-3">
            <i class="bi bi-arrow-left"></i> Volver
        </a>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-center">Registrar Proveedor</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php?accion=guardarProveedor" method="POST" id="formProveedor">
                            <!-- Empresa (OBLIGATORIO) -->
                            <div class="mb-3">
                                <label class="form-label">Empresa <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="empresa" 
                                       class="form-control form-control-sm" 
                                       id="empresa"
                                       maxlength="100"
                                       onkeypress="return soloLetrasYNumeros(event)"
                                       onkeyup="validarEmpresa(this)"
                                       required>
                                <div id="empresa-error" class="invalid-feedback"></div>
                            </div>

                            <!-- Contacto (OBLIGATORIO) -->
                            <div class="mb-3">
                                <label class="form-label">Contacto <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="contacto" 
                                       class="form-control form-control-sm" 
                                       id="contacto"
                                       maxlength="100"
                                       onkeypress="return soloLetrasYEspacios(event)"
                                       onkeyup="validarContacto(this)"
                                       required>
                                <div id="contacto-error" class="invalid-feedback"></div>
                            </div>

                            <!-- Teléfono (OBLIGATORIO) -->
                            <div class="mb-3">
                                <label class="form-label">Teléfono <span class="text-danger">*</span></label>
                                <input type="tel" 
                                       name="telefono" 
                                       class="form-control form-control-sm" 
                                       id="telefono"
                                       maxlength="20"
                                       onkeypress="return soloNumeros(event)"
                                       onkeyup="validarTelefono(this)"
                                       required>
                                <div id="telefono-error" class="invalid-feedback"></div>
                            </div>

                            <!-- Email (OPCIONAL - SIN VALIDACIÓN) -->
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" 
                                       name="email" 
                                       class="form-control form-control-sm" 
                                       id="email"
                                       maxlength="100"
                                       placeholder="ejemplo@correo.com (opcional)">
                                <!-- Sin validaciones -->
                            </div>

                            <!-- Dirección (OPCIONAL - SIN VALIDACIÓN) -->
                            <div class="mb-3">
                                <label class="form-label">Dirección</label>
                                <textarea name="direccion" 
                                          class="form-control form-control-sm" 
                                          id="direccion"
                                          rows="3"
                                          maxlength="255"
                                          placeholder="Dirección (opcional)"></textarea>
                                <!-- Sin validaciones -->
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" id="btnGuardar">
                                    <i class="bi bi-save"></i> Guardar Proveedor
                                </button>
                                <a href="index.php?accion=consultarProveedores" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Funciones de validación SOLO para campos obligatorios
function soloLetrasYNumeros(event) {
    let char = String.fromCharCode(event.which);
    // Permitir letras, números y espacios
    if (!/^[a-zA-Z0-9\s]$/.test(char) && event.which !== 8 && event.which !== 0) {
        event.preventDefault();
        return false;
    }
    return true;
}

function soloLetrasYEspacios(event) {
    let char = String.fromCharCode(event.which);
    // Permitir solo letras y espacios (incluyendo tildes)
    if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]$/.test(char) && event.which !== 8 && event.which !== 0) {
        event.preventDefault();
        return false;
    }
    return true;
}

function soloNumeros(event) {
    let char = String.fromCharCode(event.which);
    // Permitir solo números
    if (!/^[0-9]$/.test(char) && event.which !== 8 && event.which !== 0) {
        event.preventDefault();
        return false;
    }
    return true;
}

// Validar EMPRESA (obligatorio)
function validarEmpresa(input) {
    let errorDiv = document.getElementById('empresa-error');
    let valor = input.value.trim();
    
    if (valor === '') {
        input.classList.add('is-invalid');
        errorDiv.textContent = 'La empresa es obligatoria';
        return false;
    } else if (valor.length < 3) {
        input.classList.add('is-invalid');
        errorDiv.textContent = 'Debe tener al menos 3 caracteres';
        return false;
    } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        errorDiv.textContent = '';
        return true;
    }
}

// Validar CONTACTO (obligatorio)
function validarContacto(input) {
    let errorDiv = document.getElementById('contacto-error');
    let valor = input.value.trim();
    
    if (valor === '') {
        input.classList.add('is-invalid');
        errorDiv.textContent = 'El contacto es obligatorio';
        return false;
    } else if (valor.length < 3) {
        input.classList.add('is-invalid');
        errorDiv.textContent = 'Debe tener al menos 3 caracteres';
        return false;
    } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        errorDiv.textContent = '';
        return true;
    }
}

// Validar TELÉFONO (obligatorio)
function validarTelefono(input) {
    let errorDiv = document.getElementById('telefono-error');
    let telefono = input.value.trim();
    
    if (telefono === '') {
        input.classList.add('is-invalid');
        errorDiv.textContent = 'El teléfono es obligatorio';
        return false;
    } else if (!/^\d+$/.test(telefono)) {
        input.classList.add('is-invalid');
        errorDiv.textContent = 'Solo se permiten números';
        return false;
    } else if (telefono.length < 7) {
        input.classList.add('is-invalid');
        errorDiv.textContent = 'El teléfono debe tener al menos 7 dígitos';
        return false;
    } else {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        errorDiv.textContent = '';
        return true;
    }
}

// Validar formulario antes de enviar (SOLO campos obligatorios)
document.getElementById('formProveedor').addEventListener('submit', function(e) {
    let valido = true;
    
    valido &= validarEmpresa(document.getElementById('empresa'));
    valido &= validarContacto(document.getElementById('contacto'));
    valido &= validarTelefono(document.getElementById('telefono'));
    
    // Email y dirección NO se validan
    
    if (!valido) {
        e.preventDefault();
        alert('Por favor, complete correctamente los campos obligatorios');
    }
});

// Validaciones en tiempo real (SOLO campos obligatorios)
document.getElementById('empresa').addEventListener('input', function() {
    validarEmpresa(this);
});

document.getElementById('contacto').addEventListener('input', function() {
    validarContacto(this);
});

document.getElementById('telefono').addEventListener('input', function() {
    validarTelefono(this);
});

// Email y dirección NO tienen validaciones en tiempo real
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>