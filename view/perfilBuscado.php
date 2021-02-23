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
        <?php
        //NOTA PARA PERFIL BUSCADO: El perfil buscado es identico al perfilUsuario principal pero la diferencia es que este perfil solo muestra
        //un perfil buscado y muestra los comentarios y las fotos que tiene subidas, pero aqui no se pueden subir 
        @session_start();
        include_once '../controller/UsuarioController.php';
        ?>
        <div class="contenedorPerfil">
            <header class="contenedorHeader headerPerfil">
                <div class="titulo">
                    <a href="../index.php"><img src="styles/logo.png" alt="logo"/></a>
                </div>
                <div class="contenedorBotones">
                    <nav>
                        <ul>
                            <li><form action="perfilUsuario.php" method="post"><button type="submit" name="volver">Volver</button></form></li>                            
                        </ul>
                    </nav>
                </div>
            </header>
            <main class="perfilUsuario">
                <div class="infoPerfil">
                    <p><?php
                        $etiquetaFoto = UsuarioController::cargarIcono($_SESSION["buscado"]);
                        echo $etiquetaFoto;
                        ?></p>
                    <p><?php echo $_SESSION["buscado"]; ?></p>
                    <?php
                    $comentarios = UsuarioController::imprimirComentarios($_SESSION["buscado"]);
                    for ($i = 0; $i < count($comentarios); $i++) {
                        echo '<p class="comentario">' . $comentarios[$i] . '</p>';
                    }
                    ?>
                </div>
                <div class="contenedorFotosForm">

                    <div class="contenedorFotos">
                        <?php
                        if (isset($_POST["subirFoto"])) {
                            UsuarioController::subirFoto();
                        }
                        $imagenes = UsuarioController::imprimirImagenes($_SESSION["buscado"]);
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
    </body>
</html>
