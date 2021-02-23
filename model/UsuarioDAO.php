<?php

//Registra a un usuario en la base de datos que se le pasa como parametro
/**
 * 
 * @param type $usuario Usuario
 * @return boolean
 * 
 * Si la consulta se ejecuta devuelve true y en caso contrario devuelve false
 * 
 */
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

/**
 * Funcion que logea a un usuario siempre y cuando los datos del formulario coincidan con los de la base de datos
 * @param type $nombre
 * @param type $password
 * @return boolean
 */
function loginUsuario($nombre, $password) {
    include_once '../config/Database.php';
    $conexion = Database::conectar();
    $existe = false;
    $resultados = $conexion->query('SELECT * from usuarios');
    while ($registro = $resultados->fetch(PDO::FETCH_BOTH)) {
        if ($registro["nombre"] == $nombre && $registro["password"] == $password) {
            $existe = true;
        }
    }
    return $existe;
}

/**
 * Busca el icono que tiene el usuario en su perfil y devuelve el nombre de la foto
 * @param type $nombreUsuario
 * @return nombre de la foto
 */
function buscarFoto($nombreUsuario) {
    $nombreFoto = "";
    include_once '../config/Database.php';
    $conexion = Database::conectar();
    $resultado = $conexion->query("SELECT icono FROM usuarios where nombre='" . $nombreUsuario . "'");
    foreach ($resultado as $row) {
        $nombreFoto = $row["icono"];
    }
    return $nombreFoto;
}

/**
 * Funcion que carga la imagen que subes al formulario en la base de datos y la mueve desde la carpeta de origen a la carpeta destino
 * que en este caso el directorio es img
 */
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

/**
 * Funcion que dependiendo del usuario que se le pase como parametro y busca todas las fotos que ha subido ese usuario
 * @param type $nombreUsuario
 * @return array con el nombre de las imagenes
 */
function cargarImagenes($nombreUsuario) {
    $imagenes = [];
    include_once '../config/Database.php';
    $conexion = Database::conectar();
    $resultado = $conexion->query("SELECT ruta FROM imagenes where usuario='" . $nombreUsuario . "'");
    foreach ($resultado as $row) {
        array_push($imagenes, $row["ruta"]);
    }
    return $imagenes;
}

/**
 * Funcion que se encarga de guardar un comentario que se pasa a traves de un formulario en la base de datos 
 */
function comentar() {
    include_once '../config/Database.php';
    $comentario = $_POST["comentario"];
    $conexion = Database::conectar();
    // Prepare
    $statement = $conexion->prepare("INSERT INTO comentarios (usuario, comentario) VALUES (?,?)");
    $nombre = $_SESSION["usuario"];
    $statement->bindParam(1, $nombre);
    $statement->bindParam(2, $comentario);
    $statement->execute();
}

/**
 * Funcion que se encarga de recoger los comentarios de la base de datos de un determinado usuario, el que se pasa como parametro
 * @param type $nombreUsuario del que se quieren coger los comentarios
 * @return array que contiene todos los comentarios de un usuario
 */
function recogerComentarios($nombreUsuario) {
    $comentarios = [];
    include_once '../config/Database.php';
    $conexion = Database::conectar();
    $resultado = $conexion->query("SELECT comentario FROM comentarios where usuario='" . $nombreUsuario . "'");

    foreach ($resultado as $row) {
        array_push($comentarios, $row["comentario"]);
    }
    return $comentarios;
}

/**
 * Funcion que busca una persona en la base de datos, crea un objeto Usuario y lo devuelve,
 * en caso de no encontrar ese nombre devuelve un objeto null
 * @param type $nombreAmigo
 * @return \Usuario
 */
function buscarPersona($nombreAmigo) {
    $usuario = null;
    include_once '../config/Database.php';
    include_once '../model/Usuario.php';
    $conexion = Database::conectar();
    $resultado = $conexion->query("SELECT * FROM usuarios where nombre LIKE '%" . $nombreAmigo . "%'");
    foreach ($resultado as $row) {
        $usuario = new Usuario($row["nombre"], $row["email"], $row["password"], $row["icono"]);
    }
    return $usuario;
}

/**
 * Funcion que se encarga de agregar un amigo a la lista de amigos e inserta esa relacion en la base de datos
 * @param type $usuarioAgregado
 */
function agregarAmigo($usuarioAgregado) {
    include_once '../config/Database.php';
    $conexion = Database::conectar();
    // Prepare
    $statement = $conexion->prepare("INSERT INTO amistades VALUES (?,?)");
    $usuarioEmisor = $_SESSION["usuario"];
    $usuarioReceptor = $usuarioAgregado;
    $statement->bindParam(1, $usuarioEmisor);
    $statement->bindParam(2, $usuarioReceptor);
    $statement->execute();
}

/**
 * Funcion que se encarga de comprobar si una persona buscada es amigo o no de la cuenta logeada y devuelve true
 * en funcion de si las dos personas son amigos o no
 * @param type $nombreUsuario
 * @return boolean
 */
function comprobarAmigo($nombreUsuario) {
    include_once '../config/Database.php';
    $conexion = Database::conectar();
    $usuarioEmisor = $_SESSION["usuario"];
    $usuarioReceptor = $nombreUsuario;
    // Prepare
    $resultado = $conexion->query("select * from  amistades where usuarioEmisor='" . $usuarioEmisor . "' and usuarioReceptor='$usuarioReceptor'");
    if ($resultado->rowCount() == 1) {
        return true;
    } else {
        return false;
    }
}

?>
