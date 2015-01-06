<?php
require_once './Entidades/EntidadNegocio.php';
require_once './Entidades/EntidadEvento.php';

    class UsuarioNoRegistrado extends Controlador{
        


        function __construct() {
            parent::__construct();
           
        }
        
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
        
        public function registrarse(){
            
            $this->vista->localidades = $this->modelo->buscarLocalidades();
            $this->vista->provincias = $this->modelo->buscarProvincias();
            $this->vista->render($this,'registrarse');
            
        }
        
        public function olvidarContrasena(){
            
            
            $this->vista->render($this,'olvidarContrasena');
            
        }


        public function cargarDetallesEvento($id){
        
        $objetoEvento = $this->modelo->buscarDetallesEvento($id);
        
        $objetoEventoFormateado = $this->cambiarFechaHora($objetoEvento);
                
        return $objetoEventoFormateado[0];
    }
        
    
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
        $datosUsuario["Propietario"]= 0;
        
         if(!filter_var($datosUsuario["Email"], FILTER_VALIDATE_EMAIL))
              {
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
            $this->iniciarSesion($correcto,$datosUsuario["Email"]);
            echo $correcto;
          }else{
              echo "Error de acceso al servidor";
          }
              }
              }
    }
    
    
    public function suscribir(){
        
        if((isset($_POST["email"]))&& ($_POST["email"]!= '')){
            $data["email"]= $_POST["email"];
            
            if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL))
              {
              echo "email no valido";
              }else{
            $correcto = $this->modelo->suscribir($data);
             echo $correcto;
              }
        }  
    }
    
      public function EliminarSuscribir(){
        
        if((isset($_POST["email"]))&& ($_POST["email"]!= '')){

            $correcto = $this->modelo->EliminarSuscribir($_POST["email"]);
             echo $correcto;
        }  
    }
    
    public function autenticar(){
        $usuario["Email"] = $_POST["email"];
        $usuario["Contrasena"] = $_POST["pass"];
        
        $correcto = $this->modelo->comprobarUsuario($usuario,True);
        $this->iniciarSesion($correcto, $usuario["Email"]);
        echo $correcto;
    }


    public function iniciarSesion($registrado,$usuario){
        
        if($registrado){
            Sesion::init();
            if(!Sesion::exist()){ 
                Sesion::setValue('email', $usuario);
           } 
        }
        
    }
    
    public function destruirSesion(){
        Sesion::unsetValue('email');
        Sesion::destroy();
    }
    

    }

