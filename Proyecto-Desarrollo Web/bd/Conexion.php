<?php
class Conexion
{
    public function conectar()
    {

        $host = "localhost";
        $port = "3306"; //poner el puerto que utilicen
        $dbname = "proyecto_dw";
        $user = "root";
        $password = "";

        try {
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
