<?php
function enviarCorreo(){
    $to="jorgeuva22@gmail.com";
    $subject="Bienvenido usuario";
    $mensaje="Gracias por registrarte en Show UrSelf, inicia sesión para disfrutar de la red social";
    $headers='From: showurselfweb@gmail.com'."\r\n".
            'Reply-To: showurselfweb@gmail.com'."\r\n".
            'X-Mailer: PHP/'.phpversion();
        mail($to,$subject,$mensaje,$headers);
}
?>