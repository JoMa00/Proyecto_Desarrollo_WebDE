<?php
require_once __DIR__ . '/../bd/conexion.php';
require_once __DIR__ . '/../modelo/Ventas.php';

class VentasDao
{
    public function registrar($venta)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sqlInsert = "INSERT INTO ventas (productoId, cantidad, precioUnitario, total)
                      VALUES (:productoId, :cantidad, :precioUnitario, :total)";

        $stmt = $pdo->prepare($sqlInsert);

        return $stmt->execute([
            ':productoId' => $venta->productoId,
            ':cantidad' => $venta->cantidad,
            ':precioUnitario' => $venta->precioUnitario,
            ':total' => $venta->total
        ]);
    }

    public function listarTodos()
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sql = "SELECT v.id, p.nombre as producto, v.cantidad, v.precioUnitario, v.total, v.productoId
                FROM ventas v
                INNER JOIN productos p ON v.productoId = p.id
                ORDER BY v.id";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sql = "SELECT v.id, p.nombre as producto, v.cantidad, v.precioUnitario, v.total, v.productoId
                FROM ventas v
                INNER JOIN productos p ON v.productoId = p.id
                WHERE v.id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $venta = new Venta();
            $venta->id = $row['id'];
            $venta->producto = $row['producto'];
            $venta->productoId = $row['productoId'];
            $venta->cantidad = $row['cantidad'];
            $venta->precioUnitario = $row['precioUnitario'];
            $venta->total = $row['total'];
            return $venta;
        }

        return null;
    }

    public function actualizar($venta)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sqlUpdate = "UPDATE ventas SET productoId = :productoId, cantidad = :cantidad, precioUnitario = :precioUnitario, total = :total WHERE id = :id";

        $stmt = $pdo->prepare($sqlUpdate);

        return $stmt->execute([
            ':productoId' => $venta->productoId,
            ':cantidad' => $venta->cantidad,
            ':precioUnitario' => $venta->precioUnitario,
            ':total' => $venta->total,
            ':id' => $venta->id
        ]);
    }

    public function eliminar($id)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sqlDelete = "DELETE FROM ventas WHERE id = :id";

        $stmt = $pdo->prepare($sqlDelete);

        return $stmt->execute([':id' => $id]);
    }
}
