<?php
require_once __DIR__ . '/../dao/VentasDao.php';
require_once __DIR__ . '/../dao/ProductosDao.php';
require_once __DIR__ . '/../modelo/Ventas.php';

class VentasControlador
{
    public static function obtenerTodos()
    {
        $dao = new VentasDAO();
        return $dao->listarTodos();
    }

    public static function obtenerPorId($id)
    {
        $dao = new VentasDAO();
        return $dao->buscarPorId($id);
    }

    public static function guardarVenta()
    {
        $venta = new Venta();
        $venta->productoId = $_POST['productoId'];
        $venta->cantidad = $_POST['cantidad'];
        $venta->precioUnitario = $_POST['precioUnitario'];
        $venta->total = $_POST['total'];

        $dao = new VentasDAO();
        $daoProductos = new ProductosDao();

        // Restar stock del producto
        if ($daoProductos->restarStock($venta->productoId, $venta->cantidad)) {
            if ($dao->registrar($venta)) {
                $_SESSION['mensaje'] = 'Venta registrada correctamente';
                $_SESSION['tipo'] = 'exito';
            } else {
                $_SESSION['mensaje'] = 'Error al registrar venta';
                $_SESSION['tipo'] = 'error';
            }
        } else {
            $_SESSION['mensaje'] = 'Error al actualizar el stock';
            $_SESSION['tipo'] = 'error';
        }
        header("Location: index.php?accion=consultarVenta");
        exit;
    }

    public static function editarVenta()
    {
        $daoVentas = new VentasDao();
        $daoProductos = new ProductosDao();

        $ventaAnterior = $daoVentas->buscarPorId($_POST['id']);

        // Calcula la diferencia 
        $cantidadAnterior = $ventaAnterior->cantidad;
        $cantidadNueva = $_POST['cantidad'];
        $diferencia = $cantidadNueva - $cantidadAnterior;

        // Ajusta stock del producto
        if ($diferencia != 0) {
            if ($diferencia > 0) {
                $daoProductos->restarStock($_POST['productoId'], $diferencia);
            } else {
                $daoProductos->sumarStock($_POST['productoId'], abs($diferencia));
            }
        }

        $venta = new Venta();
        $venta->id = $_POST['id'];
        $venta->productoId = $_POST['productoId'];
        $venta->cantidad = $cantidadNueva;
        $venta->precioUnitario = $_POST['precioUnitario'];
        $venta->total = $_POST['total'];

        if ($daoVentas->actualizar($venta)) {
            $_SESSION['mensaje'] = 'Venta actualizada correctamente';
            $_SESSION['tipo'] = 'exito';
        } else {
            $_SESSION['mensaje'] = 'Error al actualizar venta';
            $_SESSION['tipo'] = 'error';
        }
        header("Location: index.php?accion=consultarVenta");
        exit;
    }

    public static function eliminar($id)
    {
        $dao = new VentasDao();
        if ($dao->eliminar($id)) {
            $_SESSION['mensaje'] = 'Venta eliminada correctamente';
            $_SESSION['tipo'] = 'exito';
        } else {
            $_SESSION['mensaje'] = 'Error al eliminar venta';
            $_SESSION['tipo'] = 'error';
        }
        header("Location: index.php?accion=consultarVenta");
        exit;
    }

    public static function listarAjax()
    {
        $dao = new VentasDao();
        $ventas = $dao->listarTodos();

        header('Content-Type: application/json');
        echo json_encode($ventas);
        exit;
    }
}

// Endpoint para AJAX
if (isset($_GET['accion']) && $_GET['accion'] == 'listarVentas') {
    VentasControlador::listarAjax();
}
