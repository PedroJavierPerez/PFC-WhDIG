<?php
require_once './Entidades/EntidadNegocio.php';
require_once './Entidades/EntidadEvento.php';

    class Index extends Controlador{
        


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
        
        public function cargarEventos(){
        $objetosEvento = $this->modelo->buscarEventos();
        
        $objetosEventoFormateado = $this->cambiarFechaHora($objetosEvento);
                
        return $objetosEventoFormateado;
        
    }
    

    public function cargarLocalidadesProvincias(){
        
        $provincia = $_POST["provincia"];
        
        $localidades = $this->modelo->buscarLocalidadesProvincia($provincia);

        
        echo json_encode($localidades);

    }
    
   
    
    public function filtrarEventos(){
        
        $fechaI = $_POST["fechaI"];
        $fechaF = $_POST["fechaF"];
        $provincia = $_POST["provincia"];
        $municipio = $_POST["municipio"];
        $tipo = $_POST["tipo"];
        $local = $_POST["local"];


        $fechaActual = date("Y-m-d");
        $consulta = "Fecha >= '".$fechaActual."'";

        $consulta2 = "1";

        if(($fechaI != NULL)&&($fechaF != NULL)){
            $fechaActual = date("Y-m-d");
            if($fechaI < $fechaActual){
                $fechaI = $fechaActual;
            }
            $consulta.=" AND (Fecha BETWEEN '".$fechaI."' AND '" .$fechaF."')";
        }else{
            If($fechaI != NULL){
                $fechaActual = date("Y-m-d");
                if($fechaI < $fechaActual){
                  $fechaI = $fechaActual;
                }
                $fechaAux = "2099-12-31";
                $consulta.=" AND (Fecha BETWEEN '".$fechaI."' AND '" .$fechaAux."')";
            }else{
                If($fechaF != NULL){
                    $fechaActual = date("Y-m-d");
                    $consulta.=" AND (Fecha BETWEEN '".$fechaActual."' AND '" .$fechaF."')";
                }
            }
        }
        If($provincia != NULL){
            $consulta2.=" AND Provincia = '".$provincia."'";
        }

        If($municipio != NULL){
            $consulta2.=" AND Localidad = '".$municipio."'";
        }

        If($tipo != NULL){
            $consulta.=" AND Tipo = '".$tipo."'";
        }

        If($local != NULL){
            $consulta2.=" AND Nombre = '".$local."'";
        }

        if(($provincia != NULL)||($municipio != NULL)||($local != NULL)){
            $bandera = false;
            $negocios = $this->modelo->buscarNegocio($consulta2,true);
            if(count($negocios)!=0){
            foreach ($negocios as $negocio) {
               $idnegocio = $negocio["Id_negocio"];
               $consulta.=" AND Id_negocio = '".$idnegocio."' ORDER BY Id_evento DESC";
               $eventos = $this->modelo->filtrarEventos($consulta);
               if($eventos!= "false"){
                   $bandera = true;
               foreach ($eventos as $evento) {
                $arrayObjetosEvento[] = $evento;
               }
               }else{
                   echo json_encode($eventos);
               }
            }
            if($bandera){
             $objetosEventoFormateado = $this->cambiarFechaHora($arrayObjetosEvento);
             $eventosJSON = $this->pasarJSON($objetosEventoFormateado);
                echo $eventosJSON;
            }
            }else{
                echo json_encode("false");
            }
        }else{
            $consulta.=" ORDER BY Id_evento DESC";
            $eventos = $this->modelo->filtrarEventos($consulta);
            if($eventos!= "false"){
            $objetosEventoFormateado = $this->cambiarFechaHora($eventos);
             $eventosJSON = $this->pasarJSON($objetosEventoFormateado);
             echo $eventosJSON;
            }else{
               echo json_encode($eventos);
            }
        }
    }

   

    public function pasarJSON($objetosEvento){

     foreach ($objetosEvento as $evento) {         
        $eventos = new stdClass();
        $eventos->nombre = $evento->obtenerNombre();
        $eventos->id = $evento->obtenerIdentificador();
        $eventos->descripcion = $evento->obtenerDescripcion();
        $eventos->hora = $evento->obtenerHora();
        $eventos->fecha = $evento->obtenerFecha();
        $negocio = $evento->obtenerNegocio();
        $eventos->provincia = $negocio->obtenerProvincia();
        $eventosJSON[] = $eventos;
    }
    return json_encode($eventosJSON);
    
    }
    
    
    public function suscribir(){
        
        if((isset($_POST["email"]))&& ($_POST["email"]!= '')){
            $data["email"]= $_POST["email"];

            $correcto = $this->modelo->suscribir($data);
             echo $correcto;
        }  
    }
    
      public function EliminarSuscribir(){
        
        if((isset($_POST["email"]))&& ($_POST["email"]!= '')){
            $data["email"]= $_POST["email"];

            $correcto = $this->modelo->EliminarSuscribir($data);
             echo $correcto;
        }  
    }
    

    }

