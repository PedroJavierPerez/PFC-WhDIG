<?php
require_once ('./Entidades/UsuarioAbstracto.php');
require_once ('./Entidades/EntidadUsuarioRegistrado.php');

class UsuarioRegistrado extends Controlador{
        


        function __construct() {
            parent::__construct();
           
        }
        
        function index(){
            
           
            $this->vista->negocios = $this->modelo->buscarNegocios();
            $this->vista->tipos = array("Noche",'Bares','Pubs','Deporte','Charlas y conferencias',
                                     'Conciertos','Cursos','Espectáculos','Exposiciones','Ferias','Libros',
                                     'Cine','Teatro','Hoteles','Otros');
            $this->vista->localidades = $this->modelo->buscarLocalidades();
            $this->vista->provincias = $this->modelo->buscarProvincias();
            $this->vista->eventos = $this->cargarEventos();
            $this->vista->render($this,'index');
        }
        
        function miCuenta(){
            
            $usuario = $this->modelo->buscarUsuario($_SESSION["email"]);
            $this->vista->usuario = $usuario;
            $this->vista->localidades = $this->modelo->buscarLocalidadesProvincia($usuario->obtenerProvincia());
            $this->vista->provincias = $this->modelo->buscarProvincias();
            
            $this->vista->render($this,'miCuenta');
        }
        
        public function cerrarSesion(){
        Sesion::unsetValue('email');
        Sesion::destroy();
        header("Location:".URL."UsuarioNoRegistrado");
    }

     
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
        
         $correcto = $this->modelo->modificarDatosUsuario($datosUsuario);
         echo $correcto;
    }
    
    public function eliminarCuentaUsuario() {
        
        $usuario["Email"] = $_SESSION["email"];
        $usuario["Contrasena"] = $_POST["pass"];
       
        
            $correcto = $this->modelo->eliminarCuentaUsuario($usuario);
            
            echo $correcto;
        
        
    }
    
}