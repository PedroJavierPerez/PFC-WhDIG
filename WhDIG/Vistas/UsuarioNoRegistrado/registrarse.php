<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Web de eventos de ocio">
        <meta name="keywords" content="evento,ocio,bar,deporte,pub">
        <title>WhDIG</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilos.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/registrarse.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script>
        <script src="<?php echo URL; ?>Vistas/UsuarioNoRegistrado/js/registrarse.js"></script>
        
        
    </head>
    <body>
        <header>
            <div id="subheader">
                <div id="logo"><p><a href="<?php echo URL; ?>UsuarioNoRegistrado">WhDIG</a></p></div>
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
                
            </div>
       
        </header>
        
        <section id="wrap">
            <section id ="main">
               
                <section id="formularioRegistro">
                    
                        
                   
                    <article id="articleFormulario">
                        <form id="formRegistro">
                       
                          <p id="tituloRegistro">Formulario de registro</p>  
                           
                        <p class="pInformacion">Información requerida</p>
                       
                        <div class="tablas">
                        <table id="tabla2">
                            
                      
                            <tr>   
                                <td class="fila"> <label for ="nombre">Nombre:</label></td>
                                <td><input class="inp" type="text" id="nombre" placeholder="Escriba su nombre" required></td>
                            </tr>
                        
                            <tr>
                                <td class="fila"><label for ="Remail">Email:</label></td>
                                <td><input class="inp" type="email" id="Remail" placeholder="Escriba su email" required></td>
                            </tr>
                        <tr>
                        <td class="fila"><label for ="Rcontrasena">Contraseña:</label></td>
                        <td><input class="inp" type="password" id="Rcontrasena" placeholder="Escriba su contraseña" required></td>
                        </tr>
                        </table>
                        <table id="tabla3">
                       <tr>
                           <td id="tdVerificar"><label for ="verificarContrasena">Verificar contraseña:</label></td>
                           <td><input class="inp" type="password" id="verificarContrasena" placeholder="Repita su contraseña" required></td>
                       </tr>
                        </table>
                         <table id="tabla4">
                             
                               <tr>
                        <td class="fila"><label for ="provincia">Provincia:</label></td>
                        <td><input class="inp" list="provincia" name="prov" placeholder="Escriba su provincia" required></td>
                        
                            <datalist id="provincia" >
                                     
                             <?php foreach ($this->provincias as $provincia) { ?>
                                  
                                <option value='<?php echo $provincia["provincia"]?>'></option>
                        
                             <?php }  ?> 
                                   
                                     
                                     
                            </datalist>
                        </tr>
                             
                            <tr>
                        <td class="fila"><label for ="localidad">Localidad:</label></td>
                        <td><input class="inp" list="localidad" name="loc" id= "loc" placeholder="Escriba su localidad" required></td>
                        
                            <datalist id="localidad" >
                                     
                             <?php foreach ($this->localidades as $localidad) { ?>
                                  
                                <option value='<?php echo $localidad["nombre"]?>'></option>
                        
                             <?php }  ?> 
                                   
                                     
                                     
                            </datalist>
                            </tr>
                        
                      
                       <tr>
                        <td class="fila"><label for ="genero">Genero:</label></td>
                        <td><input type="radio" name="genero" value="M" required/> M
                        <input type="radio" name="genero" value="F" required/> F </td>
                        </tr>
                        </table>
                        </div>   
                        <p class="pInformacion">Información adicional</p>
                        <div class="tablas">
                       <table id="tabla6">
                        <tr>
                        <td><label for ="fecha">Fecha de Nacimiento:</label></td>
                        <td><input type="date" id="fecha"></td>
                        </tr>
                       </table>
                        <div id="divInformacion">
                        <label for ="informacion"></label>
                        <input type="checkbox" id="informacion" name="informacion" value="1"/> Permitir recibir información.
                        </div>
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
