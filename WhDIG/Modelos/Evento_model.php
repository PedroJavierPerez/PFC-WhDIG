<?php
require_once './Entidades/EntidadEvento.php';
require_once './Entidades/EntidadNegocio.php';
require_once './Entidades/EntidadEstadisticasEvento.php';

class Evento_model extends Modelo{
    
    function __construct() {
        parent::__construct();
    }
    
     
     public function buscarDetallesEvento($id){
         
         $evento = $this->db->select("*","evento","Id_evento = '".$id."' ORDER BY Id_evento DESC");
       
      
       $objetoEvento = new EntidadEvento($evento[0]);
       $negocio = $this->buscarNegocio($evento[0]["Id_negocio"]);
       $estadisticas = $this->buscarEstadisticas($evento[0]["Id_estadisticas"]);
       $objetoEstadistica = new EntidadEstadisticasEvento($estadisticas[0]);
       $objetoNegocio = new EntidadNegocio($negocio[0]);
       $objetoEvento->cambiarNegocio($objetoNegocio);
       $objetoEvento->cambiarEstadisticas($objetoEstadistica);
       $objetosEvento[]=$objetoEvento;
       
       return $objetosEvento;
     }
     
     function buscarEstadisticas($idEstadisticas){
        
        
       return $this->db->select("*","estadisticas","Id_estadisticas = '".$idEstadisticas."'");
        
    }
    
    function comprobarEvento($idEvento){
        
        
       return $this->db->check("Id_evento","evento","Id_evento = '".$idEvento."'",True);
        
    }
    

    
}

