<?php
require_once ('./Controladores/UsuarioRegistrado.php');

class Administrador extends UsuarioRegistrado{
    
    
    function __construct() {
            parent::__construct();
           
        }
        
    /**
    * index
    *
    * Renderiza la vista principal del administrador e inicializa
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
    
    /**
	* enviarCorreoInformativo
	*
	* Envia email al propietario.
	*/
    function enviarCorreoInformativo(){
        $destino = $_POST["email"];
        $asunto = $_POST["asunto"]." [WhDIG]";
        $comentario = $_POST["texto"];
        
        if(isset($asunto)&&($asunto!==' [WhDIG]')&&isset($comentario)&&($comentario!=='')){
        
            $headers = 'From:'.$destino."\r\n".
                        'Reply-To:'.$destino."\r\n".
                        'Content-type: text/html; charset=UTF-8 \r\n'.
                        'X-Mailer:PHP/'.phpversion();

            $correcto = mail(utf8_decode($destino), utf8_decode($asunto), utf8_decode($comentario), $headers);
            echo $correcto;
    
        }else{
            echo "Datos incompletos";
        }
    }

}