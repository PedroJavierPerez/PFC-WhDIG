<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Web de eventos de ocio">
        <meta name="keywords" content="evento,ocio,bar,deporte,pub">
        <title>WhDIG</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilos.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/inicio.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script>
        <script src="<?php echo URL; ?>Vistas/UsuarioRegistrado/js/index.js"></script>
        <script src="<?php echo URL; ?>Public/js/eventosGenerales.js"></script>
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
                         <li><a id="salir" href="">Salir</a></li>
                    </ul>
                </nav>
            </div>
       
        </header>
        
        <section id="wrap">
            <section id ="main">
                
                <aside class="aside" id="asideFiltro">
                    
                    <section class="filtro">
                        <div id="eventoshoy">
                            <hgroup><h3>Eventos de hoy:<br><?php echo date("d-m-Y");?></h3></hgroup>
                        <ul>
                            <?php if(isset($this->eventosHoy)) { ?>
                            <?php foreach ($this->eventosHoy as $eventoHoy) { ?>
                            <a id="<?php echo $eventoHoy->obtenerIdentificador();?>" href=''><div id ='ideventoshoy'><li><span id='spanHora'><?php echo $eventoHoy->obtenerHora();?></span> - 
                                       <span id = 'spanNombreEvento'><?php echo $eventoHoy->obtenerNombre();?></span> <br>
                                       <p id='pNombreLocal'><?php echo $eventoHoy->obtenerNegocio()->obtenerNombre();?></p></li></div></a>
                           <?php }  ?>
                            <?php }else{  ?>
                            <p id="noEventosHoy">No tiene ningún evento para hoy.</p>
                            <?php }  ?>
                        </ul>
                                
                        </div>
                        
                    </section>
                 
                
                   
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

                   <?php foreach ($this->eventos as $evento) { 
                       
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
                    
                  <?php }  ?>
                    
                </section>
                
                
            </section>

            <div id="copyright"><p>Copyright © 2014 | Pedro Javier Pérez Mora</p></div>
        </section>
               
        
        <?php
        // put your code here
        ?>
    </body>
</html>
