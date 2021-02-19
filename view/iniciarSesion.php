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
                    <input type="text" name="usuario" id="usuario" /><br>
                    <label for="password1">Contraseña</label>
                    <input type="password" name="password1" id="correo" /><br>
                    <button name="registro">ENVIAR</button>
        </form> 
            <div>
                <p>Iniciar Sesion</p>
                <p>Bienvenido a Show UrSelf</p>
                <p>Inicie sesion para disfrutar de la red social<br> y compartir buenos momentos</p>
            </div>
            </div>
        <?php
        if(isset($_POST["iniciarSesion"])){

        }
        if(isset($_POST["registro"])){
            header('Location:registro.php');
        }
        ?>
    </body>
</html>
