<?php

class EntidadUsuarioNoRegistrado extends UsuarioAbstracto{
    
  public function __construct($array){
        $this->email = $array["email"];
       
    }
    
}

