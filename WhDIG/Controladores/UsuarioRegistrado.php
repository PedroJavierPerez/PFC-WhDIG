<?php
require_once ('./Entidades/UsuarioAbstracto.php');
require_once ('./Entidades/EntidadUsuarioRegistrado.php');

class UsuarioRegistrado extends ControladorUsuario{
        


        function __construct() {
            parent::__construct();
           
        }
        
        /**
	* index
	*
	* Renderiza la vista principal del usuario registrado e inicializa
	* las variables necesarias para esta.
	*
	* @param int $numPag Número de página de eventos que queremos mostrar.
	*/
        function index($numPag = 1){
            
           
            $this->vista->negocios = $this->modelo->buscarNegocios();
            $this->vista->tipos = array("Noche",'Bares','Pubs','Deporte','Charlas y conferencias',
                                     'Conciertos','Cursos','Espectáculos','Exposiciones','Ferias','Libros',
                                     'Cine','Teatro','Hoteles','Otros');
            $this->vista->localidades = $this->modelo->buscarLocalidades();
            $this->vista->provincias = $this->modelo->buscarProvincias();
            $this->vista->eventos = $this->cargarEventos();
            $this->vista->cortePag = $numPag;
            $this->vista->eventosHoy = $this->cargarEventosAsistir($_SESSION["email"],true);
            $this->vista->usuario = $this->modelo->buscarUsuario($_SESSION["email"]);
            $this->vista->render($this,'index');
        }
        
        /**
	* miCuenta
	*
	* Renderiza la vista mi cuenta e inicializa
	* las variables necesarias para esta.
	*/
        function miCuenta(){
            
            $usuario = $this->modelo->buscarUsuario($_SESSION["email"]);
            $this->vista->usuario = $usuario;
            $this->vista->localidades = $this->modelo->buscarLocalidadesProvincia($usuario->obtenerProvincia());
            $this->vista->provincias = $this->modelo->buscarProvincias();
            
            $this->vista->render($this,'miCuenta');
        }
        
        /**
	* detallesEvento
	*
	* Renderiza la vista para mostrar los detalles de un evento para un usuario registrado e inicializa
	* las variables necesarias para esta.
	*
	* @param int $id Identificador del evento.
	*/
        public function detallesEvento($id){
            
        $encontrado = $this->modelo->comprobarEvento($id);
            if($encontrado){
                $this->vista->usuario = $this->modelo->buscarUsuario($_SESSION["email"]);
                $this->vista->comentarios = $this->modelo->buscarComentariosEvento($id);
                $this->vista->detallesEvento = $this->cargarDetallesEvento($id);
                $this->vista->idEvento=$id;
                $this->vista->render($this,'detallesEventoUR');
            }else{
                if(!$encontrado){
                   echo "No existe evento ".$id;
                }else{
                   echo "Error en el acceso al servidor.";
                }
            }
        }
        
        /**
	* asistenciaEventos
	*
	* Renderiza la vista asistencia a eventos del usuario registrado e inicializa
	* las variables necesarias para esta.
	*/
         function asistenciaEventos(){
            
            $this->vista->eventosAsistir = $this->cargarEventosAsistir($_SESSION["email"]);
            $this->vista->usuario = $this->modelo->buscarUsuario($_SESSION["email"]);
            $this->vista->render($this,'asistenciaEventos');
        }
        
        
        
        /**
	* cerrarSesion
	*
	* Cierra y destruye sesión de usuario y redirige a la página principal de UR.
	*/
        public function cerrarSesion(){
            Sesion::unsetValue('email');
            Sesion::destroy();
            header("Location:".URL."UsuarioNoRegistrado");
    }

    /**
    * cargarEventosHoy
    *
    * Carga los eventos con la fecha igual al actual y que el usuario haya indicado que va a asistir.
    *
    * @return Array<EntidadEvento> Eventos con fecha actual, con la hora y fecha formateada.
    */
    public function cargarEventosHoy(){
        
        $eventoHoy = $this->modelo->buscarEventosHoy();
        
        return $this->cambiarFechaHora($eventoHoy);
        
    }
    
    /**
    * modificarDatosUsuario
    *
    * Obtiene los nuevos datos del usuario y comprueba que la fecha de nacimiento sea correcta.
    * Se comunica con el modelo para modificar los datos del usuario.
    * 
    */
    public function modificarDatosUsuario(){
        
        $datosUsuario["Email"] = $_POST["email"];
        $datosUsuario["Nombre"] = $_POST["nombre"];
        $datosUsuario["Contrasena"] = $_POST["pass"];
        $datosUsuario["Genero"] = $_POST["genero"];
        $datosUsuario["Localidad"] = $_POST["localidad"];
        $datosUsuario["Provincia"] = $_POST["provincia"];
        $fecha = $_POST["fecha"];
        if(!empty($_POST['fecha'])){ $datosUsuario["FechaNacimiento"] = $fecha;}else{$datosUsuario["FechaNacimiento"]='NULL';}
        $datosUsuario["RecibirInformacion"] = $_POST["informacion"];
        $datosUsuario["Propietario"]= 0;
        
        if(isset($datosUsuario["Email"])&& isset($datosUsuario["Nombre"])&& isset($datosUsuario["Contrasena"])&& 
           isset($datosUsuario["Genero"])&& isset($datosUsuario["Localidad"])&& isset($datosUsuario["Provincia"])&& ($datosUsuario["Email"]!=='')
                && ($datosUsuario["Nombre"]!=='') && ($datosUsuario["Contrasena"]!=='') && ($datosUsuario["Genero"]!=='') && ($datosUsuario["Localidad"]!=='') && ($datosUsuario["Provincia"]!=='')){
             
            if(!filter_var($datosUsuario["Email"], FILTER_VALIDATE_EMAIL)){
                  echo "email no valido";
             }else{
                $dateAtual= date("Y-m-d");
                 if(isset($datosUsuario["FechaNacimiento"])&& $datosUsuario["FechaNacimiento"]> $dateAtual){
                    echo "Fecha no valida";
                 }else{
                    $correcto = $this->modelo->modificarDatosUsuario($datosUsuario);
                    echo $correcto;
                }
             }
        }else{
            echo "Datos incompletos";
        }
    }
    
    /**
    * eliminarCuentaUsuario
    *
    * Obtiene el email y contraseña del usuario
    * si son correctas se comunica con el modelo para eliminarlo.
    *
    */
    public function eliminarCuentaUsuario() {
        
        $usuario["Email"] = $_SESSION["email"];
        $usuario["Contrasena"] = $_POST["pass"];
       
        if((isset($usuario["Contrasena"]))&&($usuario["Contrasena"]!=='')){
            if(!filter_var($usuario["Email"], FILTER_VALIDATE_EMAIL)){
                  echo "email no valido";
             }else{
                $correcto = $this->modelo->eliminarCuentaUsuario($usuario);
            
                echo $correcto;
        
             }
        }else{
            echo "Datos incompletos";
        }
    }
    
    /**
    * incluirFavorito
    *
    * Obtiene el email y el identificador de evento 
    * Se comunica con el modelo para incluir el evento como favorito del usuario.
    */
    public function incluirFavorito() {
        
        $usuarioEvento["Email"] = $_SESSION["email"];
        $usuarioEvento["Id_evento"] = $_POST["idEvento"];
        $usuarioEvento["Favorito"] = 1;
        
        $encontrado = $this->comprobarUsuarioEvento($usuarioEvento);
            if($encontrado){
                $correcto = $this->modelo->modificarFavorito($usuarioEvento);
                echo $correcto;
            }else{
                $correcto = $this->modelo->modificarFavorito($usuarioEvento,True); 
                echo $correcto;
            }
    }
    
    /**
    * eliminarFavorito
    *
    * Obtiene el email y el identificador de evento 
    * Se comunica con el modelo para eliminar el evento como favorito del usuario.
    */
    public function eliminarFavorito() {
        
        $usuarioEvento["Email"] = $_SESSION["email"];
        $usuarioEvento["Id_evento"] = $_POST["idEvento"];
        $usuarioEvento["Favorito"] = 0;
        $correcto = $this->modelo->modificarFavorito($usuarioEvento);
        echo $correcto;
    }
    
    /**
    * indicarAsistencia
    *
    * Obtiene el email y el identificador de evento 
    * Se comunica con el modelo para indicar la asistencia del usuario al evento.
    */
    public function indicarAsistencia() {
        
        $usuarioEvento["Email"] = $_SESSION["email"];
        $usuarioEvento["Id_evento"] = $_POST["idEvento"];
        $usuarioEvento["Asistir"] = 1;
        
        $encontrado = $this->comprobarUsuarioEvento($usuarioEvento);
            if($encontrado){
                $correcto = $this->modelo->modificarAsistencia($usuarioEvento);
                $correcto2 =$this->sumarEstadisticasEvento($usuarioEvento);
                echo $correcto;
            }else{
                $correcto = $this->modelo->modificarAsistencia($usuarioEvento,True);
                $correcto2 =$this->sumarEstadisticasEvento($usuarioEvento);
                echo $correcto;
            }
        
    } 
    
    /**
    * eliminarAsistencia
    *
    * Obtiene el email y el identificador de evento 
    * Se comunica con el modelo para eliminar la asistencia del usuario al evento.
    */
    public function eliminarAsistencia() {

    $usuarioEvento["Email"] = $_SESSION["email"];
    $usuarioEvento["Id_evento"] = $_POST["idEvento"];
    $usuarioEvento["Asistir"] = 0;
    $correcto = $this->modelo->modificarAsistencia($usuarioEvento);
    $correcto2 =$this->restarEstadisticasEvento($usuarioEvento);
    echo $correcto;
        
        
    }
    
    /**
    * comprobarUsuarioEvento
    *
    * Se comunica con el modelo para comprobar que ya existe relación entre usuario y evento.
    * 
    * @param array $usuarioEvento Identificador de evento y email de usuario.
    * 
    * @return Boolean True/false
    */
    public function comprobarUsuarioEvento($usuarioEvento) {

        return $this->modelo->comprobarUsuarioEvento($usuarioEvento);
    }

    /**
    * guardarComentario
    *
    * Obtiene el email y el identificador de evento. 
    * Se comunica con el modelo para incluir el nuevo comentario.
    */
    public function guardarComentario() {

        $datosComentario["Email"] = $_SESSION["email"];
        $datosComentario["Id_evento"] = $_POST["idEvento"];
        $datosComentario["Texto"] = $_POST["texto"];

        if((isset($datosComentario["Texto"]))&&($datosComentario["Texto"]!=='')){
           
            $correcto = $this->modelo->incluirNuevoComentario($datosComentario); 
            echo $correcto;
        }else{
            echo "Datos incompletos";
        }
    } 
    
    /**
    * cargarEventosAsistir
    *
    * Obtiene del modelo los eventos a los que el usuario va a asiatir.
    *
    * @param String $email Email del usuario.
    * @param String $hoy Indica si se desean todos los eventos a lo que va a asstir el usuario 
    *    o solo los de la fecha actual
    * 
    * @return Array<EntidadEvento> Eventos a los que el usuario va a asistir o eventos que va a asitir hoy.
    */
    public function cargarEventosAsistir($email,$hoy=false) {
        
       $detallesEventos = $this->modelo->buscarDetallesEventosUsuarioAsistir($email);
       $where = '(';
           if(isset($detallesEventos)){
               foreach ($detallesEventos as $detallesEvento) {
           
                   $where .="Id_evento = '".$detallesEvento["Id_evento"]."' OR ";            
               }
               $where = substr($where, 0, -3);
               $dateAtual= date("Y-m-d");
       
               if(!$hoy){
                    $where .= ") AND (Fecha >= '".$dateAtual."') ORDER BY Fecha ASC";
               }else{
                    $where .= ") AND (Fecha = '".$dateAtual."') ORDER BY Fecha ASC";    
               }
       
                $objetosEventos = $this->modelo->buscarEventosAsistir($where);
                return $this->cambiarFechaHora($objetosEventos);
      
           }else{
               return null;
           }
       
    }
    
    /**
    * sumarEstadisticasEvento
    *
    * Obtiene a través del modelo las estadisticas de un evento.
    * Suma 1 a las estadisticas segun los datos del usuario.
    *
    * @return Boolean True/False Si las estadisticas se modificaron correctamente.
    */
    public function sumarEstadisticasEvento($usuarioEvento) {
        
     $usuario = $this->modelo->buscarUsuario($usuarioEvento["Email"]);
     $evento = $this->modelo->buscarEvento($usuarioEvento["Id_evento"]);
     $estadisticas = $evento->obtenerEstadisticas();
     
         if($usuario->obtenerGenero()== 'M'){
             $datosEstadisticas["Hombres"]= $estadisticas->obtenerNuHombres()+1;
         }else{
             $datosEstadisticas["Mujeres"]= $estadisticas->obtenerNuMujeres()+1;
         }

         if($usuario->obtenerLocalidad() == $evento->obtenerNegocio()->obtenerLocalidad()){
             $datosEstadisticas["Locales"]=$estadisticas->obtenerNuLocales()+1;
         }else{
             $datosEstadisticas["Forasteros"]=$estadisticas->obtenerNuForasteros()+1;
         }

         return $this->modelo->modificarEstadisticasEvento($datosEstadisticas,$evento);
    }
      
    /**
    * restarEstadisticasEvento
    *
    * Obtiene a través del modelo las estadisticas de un evento.
    * Resta 1 a las estadisticas segun los datos del usuario.
    *
    * @return Boolean True/False Si las estadisticas se modificaron correctamente.
    */
    public function restarEstadisticasEvento($usuarioEvento) {
        
     $usuario = $this->modelo->buscarUsuario($usuarioEvento["Email"]);
     $evento = $this->modelo->buscarEvento($usuarioEvento["Id_evento"]);
     $estadisticas = $evento->obtenerEstadisticas();
     
         if($usuario->obtenerGenero()== 'M'){
             $datosEstadisticas["Hombres"]= $estadisticas->obtenerNuHombres()-1;
         }else{
             $datosEstadisticas["Mujeres"]= $estadisticas->obtenerNuMujeres()-1;
         }

         if($usuario->obtenerLocalidad() == $evento->obtenerNegocio()->obtenerLocalidad()){
             $datosEstadisticas["Locales"]=$estadisticas->obtenerNuLocales()-1;
         }else{
             $datosEstadisticas["Forasteros"]=$estadisticas->obtenerNuForasteros()-1;
         }

         return $this->modelo->modificarEstadisticasEvento($datosEstadisticas,$evento);
    }
    
    /**
	* autenticar
	*
	* Obtiene el email y contraseña del usuario y comprueba que existe.
        * LLama a la función iniciar sesión.
	*/
    public function autenticar(){
        $usuario["Email"] = $_POST["email"];
        $usuario["Contrasena"] = $_POST["pass"];
        
        if(!filter_var($usuario["Email"], FILTER_VALIDATE_EMAIL)){
                echo "email no valido";
        }else{
                $correcto = $this->modelo->comprobarUsuario($usuario,True);
        
        
            if($correcto){

                $usu = $this->modelo->buscarUsuario($usuario["Email"]);
                $usuario["Administrador"] = $usu->obtenerEsAdministrador();
                $this->iniciarSesion($correcto, $usuario);

                    if($usu->obtenerEsAdministrador() == 1){
                        echo "A";
                    }else{
                        echo "NA";
                    }
            }else{
                echo $correcto;
            }
        }
    }

    /**
	* iniciarSesion
	*
	* Inicia sesión de usuario.
	*
	* @param Boolean $registrado Indica si existe usuario con la contraseña y email indicados.True/False
        * @param Array $usuario datos usuario.
	*/
    public function iniciarSesion($registrado,$usuario){
        
        if(!isset($usuario["Administrador"])){
            $usuario["Administrador"]=0;
        }
        if($registrado){
            Sesion::init();
            if(!Sesion::exist()){ 
                Sesion::setValue('email', $usuario["Email"]);
                Sesion::setValue('administrador', $usuario["Administrador"]);
           } 
        }  
        
    }

       /**
    * recuperarContrasena
    *
    * Obtiene el email y lo valida, modifica la contraseña del usuario y se envia al correo.
    * 
    */ 
    function recuperarContrasena(){
        
        $email= $_POST["email"];
        
        if((isset($email["email"]))&&($email["email"]!=='')){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                echo "email no valido";
            }else{
                $usuario["Email"] = $email;
                    if($this->modelo->comprobarUsuario($usuario)){
                        $nuevaContrasena = $this->generaContrasena_random(5);
                        if($this->modelo->modificarContrasenaUsuario($email,$nuevaContrasena)){
                            if(!$this->enviarEmailNuevaContasena($email,$nuevaContrasena)){
                                $correcto = "email no enviado";
                            }else{     
                                $correcto = true;
                            }
                        }else{
                            $correcto = "Contrasena no modificada";
                        }
                    }else{
                        $correcto =false;
                    }
                    echo $correcto;
            }
        }else{
            echo "Datos incompletos";
        }
    }
    
    /**
    * generaContrasena_random
    *
    * Genera contraseña aleatoria.
    *
    * @param int $longitud Longitud de la contraseña.
    * 
    * @return String Contraseña creada aleatoriamente.
    */ 
    function generaContrasena_random($longitud){  
         $caracteres = 'ABCDEFGHIJuvwxRST234567UVWXYZabcdefghijklmnopqKLMNOPQrstyz0189';
         $pass = '';
            for ($i=0; $i<$longitud; ++$i){ 
                $pass .= substr($caracteres, (mt_rand() % strlen($caracteres)), 1);
            }
        return $pass;
    } 
    
     /**
    * enviarEmailNuevaContasena
    *
    * Envia email para obtener la nueva contraseña en caso de olvido
    *
    * @param String $destino Email de destino donde se enviara el correo.
    * @param String $nuevaContrasena Nueva contraseña del usuario.
    * @return Boolean Se envió correctamente el correo True/False.
    */
    public function enviarEmailNuevaContasena($destino, $nuevaContrasena){
        
        $asunto = "Nueva contraseña[WhDIG]";
        $comentario = 
                '<strong>EMAIL: </strong>'.$destino.'</strong><br>
                <strong>NUEVA CONTRASEÑA:'.$nuevaContrasena.'</strong><br><br>
                
                <strong>ARRIBA PUEDES ENCONTRAR SU NUEVA CONTRASEÑA.</strong><br>
                <strong>PUEDES CAMBIARLA EN CUALQUIER MOMENTO DESDE LA PESTAÑA MI CUENTA DENTRO DE LA APLICACIÓN.</strong><br><br><br>';            
        
        $headers = 'From:'.$destino."\r\n".
                    'Reply-To:'.$destino."\r\n".
                    'Content-type: text/html; charset=UTF-8 \r\n'.
                    'X-Mailer:PHP/'.phpversion();
                     
                    
           return mail(utf8_decode($destino), utf8_decode($asunto), utf8_decode($comentario), $headers);
    }
   
        
}

