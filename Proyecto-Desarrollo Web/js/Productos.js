
function eliminarProducto(id) {
    if (!confirm('¿Está seguro de eliminar este producto?')) {
        return;
    }

   
    fetch('index.php?accion=eliminarProductoAjax', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + id
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            document.querySelector(`tr[data-id="${id}"]`).remove();
            alert('Producto eliminado exitosamente');
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error de conexión');
    });
}