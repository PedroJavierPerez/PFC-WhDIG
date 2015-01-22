<?php

class EntidadPropietario extends EntidadUsuarioRegistrado{
    
    private $negocios;
    
    public function __construct($array){
        
        parent::__construct($array);
        $this->negocios = $array["negocios"];
    }
    
     /**
    * obtenerNegocios
    *
    * Obtiene los negocios pertenecientes al propietario.
    *
    * @return Array<EntidadNegocio> $negocios
    */
    public function obtenerNegocios(){
        return $this->negocios;
    }
    
    /**
    * CambiarNegocios
    *
    * Modifica los negocios pertenecientes al propietario.
    *
    *@param Array<EntidadNegocio> $negocios Negocios del propietario.  
    */
    public function cambiarNegocios($negocios){
        $this->negocios = $negocios;
    }

}

