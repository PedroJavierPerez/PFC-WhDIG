<?php
require_once './Entidades/EntidadNegocio.php';
require_once './Entidades/EntidadEvento.php';


    class Controlador{

        function __construct() {
            Sesion::init();
            $this->vista = new Vista();
            $this->loadModel();
        }
        
        /**
    * loadModel
    *
    * Carga el modelo con el mismo nombre que el controlador + _model.
    */
    function loadModel(){
        $modelo = get_class($this).'_model';
        $dir = 'modelos/'.$modelo.'.php';

        if(file_exists($dir)){
            require_once $dir;
            $this->modelo = new $modelo();
        }
    }
    
    /**
    * cambiarFechaHora
    *
    * Formatea la fecha y hora de los eventos.
    *
    * @param Array<EntidadEvento> $eventos Eventos para cambiar fecha y hora.
    * @return Array<EntidadEvento> Eventos con la fecha y hora formateadas.
    */
    public function cambiarFechaHora($eventos){
        
       if(isset($eventos)){
            foreach ($eventos as $evento) {         

                $evento->cambiarFecha($this->formatoFecha($evento->obtenerFecha()));
                $evento->cambiarHora($this->formatoHora($evento->obtenerHora()));
            }
         return $eventos;
       }
    }
    
    /**
    * formatoFecha
    *
    * Formatea la fecha del evento d-m-Y.
    *
    * @param String $fecha Fecha del evento.
    * @return Date Fecha formateada.
    */
    public function formatoFecha($fecha){
        
         $fecha_date=date_create($fecha);
         return date_format($fecha_date, 'd-m-Y');
    }
    
    /**
    * formatoHora
    *
    * Formatea la hora del evento 00:00.
    *
    * @param String $hora Hora del evento.
    * @return Date Hora formateada..
    */
    public function formatoHora($hora){
        $hora_time = date_create($hora);
        return date_format($hora_time, 'G:i');
    }
    
    /**
    * cargarEventos
    *
    * Se comunica con el modelo para obtener todos los eventos con fecha => que la actual.
    *
    * @return Array<EntidadEvento> Eventos con fecha y hora formateados.
    */
    public function cargarEventos(){
        $objetosEvento = $this->modelo->buscarEventos();
        
        $objetosEventoFormateado = $this->cambiarFechaHora($objetosEvento);
                
        return $objetosEventoFormateado;
        
    }
    
    /**
    * cargarLocalidadesProvincias
    *
    * Obtiene la provincia y se comunica con el modelo para obtener las localidades de esta.
    * Pasa las localidades a la vista en JSON.
    */
    public function cargarLocalidadesProvincias(){
        
        $provincia = $_POST["provincia"];
        
        $localidades = $this->modelo->buscarLocalidadesProvincia($provincia);

       
        echo json_encode($localidades);

    }
    
    /**
    * filtrarEventos
    *
    * Obtiene los datos de filtrado, forma la consulta y busca los eventos que cumplen las condiciones.
    * Pasa los eventos a la vista en JSON.
    */
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

        $consulta = $this->formarConsultaCondicionFechas($consulta, $fechaI, $fechaF);
        $consulta2 = $this->formarConsultaCondicionProvincia($consulta2, $provincia);
        $consulta2 = $this->formarConsultaCondicionMunicipio($consulta2, $municipio);
        $consulta = $this->formarConsultaCondicionTipo($consulta, $tipo);
        $consulta2 = $this->formarConsultaCondicionLocal($consulta2, $local);
        
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
             $eventosJSON = $this->pasarEventosJSON($objetosEventoFormateado);
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
             $eventosJSON = $this->pasarEventosJSON($objetosEventoFormateado);
             echo $eventosJSON;
            }else{
               echo json_encode($eventos);
            }
        }
    }

    /**
    * formarConsultaCondicionFechas
    *
    * Forma la consulta dependiendo de la fecha de inicio y fecha final.
    * @param String $consulta Consulta para completarla.
    * @param String $fechaI Fecha inicio para buscar los eventos.
    * @param String $fechaF Fecha final para buscar los eventos.
    * @return String Consulta
    */
     public function formarConsultaCondicionFechas($consulta,$fechaI,$fechaF){
         
           if(($fechaI != NULL)&&($fechaF != NULL)){
                $fechaActual = date("Y-m-d");
                    if($fechaI < $fechaActual){
                        $fechaI = $fechaActual;
                    }
                $consulta.=" AND (Fecha BETWEEN '".$fechaI."' AND '" .$fechaF."')";
            }else{
                If($fechaI != NULL){
                    $consulta = $this->formarConsultaCondicionFechaInicio($consulta, $fechaI);   
                }else{
                    If($fechaF != NULL){
                        $consulta = $this->formarConsultaCondicionFechaFinal($consulta, $fechaF);     
                    }
                }
            }
            return $consulta;
     }
     
     /**
    * formarConsultaCondicionFechaInicio
    *
    * Forma la consulta dependiendo de la fecha de inicio.
    * @param String $consulta Consulta para completarla.
    * @param String $fechaI Fecha inicio para buscar los eventos.
    * @return String Consulta
    */
     public function formarConsultaCondicionFechaInicio($consulta,$fechaI){
          $fechaActual = date("Y-m-d");
                if($fechaI < $fechaActual){
                  $fechaI = $fechaActual;
                }
            $fechaAux = "2099-12-31";
            $consulta.=" AND (Fecha BETWEEN '".$fechaI."' AND '" .$fechaAux."')";
         
          return $consulta;
     }
     
      /**
    * formarConsultaCondicionFechaFinal
    *
    * Forma la consulta dependiendo de la fecha de fin.
    * @param String $consulta Consulta para completarla.
    * @param String $fechaF Fecha final para buscar los eventos.
    * @return String Consulta
    */
     public function formarConsultaCondicionFechaFinal($consulta,$fechaF){
           $fechaActual = date("Y-m-d");
           $consulta.=" AND (Fecha BETWEEN '".$fechaActual."' AND '" .$fechaF."')";
           
           return $consulta;
     }
     
      /**
    * formarConsultaCondicionProvincia
    *
    * Forma la consulta dependiendo de la provincia.
    * @param String $consulta2 Consulta para completarla.
    * @param String $provincia Provincia donde se realiza el evento
    * @return String Consulta
    */
     public function formarConsultaCondicionProvincia($consulta2,$provincia){
         
         If($provincia != NULL){
            $consulta2.=" AND Provincia = '".$provincia."'";
        }

        return $consulta2;
     }
     
      /**
    * formarConsultaCondicionMunicipio
    *
    * Forma la consulta dependiendo del municipio.
    * @param String $consulta2 Consulta para completarla.
    * @param String $municipio Municipio donde se realiza el evento
    * @return String Consulta
    */
     public function formarConsultaCondicionMunicipio($consulta2,$municipio){
         
         If($municipio != NULL){
            $consulta2.=" AND Localidad = '".$municipio."'";
        }

        return $consulta2;
     }
     
      /**
    * formarConsultaCondicionLocal
    *
    * Forma la consulta dependiendo del local.
    * @param String $consulta2 Consulta para completarla.
    * @param String $local Local del evento
    * @return String Consulta
    */
     public function formarConsultaCondicionLocal($consulta2,$local){

        If($local != NULL){
            $consulta2.=" AND Nombre = '".$local."'";
        }
        return $consulta2;
     }
     
      /**
    * formarConsultaCondicionTipo
    *
    * Forma la consulta dependiendo del tipo.
    * @param String $consulta Consulta para completarla.
    * @param String $tipo Tipo del evento
    * @return String Consulta
    */
     public function formarConsultaCondicionTipo($consulta,$tipo){
         
          If($tipo != NULL){
            $consulta.=" AND Tipo = '".$tipo."'";
        }
        return $consulta;
     }
    
   /**
    * cargarDetallesEvento
    *
    * Se comunica con el modelo para obtener los detalles de un evento dado su identificador.
    * @param int $id Identificador del evento.
    * @return EntidadEvento Evento con fecha y hora formateados.
    */ 
   public function cargarDetallesEvento($id){
        
        $objetoEvento = $this->modelo->buscarDetallesEvento($id);
        
        $objetoEventoFormateado = $this->cambiarFechaHora($objetoEvento);
                
        return $objetoEventoFormateado[0];
    }

    /**
    * pasarEventosJSON
    *
    * Transforma los objetos a JSON.
    * @param Array<EntidadEvento> $objetosEvento Objetos evento.
    * @return Array<JSON> Eventos en JSON.
    */
    public function pasarEventosJSON($objetosEvento){

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
    
    
}

