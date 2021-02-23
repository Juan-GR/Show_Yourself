<?php

//Clase Usuario Controller con metodos estaticos ya que no se va a instaciar un objeto del tipo UsuarioController
class UsuarioController {

    /**
     * Metodo registrar que crea un objeto Usuario a partir de los datos que se pasan como parametro
     * Tiene dos condiciones, cuando llama a registrarUsuario de usuarioDAO comprueba si el usuario existe, si existe devuelve un mensaje de error,
     * si no existe enviara un correo a la cuenta de correo, creará la sesion de usuario y le redirige a su perfil
     * @param type $nombre
     * @param type $email
     * @param type $password
     */
    public static function registrar($nombre, $email, $password) {
        include_once '../model/Usuario.php';
        include_once '../model/UsuarioDAO.php';
        include_once '../controller/servidor.php';
        $usuario = new Usuario($nombre, $email, $password, 'icondefault.png');
        if (registrarUsuario($usuario)) {
            enviarCorreo($usuario->getEmail(), $usuario->getNombre());
            session_start();
            $_SESSION["usuario"] = $usuario->getNombre();
            header('Location:perfilUsuario.php');
        } else {
            echo "<div id='error'>El usuario ya existe</div>";
        }
    }

    /**
     * Metodo logear que recibe dos parametros y llama a LoginUsuario, si devuelve true le crea la sesion y le redirige al perfil
     * en caso de que el usuario exista y en caso contrario devuelve un error
     * @param type $nombre
     * @param type $password
     */
    public static function logear($nombre, $password) {
        include_once '../model/UsuarioDAO.php';
        if (loginUsuario($nombre, $password)) {
            session_start();
            $_SESSION["usuario"] = $nombre;
            header('Location:perfilUsuario.php');
        } else {
            echo "<div id='error'>Credenciales Incorrectos</div>";
        }
    }

    /**
     * Comprueba la sesion en donde se llame, si no existe la sesion redirige al index
     */
    public static function comprobarSesion() {
        @session_start();
        if (!isset($_SESSION, $_SESSION["usuario"])) {
            header('Location:../index.php');
        }
    }

    /**
     * Metodo que recibe como parametro el nombre de un usuario y llama a la funcion buscar foto que encuentra su icono y devuelve una etiqueta img con el logo
     * @param type $nombreUsuario
     * @return type
     */
    public static function cargarIcono($nombreUsuario) {
        include_once '../model/UsuarioDAO.php';
        $imagen = buscarFoto($nombreUsuario);
        return "<img src='img/$imagen'>";
    }

    /**
     * Metodo que llama a cargarImagen que se encarga de subir a la base de datos la imagen y la mueve a la carpeta preseleccionada
     */
    public static function subirFoto() {
        include_once '../model/UsuarioDAO.php';
        cargarImagen();
    }

    /**
     * Metodo que recibe como parametro un nombre de usuario y se le pasa a cargarImagenes
     * @param type $nombreUsuario
     * @return type
     */
    public static function imprimirImagenes($nombreUsuario) {
        include_once '../model/UsuarioDAO.php';
        return cargarImagenes($nombreUsuario);
    }

    /**
     * Metodo cargarComentario que llama a comentar que se encarga de subir el comentario a la base de datos
     */
    public static function cargarComentario() {
        include_once '../model/UsuarioDAO.php';
        comentar();
    }

    /**
     * Metodo imprimirComentarios que se encarga de llamar a recogerComentarios que recoge todos los comentarios y este metodo se encarga de devovlerlos
     * @param type $nombreUsuario
     * @return type
     */
    public static function imprimirComentarios($nombreUsuario) {
        include_once '../model/UsuarioDAO.php';
        return recogerComentarios($nombreUsuario);
    }

    /**
     * Metodo imprimirAmigo que llama a buscarPersona(esta se encarga de devolver el usuario de la persona buscada)
     * @return string
     * 
     */
    public static function imprimirAmigo() {
        include_once '../model/UsuarioDAO.php';
        include_once '../model/Usuario.php';
        $amigo = buscarPersona($_POST["amigo"]);
        $cadena = "";
        //Si se encuentra una persona entra en el if
        if ($amigo != null) {
            //Comprueba si el usuario con sesion iniciada es amigo del usuario buscado
            //Si es un amigo se genera un boton que permite ver su perfil
            if (comprobarAmigo($amigo->getNombre())) {
                $cadena = '<p><img src="img/' . $amigo->getIcono() . '"</p>';
                $cadena .= '<p>' . $amigo->getNombre() . '</p>';
                $cadena .= "<form method='post'><input type='hidden' name='nombre' value='" . $amigo->getNombre() . "'><button name='ver'>Ver perfil</button></form>";
                return $cadena;
                //Si el usuario no es amigo se crea un boton con la posibilidad de añadir amigo
            } else {
                $cadena = '<p><img src="img/' . $amigo->getIcono() . '"</p>';
                $cadena .= '<p>' . $amigo->getNombre() . '</p>';
                $cadena .= "<form method='post'><input type='hidden' name='nombre' value='" . $amigo->getNombre() . "'><button name='add'>Añadir Amigo</button></form>";
                return $cadena;
            }
        } else {
            //Retorna una cadena en caso de no existir el usuario
            return "No existe ese usuario";
        }
    }

    /**
     * Metodo que llama a agregarAmigo que se encarga de establecer la relacion de los dos usuarios en la base de datos
     */
    public static function addAmigo() {
        include_once '../model/UsuarioDAO.php';
        agregarAmigo($_POST["nombre"]);
    }

}

?>