<?php
require_once ('./Modelos/UsuarioRegistrado_model.php');

class Administrador_model extends UsuarioRegistrado_model{
    
    public function __construct() {
        parent::__construct();
    }

       /**
    * cargarNegociosSinAlta
    *
    * Obtiene los negocios que no han sido dados de alta.
    *
    * @return Array<EntidadNegocio> Negocios.
    */
      public function cargarNegociosSinAlta() {
         
         $negocios = $this->db->select("*","negocio","EstadoAlta = 0");
           if(isset($negocios)) {
               foreach ($negocios as $negocio) {
                   $propietario =  $this->buscarUsuario($negocio["Email"]);
                       if(isset($propietario)){
                           $objetosNegocio[] = $this->crearObjetoNegocio($negocio);
                       }
               }
               return $objetosNegocio;
           }     
     }
     
     
     /**
    * modificarAceptarEstadoAltaNegocio
    *
    * Modifica el estado de alta del negocio a aceptado.
    *
    * @param String $idNegocio identificador del negocio.
    * @return Boolean Indica si se modificó correctamente el alta del negocio.
    */
    public function modificarAceptarEstadoAltaNegocio($idNegocio){
        
        $altaNegocio["EstadoAlta"] = 1;
       return $this->db->update("negocio",$altaNegocio,"Id_negocio = '".$idNegocio."'");
        
    }
     
      /**
    * modificarRechazarEstadoAltaNegocio
    *
    * Elimina el negocio que se ha rechazado.
    *
    * @param String $idNegocio identificador del negocio.
    * @return Boolean Indica si se elimino correctamente el negocio.
    */
     public function modificarRechazarEstadoAltaNegocio($idNegocio) {
        
        $where = "Id_negocio = '".$idNegocio."'";
        return $this->db->delete("negocio",$where,True);
        
    }
     
     /**
    * modificarEstadoAltaNegocioEnEspera
    *
    * Modifica el estado de alta del negocio a en espera.
    *
    * @param String $idNegocio identificador del negocio.
    * @return Boolean Indica si se modificó correctamente el estado del negocio.
    */
    public function modificarEstadoAltaNegocioEnEspera($idNegocio){
        
        $altaNegocio["EstadoAlta"] = 0;
       return $this->db->update("negocio",$altaNegocio,"Id_negocio = '".$idNegocio."'");
        
    }
    
    
}