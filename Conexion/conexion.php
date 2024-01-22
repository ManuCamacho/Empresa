<?php
class Conexion {
    private static $conexion;

    public static function obtenerConexion() {
        include "datosConexion.php";

        try {
            self::$conexion = new PDO(DSN, USER, PWD);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión establecida ...<br>";
        } catch(PDOException $e) {
            echo "Fallo en la conexión: " . $e->getMessage();
        }

        return self::$conexion;
    }
}
?>
