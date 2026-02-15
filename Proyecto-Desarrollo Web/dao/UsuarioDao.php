<?php
require_once __DIR__ . '/../bd/Conexion.php';
require_once __DIR__ . '/../modelo/Usuario.php';

class UsuarioDao
{
    public function autenticar($nombre, $clave)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();
        
        // IMPORTANTE: En producción deberías usar password_hash() y password_verify()
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE nombre = :nombre AND clave = :clave");

        $stmt->execute([
            'nombre' => $nombre,
            'clave' => $clave
        ]);

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila) {
            $user = new Usuario();
            $user->id = $fila['id'];
            $user->nombre = $fila['nombre'];
            $user->correo = $fila['correo'];
            $user->rol = $fila['rol'];
            return $user;
        }
        return null;
    }

    public function listarTodos()
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sql = "SELECT id, nombre, correo, rol
                FROM usuario
                ORDER BY id";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        // No es necesario seleccionar la clave por seguridad
        $sql = "SELECT id, nombre, correo, rol 
                FROM usuario
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $usuario = new Usuario();
            $usuario->id = $row['id'];
            $usuario->nombre = $row['nombre'];
            $usuario->correo = $row['correo'];
            $usuario->rol = $row['rol'];
            return $usuario;
        }
        return null;
    }

    public function registrar($usuario)
    {
        try {
            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            $sqlInsert = "INSERT INTO usuario (nombre, correo, clave, rol)
                          VALUES (:nombre, :correo, :clave, :rol)";

            $stmt = $pdo->prepare($sqlInsert);

            return $stmt->execute([
                ':nombre' => $usuario->nombre,
                ':correo' => $usuario->correo,
                ':clave' => $usuario->clave,
                ':rol' => $usuario->rol
            ]);
        } catch (PDOException $e) {
            // Para debugging en desarrollo (quitar en producción)
            error_log("Error al registrar usuario: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarUsuario($usuario)
    {
        try {
            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            $sqlUpdate = "UPDATE usuario SET 
                            nombre = :nombre,
                            correo = :correo,
                            rol = :rol
                          WHERE id = :id";
            
            $stmt = $pdo->prepare($sqlUpdate);

            return $stmt->execute([
                ':nombre' => $usuario->nombre,
                ':correo' => $usuario->correo,
                ':rol' => $usuario->rol,
                ':id' => $usuario->id
            ]);
        } catch (PDOException $e) {
            error_log("Error al actualizar usuario: " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id)
    {
        try {
            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            $sqlDelete = "DELETE FROM usuario WHERE id = :id";

            $stmt = $pdo->prepare($sqlDelete);

            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }
}