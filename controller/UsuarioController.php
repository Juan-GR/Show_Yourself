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
        if (loginUsuario($nombre, $password)) {
            session_start();
            $_SESSION["usuario"] = $nombre;
            header('Location:perfilUsuario.php');
        } else {
            echo "Credenciales incorrectos";
        }
    }

    public static function cargarIcono($nombreUsuario) {
        include_once '../model/UsuarioDAO.php';
        $imagen = buscarFoto($nombreUsuario);
        return "<img src='img/$imagen'>";
    }

    public static function subirFoto() {
        include_once '../model/UsuarioDAO.php';
        cargarImagen();
    }

    public static function imprimirImagenes($nombreUsuario) {
        include_once '../model/UsuarioDAO.php';
        return cargarImagenes($nombreUsuario);
    }

    public static function cargarComentario() {
        include_once '../model/UsuarioDAO.php';
        comentar();
    }

    public static function imprimirComentarios($nombreUsuario) {
        include_once '../model/UsuarioDAO.php';
        return recogerComentarios($nombreUsuario);
    }

    public static function imprimirAmigo() {
        include_once '../model/UsuarioDAO.php';
        include_once '../model/Usuario.php';
        $amigo = buscarPersona($_POST["amigo"]);
        $cadena = "";
        if ($amigo != null) {
            if (comprobarAmigo($amigo->getNombre())) {
                $cadena = '<p><img src="img/' . $amigo->getIcono() . '"</p>';
                $cadena .= '<p>' . $amigo->getNombre() . '</p>';
                $cadena .= "<form method='post'><input type='hidden' name='nombre' value='" . $amigo->getNombre() . "'><button name='ver'>Ver perfil</button></form>";
                return $cadena;
            } else {
                $cadena = '<p><img src="img/' . $amigo->getIcono() . '"</p>';
                $cadena .= '<p>' . $amigo->getNombre() . '</p>';
                $cadena .= "<form method='post'><input type='hidden' name='nombre' value='" . $amigo->getNombre() . "'><button name='add'>Añadir Amigo</button></form>";
                return $cadena;
            }
        } else {
            return "No existe ese usuario";
        }
    }

    public static function addAmigo() {
        include_once '../model/UsuarioDAO.php';
        agregarAmigo($_POST["nombre"]);
    }

}

?>