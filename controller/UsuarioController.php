<?php

class UsuarioController{
    public static function registrar($nombre, $email, $password){
        include_once '../model/Usuario.php';
        include_once '../model/UsuarioDAO.php';
        include_once '../controller/servidor.php';
        $usuario= new Usuario($nombre, $email, $password, 'icondefault.png');
        if(registrarUsuario($usuario)){
            enviarCorreo($usuario->getEmail());
            session_start();
            $_SESSION["usuario"]=$usuario->getNombre();
            header('Location:perfilUsuario.php');
        }else{
            echo "El usuario ya existe";
        }
    }
}

?>