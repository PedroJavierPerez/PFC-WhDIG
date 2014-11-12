<?php
require_once './Entidades/EntidadNegocio.php';
require_once './Entidades/EntidadEvento.php';
require_once './Entidades/EntidadEstadisticasEvento.php';

 ?>

<!DOCTYPE html>



<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Web de eventos de ocio">
        <meta name="keywords" content="evento,ocio,bar,deporte,pub">
        <title>WhDIG</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilosDetalles.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/jquery.lightbox-0.5.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilos.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery.lightbox-0.5.js"></script>
        
        <!--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->
        <!--<script type="text/javascript" src="<?php // echo URL; ?>Public/js/eventos_index.js"></script>-->
        <script type="text/javascript" src="<?php echo URL; ?>Vistas/Evento/js/detallesEventoUNR.js"></script>

    </head>
    <body>
        <header>
            <div id="subheader">
                <div id="logo"><p><a href="<?php echo URL; ?>Index">WhDIG</a></p></div>
                
                <div id="identificarse">
                    <div id="formulario">
                    <form id="formAutentificar">
                        <label for ="email">Email:</label>
                        <input type="email" id="email" placeholder="Escribe tu email" required>
                        <label for ="contrasena">Contraseña:</label>
                        <input type="password" id="contrasena" placeholder="Escribe tu contraseña" required>
                        <input class="botones" type="submit" value="Entrar" id="btnEntrar">
                        
                            
                    </form>
                    <div id="olvidarContraseña">
                    <p><a href="">¿Has olvidado tu contraseña?</a></p>
                    </div>
                    </div>
                </div>
                <div id="logo2"><h2>Where do I go?</h2></div>
                <div id="Registrarse"> <input class="botones" id="btnRegistrarse" type="button" value="Regístrate"></div>
            </div>
       
        </header>
        
        <section id="wrap">
            <section id ="main">
                <section id="detallesEvento">
                    <?php
                     $objEvento = $this->detallesEvento;
                     $estadisticas = $objEvento->obtenerEstadisticas();
                     $negocio = $objEvento->obtenerNegocio();
                    ?>
    <article>
        <hgroup><h4 class='titulo'><?php echo $objEvento->obtenerNombre();?></h4></hgroup>
    <div id='galeria'>
        <a href= "<?php echo URL; ?>Public/fotos/<?php echo $objEvento->obtenerFoto();?>" title='<?php echo $objEvento->obtenerNombre();?>'>
            <img class='imag' src='<?php echo URL; ?>Public/fotos/<?php echo $objEvento->obtenerFoto();?>'/>
        </a>
    </div>
    <div id='lista'>
        <p>
        <ul class= 'listaDetalles' id='datosEvento'>
            <li><span>+ Tipo:</span> <?php echo $objEvento->obtenerTipo();?></li>
            <li><span>+ Fecha:</span> <?php echo $objEvento->obtenerFecha();?></li>
            <li><span>+ Hora:</span> <?php echo $objEvento->obtenerHora();?></li>
            <li><span>+ Asistentes:</span> <?php echo $estadisticas->numeroAsistentes();?></li>
            <li id='descri'><span>+ Descripción:</span> <?php echo $objEvento->obtenerDescripcion();?></li>
        </ul>
        <ul class= 'listaDetalles' id='datosNegocio'>
            <li><span>+ Nombre local:</span> <?php echo $negocio->obtenerNombre();?></li>
            <li><span>+ Dirección:</span> Calle <?php echo $negocio->obtenerDireccion();?></li>
            <li><span>+ Localidad:</span> <?php echo $negocio->obtenerLocalidad();?></li>
            <li><span>+ Provincia:</span> <?php echo $negocio->obtenerProvincia();?></li>
            <li><span>+ Teléfono:</span> <?php echo $negocio->obtenerTelefono();?></li>
        </ul>
        </p>
    </div>
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

