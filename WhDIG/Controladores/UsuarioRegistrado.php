<?php
require_once ('./Entidades/UsuarioAbstracto.php');
require_once ('./Entidades/EntidadUsuarioRegistrado.php');

class UsuarioRegistrado extends Controlador{
        


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
	* administrador
	*
	* Renderiza la vista administrador e inicializa
	* las variables necesarias para esta.
	*/
         function administrador($numPag = 1){
            
            $this->vista->negociosEsperaAlta = $this->modelo->cargarNegociosSinAlta();
            $this->vista->usuario = $this->modelo->buscarUsuario($_SESSION["email"]);
            $this->vista->cortePag = $numPag;
            $this->vista->render($this,'administrador');
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
        
        $dateAtual= date("Y-m-d");
            if(isset($datosUsuario["FechaNacimiento"])&& $datosUsuario["FechaNacimiento"]> $dateAtual){
                echo "Fecha no valida";
            }else{
                $correcto = $this->modelo->modificarDatosUsuario($datosUsuario);
                echo $correcto;
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
       
        
            $correcto = $this->modelo->eliminarCuentaUsuario($usuario);
            
            echo $correcto;
        
        
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


        $correcto = $this->modelo->incluirNuevoComentario($datosComentario); 
        echo $correcto;

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
    * aceptarNegocio
    *
    * Modifica el estado de alta del negocio a aceptado. 
    */
    public function aceptarNegocio() {

        $idNegocio = $_POST["idNegocio"];


        $correcto = $this->modelo->modificarAceptarEstadoAltaNegocio($idNegocio); 
        
         if($correcto){
             $negocio = $this->modelo->buscarNegocio($idNegocio);
             $objetoNegocio = $this->modelo->crearObjetoNegocio($negocio[0]);
             $destino = $objetoNegocio->obtenerPropietario()->obtenerEmail();
             $nombreNegocio = $objetoNegocio->obtenerNombre();
            $correcto = $this->enviarEmailconfirmarAlta($destino, $nombreNegocio);
            if($correcto == false){
                $this->modelo->modificarEstadoAltaNegocioEnEspera($idNegocio);
            }
         }
         echo $correcto;
    } 
    
    
      /**
    * rechazarNegocio
    *
    * Modifica el estado de alta del negocio a rechazado. 
    */
    public function rechazarNegocio() {

        $idNegocio = $_POST["idNegocio"];
        
        $negocio = $this->modelo->buscarNegocio($idNegocio);
        $correcto = $this->modelo->modificarRechazarEstadoAltaNegocio($idNegocio);
        
         if($correcto){
             
             $objetoNegocio = $this->modelo->crearObjetoNegocio($negocio[0]);
             $destino = $objetoNegocio->obtenerPropietario()->obtenerEmail();
             $nombreNegocio = $objetoNegocio->obtenerNombre();
            $correcto = $this->enviarEmailRechazarAlta($destino,$nombreNegocio);
            
         }
        echo $correcto;

    } 
    
    
        /**
	* enviarEmailconfirmarAlta
	*
	* Envia email para confirmar alta de negocio.
	*
	* @param String $destino Email de destino donde se enviara el correo.
        * @param String $negocio Nombre del negocio.
        * @return Boolean Se envio correctamente el correo True/False.
	*/
    public function enviarEmailconfirmarAlta($destino, $negocio){
        
        $asunto = "Alta negocio[WhDIG]";
        $comentario = 
                '<strong>EMAIL: </strong>'.$destino.'</strong><br><br>
                
                <strong>EL ADMINISTRADOR DE LA APLICACIÓN WhDIG LE INFORMA QUE SU NEGOCIO '.$negocio.' HA SIDO VERIFICADO CORRECTAMENTE.</strong><br><br> 
                <strong>EL NEGOCIO YA FUE DADO DE ALTA.</strong><br><br><br> 
           
                <strong>GRACIAS POR CONFIAR EN WhDIG.</strong><br><br><br>';
                
        
        $headers = 'From:'.$destino."\r\n".
                    'Reply-To:'.$destino."\r\n".
                    'Content-type: text/html; charset=UTF-8 \r\n'.
                    'X-Mailer:PHP/'.phpversion();
                     
                    
            return mail(utf8_decode($destino), utf8_decode($asunto), utf8_decode($comentario), $headers);
    }
    
       /**
	* enviarEmailRechazarAlta
	*
	* Envia email para denegar alta de negocio.
	*
	* @param String $destino Email de destino donde se enviara el correo.
        * @param String $negocio Nombre del negocio.
        * @return Boolean Se envio correctamente el correo True/False.
	*/
    public function enviarEmailRechazarAlta($destino, $negocio){
        
        $asunto = "Alta negocio[WhDIG]";
        $comentario = 
                '<strong>EMAIL: </strong>'.$destino.'</strong><br><br>
                
                <strong>EL ADMINISTRADOR DE LA APLICACIÓN WhDIG LE INFORMA QUE SU NEGOCIO '.$negocio.' NO CUMPLE LAS CONDICIONES NECESARIAS PARA SER VERIFICADO CORRECTAMENTE.</strong><br><br> 
                <strong>EL NEGOCIO NO FUE DADO DE ALTA.</strong><br><br><br> 
           
                <strong>GRACIAS POR CONFIAR EN WhDIG.</strong><br><br><br>';
                
        
        $headers = 'From:'.$destino."\r\n".
                    'Reply-To:'.$destino."\r\n".
                    'Content-type: text/html; charset=UTF-8 \r\n'.
                    'X-Mailer:PHP/'.phpversion();
                     
                    
            return mail(utf8_decode($destino), utf8_decode($asunto), utf8_decode($comentario), $headers);
    }
    
    function enviarCorreoInformativo(){
        $destino = $_POST["email"];
        $asunto = $_POST["asunto"]." [WhDIG]";
        $comentario = $_POST["texto"];
        
        $headers = 'From:'.$destino."\r\n".
                    'Reply-To:'.$destino."\r\n".
                    'Content-type: text/html; charset=UTF-8 \r\n'.
                    'X-Mailer:PHP/'.phpversion();
        
        $correcto = mail(utf8_decode($destino), utf8_decode($asunto), utf8_decode($comentario), $headers);
        echo $correcto;
    }
        
}

