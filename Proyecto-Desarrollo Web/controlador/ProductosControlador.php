<?php
require_once __DIR__ . '/../dao/ProductosDAO.php';
require_once __DIR__ . '/../modelo/Producto.php';

class ProductosControlador
{
    public static function guardarProducto()
    {
        $producto = new Producto();
        $producto->nombre = $_POST['nombre'];
        $producto->precioUnitario = $_POST['precio'];
        $producto->categoria = $_POST['categoria'];
        $producto->stock = $_POST['stock'];

        $dao = new ProductosDao();
        if ($dao->registrarProducto($producto)) {
            header("Location: index.php?accion=consultarProducto");
        } else {
            echo "Error al registrar producto.";
        }
        exit;
    }

    public static function obtenerTodos()
    {
        $dao = new ProductosDao();
        return $dao->listarTodos();
    }

    public static function obtenerId($id)
    {
        $dao = new ProductosDao();
        return $dao->buscarId($id);
    }

    public static function editarProducto()
    {
        $producto = new Producto();
        $producto->id = $_POST['id'];
        $producto->nombre = $_POST['nombre'];
        $producto->precioUnitario = $_POST['precio'];
        $producto->categoria = $_POST['categoria'];
        $producto->stock = $_POST['stock'];

        $dao = new ProductosDao();
        $dao->actualizarProducto($producto);

        header("Location: index.php?accion=consultarProducto&mensaje=editado");
        exit;
    }




    public static function eliminarProductoAjax()
    {
        header('Content-Type: application/json');
        $id = $_POST['id'] ?? null;
        $dao = new ProductosDao();
        $resultado = $dao->eliminar($id);

        if ($resultado) {
            echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar producto']);
        }
        exit;
    }
}
