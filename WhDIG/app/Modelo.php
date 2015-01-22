<?php

    class Modelo{
        
        //Crea nueva conexión base de datos
        function __construct() {
            $this->db = new ConexionMySQLi(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }

    /**
    * buscarNegocio
    *
    * Obtiene un negocio dado su identificador.
    *
    * @param String $where identificador evento.
    * @param String $completo Indica si el where esta completo o hay que formarlo.
    */   
    function buscarNegocio($where, $completo = false){
        
        if($completo == false){
            return $this->db->select("*","negocio","Id_negocio = '".$where."'");
        }else{
            return $this->db->select("*","negocio",$where);  
        }
    }
    
    /**
    * buscarEventos
    *
    * Obtiene todos los eventos con la fecha mayor o igual a la anterior
    * @return Array<EntidadEvento> Eventos que cumplen la condición.
    */ 
    function buscarEventos(){
        $dateAtual= date("Y-m-d");
        $eventos = $this->db->select("*","evento","Fecha >= '".$dateAtual."' ORDER BY Id_evento DESC");
            if(isset($eventos)){
                foreach ($eventos as $event) {
                    $evento = new EntidadEvento($event);
                    $negocio = $this->buscarNegocio($event["Id_negocio"]);
                    $objetoNegocio = new EntidadNegocio($negocio[0]);
                    $evento->cambiarNegocio($objetoNegocio);
                    $arrayEventos[] = $evento;
                }
                return $arrayEventos;
            }
    }
    
     /**
    * filtrarEventos
    *
    * Obtiene todos los eventos que cumplen las condiciones de filtrado.
    * @param String $where Condición de filtrado. 
    * @return Array<EntidadEvento> Eventos que cumplen la condición de filtrado.
    * @return Boolean false si ningun evento cumple la condición.
    */ 
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
    
     
     /**
    * buscarProvincias
    *
    * Obtiene todas las provincias de la DB.
    * @return Array<String> Nombre de la provincias.
    */ 
    function buscarProvincias(){
        
        return $this->db->select("provincia","provincias");
    }
    
     /**
    * buscarLocalidades
    *
    * Obtiene todas las provincias de la DB.
    * @return Array<String> Nombre de las localidades.
    */
    function buscarLocalidades(){
        
        return $this->db->select("nombre","municipios");
    }
    
     /**
    * buscarLocalidadesProvincia
    *
    * Obtiene todas las localidades pertenecientes a una provincia.
    * @param String $provincia Nombre de la provincia.
    * @return Array<String> Nombre de las localidades.
    */
    function buscarLocalidadesProvincia($provincia){
        
         $idProvincia = $this->db->select("id_provincia","provincias","provincia = '".$provincia."'");
        return $this->db->select("nombre","municipios","id_provincia = '".$idProvincia[0]["id_provincia"]."'");
        
         
     }
    
     /**
    * buscarNegocios
    *
    * Obtiene todos los nombres de los negocios.
    * @return Array<String> Nombre de los negocios.
    */ 
    function buscarNegocios(){
        
        return $this->db->select("Nombre","negocio");
    }
    
     /**
    * buscarEstadisticas
    *
    * Obtiene las estadisticas de un evento.
    * @param int $idEstadisticas Identificador de estadisticas. 
    * @return Array<String> Estadisticas del evento.
    */ 
    function buscarEstadisticas($idEstadisticas){
        
        
       return $this->db->select("*","estadisticas","Id_estadisticas = '".$idEstadisticas."'");
        
    }
    
     /**
    * comprobarEvento
    *
    * Comprueba que existe un evento.
    * @param int $idEvento Identificador evento. 
    * @return Boolean Indica si existe el evento.
    */ 
    function comprobarEvento($idEvento){
        
        
       return $this->db->check("Id_evento","evento","Id_evento = '".$idEvento."'",True);
        
    }
    
      
        
        
    }

