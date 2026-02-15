<?php
require_once __DIR__ . '/../dao/ProveedorDao.php';
require_once __DIR__ . '/../modelo/Proveedor.php';

class ProveedorControlador
{
    public static function guardarProveedor()
    {
        session_start();
        
        $proveedor = new Proveedor();
        $proveedor->empresa = $_POST['empresa'];
        $proveedor->contacto = $_POST['contacto'];
        $proveedor->telefono = $_POST['telefono'];
        $proveedor->email = $_POST['email'];
        $proveedor->direccion = $_POST['direccion'];

        $dao = new ProveedorDao();
        if ($dao->registrar($proveedor)) {
            $_SESSION['mensaje'] = 'Proveedor guardado correctamente';
        } else {
            $_SESSION['mensaje'] = 'Error al guardar proveedor';
        }
        header("Location: index.php?accion=consultarProveedores");
        exit;
    }

    public static function obtenerTodos()
    {
        $dao = new ProveedorDao();
        return $dao->listarTodos();
    }

    public static function obtenerPorId($id)
    {
        $dao = new ProveedorDao();
        return $dao->buscarPorId($id);
    }

    public static function editarProveedor()
    {
        session_start();
        
        $proveedor = new Proveedor();
        $proveedor->id = $_POST['id'];
        $proveedor->empresa = $_POST['empresa'];
        $proveedor->contacto = $_POST['contacto'];
        $proveedor->telefono = $_POST['telefono'];
        $proveedor->email = $_POST['email'];
        $proveedor->direccion = $_POST['direccion'];

        $dao = new ProveedorDao();
        if ($dao->actualizar($proveedor)) {
            $_SESSION['mensaje'] = 'Proveedor actualizado correctamente';
        } else {
            $_SESSION['mensaje'] = 'Error al actualizar proveedor';
        }
        header("Location: index.php?accion=consultarProveedores");
        exit;
    }

    public static function listarAjax(): never
    {
        $dao = new ProveedorDao();
        $proveedores = $dao->listarTodos();

        header('Content-Type: application/json');
        echo json_encode($proveedores);
        exit;
    }

    public static function eliminarProveedor($id)
    {
        session_start();
        
        $dao = new ProveedorDao();
        if ($dao->eliminar($id)) {
            $_SESSION['mensaje'] = 'Proveedor eliminado correctamente';
        } else {
            $_SESSION['mensaje'] = 'Error al eliminar proveedor';
        }
        header("Location: index.php?accion=consultarProveedores");
        exit;
    }
}

// Endpoint para AJAX
if (isset($_GET['accion']) && $_GET['accion'] == 'listarProveedoresAjax') {
    ProveedorControlador::listarAjax();
}