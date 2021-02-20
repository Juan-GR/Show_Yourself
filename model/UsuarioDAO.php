<?php

@session_start();

function registrarUsuario($usuario) {
    include_once '../config/Database.php';
    include_once 'Usuario.php';
    $conexion = Database::conectar();
    // Prepare
    $statement = $conexion->prepare("INSERT INTO usuarios (nombre, email,password,icono,fecha_alta) VALUES (?,?,?,?,CURDATE())");
    // Bind
    $nombre = $usuario->getNombre();
    $email = $usuario->getEmail();
    $password = $usuario->getPassword();
    $icono = $usuario->getIcono();
    $statement->bindParam(1, $nombre);
    $statement->bindParam(2, $email);
    $statement->bindParam(3, $password);
    $statement->bindParam(4, $icono);
    // Excecute
    try {
        $statement->execute();
        return true;
    } catch (Exception $ex) {
        return false;
    }
}

function loginUsuario($nombre, $password) {
    include_once '../config/Database.php';
    include_once 'Usuario.php';
    $conexion = Database::conectar();
    $existe = false;
    $resultado = $conexion->query("SELECT * FROM usuarios where nombre='.$nombre.' and password=$password");

    if ($resultado) {
        $existe = true;
    }
    return $existe;
}

function buscarFoto() {
    $nombreFoto = "";
    include_once '../config/Database.php';
    $conexion = Database::conectar();
    $resultado = $conexion->query("SELECT icono FROM usuarios where nombre='" . $_SESSION['usuario'] . "'");
    foreach ($resultado as $row) {
        $nombreFoto = $row["icono"];
    }
    return $nombreFoto;
}

function cargarImagen() {
    include_once 'Usuario.php';
    include_once '../config/Database.php';
    $uploads_dir = 'img';
    $tmp_name = $_FILES["foto"]["tmp_name"];
    $name = basename($_FILES["foto"]["name"]);
    move_uploaded_file($tmp_name, "$uploads_dir/$name");

    $conexion = Database::conectar();
    // Prepare
    $statement = $conexion->prepare("INSERT INTO imagenes (usuario, ruta) VALUES (?,?)");
    $nombre = $_SESSION["usuario"];
    $statement->bindParam(1, $nombre);
    $statement->bindParam(2, $name);
    $statement->execute();
        
}

?>
