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
        <title>Show UrSelf</title>
    </head>
    <body>
        <header class="contenedorHeader">
            <div class="titulo">
                <img src="styles/logo.png" alt="logo"/>
            </div>
            <div class="contenedorBotones">
                <nav>
                    <ul>
                        <li><form action="" method="post"><button type="submit" name="iniciarSesion">Iniciar Sesion</button></form></li>
                        <li><form action="" method="post"><button type="submit" name="registrarse">Registrarse</button></form></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <section class="seccion1">
                <img src="styles/chico.png">
                <div>
                <h2>¡Únete, disfruta y haz muchos amigos!</h2>
                <p>Una red social apta para todos los públicos,<br> donde podras compartir tus mejores momentos,<br> hacer amigos y comentar todo.</p>
                </div>
            </section>
            <section class="seccion2">
                <div>
                <h2>Sube fotos y mira lo que hacen tus amigos</h2>
                <p>Con solo darle un clic podras compartir todo lo que haces,<br>ver lo que hacen tus amigos,<br>y compartir tu vida.</p></div>
                <p>
                <img src="styles/camara.png">
                </p>
            </section>
            <section class="seccion3">
                <img src="styles/movil.png">
                <div>
                <h2>¡Comienza hoy mismo!</h2>
                <p>Registrate si no tienes cuenta<br> y empieza a compartir tus momentos desde ahora<br>siguiendo nuestra filosofía, SÉ TU MISMO.</p>
                </div>
            </section>
        </main>
        <footer>
            <h1>Tu red social y la de todos</h1>
            <ul>
                <li>Contacto</li>
                <li>juangr@alumnos.iesgalileo.es</li>
                <li>678-XXX-XXX</li>
            </ul>
            <ul>
                <li>Cursos</li>
                <li>A.S.I.R</li>
                <li>D.A.W</li>
            </ul>
            <p><img src="styles/logo.png" alt="logo"/></p>
        </footer>
        <?php
        if(isset($_POST["registrarse"])){
            header('Location:registro.php');
        }
        if(isset($_POST["iniciarSesion"])){
            
        }
        ?>

    </body>
</html>
