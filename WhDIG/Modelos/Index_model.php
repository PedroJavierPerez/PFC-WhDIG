<?php

class Index_model extends Modelo{
    
    public function __construct() {
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
     
    
      function suscribir($unr){
        
      return $this->db->insert("usuario_no_registrado",$unr);
    }
    
    function EliminarSuscribir($unr){
        
      return $this->db->delete("usuario_no_registrado",$unr);
    }
    
    function buscarNegocios(){
        
        return $this->db->select("Nombre","negocio");
    }
}

