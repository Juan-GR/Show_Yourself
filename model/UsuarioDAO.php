<?php
function registrarUsuario($usuario) {
    include_once '../config/Database.php';
    include_once 'Usuario.php';
    $conexion = Database::conectar();
    // Prepare
    $statement = $conexion->prepare("INSERT INTO usuarios (nombre, email,password,icono,fecha_alta) VALUES (?,?,?,?,CURDATE())");
    // Bind
    $nombre=$usuario->getNombre();
    $email=$usuario->getEmail();
    $password=$usuario->getPassword();
    $icono=$usuario->getIcono();
    $statement->bindParam(1,$nombre);
    $statement->bindParam(2, $email);
    $statement->bindParam(3, $password);
    $statement->bindParam(4,$icono);
    // Excecute
    try {
        $statement->execute();
        return true;
    } catch (Exception $ex) {
        return false;
    }
}
?>
