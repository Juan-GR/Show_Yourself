<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles/estilos.css">
        <title>Perfil</title>
    </head>
    <body>
       
        <?php
        //Comprobamos la sesion
        include_once '../controller/UsuarioController.php';
        UsuarioController::comprobarSesion();
        ?>
        <div class="contenedorPerfil">
            <header class="contenedorHeader headerPerfil">
                <div class="titulo">
                    <a href="../index.php"><img src="styles/logo.png" alt="logo"/></a>
                </div>
                <div class="contenedorBotones">
                    <nav>
                        <ul>
                            <li><form action="amigos.php" method="post"><button type="submit" name="amigos">Amigos</button></form></li>
                            <li><form action="" method="post"><button type="submit" name="cerrarSesion">Cerrar Sesion</button></form></li>                            
                        </ul>
                    </nav>
                </div>
            </header>

            <main class="perfilUsuario">
                <div class="iconoPerfil"><p><?php
                    //Cargamos el icono del perfil de usuario
                        $etiquetaFoto = UsuarioController::cargarIcono($_SESSION["usuario"]);
                        echo $etiquetaFoto;
                        ?></p>
                    <p><?php echo $_SESSION["usuario"]; ?></p>
                </div>
                <div class="infoPerfil">

                    <form method="POST">
                        <input type="text" name="comentario"/>
                        <button name="comentar">Comentar</button>
                    </form>
                    <?php
                    //Carga los comentarios en la base de datos cuando se envia el formulario
                    if (isset($_POST["comentar"]) && !empty($_POST["comentario"])) {
                        UsuarioController::cargarComentario();
                    }
                    //Imprime los comentarios
                    $comentarios = UsuarioController::imprimirComentarios($_SESSION["usuario"]);
                    for ($i = 0; $i < count($comentarios); $i++) {
                        echo '<p class="comentario">' . $comentarios[$i] . '</p>';
                    }
                    ?>
                </div>
                <div class="contenedorFotosForm">
                    <div class="contenedorFormAmigos">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="custom-input-file">
                                <input type="file" id="fichero-tarifas" class="input-file" name="foto">
                                Seleccionar imagen
                            </div>
                            <button type="submit" name="subirFoto" class="botonAdd">Subir foto</button>
                        </form>
                    </div>
                    <div class="contenedorFotos">
                        <?php
                        //Si se pulsa el boton se sube la foto que hayas elegido
                        if (isset($_POST["subirFoto"])) {
                            UsuarioController::subirFoto();
                        }
                        //Imprime todas las imagenes del usuario
                        $imagenes = UsuarioController::imprimirImagenes($_SESSION["usuario"]);
                        for ($i = 0; $i < count($imagenes); $i++) {
                            echo '<p><img src="img/' . $imagenes[$i] . '"></p>';
                        }
                        ?>
                    </div>
                </div>
            </main>
            <footer class="footerPerfil">
                <h1>Tu red social y la de todos</h1>
                <ul>
                    <li>Contacto</li>
                    <li>juangr@alumnos.iesgalileo.es</li>
                    <li>678-XXX-XXX</li>
                </ul>
                <ul>
                    <li>Cursos</li>
                    <li>A.S.I.R</li>
                    <li>D.A.W</li>
                </ul>
                <p><img src="styles/logo.png" alt="logo"/></p>
            </footer>
        </div>
        <?php
        if (isset($_POST["cerrarSesion"])) {
            session_destroy();
            unset($_SESSION["usuario"]);
            header('Location:../index.php');
        }
        ?>
    </body>
</html>
