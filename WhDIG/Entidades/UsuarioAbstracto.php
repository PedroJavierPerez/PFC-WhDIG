<?php

class UsuarioAbstracto{
    
    private $email;
    
    public function __construct($array) {
        $this->email = $array["Email"];
    }

    public function obtenerEmail(){
        return $this->email;
    }
    
    public function cambiarEmail($email){
        $this->email = $email;
    }
    
}


