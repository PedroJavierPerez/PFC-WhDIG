<?php

class UsuarioAbstracto{
    
    private $email;
    
    public function __construct($array) {
        $this->email = $array["Email"];
    }
    
    /**
    * obtenerEmail
    *
    * Obtiene el email del usuario.
    *
    * @return String $email
    */
    public function obtenerEmail(){
        return $this->email;
    }
    
    /**
    * CambiarEmail
    *
    * Modifica el email del usuario.
    *
    *@param String $email Email del usuario.  
    */
    public function cambiarEmail($email){
        $this->email = $email;
    }
    
}


