<?php
require_once __DIR__ . '/../dao/UsuarioDAO.php';
require_once __DIR__ . '/../modelo/Usuario.php';

class UsuarioControlador
{
    public static function procesarLogin($nombre, $clave)
    {
        $dao = new UsuarioDAO();
        $usuarioObj = $dao->autenticar($nombre, $clave);

        if ($usuarioObj) {
            session_start();
            $_SESSION['nombre'] = $usuarioObj->nombre;
            header("Location: index.php?accion=menu");
        } else {
            $_SESSION['error_login'] = "Usuario o contraseña incorrectos";
            header("Location: index.php?accion=login");
        }
        exit;
    }

    public static function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?accion=inicio");
        exit;
    }

    public static function guardarUsuario()
    {
        $usuario = new Usuario();
        $usuario->nombre = $_POST['nombre'];
        $usuario->correo = $_POST['correo'];
        $usuario->clave = $_POST['clave'];
        $usuario->rol = $_POST['rol'];

        $dao = new UsuarioDAO();
        if ($dao->registrar($usuario)) {
            header("Location: index.php?accion=consultarUsuarios&mensaje=agregado");
        } else {
            header("Location: index.php?accion=consultarUsuarios&mensaje=error");
        }
        exit;
    }

    public static function obtenerTodos()
    {
        $dao = new UsuarioDAO();
        return $dao->listarTodos();
    }

    public static function obtenerPorId($id)
    {
        $dao = new UsuarioDao();
        return $dao->buscarPorId($id);
    }

    public static function editarUsuario()
    {
        $usuario = new Usuario();
        $usuario->id = $_POST['id'];
        $usuario->nombre = $_POST['nombre'];
        $usuario->correo = $_POST['correo'];
        $usuario->rol = $_POST['rol'];

        $dao = new UsuarioDao();
        if ($dao->actualizarUsuario($usuario)) {
            header("Location: index.php?accion=consultarUsuarios&mensaje=editado");
        } else {
            header("Location: index.php?accion=consultarUsuarios&mensaje=error");
        }
        exit;
    }

    public static function eliminarUsuario($id)
    {
        $dao = new UsuarioDao();
        if ($dao->eliminar($id)) {
            header("Location: index.php?accion=consultarUsuarios&mensaje=eliminado");
        } else {
            header("Location: index.php?accion=consultarUsuarios&mensaje=error");
        }
        exit;
    }
}