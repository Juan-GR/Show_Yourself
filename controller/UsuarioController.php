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
    
    public static function cargarIcono(){
        include_once '../model/UsuarioDAO.php';
        $imagen= buscarFoto();
        return "<img src='img/$imagen'>";
    }
    
    public static function subirFoto(){
        include_once '../model/UsuarioDAO.php';
        cargarImagen();
    }
    
    public static function imprimirImagenes() {
        include_once '../model/UsuarioDAO.php';
        return cargarImagenes();
    }
    public static function cargarComentario() {
        include_once '../model/UsuarioDAO.php';
        comentar();
    }
    
    public static function imprimirComentarios() {
        include_once '../model/UsuarioDAO.php';
        return recogerComentarios();
    }
}

?>