<?php
function registrar($nombre, $email, $password) {
    include_once '../config/Database.php';
    $conexion = Database::conectar();
    // Prepare
    $statement = $conexion->prepare("INSERT INTO usuarios (nombre, email,password,icono,fecha_alta) VALUES (?,?,?,'icondefault.png',CURDATE())");
    // Bind
    $statement->bindParam(1, $nombre);
    $statement->bindParam(2, $email);
    $statement->bindParam(3, $password);
    // Excecute
    $statement->execute();
}
?>
