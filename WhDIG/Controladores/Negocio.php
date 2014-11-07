<?php

class Negocio extends Controlador{
    
    function __construct() {
        parent::__construct();
    }
    
    public function cargarNegocios(){
       return $this->modelo->buscarNegocios();
    }
}

