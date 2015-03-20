<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Web de eventos de ocio">
        <meta name="keywords" content="evento,ocio,bar,deporte,pub">
        <title>WhDIG</title>
        <link rel="shortcut icon" href="<?php echo URL; ?>Public/images/favicon.png" type="image/png" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilos.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/inicioAdministrador.css">
         <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/asistenciaEventos.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script>
        <script src="<?php echo URL; ?>Vistas/Administrador/js/asistenciaEventos.js"></script>
        <script src="<?php echo URL; ?>Public/js/eventosGeneralesAdmin.js"></script>
     
    </head>
    <body>
        <header>
            <div id="subheader">
                <div id="logoCompleto">
                    <div id="logo"><p><a href=""><p>WhDIG</p></a></p></div>
                    <div id="logo2"><h2>Where do I go?</h2></div>
                </div>
                 <nav>
                     <ul>
                         <li><a id="inicio" href="">Inicio</a></li>
                         <li><a id="miCuenta" href="">Mi cuenta</a></li>
                         <li><a id="asistencia" href="">Asistencia a eventos</a></li>
                         
                         <li><a id="administrador" href="">Administrador</a></li>
                        
                         <li><a id="salir" href="">Salir</a></li>
                    </ul>
                </nav>
            </div>
       
        </header>
        
        <section id="wrap">
            <section id ="main">
                
                <section id="eventos">

                   <?php 
                   if(isset($this->eventosAsistir)){
                    foreach ($this->eventosAsistir as $evento) { 
                       
                       $negocio = $evento->obtenerNegocio();
                       ?>
                        
                    <div class="divEvento">
                    <a id='<?php echo $evento->obtenerIdentificador();?>' class="enlaceEvento" href=''><article>
                            <hgroup><h4 class='titulo'><?php echo $evento->obtenerNombre();?> (<?php echo $negocio->obtenerProvincia();?>)</h4></hgroup>
                    <p>
                    <ul>
                        <li><?php echo substr($evento->obtenerDescripcion(), 0, 297);?> . . .</li>
                    <li class='fechalista'>+ Fecha: <?php echo $evento->obtenerFecha();?></li>
                    <li>+ Hora: <?php echo $evento->obtenerHora();?></li>
                    </ul>
                    
                    </article></a>
                    
                    <div id="<?php echo $evento->obtenerIdentificador();?>" class="divArticle">
                    
                        <table id="iconos">
            
                            <tr>
                                <td id= "nAsistentes">Asistentes: <?php echo $evento->obtenerEstadisticas()->numeroAsistentes();?></td>
                                <td class="metaforaAsistir "><a id="aAsistirBandera" href=""><img class='asistir' src='<?php echo URL; ?>Public/images/bandera.png'/></a></td>
                                <td class="metaforaAsistir oculto"><a id="aAsistir" href="">Asistir</a></td>
                                <td class="metaforaFavorito <?php if (($evento->obtenerDetallesEventoUsuario()->obtenerFavorito())==1){}else{echo "oculto";}?>"><a href=""><img class='favorito' src='<?php echo URL; ?>Public/images/favorito.png'/></a></td>
                                <td class="metaforaFavorito <?php if (($evento->obtenerDetallesEventoUsuario()->obtenerFavorito())==1){ echo "oculto"; }else{}?>"><a href=""><img class='noFavorito' src='<?php echo URL; ?>Public/images/noFavorito.png'/></a></td>
                            </tr>
            
                        </table>
                    </div>
                    </div> 
                    
                    <?php } 
                    
                    }else{  ?>
                    <div id="noEventosAsistir">
                        <p class='NoFiltro'>No existen eventos a los que vaya a asistir.</p>
                    </div>
                    <?php } ?>
                        
                </section>
                
     
            </section>

            <div id="copyright"><p>Copyright © 2014 | Pedro Javier Pérez Mora</p></div>
        </section>
               
        
        <?php
        // put your code here
        ?>
    </body>
</html>

