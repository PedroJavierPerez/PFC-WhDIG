<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Web de eventos de ocio">
        <meta name="keywords" content="evento,ocio,bar,deporte,pub">
        <title>WhDIG</title>
        <link rel="shortcut icon" href="<?php echo URL; ?>Public/images/favicon.png" type="image/png" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilos.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/olvidarContrasena.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script>
        <script src="<?php echo URL; ?>Vistas/UsuarioNoRegistrado/js/olvidarContrasena.js"></script>
        <script src="<?php echo URL; ?>Public/js/eventosGenerales.js"></script>
        
        
    </head>
    <body>
        <header>
            <div id="subheader">
               <div id="logoCompleto">
                    <div id="logo"><p><a href="<?php echo URL; ?>UsuarioNoRegistrado"><p>WhDIG</p></a></p></div>
                    <div id="logo2"><h2>Where do I go?</h2></div>
                </div>
               
            </div>
       
        </header>
        
        <section id="wrap">
            <section id ="main">
               
                <section id="formularioOlvidarContrasena">
                    
                      <article class="articleFormulario ocultar">
                        <form id="formEliminarCuenta">
                       
                            <p class="titulo" id="tituloRecuperarContrasena">Recuperar contraseña</p>
                            <div id="inputRecuperar"> 
                        <label for ="contrasenaEliminarCuenta">Introduzca su email:</label>
                        <input class="inp" type="email" id="inputEmail" required>
                            </div>
                        <input  class="botones" type="submit" value="Enviar" id="btnEnviar">
                       
                    </form>
                        
                    </article>
                </section>
                
    
            </section>

            <div id="copyright"><p>Copyright © 2014 | Pedro Javier Pérez Mora</p></div>
        </section>
               
        
        <?php
        // put your code here
        ?>
    </body>
</html>
