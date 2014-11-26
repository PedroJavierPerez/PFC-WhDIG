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
            $this->vista->eventosHoy = $this->cargarEventosAsistir($_SESSION["email"],true);
            $this->vista->render($this,'index');
        }
        
        function miCuenta(){
            
            $usuario = $this->modelo->buscarUsuario($_SESSION["email"]);
            $this->vista->usuario = $usuario;
            $this->vista->localidades = $this->modelo->buscarLocalidadesProvincia($usuario->obtenerProvincia());
            $this->vista->provincias = $this->modelo->buscarProvincias();
            
            $this->vista->render($this,'miCuenta');
        }
        
        public function detallesEvento($id){
        $encontrado = $this->modelo->comprobarEvento($id);
        if($encontrado){
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
        
        
         function asistenciaEventos(){
            
            $this->vista->eventosAsistir = $this->cargarEventosAsistir($_SESSION["email"]);
            
            $this->vista->render($this,'asistenciaEventos');
        }
        
        
        
        public function cerrarSesion(){
        Sesion::unsetValue('email');
        Sesion::destroy();
        header("Location:".URL."UsuarioNoRegistrado");
    }

    public function cargarEventosHoy(){
        
        $eventoHoy = $this->modelo->buscarEventosHoy();
        
        return $this->cambiarFechaHora($eventoHoy);
        
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
    
    public function eliminarFavorito() {
        
        $usuarioEvento["Email"] = $_SESSION["email"];
        $usuarioEvento["Id_evento"] = $_POST["idEvento"];
        $usuarioEvento["Favorito"] = 0;
        $correcto = $this->modelo->modificarFavorito($usuarioEvento);
        echo $correcto;
    }
    
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
    
        public function eliminarAsistencia() {
        
        $usuarioEvento["Email"] = $_SESSION["email"];
        $usuarioEvento["Id_evento"] = $_POST["idEvento"];
        $usuarioEvento["Asistir"] = 0;
        $correcto = $this->modelo->modificarAsistencia($usuarioEvento);
        $correcto2 =$this->restarEstadisticasEvento($usuarioEvento);
        echo $correcto;
        
        
    }
    
        public function comprobarUsuarioEvento($usuarioEvento) {
    
            return $this->modelo->comprobarUsuarioEvento($usuarioEvento);
        }
        
        
        public function guardarComentario() {
        
        $datosComentario["Email"] = $_SESSION["email"];
        $datosComentario["Id_evento"] = $_POST["idEvento"];
        $datosComentario["Texto"] = $_POST["texto"];
        
        
        $correcto = $this->modelo->incluirNuevoComentario($datosComentario); 
        echo $correcto;
        
    } 
    
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
}

