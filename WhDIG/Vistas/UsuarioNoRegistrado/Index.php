<?php
require_once './Entidades/EntidadNegocio.php';
require_once './Entidades/EntidadEvento.php';

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Web de eventos de ocio">
        <meta name="keywords" content="evento,ocio,bar,deporte,pub">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WhDIG</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilos.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script> 
       
        <script src="<?php echo URL; ?>Vistas/UsuarioNoRegistrado/js/index.js"></script>

    </head>
    <body>
        <header>
            <div id="subheader">
                <div id="logoCompleto">
                    <div id="logo"><p><a href=""><p>WhDIG</p></a></p></div>
                    <div id="logo2"><h2>Where do I go?</h2></div>
                </div>
                
                <div id="divIdentificarse">
                  <div id="identificarse">
                    <div id="formulario">
                    <form id="formAutentificar">
                       <div id="labelAutenti"> <label for ="email">Email:</label>
                        <label for ="contrasena">Contraseña:</label></div>
                        <div id="inputAutenti"><input type="email" id="email" placeholder="Escribe tu email" required>                       
                            <input type="password" id="contrasena" placeholder="Escribe tu contraseña" required></div>
                            <input class="botones" id="btnRegistrarseForm" type="button" value="Regístrate">
                        <input class="botones" type="submit" value="Entrar" id="btnEntrar">
                        
                            
                    </form>
                    <div id="olvidarContrasena">
                    <p><a href="">¿Has olvidado tu contraseña?</a></p>
                    </div>
                    </div>
                </div>
                
                <div id="Registrarse"> <input class="botones" id="btnRegistrarse" type="button" value="Regístrate"></div>
            </div>
       </div>
        </header>
        
        <section id="wrap">
            <section id ="main">

                <section id="bienvenidos">
                    <article>
                        <hgroup><h3>Bienvenido a nuestra web de eventos de ocio</h3></hgroup>
                    </article>
                </section>
                
                <aside class="aside" id="asideFiltro">
                    <section id="sectionFiltro" class="filtro">

                         <form id= "formFiltro">
                             <div class="izquierda"><label for ="fechaInicio">Desde:</label>
                                 <input type="date" id="fechaInicio"></div>
                             <div class="derecha"><label for ="fechaInicio">Hasta:</label>
                                 <input type="date" id="fechaFin"></div>
                              <div class="izquierda"><label for ="provincia">Provincia:</label>
                              <input list ="provincia" name="pro" class="inp"></div>
                              <datalist id="provincia" >
                                     
                           
                           <?php foreach ($this->provincias as $provincia) { ?>
                                  
                        <option value='<?php echo $provincia["provincia"]?>'></option>
                        
                           <?php }  ?>
                            
                             </datalist>
                             <div class="derecha"><label for ="ciudad">Ciudad:</label>
                             <input list="ciudad" name="ciu" id="ciud" class="inp"></div>
                                 <datalist id="ciudad" >
                                     
                           
                           <?php foreach ($this->localidades as $localidad) { ?>
                                  
                        <option value='<?php echo $localidad["nombre"]?>'></option>
                        
                           <?php }  ?> 
                                   
                                     
                                     
                                 </datalist>
                             
                             <div class="izquierda"><label for ="tipo">Tipo:</label>
                             <input list="tipo" name="tip" class="inp"></div>
                            
                             <datalist id="tipo" >
                                     
                                 
                                 <?php foreach ($this->tipos as $tipo){?>
                                 
                                 
                                 <option value= '<?php echo $tipo ?>'></option>
                                     
                                 <?php } ?>
                             </datalist>
                             <div class="derecha"><label for ="local">Local:</label>
                             <input list="local" name="loc" class="inp"></div>
                                 <datalist id="local">
                                     
                           
                           <?php foreach ($this->negocios as $negocio) { ?>
                                  
                        <option value='<?php echo $negocio["Nombre"]?>'></option>
                        
                           <?php }  ?> 
                        
                                 </datalist>
                             <input class="botones" type="submit" value="Filtrar" id="btnFiltrar">
                         </form>
                    </section>
                    </aside>
                
                
                <section id="eventos">
                  
                    
                   <?php 
                   if(isset($this->eventos)){
                   foreach ($this->eventos as $evento) { 
                       
                       $negocio = $evento->obtenerNegocio();
                       ?>
                        
                    
                    <a id='<?php echo $evento->obtenerIdentificador();?>' href=''><article>
                            <hgroup><h4 class='titulo'><?php echo $evento->obtenerNombre();?> (<?php echo $negocio->obtenerProvincia();?>)</h4></hgroup>
                    <p>
                    <ul>
                        <li><?php echo $evento->obtenerDescripcion();?></li>
                    <li class='fechalista'>+ Fecha: <?php echo $evento->obtenerFecha();?></li>
                    <li>+ Hora: <?php echo $evento->obtenerHora();?></li>
                    </ul>
                    </p>
                    </article></a>
                    
                   <?php } ?>
                    <?php
                   }else{?>
                    <p class='NoFiltro'>No hay eventos disponibles.</p>
                    <?php } ?>
                </section>
                
                <aside class="aside" id="asideSuscribir">
                    <section id="sectionSuscribir" class="filtro">
                        <div id="suscribir" class="informacion">
                        <div class="cabecera"><hgroup><h3>Suscribir:</h3></hgroup><span class="triangulo"></span></div>
                        
                            <form id="formSuscribir">
                                <label for ="Iemail">Email:</label>
                                <input type="email" id="Iemail" placeholder="Escribe tu email" required>
                                <input class="botones" type="submit" value="Recibir" id="btnRecibir">
                                
                            </form>
                            
                        </div>
                        
                    </section>
                    
                    <section id="sectionEliminarSuscribir" class="filtro">
                        <div id="EliminarSuscribir" class="informacion">
                            <div id="cabeceraEliminarSuscripcion"class="cabecera"><hgroup><h3>Eliminar Suscripción:</h3></hgroup><span class="triangulo"></span></div>
                        <!--<hgroup><h3>Eliminar Suscripción:</h3></hgroup>-->
                        
                            <form id="formEliminarSuscribir">
                                <label for ="Iemail">Email:</label>
                                <input type="email" id="NIemail" placeholder="Escribe tu email" required>
                                
                                <input  class="botones" type="submit" value="No Recibir" id="btnNoRecibir">
                            </form>
                            
                                
                        </div>
                        
                    </section>
                    
                </aside>
             
            </section>

            <div id="copyright"><p>Copyright © 2014 | Pedro Javier Pérez Mora</p></div>
        </section>
               
        
        <?php
        // put your code here
        ?>
    </body>
</html>





