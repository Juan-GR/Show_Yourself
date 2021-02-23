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
        <title>Inicio de sesion Show UrSelf</title>
    </head>
    <body>
        <?php
        //Si existe la sesion redirige automaticamente al perfil
        @session_start();
        if (isset($_SESSION["usuario"])) {
            header('Location:perfilUsuario.php');
        }
        ?>
        <header class="contenedorHeader">
            <div class="titulo">
                <a href="../index.php"><img src="styles/logo.png" alt="logo"/></a>
            </div>
            <div class="contenedorBotones">
                <nav>
                    <ul>
                        <li><form action="" method="post"><button type="submit" name="registro">Registrarse</button></form></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="divformulario">
            <form method="POST" action="">
                <label for="usuario">Nombre de usuario</label>
                <input type="text" name="usuario" required/><br>
                <label for="password">Contraseña</label>
                <input type="password" name="password" required/><br>
                <button name="iniciarSesion">ENVIAR</button>
            </form> 
            <div>
                <p>Iniciar Sesion</p>
                <p>Bienvenido a Show UrSelf</p>
                <p>Inicie sesion para disfrutar de la red social<br> y compartir buenos momentos</p>
            </div>
        </div>
        <?php
        //Si se pulsa iniciar sesion, se llama al metodo logear de la clase
        if (isset($_POST["iniciarSesion"])) {
            include_once '../controller/UsuarioController.php';
            UsuarioController::logear($_POST["usuario"], $_POST["password"]);
        }
        //Si se pulsa registro lleva a la vista de registro
        if (isset($_POST["registro"])) {
            header('Location:registro.php');
        }
        ?>
    </body>
</html>
