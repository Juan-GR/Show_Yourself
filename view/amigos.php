<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Buscar amigos</title>
    </head>
    <body>
        <form method="POST" action="">
            <input type="text" name="amigo">
            <button name="buscarAmigo">Buscar amigos</button>
        </form>
        <div>
            <?php
            @session_start();
            include_once '../controller/UsuarioController.php';
            //Si se pulsa en buscarAmigo imprime un usuario si existe
            if(isset($_POST["buscarAmigo"])){
            $amigo= UsuarioController::imprimirAmigo();
            echo $amigo;
            }
            //Si se pulsa ver te lleva al perfil del usuario y se crea una sesion para ese usuario
            if(isset($_POST["ver"])){
                $_SESSION["buscado"]=$_POST["nombre"];
                header("Location:perfilBuscado.php");
            }
            //Si se pulsa add se llama a la funcion addAmigo que añade esa persona a tu lista de amigos
            if(isset($_POST["add"])){
                UsuarioController::addAmigo();
            }
            ?>
        </div>
    </body>
</html>
