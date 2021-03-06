<?php
require_once './Entidades/EntidadNegocio.php';
require_once './Entidades/EntidadEvento.php';
require_once './Controladores/UsuarioRegistrado.php';

    class UsuarioNoRegistrado extends ControladorUsuario{
        


        function __construct() {
            parent::__construct();
           
        }
        
        /**
	* index
	*
	* Renderiza la vista principal del usuario no registrado y inicializa
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
            $this->vista->cortePag = $numPag;
            $this->vista->eventos = $this->cargarEventos();
            $this->vista->render($this,'index');
        }
        
        /**
	* detalles
	*
	* Renderiza la vista de detalles de un evento e inicializa
	* las variables necesarias para esta.
	*
	* @param int $id Identificador del evento del que queremos motrar los eventos.
	*/
        public function detalles($id){
            $encontrado = $this->modelo->comprobarEvento($id);
                if($encontrado){
                    $this->vista->detallesEvento = $this->cargarDetallesEvento($id);
                    $this->vista->idEvento=$id;
                    $this->vista->render($this,'detallesEventoUNR');
                }else{
                    echo "No existe evento ".$id; 
                }
        }
        
        /**
	* registrarse
	*
	* Renderiza la vista para el registro de un nuevo usuario y inicializa
	* las variables necesarias para esta.
	*/
        public function registrarse(){
            
            $this->vista->localidades = $this->modelo->buscarLocalidades();
            $this->vista->provincias = $this->modelo->buscarProvincias();
            $this->vista->render($this,'registrarse');
            
        }
        
        /**
	* olvidarContrasena
	*
	* Renderiza la vista para recuperar la contraseña en caso de olvido y inicializa
	* las variables necesarias para esta.
	*/
        public function olvidarContrasena(){
            
            
            $this->vista->render($this,'olvidarContrasena');
            
        }

        /**
	* cargarDetallesEvento
	*
	* Busca los detalles de un evento y formatea la fecha y hora.
	*
	* @param int $id Identificador del evento del que queremos motrar los eventos.
        *
	* @return EntidadEvento $objetoEventoFormateado Objeto evento.   
	*/
        public function cargarDetallesEvento($id){
        
            $objetoEvento = $this->modelo->buscarDetallesEvento($id);

            $objetoEventoFormateado = $this->cambiarFechaHora($objetoEvento);
                
            return $objetoEventoFormateado[0];
        }
        
    /**
	* obtenerDatosNuevoUsuario
	*
	* Obtiene los datos del nuevo usuario, comprueba que el email y fecha son correctos.
	* Si el usuario estaba suscrito se borra la supcripción.
        * Guarda los datos del nuevo usuario llamando a la función EliminarSuscribir.
	*/
    public function obtenerDatosNuevoUsuario(){
        
        $datosUsuario["Email"] = $_POST["email"];
        $datosUsuario["Nombre"] = $_POST["nombre"];
        $datosUsuario["Contrasena"] = $_POST["pass"];
        $datosUsuario["Genero"] = $_POST["genero"];
        $datosUsuario["Localidad"] = $_POST["localidad"];
        $datosUsuario["Provincia"] = $_POST["provincia"];
        $fecha = $_POST["fecha"];
        if(!empty($_POST['fecha'])){ $datosUsuario["FechaNacimiento"] = $fecha;}
        $datosUsuario["RecibirInformacion"] = $_POST["informacion"];
        $datosUsuario["Propietario"]= $_POST["propietario"];
        
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
                    $correcto2 =true;
                    if($this->modelo->comprobarUNR($datosUsuario["Email"])){
                        $correcto2 =  $this->modelo->EliminarSuscribir($datosUsuario["Email"]);
                    }
                    if($correcto2 == true){
                        $correcto = $this->modelo->guardarDatosNuevoUsuario($datosUsuario);

                        UsuarioRegistrado::iniciarSesion($correcto,$datosUsuario["Email"]);

                        echo $correcto;
                    }else{
                        echo "Error de acceso al servidor";
                    }
                }
             }
        }else{
            echo "Datos incompletos";
        }
    }
    
    /**
	* suscribir
	*
	* Obtiene el email del UNR, realiza la suscripción. 
	* LLama a la función enviarEmailSuscribir para enviar email de confirmación.
	*/
    public function suscribir(){
        
        if((isset($_POST["email"]))&& ($_POST["email"]!= '')){
            $data["email"]= $_POST["email"];
            $data["Estado"]=0;
            
                if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)){
                    echo "email no valido";
                }else{   
                    $correcto = $this->modelo->suscribir($data);
                    if($correcto == True){
                        if(!$this->enviarEmailSuscribir($data["email"])){
                            $correcto = "email no enviado";
                                $this->modelo->EliminarSuscribir($data["email"]);
                        }  
                    }else{  
                        $correcto2 = $this->modelo->comprobarUNRactivo($data["email"]);
                        if($correcto2 == False){
                            $correcto = True;
                             if(!$this->enviarEmailSuscribir($data["email"])){
                                 $correcto = "email no enviado";}
                        }else{ $correcto = False;}  
                    }
                    echo $correcto;
                }
        }else{
            echo "Datos incompletos";
        } 
    }
    
    /**
	* activarSuscribir
	*
	* Confirma la suscripción del UNR poniendo su estado a 0.
	*
	* @param String $email Email del UNR.
	*/
     public function activarSuscribir($email){
         
         if(isset($email)){
             
             $unr["Estado"]= 1;
             $correcto = $this->modelo->editarUNR($unr,$email);
             
                if($correcto){
                    header('Location: http://localhost/PFC-WhDIG/WhDIG/UsuarioNoRegistrado');
                }
         }
         
     }
    
     /**
	* enviarEmailSuscribir
	*
	* Envia email para confirmar suscripción.
	*
	* @param String $destino Email de destino donde se enviara el correo.
        * 
        * @return Boolean Se envio correctamente el correo True/False.
	*/
    public function enviarEmailSuscribir($destino){
        
        $activateLink1 = "http://localhost/PFC-WhDIG/WhDIG/UsuarioNoRegistrado/activarSuscribir/".$destino;
        $activateLink2 = "http://localhost/PFC-WhDIG/WhDIG/UsuarioNoRegistrado/activarSuscribir/";
        $asunto = "Activación suscripción[WhDIG]";
        $comentario = 
                '<strong>EMAIL: </strong>'.$destino.'</strong><br>
                <strong>LINK DE ACTIVACIÓN:<br><a href="'.$activateLink1.'">'.$activateLink2.' </strong></a><br><br>
                <strong>POR FAVOR HAGA CLICK EN LINK DE ARRIBA PARA VERIFICAR SU EMAIL Y PODER ENVIARLE INFORMACION DE LOS NUEVOS EVENTOS.</strong><br><br> 
                <strong>SI EL LINK NO FUNCIONA INTENTELO UNA SEGUNDA VEZ, EL SERVIDOR A VECES TARDA EN PROCESAR LA PRIMERA ORDEN.</strong><br><br><br> 
           
                <strong>GRACIAS POR SUSCRIBIRSE EN WhDIG.</strong><br><br><br>';
                
        
        $headers = 'From:'.$destino."\r\n".
                    'Reply-To:'.$destino."\r\n".
                    'Content-type: text/html; charset=UTF-8 \r\n'.
                    'X-Mailer:PHP/'.phpversion();
                     
                    
            return mail(utf8_decode($destino), utf8_decode($asunto), utf8_decode($comentario), $headers);
    }
    
    /**
    * enviarEmailEliminarSuscribir
    *
    * Envia email para confirmar la eliminación de la suscripción.
    *
    * @param String $destino Email de destino donde se enviara el correo.
    * 
    * @return Boolean Se envio correctamente el correo True/False.
    */
    public function enviarEmailEliminarSuscribir($destino){
        
        $activateLink1 = "http://localhost/PFC-WhDIG/WhDIG/UsuarioNoRegistrado/eliminarSuscribir/".$destino;
        $activateLink2 = "http://localhost/PFC-WhDIG/WhDIG/UsuarioNoRegistrado/eliminarSuscribir/";
        $asunto = "Eliminar suscripción[WhDIG]";
        $comentario = 
                '<strong>EMAIL: </strong>'.$destino.'</strong><br>
                <strong>LINK PARA ELIMINAR SUSCRIPCIÓN:<br><a href="'.$activateLink1.'">'.$activateLink2.' </strong></a><br><br>
                <strong>POR FAVOR HAGA CLICK EN LINK DE ARRIBA PARA VERIFICAR SU EMAIL Y ELIMINAR SU SUSCRIPCIÓN.</strong><br><br> 
                <strong>SI EL LINK NO FUNCIONA INTENTELO UNA SEGUNDA VEZ, EL SERVIDOR A VECES TARDA EN PROCESAR LA PRIMERA ORDEN.</strong><br><br><br>'; 
          
                
        
        $headers = 'From:'.$destino."\r\n".
                    'Reply-To:'.$destino."\r\n".
                    'Content-type: text/html; charset=UTF-8 \r\n'.
                    'X-Mailer:PHP/'.phpversion();
                     
                    
           return mail(utf8_decode($destino), utf8_decode($asunto), utf8_decode($comentario), $headers);
    }
    
 

    /**
    * confirmarEliminarSuscripcion
    *
    * Comprueba que existe la suscripción y en caso afirmativo envia un correo
    * para confirmar la eliminación de la suscripción.
    * 
    */
      public function confirmarEliminarSuscripcion(){
        
        if((isset($_POST["email"]))&& ($_POST["email"]!= '')){
            
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                    echo "email no valido";
                }else{
                if($this->modelo->comprobarUNR($_POST["email"])){

                   $correcto = $this->enviarEmailEliminarSuscribir($_POST["email"]);

                   if(!$correcto){
                       $correcto = "email no enviado";
                   }
                }else{
                    $correcto = false;
                }

                 echo $correcto;
            }
        }else{
            echo "Datos incompletos";
        }
      }
    
      /**
	* eliminarSuscribir
	*
	* Elimina la suscripción del usuario 
        * Redirije a la página principal del usuario no registrado. 
	*
	* @param String $email Email del usuario.
	*/
    public function eliminarSuscribir($email){
         if($this->modelo->EliminarSuscribir($email)){
             header('Location: http://localhost/PFC-WhDIG/WhDIG/UsuarioNoRegistrado');
         }else{
             echo utf8_decode("Error. La suscripción ya fue eliminada anteriormente.");
         }
    }
    
    
    
    /**
    * destruirSesion
    *
    * destruir sesión de usuario.
    */ 
    public function destruirSesion(){
        Sesion::unsetValue('email');
        Sesion::destroy();
    }
    

    }

