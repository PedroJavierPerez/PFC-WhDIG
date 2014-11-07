<?php
require_once './Entidades/EntidadEvento.php';
require_once './Entidades/EntidadNegocio.php';
require_once './Entidades/EntidadEstadisticasEvento.php';

class Evento_model extends Modelo{
    
    function __construct() {
        parent::__construct();
    }
    
    function buscarEventos(){
        $dateAtual= date("Y-m-d");
       $eventos = $this->db->select("*","evento","Fecha >= '".$dateAtual."' ORDER BY Id_evento DESC");
       
       foreach ($eventos as $event) {
       $evento = new EntidadEvento($event);
       $negocio = $this->buscarNegocio($event["Id_negocio"]);
       $objetoNegocio = new EntidadNegocio($negocio[0]);
       $evento->cambiarNegocio($objetoNegocio);
       $arrayEventos[] = $evento;
       }
       return $arrayEventos;
    }
    
    function filtrarEventos($where){
      
       $eventos = $this->db->select("*","evento",$where);
       if(count($eventos)!=0){
       foreach ($eventos as $event) {
       $evento = new EntidadEvento($event);
       $negocio = $this->buscarNegocio($event["Id_negocio"]);
       $objetoNegocio = new EntidadNegocio($negocio[0]);
       $evento->cambiarNegocio($objetoNegocio);
       $arrayEventos[] = $evento;
       }
       
        return $arrayEventos;
       }else{
           return "false";
       }
    }
    
    function buscarNegocio($where, $completo = false){
        
        if($completo == false){
       return $this->db->select("*","negocio","Id_negocio = '".$where."'");
        }else{
          return $this->db->select("*","negocio",$where);  
        }
    }
    
     
    
    function buscarProvincias(){
        
        return $this->db->select("provincia","provincias");
    }
    
     function buscarLocalidades(){
        
        return $this->db->select("nombre","municipios");
    }
    
     function buscarLocalidadesProvincia($provincia){
        
         $idProvincia = $this->db->select("id_provincia","provincias","provincia = '".$provincia."'");
        return $this->db->select("nombre","municipios","id_provincia = '".$idProvincia[0]["id_provincia"]."'");
        
         
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

