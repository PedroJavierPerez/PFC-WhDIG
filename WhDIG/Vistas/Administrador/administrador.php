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
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/administrador.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script>
        <script src="<?php echo URL; ?>Vistas/Administrador/js/administrador.js"></script>
        
        <script src="<?php echo URL; ?>Public/js/eventosGeneralesAdmin.js"></script>
    </head>
    <body>
        <header>
            <div id="subheader">
               <div id="logoCompleto">
                    <div id="logo"><p><a href="<?php echo URL; ?>Administrador"><p>WhDIG</p></a></p></div>
                    <div id="logo2"><h2>Where do I go?</h2></div>
                </div>
                 <nav>
                     <ul id="menu">
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
                    <p class="titulo2" id="tituloNegociosAlta">Alta de negocios</p>
                    <?php  $i =0;
                    $numPa = floor((count($this->negociosEsperaAlta))/5);
                    $resto = (count($this->negociosEsperaAlta))%5;
                    if($resto != 0){ $numPa = $numPa +1;}
                    
                    ?>
                   <?php 
                   if(isset($this->negociosEsperaAlta)){
                   foreach ($this->negociosEsperaAlta as $negocio) { 
                       $i = $i +1;
                       $evenPag = isset($this->cortePag)? ($this->cortePag*5)-5 :0;
                       if(($i>$evenPag)&&($i<=$evenPag + 5)){
                       $propietario = $negocio->obtenerPropietario();
                       ?>
                        
                    
                    <article class="articulos" id='<?php echo $negocio->obtenerIdentificador();?>'>
                            <hgroup><h4 class='titulo'><?php echo $negocio->obtenerNombre();?> (<?php echo $negocio->obtenerProvincia();?>)</h4></hgroup>
                    <p>
                    <ul>
                        <li>+ Propietario: <?php $email= $propietario->obtenerEmail();
                        echo "<a id='$email' href='mailto:$email'>$email</a>";?></li>
                        <li>+ Tipo de local: <?php echo $negocio->obtenerTipo();?></li>
                        <li>+ Localidad: <?php echo $negocio->obtenerLocalidad();?></li>
                        <li>+ Dirección: Calle <?php echo $negocio->obtenerDireccion();?></li>
                        <li>+ Codigo Postal: <?php echo $negocio->obtenerCodigoPostal();?></li>
                    </ul>
                    
                    <div id="bot">
                         <div><input  class="botones" type="submit" value="Aceptar" id="btnAceptarNegocio"></div>
                         <div class="tdEnviarCorreo"><input  class="botones" type="submit" value="Enviar correo" id="btnEnviarCorreo"></div>
                         <div class="tdCancelarCorreo"><input  class="botones" type="submit" value="Cancelar correo" id="btnCancelarCorreo"></div>
                         <div id="rechazar"><input class="botones" type="submit" value="Rechazar" id="btnRechazarNegocio"></div>
                    </div>            
                        
                    <div id="formCorreo">
                        
                        <form>
                            <label for ="asunto">Asunto:</label>
                            <input id="inp" type="text" id="asunto" required>
                            <textarea placeholder="Escribe aquí el texto" id="textoCorreo" rows="4" cols="60" required></textarea>
                            <div id="divBtnEnviar"><input  class="botones" type="submit" value="Enviar" id="btnEnviar"></div>
                        </form>
                    </div>
                    
                    
                    </article>
                    
                  <?php 
                  
                   }
                   }
                   ?>
                    <div id="divPag" class="<?php echo $this->cortePag;?>">
                   <?php
                   for($j=0;$j<$numPa;$j++){
                   ?>
                        <a id="<?php echo $j+1;?>" href=""><?php echo $j+1;?> </a>
                   <?php }?>
                    </div>
                    
                    <?php
                   }else{?>
                    <div id=noEventosAsistir>
                        <p class='NoFiltro'>No existen negocios para dar de alta.</p>
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
