
<?php

class Database {
    /**
     * Metodo estatico de la clase que conecta con la base de datos
     * @return $conexion
     */
    public static function conectar() {
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=showurself', 'root', '');
        } catch (PDOException $error) {
            die("Error" . $error->getMessage());
        }
        return $conexion;
    }
}

?>