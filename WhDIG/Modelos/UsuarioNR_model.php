<?php

class UsuarioNR_model extends Modelo{
    
    function __construct() {
        parent::__construct();
    }
    
    function suscribir($unr){
        
      return $this->db->insert("usuario_no_registrado",$unr);
    }
    
    function EliminarSuscribir($unr){
        
      return $this->db->delete("usuario_no_registrado",$unr);
    }
}

