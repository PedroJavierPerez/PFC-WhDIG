<?php
require_once './Entidades/EntidadEstadisticasEvento.php';


class UsuarioNoRegistrado_model extends Modelo{
    
    public function __construct() {
        parent::__construct();
    }
    
    
     
    
      function suscribir($unr){
        
      return $this->db->insert("usuario_no_registrado",$unr);
    }
    
    function EliminarSuscribir($unr){
        
      return $this->db->delete("usuario_no_registrado","Email = '".$unr."'",True);
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
     
     
    
   
    
    function comprobarUNR($email){
        
        
       return $this->db->check("Email","usuario_no_registrado","Email = '".$email."'",True);
        
    }
    
    public function guardarDatosNuevoUsuario($datosUsuario){
        
        return $this->db->insert("usuario",$datosUsuario);
        
    }
    
  public function comprobarUsuario($usuario,$completo = False){
        
        if($completo){
            
        $where= "Email = '".$usuario["Email"]."' AND Contrasena = '".$usuario["Contrasena"]."'";
       return $this->db->check("Email","usuario",$where,True);
       
        }else{
           return $this->db->check("Email","usuario",$usuario); 
        }
    }
            
}

