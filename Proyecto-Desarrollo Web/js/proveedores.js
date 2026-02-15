// js/proveedores.js - EXACTAMENTE IGUAL a consultarVentas.js
document.addEventListener('DOMContentLoaded', function() {
    const btnCargar = document.getElementById('btnCargarProveedores');
    const tbody = document.getElementById('tbodyProveedores');
    const registrosPorPagina = 8;
    let todosLosRegistros = [];

    btnCargar.addEventListener('click', function() {
        // 1. PETICIÓN - Pedir datos al servidor
        fetch('index.php?accion=listarProveedoresAjax')
            // 2. RESPUESTA - El servidor nos devuelve JSON
            .then(response => response.json())
            // 3. ACTUALIZACIÓN - Guardar todos los datos
            .then(data => {
                todosLosRegistros = data;
                mostrarPaginaActual();
            })
            .catch(error => {
                console.error('Error:', error);
                tbody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Error al cargar datos</td></tr>`;
            });
    });

    function mostrarPaginaActual() {
        // Obtener página actual de la URL
        const params = new URLSearchParams(window.location.search);
        const paginaActual = parseInt(params.get('pagina')) || 1;
        
        tbody.innerHTML = ''; // Limpiar tabla
        
        // Calcular inicio y fin
        const inicio = (paginaActual - 1) * registrosPorPagina;
        const fin = inicio + registrosPorPagina;
        const registrosPagina = todosLosRegistros.slice(inicio, fin);

        if (registrosPagina.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="text-center">No hay proveedores</td></tr>`;
            return;
        }

        // Mostrar solo los 8 registros de esta página
        registrosPagina.forEach(proveedor => {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${proveedor.id}</td>
                <td>${escapeHtml(proveedor.empresa)}</td>
                <td>${escapeHtml(proveedor.contacto)}</td>
                <td>${escapeHtml(proveedor.telefono || '')}</td>
                <td>${escapeHtml(proveedor.email || '')}</td>
                <td class="text-center">
                    <a href="index.php?accion=editarProveedor&id=${proveedor.id}" 
                       class="btn btn-warning btn-sm me-1">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <a onclick="return confirm('¿Eliminar?')" 
                       href="index.php?accion=eliminarProveedor&id=${proveedor.id}" 
                       class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i> Eliminar
                    </a>
                </td>
            `;
            tbody.appendChild(fila);
        });
    }

    function escapeHtml(text) {
        if (!text) return '';
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Cargar proveedores al abrir la página
    btnCargar.click();
});