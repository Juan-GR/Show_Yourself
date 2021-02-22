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
            include_once '../controller/UsuarioController.php';
            if(isset($_POST["buscarAmigo"])){
            $amigo= UsuarioController::imprimirAmigo();
            echo $amigo;
            }
            ?>
        </div>
    </body>
</html>
