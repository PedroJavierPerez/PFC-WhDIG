<?php
require_once './Entidades/EntidadEstadisticasEvento.php';


class UsuarioNoRegistrado_model extends Modelo{
    
    public function __construct() {
        parent::__construct();
    }
    
    
     
    /**
    * suscribir
    *
    * Realiza la nueva suscripción
    *
    * @param String $unr Email del usuario no registrado.
    */
    function suscribir($unr){
        
      return $this->db->insert("usuario_no_registrado",$unr);
    }
    
    /**
    * editarUNR
    *
    * Edita el usuario no reguistrado poniendo su estado a 1.
    *
    * @param String $unr estado = 1.
    * @param String $email Email del usuario no registrado.
    */
    function editarUNR($unr, $email){
        
      return $this->db->update("usuario_no_registrado",$unr,"Email = '".$email."'");
    }
    
    /**
    * EliminarSuscribir
    *
    * Elimina la suscripción.
    *
    * @param String $unr email del usuario no registrado.
    */
    function EliminarSuscribir($unr){
        
      return $this->db->delete("usuario_no_registrado","Email = '".$unr."'",True);
    }
    
    
    
    /**
    * buscarDetallesEvento
    *
    * Busca los detalles de un evento concreto.
    *
    * @param int $id Identificador del email a buscar.
    */
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
     
     
    /**
    * comprobarUNR
    *
    * Comprueba la suscripcion de un usuario pasando su email.
    *
    * @param String $email Email del usuario.
    */
    function comprobarUNR($email){
        
        
       return $this->db->check("Email","usuario_no_registrado","Email = '".$email."'",True);
        
    }
    
    /**
    * guardarDatosNuevoUsuario
    *
    * Guarda los datos del nuevo usuario.
    *
    * @param Array<String> $datosUsuario Datos del nuevo usuario.
    */
    public function guardarDatosNuevoUsuario($datosUsuario){
        
        return $this->db->insert("usuario",$datosUsuario);
        
    }
    
    /**
    * comprobarUsuario
    *
    * Comprueba que esiste un usuario registrado con un email y contraseña.
    *
    * @param Array<String> $usuario email y contraseña del usuario.
    * @param Boolean $completo Indica si se pasara $usuario como arreglo o se formara el String de condición.
    */
    public function comprobarUsuario($usuario,$completo = False){
        
        if($completo){
            
            $where= "Email = '".$usuario["Email"]."' AND Contrasena = '".$usuario["Contrasena"]."'";
            return $this->db->check("Email","usuario",$where,True);
       
        }else{
           return $this->db->check("Email","usuario",$usuario); 
        }
    }
            
}

