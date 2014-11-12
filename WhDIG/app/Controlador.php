<?php

    class Controlador{

        function __construct() {
            $this->vista = new Vista();
            $this->loadModel();
        }
        
        function loadModel(){
            $modelo = get_class($this).'_model';
            $dir = 'modelos/'.$modelo.'.php';
            
            if(file_exists($dir)){
                require_once $dir;
                $this->modelo = new $modelo();
            }
        }
        
       public function cambiarFechaHora($eventos){
        
         foreach ($eventos as $evento) {         
         
            $evento->cambiarFecha($this->formatoFecha($evento->obtenerFecha()));
            $evento->cambiarHora($this->formatoHora($evento->obtenerHora()));
        }
        return $eventos;
    }
       public function formatoFecha($fecha){
        
         $fecha_date=date_create($fecha);
         return date_format($fecha_date, 'd-m-Y');
    }
    
    public function formatoHora($hora){
        $hora_time = date_create($hora);
        return date_format($hora_time, 'G:i');
    }
    }

