<?php

class UsuarioAbstracto{
    
    private $email;
    
    public function __construct() {
        
    }

    public function obtenerEmail(){
        return $this->email;
    }
    
    public function cambiarEmail($email){
        $this->email = $email;
    }
    
}


