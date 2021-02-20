<?php

class UsuarioController {

    public static function registrar($nombre, $email, $password) {
        include_once '../model/Usuario.php';
        include_once '../model/UsuarioDAO.php';
        include_once '../controller/servidor.php';
        $usuario = new Usuario($nombre, $email, $password, 'icondefault.png');
        if (registrarUsuario($usuario)) {
            enviarCorreo($usuario->getEmail());
            session_start();
            $_SESSION["usuario"] = $usuario->getNombre();
            header('Location:perfilUsuario.php');
        } else {
            echo "El usuario ya existe";
        }
    }

    public static function logear($nombre, $password) {
        include_once '../model/UsuarioDAO.php';
        
        if(loginUsuario($nombre, $password)){
            session_start();
            $_SESSION["usuario"] = $nombre;
            header('Location:perfilUsuario.php');
        }else{
            echo "Credenciales incorrectos";
        }     
    }
    
    public static function cargarFoto(){
        include_once '../model/UsuarioDAO.php';
        $imagen= buscarFoto();
        echo "<img src='img/$imagen'>";
    }
}

?>