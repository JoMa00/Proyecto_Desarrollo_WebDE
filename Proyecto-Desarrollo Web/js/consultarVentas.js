document.addEventListener('DOMContentLoaded', function() {
    const btnCargar = document.getElementById('btnCargarVentas');
    const tbody = document.getElementById('tbodyVentas');
    const registrosPorPagina = 8;
    let todosLosRegistros = [];

    btnCargar.addEventListener('click', function() {
        // 1. PETICIÓN - Pedir datos al servidor
        fetch('controlador/VentasControlador.php?accion=listarVentas')
            // 2. RESPUESTA - El servidor nos devuelve JSON
            .then(response => response.json())
            // 3. ACTUALIZACIÓN - Guardar todos los datos y mostrar solo 8
            .then(data => {
                todosLosRegistros = data;
                mostrarPaginaActual();
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

        // Mostrar solo los 8 registros de esta página
        registrosPagina.forEach(venta => {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${venta.id}</td>
                <td>${venta.producto}</td>
                <td>${venta.cantidad}</td>
                <td>$${venta.precioUnitario}</td>
                <td>$${venta.total}</td>
                <td class="text-center">
                    <a href="index.php?accion=editarVenta&id=${venta.id}" class="btn btn-warning btn-sm">Editar</a>
                    <a onclick="return confirm('¿Eliminar?')" href="index.php?accion=eliminarVenta&id=${venta.id}" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            `;
            tbody.appendChild(fila);
        });
    }

    // Cargar ventas al abrir la página
    btnCargar.click();
}); 