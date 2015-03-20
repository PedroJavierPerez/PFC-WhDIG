<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Web de eventos de ocio">
        <meta name="keywords" content="evento,ocio,bar,deporte,pub">
        <title>WhDIG</title>
        <link rel="shortcut icon" href="<?php echo URL; ?>Public/images/favicon.png" type="image/png" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilos.css"> 
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/registrarse.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script>
        <script src="<?php echo URL; ?>Vistas/UsuarioNoRegistrado/js/registrarse.js"></script>
        <script src="<?php echo URL; ?>Public/js/eventosGenerales.js"></script>
        
        
    </head>
    <body>
        <header>
            <div id="subheader">
                <div id="logoCompleto">
                    <div id="logo"><p><a href="<?php echo URL; ?>UsuarioNoRegistrado"><p>WhDIG</p></a></p></div>
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
                            <!--<input class="botones" id="btnRegistrarseForm" type="button" value="Regístrate">-->
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
               
                <section id="formularioRegistro">
                    
                        
                   
                    <article id="articleFormulario">
                        <form id="formRegistro">
                            <div id="divForm">
                          <p id="tituloRegistro">Formulario de registro</p>  
                           
                        <p class="pInformacion">Información requerida</p>
                       
                        
                          <label for ="nombre">Nombre:</label>
                            
                             <input class="inp" type="text" id="nombre" placeholder="Escriba su nombre" required>
                            
                           
                                <label for ="Remail">Email:</label>
                                
                                <input class="inp" type="email" id="Remail" placeholder="Escriba su email" required>
                           
                        
                        <label for ="Rcontrasena">Contraseña:</label>
                       
                        <input class="inp" type="password" id="Rcontrasena" placeholder="Escriba su contraseña" required>
                        
                         
                           <label for ="verificarContrasena">Verificar contraseña:</label>
                          
                           <input class="inp" type="password" id="verificarContrasena" placeholder="Repita su contraseña" required>
                      
                         
                            
                             <label for ="provincia">Provincia:</label>
                            
                        <input class="inp" list="provincia" name="prov" placeholder="Escriba su provincia" required>
                        
                            <datalist id="provincia" >
                                     
                             <?php foreach ($this->provincias as $provincia) { ?>
                                  
                                <option value='<?php echo $provincia["provincia"]?>'></option>
                        
                             <?php }  ?> 
                                   
                                     
                                     
                            </datalist>
                         
                        
                        <label for ="localidad">Localidad:</label>
                        
                        <input class="inp" list="localidad" name="loc" id= "loc" placeholder="Escriba su localidad" required>
                        
                            <datalist id="localidad" >
                                     
                             <?php foreach ($this->localidades as $localidad) { ?>
                                  
                                <option value='<?php echo $localidad["nombre"]?>'></option>
                        
                             <?php }  ?> 
                                   
                                     
                                     
                            </datalist>
                            
                       
                        <label for ="genero" id="labelGenero">Genero:</label>
                     
                        <input type="radio" name="genero" value="M" required/> M
                        <input type="radio" name="genero" value="F" required/> F 
                        
                       
                          
                        <p class="pInformacion">Información adicional</p>
                        
                       
                        <label for ="fecha">Fecha de Nacimiento:</label>
                        
                        <input  class="inp" type="date" id="fecha">
                        
                        <label for ="informacion"></label>
                       
                        <span id="pro"><input type="checkbox" id="propietario" name="propietario" value="1"/> Eres propietario.</span>
                        
                        <input type="checkbox" id="informacion" name="informacion" value="1"/> Permitir recibir información.
                        
                        <input  class="botones" type="submit" value="Enviar datos" id="btnEnviarDatos">
                            </div>
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
