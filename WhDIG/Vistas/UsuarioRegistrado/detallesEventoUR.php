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
        
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/jquery.lightbox-0.5.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilos.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/inicio.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilosDetallesUR.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery.lightbox-0.5.js"></script>
        
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/eventosGenerales.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>Vistas/UsuarioRegistrado/js/detallesEventoUR.js"></script>

    </head>
    <body>
        <header>
            <div id="subheader">
                <div id="logo"><p><a href="<?php echo URL; ?>UsuarioRegistrado">WhDIG</a></p></div>
                
                
                <div id="logo2"><h2>Where do I go?</h2></div>
                <nav>
                     <ul>
                         <li><a id="inicio" href="">Inicio</a></li>
                         <li><a id="miCuenta" href="">Mi cuenta</a></li>
                         <li><a id="asistencia" href="">Asistencia a eventos</a></li>
                         <li><a id="salir" href="">Salir</a></li>
                    </ul>
                </nav>
            </div>
       
        </header>
        
        <section id="wrap">
            <section id ="main">
                <section class="section" id="detallesEvento">
                    <?php
                     $objEvento = $this->detallesEvento;
                     $estadisticas = $objEvento->obtenerEstadisticas();
                     $negocio = $objEvento->obtenerNegocio();
                    ?>
    <article class ="numeroEvento" id="<?php echo $objEvento->obtenerIdentificador();?>">
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
        
    </div>
        <table id="iconos">
            
            <tr>
                <td class="metaforaAsistir oculto"><img class='asistir' src='<?php echo URL; ?>Public/images/bandera.png'/><a id="aAsistirBandera" href="">Asistir</a></td>
                <td class="metaforaAsistir "><a id="aAsistir" href="">Asistir</a></td>
                <td class="metaforaAsistir"></td>
                <td class="metaforaFavorito oculto"><a href=""><img class='favorito' src='<?php echo URL; ?>Public/images/favorito.png'/></a></td>
                <td class="metaforaFavorito"><a href=""><img class='noFavorito' src='<?php echo URL; ?>Public/images/noFavorito.png'/></a></td>
            </tr>
            
        </table>
        
    </article>
                </section>
                <section class="section" id="comentarios">
                    <article id="articleComentario">
                        
                     <p id="tituloComentarios">Todos los comentarios:</p>
                     <div id="nuevoComentario">
                        <form id="formComentario">
                            <!--<input type="text" id="comentario" placeholder="Escriba su comentario" required>-->
                            <textarea placeholder="Escribe aquí tus comentarios" id="miComentario" rows="4" cols="90"></textarea>
                            <input  class="botones btnFormularioComentario" type="submit" value="Comentar" id="btnComentar">
                        </form>
                     </div>
                     
                     <div id="todosComentarios">
                         
                         <?php if(isset($this->comentarios)){
                            foreach ($this->comentarios as $comentario) {?>
                         
                         <article class="comentario">
                             <p id="nombreUsuario"><?php echo $comentario->obtenerUsuario()->obtenerNombre();?></p>
                             <div id="textoComentario">
                                 <p><?php echo $comentario->obtenerTexto();?></p>   
                             </div>
                             
                         </article>                       
                         
                         
                         <?php 
                            }
                            } ?>
                         
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

