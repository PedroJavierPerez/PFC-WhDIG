<?php

    class Modelo{
        
        function __construct() {
            $this->db = new ConexionMySQLi(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }

        
          function buscarNegocio($where, $completo = false){
        
        if($completo == false){
       return $this->db->select("*","negocio","Id_negocio = '".$where."'");
        }else{
          return $this->db->select("*","negocio",$where);  
        }
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
     
     function buscarNegocios(){
        
        return $this->db->select("Nombre","negocio");
    }
    
    function buscarEstadisticas($idEstadisticas){
        
        
       return $this->db->select("*","estadisticas","Id_estadisticas = '".$idEstadisticas."'");
        
    }
    
     function comprobarEvento($idEvento){
        
        
       return $this->db->check("Id_evento","evento","Id_evento = '".$idEvento."'",True);
        
    }
    
      
        
        
    }

