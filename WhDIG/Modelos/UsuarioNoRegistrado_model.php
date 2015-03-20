<?php
require_once './Entidades/EntidadEstadisticasEvento.php';


class UsuarioNoRegistrado_model extends ModeloUsuario{
    
    public function __construct() {
        parent::__construct();
    }
    
    
     
    /**
    * suscribir
    *
    * Realiza la nueva suscripción
    *
    * @param String $unr Email del usuario no registrado.
    * @return Boolean Indica si la suscripción se realizó correctamente.
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
    * @return Boolean Indica si el UNR se modifico correctamente.
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
    * @return Boolean Indica si la suscripción se borro correctamente.
    */
    function EliminarSuscribir($unr){
        
      return $this->db->delete("usuario_no_registrado","Email = '".$unr."'",True);
    }
    
    
    
    /**
    * buscarDetallesEvento
    *
    * Busca los detalles de un evento concreto.
    *
    * @param int $id Identificador del evento a buscar.
    * @return Array<EntidadEvento> Objetos evento.
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
    * @return Boolean Indica si existe el usuario no registrado.
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
    * @return Boolean Indica si el usuario se inserto correctamente.
    */
    public function guardarDatosNuevoUsuario($datosUsuario){
        
        return $this->db->insert("usuario",$datosUsuario);
        
    }
     
    /**
    * comprobarUNRactivo
    *
    * Comprueba que la suscripción del usuario no registrado esta activa.
    *
    * @param String $email Email del usuario.
    * @return Boolean Indica si la suscripción esta activa.
    */
    public function comprobarUNRactivo($email){
        
        $where = "Email = '".$email."' AND Estado = 1";
        return $this->db->check("Email","usuario_no_registrado",$where,True);
        
    }
}

