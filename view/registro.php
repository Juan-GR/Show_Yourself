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
        <title>Registro Show UrSelf</title>
    </head>
    <body>
        <?php
        //Comprueba la sesion y si existe lleva al perfil del usuario
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
                        <li><form action="" method="post"><button type="submit" name="iniciarSesion">Iniciar Sesion</button></form></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="divformulario">
            <form method="POST" action="">
                <label for="usuario">Nombre</label>
                <input type="text" name="usuario" id="usuario" required/><br>
                <label for="correo">E-mail</label>
                <input type="text" name="correo" id="correo" required/><br>
                <label for="password1">Contraseña</label>
                <input type="password" name="password1" id="correo" required/><br>
                <label for="password2">Repita su contraseña</label>
                <input type="password" name="password2" id="correo" required/><br>
                <button name="registro">ENVIAR</button>
            </form> 
            <div>
                <p>Registro</p>
                <p>Bienvenido a Show UrSelf</p>
                <p>Regístrese para disfrutar de la red social<br> y compartir buenos momentos</p>
            </div>
        </div>
        <?php
        //Si se pulsa registro registra al usuario con los datos del formulario
        if (isset($_POST["registro"])) {
            //Se comprueba que las contraseñas sean iguales, si no salta un fallo
            if ($_POST["password1"] != $_POST["password2"]) {
                echo "Las contraseñas no coinciden";
            } else {
                include_once '../controller/UsuarioController.php';
                UsuarioController::registrar($_POST["usuario"], $_POST["correo"], $_POST["password1"]);
            }
        }
        //Si pulsas iniciar sesion lleva a iniciar sesion
        if (isset($_POST["iniciarSesion"])) {
            header('Location:iniciarSesion.php');
        }
        ?>
    </body>
</html>
