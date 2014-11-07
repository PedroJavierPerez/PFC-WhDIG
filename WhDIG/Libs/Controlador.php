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
    }

