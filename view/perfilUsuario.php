<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./styles/estilos.css">
        <title>Perfil</title>
    </head>
    <body>
        <?php
        session_start();
        include_once '../controller/UsuarioController.php';
        ?>
        <div class="contenedorPerfil">
        <header class="contenedorHeader">
            <div class="titulo">
                <a href="../index.php"><img src="styles/logo.png" alt="logo"/></a>
            </div>
            <div class="contenedorBotones">
                <nav>
                    <ul>
                        <li><form action="" method="post"><button type="submit" name="cerrarSesion">Cerrar Sesion</button></form></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main class="perfilUsuario">
            <div class="perfilBorde">
                <p><?php UsuarioController::cargarFoto();?></p>
            </div>
            <div class="divFotos"></div>
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
        if(isset($_POST["cerrarSesion"])){
            session_destroy();
            $_SESSION["usuario"]=[];
        }
        ?>
    </body>
</html>
