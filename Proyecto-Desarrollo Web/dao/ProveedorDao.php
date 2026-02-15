<?php
require_once __DIR__ . '/../bd/Conexion.php';
require_once __DIR__ . '/../modelo/Proveedor.php';

class ProveedorDao
{
    public function registrar($proveedor)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sqlInsert = "INSERT INTO proveedores (empresa, contacto, telefono, email, direccion)
                      VALUES (:empresa, :contacto, :telefono, :email, :direccion)";

        $stmt = $pdo->prepare($sqlInsert);

        return $stmt->execute([
            ':empresa' => $proveedor->empresa,
            ':contacto' => $proveedor->contacto,
            ':telefono' => $proveedor->telefono,
            ':email' => $proveedor->email,
            ':direccion' => $proveedor->direccion
        ]);
    }

    public function listarTodos()
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sql = "SELECT id, empresa, contacto, telefono, email, direccion
                FROM proveedores
                ORDER BY empresa";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sql = "SELECT id, empresa, contacto, telefono, email, direccion
                FROM proveedores
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $proveedor = new Proveedor();
            $proveedor->id = $row['id'];
            $proveedor->empresa = $row['empresa'];
            $proveedor->contacto = $row['contacto'];
            $proveedor->telefono = $row['telefono'];
            $proveedor->email = $row['email'];
            $proveedor->direccion = $row['direccion'];
            return $proveedor;
        }
        return null;
    }

    public function actualizar($proveedor)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sqlUpdate = "UPDATE proveedores SET 
                        empresa = :empresa,
                        contacto = :contacto,
                        telefono = :telefono,
                        email = :email,
                        direccion = :direccion
                      WHERE id = :id";

        $stmt = $pdo->prepare($sqlUpdate);

        return $stmt->execute([
            ':empresa' => $proveedor->empresa,
            ':contacto' => $proveedor->contacto,
            ':telefono' => $proveedor->telefono,
            ':email' => $proveedor->email,
            ':direccion' => $proveedor->direccion,
            ':id' => $proveedor->id
        ]);
    }

    public function eliminar($id)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sqlDelete = "DELETE FROM proveedores WHERE id = :id";
        $stmt = $pdo->prepare($sqlDelete);
        return $stmt->execute([':id' => $id]);
    }
}