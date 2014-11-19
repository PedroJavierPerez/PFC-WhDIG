<?php require_once ('./Entidades/UsuarioAbstracto.php');?>
<?php require_once ('./Entidades/EntidadUsuarioRegistrado.php');?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Web de eventos de ocio">
        <meta name="keywords" content="evento,ocio,bar,deporte,pub">
        <title>WhDIG</title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/estilos.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/miCuenta.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>Public/css/inicio.css">
        <script type="text/javascript" src="<?php echo URL; ?>Public/js/jquery-1.11.1.js"></script>
        <script src="<?php echo URL; ?>Vistas/UsuarioRegistrado/js/miCuenta.js"></script>
        <script src="<?php echo URL; ?>Public/js/eventosGenerales.js"></script>
        
        
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
               
                <section id="formularioMiCuenta">
                    
                        
                   
                    <article class="articleFormulario">
                        <form id="formMiCuenta">
                       
                          <p class="titulo" id="tituloMiCuenta">Mi cuenta</p>  
                           
                        <p class="pInformacion">Información requerida</p>
                       
                        <div class="tablas">
                        <table id="tabla2">
                            <?php $usuario = $this->usuario?>
                      
                            <tr>   
                                <td class="fila"> <label for ="nombre">Nombre:</label></td>
                                <td><input class="inp" type="text" id="nombre" placeholder="Escriba su nombre" value="<?php echo $usuario->obtenerNombre(); ?>" required></td>
                            </tr>
                        
                            <tr>
                                <td class="fila"><label for ="email">Email:</label></td>
                                <td><input class="inp" type="email" id="email" placeholder="Escriba su email" value="<?php echo $usuario->obtenerEmail(); ?>" required></td>
                            </tr>
                        <tr>
                        <td class="fila"><label for ="contrasena">Contraseña:</label></td>
                        <td><input class="inp" type="password" id="contrasena" placeholder="Escriba su contraseña" required></td>
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
                        <td><input class="inp" list="provincia" name="prov" placeholder="Escriba su provincia" value="<?php echo $usuario->obtenerProvincia(); ?>" required></td>
                        
                            <datalist id="provincia" >
                                     
                             <?php foreach ($this->provincias as $provincia) { ?>
                                  
                                <option value='<?php echo $provincia["provincia"]?>'></option>
                        
                             <?php }  ?> 
                                   
                                     
                                     
                            </datalist>
                        </tr>
                             
                            <tr>
                        <td class="fila"><label for ="localidad">Localidad:</label></td>
                        <td><input class="inp" list="localidad" name="loc" id= "loc" placeholder="Escriba su localidad" value="<?php echo $usuario->obtenerLocalidad(); ?>" required></td>
                        
                            <datalist id="localidad" >
                                     
                             <?php foreach ($this->localidades as $localidad) { ?>
                                  
                                <option value='<?php echo $localidad["nombre"]?>'></option>
                        
                             <?php }  ?> 
                                   
                                     
                                     
                            </datalist>
                            </tr>
                        
                      
                       <tr>
                        <td class="fila"><label for ="genero">Genero:</label></td>
                        <td><input type="radio" name="genero" value="M" <?php if($usuario->obtenerGenero()=='M'){echo 'checked';} ?> required/> M
                        <input type="radio" name="genero" value="F" <?php if($usuario->obtenerGenero()=='F'){echo 'checked';} ?> required/> F </td>
                        </tr>
                        </table>
                        </div>   
                        <p class="pInformacion">Información adicional</p>
                        <div class="tablas">
                       <table id="tabla6">
                        <tr>
                        <td><label for ="fecha">Fecha de Nacimiento:</label></td>
                        <td><input type="date" id="fecha" value="<?php if($usuario->obtenerFechaNacimiento()!=NULL){echo $usuario->obtenerFechaNacimiento();} ?>"></td>
                        </tr>
                       </table>
                        <div id="divInformacion">
                        <label for ="informacion"></label>
                        <input type="checkbox" id="informacion" name="informacion" value="1" <?php if($usuario->obtenerRecibirInformacion()==1){echo 'checked';} ?>> Permitir recibir información.
                        </div>
                        <input  class="botones btnFormularioCuenta" type="submit" value="Guardar datos" id="btnGuardarDatos">
                        </div>
                    </form>
                        <a href="" id="eliminarCuenta">Eliminar cuenta</a>
                    </article>
                    
                      <article class="articleFormulario ocultar">
                        <form id="formEliminarCuenta">
                       
                            <p class="titulo" id="tituloEliminarCuenta">Eliminar cuenta</p>
                        <label for ="contrasena">Comprobar contraseña:</label>
                        <input class="inp" type="password" id="contrasenaEliminarCuenta" placeholder="Escriba su contraseña" required>
                        <input  class="botones btnFormularioCuenta" type="submit" value="Eliminar cuenta" id="btnEliminarCuenta">
                       
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
