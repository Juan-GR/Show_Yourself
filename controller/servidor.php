<?php
function enviarCorreo($email){
    $subject="Bienvenido usuario";
    $mensaje="Gracias por registrarte en Show UrSelf, inicia sesión para disfrutar de la red social";
    $headers='From: showurselfweb@gmail.com'."\r\n".
            'Reply-To: showurselfweb@gmail.com'."\r\n".
            'X-Mailer: PHP/'.phpversion();
        mail($email,$subject,$mensaje,$headers);
}
?>