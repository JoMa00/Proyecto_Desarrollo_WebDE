<?php
require_once __DIR__ . '/../bd/Conexion.php';
require_once __DIR__ . '/../modelo/Producto.php';

class ProductosDao
{

    public function registrarProducto($Producto)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sqlInsert = "INSERT productos (nombre, precioUnitario, categoria, stock)
                      VALUES (:nombre, :precio, :categoria, :stock)";

        $stmt = $pdo->prepare($sqlInsert);

        return $stmt->execute([
            ':nombre' => $Producto->nombre,
            ':precio' => $Producto->precioUnitario,
            ':categoria' => $Producto->categoria,
            ':stock' => $Producto->stock
        ]);
    }

    public function listarTodos()
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sql = "SELECT id, nombre, precioUnitario, categoria, stock
                FROM productos
                ORDER BY id";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarId($id)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();
        $sql = "SELECT id, nombre, precioUnitario, categoria, stock
                FROM productos
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $producto = new Producto();
            $producto->id = $row['id'];
            $producto->nombre = $row['nombre'];
            $producto->precioUnitario = $row['precioUnitario'];
            $producto->categoria = $row['categoria'];
            $producto->stock = $row['stock'];
            return $producto;
        }
        return null;
    }

    public function actualizarProducto($producto)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sqlUpdate = "UPDATE productos SET 
                        nombre = :nombre,
                        precioUnitario = :precio,
                        categoria = :categoria,
                        stock = :stock
                      WHERE id = :id";
        $stmt = $pdo->prepare($sqlUpdate);

        return $stmt->execute([
            ':nombre' => $producto->nombre,
            ':precio' => $producto->precioUnitario,
            ':categoria' => $producto->categoria,
            ':stock' => $producto->stock,
            ':id' => $producto->id
        ]);
    }

    public function eliminar($id)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sqlDelete = "DELETE FROM productos WHERE id = :id";

        $stmt = $pdo->prepare($sqlDelete);

        return $stmt->execute([':id' => $id]);
    }

    public function restarStock($productoId, $cantidad)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sql = "UPDATE productos SET stock = stock - :cantidad WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        
        return $stmt->execute([
            ':cantidad' => $cantidad,
            ':id' => $productoId
        ]);
    }

    public function sumarStock($productoId, $cantidad)
    {
        $conexion = new Conexion();
        $pdo = $conexion->conectar();

        $sql = "UPDATE productos SET stock = stock + :cantidad WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        
        return $stmt->execute([
            ':cantidad' => $cantidad,
            ':id' => $productoId
        ]);

    }

}
