<?php

class EntidadUsuarioNoRegistrado extends UsuarioAbstracto{
    
    private $estado;
    
  public function __construct($array){
        parent::__construct($array);
       
        $this->estado = $array["Estado"];
    }
    
    /**
    * obtenerEstado
    *
    * Obtiene el Estado del usuarioNR.
    *
    * @return String $estado Estado del usuarioNR
    */
    public function obtenerEstado(){
        return $this->estado;
    }
    
     /**
    * CambiarEstado
    *
    * Modifica el Estado del usuarioNR.
    *
    *@param String $estado Estado del usuarioNR.  
    */
    public function cambiarNombre($estado){
        $this->estado = $estado;
    }
    
}

