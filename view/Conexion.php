<?php
class Conexion {
    private static $conexion;

    public static function getConexion() {
        if (!self::$conexion) {
            self::$conexion = new mysqli("localhost", "root", "", "bibliotecadatabase");
            if (self::$conexion->connect_error) {
                throw new Exception("Error de conexión: " . self::$conexion->connect_error);
            }
        }
        return self::$conexion;
    }
}
?>
