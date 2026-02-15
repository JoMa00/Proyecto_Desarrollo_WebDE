// Configuración
const API_URL = 'api/obtenerUsuarios.php';
let paginaActual = 1;
const registrosPorPagina = 8;

// Función principal para cargar usuarios
async function cargarUsuarios(pagina = 1) {
    try {
        // Mostrar indicador de carga
        mostrarCargando(true);
        
        // Realizar petición fetch
        const response = await fetch(`${API_URL}?pagina=${pagina}&limite=${registrosPorPagina}`);
        
        // Verificar si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        
        // Convertir respuesta a JSON
        const datos = await response.json();
        
        // Verificar si los datos son válidos
        if (!datos.success) {
            throw new Error(datos.error || 'Error al cargar usuarios');
        }
        
        // Actualizar página actual
        paginaActual = pagina;
        
        // Renderizar tabla
        renderizarTabla(datos.data);
        
        // Renderizar paginación
        renderizarPaginacion(datos.paginacion);
        
        // Ocultar indicador de carga
        mostrarCargando(false);
        
    } catch (error) {
        console.error('Error al cargar usuarios:', error);
        mostrarError('Error al cargar los usuarios. Por favor, intente nuevamente.');
        mostrarCargando(false);
    }
}

// Función para renderizar la tabla
function renderizarTabla(usuarios) {
    const tbody = document.getElementById('tabla-usuarios-body');
    
    // Limpiar tabla
    tbody.innerHTML = '';
    
    // Verificar si hay usuarios
    if (!usuarios || usuarios.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center">No hay usuarios registrados</td>
            </tr>
        `;
        return;
    }
    
    // Generar filas de la tabla
    usuarios.forEach(usuario => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${usuario.id}</td>
            <td>${escapeHtml(usuario.nombre)}</td>
            <td>${escapeHtml(usuario.correo || '')}</td>
            <td>${escapeHtml(usuario.rol)}</td>
            <td class="text-center">
                <a href="index.php?accion=editarUsuario&id=${usuario.id}" 
                   class="btn btn-warning me-2">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="index.php?accion=eliminarUsuario&id=${usuario.id}" 
                   class="btn btn-danger"
                   onclick="return confirm('¿Está seguro de eliminar este usuario?')">
                    <i class="bi bi-trash"></i> Eliminar
                </a>
            </td>
        `;
        tbody.appendChild(fila);
    });
}

// Función para renderizar la paginación
function renderizarPaginacion(paginacion) {
    const contenedorPaginacion = document.getElementById('paginacion');
    
    if (!paginacion || paginacion.totalPaginas <= 1) {
        contenedorPaginacion.innerHTML = '';
        return;
    }
    
    let html = '<ul class="pagination justify-content-center">';
    
    // Botón Anterior
    if (paginacion.paginaActual > 1) {
        html += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="cargarUsuarios(${paginacion.paginaActual - 1}); return false;">
                    Anterior
                </a>
            </li>
        `;
    }
    
    // Números de página
    for (let i = 1; i <= paginacion.totalPaginas; i++) {
        const activa = i === paginacion.paginaActual ? 'active' : '';
        html += `
            <li class="page-item ${activa}">
                <a class="page-link" href="#" onclick="cargarUsuarios(${i}); return false;">
                    ${i}
                </a>
            </li>
        `;
    }
    
    // Botón Siguiente
    if (paginacion.paginaActual < paginacion.totalPaginas) {
        html += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="cargarUsuarios(${paginacion.paginaActual + 1}); return false;">
                    Siguiente
                </a>
            </li>
        `;
    }
    
    html += '</ul>';
    contenedorPaginacion.innerHTML = html;
}

// Función para mostrar/ocultar indicador de carga
function mostrarCargando(mostrar) {
    const cargando = document.getElementById('cargando');
    if (cargando) {
        cargando.style.display = mostrar ? 'block' : 'none';
    }
}

// Función para mostrar mensajes de error
function mostrarError(mensaje) {
    const contenedorError = document.getElementById('mensaje-error');
    if (contenedorError) {
        contenedorError.innerHTML = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ${mensaje}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Auto-ocultar después de 5 segundos
        setTimeout(() => {
            contenedorError.innerHTML = '';
        }, 5000);
    }
}

// Función para escapar HTML (prevenir XSS)
function escapeHtml(texto) {
    const div = document.createElement('div');
    div.textContent = texto;
    return div.innerHTML;
}

// Función para recargar la tabla (útil después de eliminar/editar)
function recargarTabla() {
    cargarUsuarios(paginaActual);
}

// Cargar usuarios al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    cargarUsuarios(1);
});

// Función para mostrar mensajes
function mostrarMensaje(texto, tipo = 'success') {
    const container = document.getElementById('mensaje-container');
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
    alerta.role = 'alert';
    alerta.innerHTML = `
        ${texto}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    container.innerHTML = '';
    container.appendChild(alerta);
    
    // Auto-ocultar después de 5 segundos
    setTimeout(() => {
        alerta.classList.remove('show');
        setTimeout(() => alerta.remove(), 150);
    }, 5000);
}

// Verificar mensajes en la URL al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const mensaje = urlParams.get('mensaje');
    
    if (mensaje) {
        let textoMensaje = '';
        let tipoAlerta = 'success';
        
        switch(mensaje) {
            case 'agregado':
                textoMensaje = 'Usuario agregado correctamente';
                break;
            case 'editado':
                textoMensaje = 'Usuario editado correctamente';
                break;
            case 'eliminado':
                textoMensaje = 'Usuario eliminado correctamente';
                break;
            case 'error':
                textoMensaje = 'Ocurrió un error al procesar la solicitud';
                tipoAlerta = 'danger';
                break;
        }
        
        if (textoMensaje) {
            mostrarMensaje(textoMensaje, tipoAlerta);
            
            // Limpiar URL después de mostrar el mensaje
            const nuevaUrl = window.location.pathname + '?accion=consultarUsuarios';
            window.history.replaceState({}, '', nuevaUrl);
        }
    }

});