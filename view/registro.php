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
        <header class="contenedorHeader">
            <div class="titulo">
                <a href="principal.php"><img src="styles/logo.png" alt="logo"/></a>
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
                    <input type="text" name="usuario" id="usuario" /><br>
                    <label for="correo">E-mail</label>
                    <input type="text" name="correo" id="correo" /><br>
                    <label for="password1">Contraseña</label>
                    <input type="password" name="password1" id="correo" /><br>
                    <label for="password2">Repita su contraseña</label>
                    <input type="password" name="password2" id="correo" /><br>
                    <button name="registro">ENVIAR</button>
        </form> 
            <div>
                <p>Registro</p>
                <p>Bienvenido a Show UrSelf</p>
                <p>Regístrese para disfrutar de la red social<br> y compartir buenos momentos</p>
            </div>
            </div>
        <?php
        if(isset($_POST["registro"])){
        include_once '../controller/servidor.php';
        enviarCorreo();
        }
        ?>
    </body>
</html>
