<?php

class Negocio_model extends Modelo{
    
    function __construct() {
        parent::__construct();
    }
    
    function buscarNegocios(){
        
        return $this->db->select("Nombre","negocio");
    }
}

