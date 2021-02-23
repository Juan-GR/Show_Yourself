<?php
/**
 * Funcion que envia un correo cuando te registras en la pagina web
 * Para el funcionamiento de esta funcion es necesario tener configurado un servidor SMTP en el ordenador local
 * @param type $email
 * @param type $usuario
 */
function enviarCorreo($email,$usuario){
    $subject="Bienvenido ".$usuario;
    $mensaje="Gracias por registrarte en Show UrSelf, inicia sesion para disfrutar de la red social";
    $headers='From: showurselfweb@gmail.com'."\r\n".
            'Reply-To: showurselfweb@gmail.com'."\r\n".
            'X-Mailer: PHP/'.phpversion();
        mail($email,$subject,$mensaje,$headers);
}
?>