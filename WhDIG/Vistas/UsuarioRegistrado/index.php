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
                <div id="logo"><p><a href="">WhDIG</a></p></div>
                
               
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
                
                <aside>
                    
                    <section class="filtro">
                        <div id="eventoshoy">
                            <hgroup><h3>Eventos de hoy:<br><?php echo date("d-m-Y");?></h3></hgroup>
                        <ul>
                           
                           
                        </ul>
                                
                        </div>
                        
                    </section>
                    
                    <section class="filtro" id="idFiltro">
                    
                        <form id= "formFiltro">
                             <label for ="fechaInicio">Desde:</label>
                             <input type="date" id="fechaInicio">
                             <label for ="fechaInicio">Hasta:</label>
                             <input type="date" id="fechaFin">
                              <label for ="provincia">Provincia:</label>
                              <input list ="provincia" name="pro" id="pro" >
                              <datalist id="provincia" >
                                     
                                      <?php foreach ($this->provincias as $provincia) { ?>
                                  
                        <option value='<?php echo $provincia["provincia"]?>'></option>
                        
                           <?php }  ?>

                            
                             </datalist>
                             <label for ="ciudad">Ciudad:</label>
                             <input list="ciudad" name="ciu" id="ciu" >
                                 <datalist id="ciudad" >
                                     
                                      <?php foreach ($this->localidades as $localidad) { ?>
                                  
                        <option value='<?php echo $localidad["nombre"]?>'></option>
                        
                           <?php }  ?>  
                                   
                                     
                                     
                                 </datalist>
                             
                             <label for ="tipo">Tipo:</label>
                             <input list="tipo" name="tip">
                            
                             <datalist id="tipo" >
                                     
                                     <?php foreach ($this->tipos as $tipo){?>
                                 
                                 
                                 <option value= '<?php echo $tipo ?>'></option>
                                     
                                 <?php } ?>

                             </datalist>
                             <label for ="local">Local:</label>
                             <input list="local" name="loc">
                                 <datalist id="local">
                                     
                                    <?php foreach ($this->negocios as $negocio) { ?>
                                  
                        <option value='<?php echo $negocio["Nombre"]?>'></option>
                        
                           <?php }  ?>
                        
                                 </datalist>
                             <input class="botones" type="submit" value="Filtrar" id="btnFiltrar">
                         </form>
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
