<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="">
            <input type="submit" value="Enviar" name="boton" />
        </form>
        <?php
        if(isset($_POST["boton"])){
            include_once '../controller/servidor.php';
                enviarCorreo();
        }
        ?>
    </body>
</html>
