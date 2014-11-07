<?php
//require_once './Entidades/EntidadUsuarioNoRegistrado.php';

class UsuarioNR extends Controlador{
    
    function __construct() {
        parent::__construct();
    } 
    
    public function suscribir(){
        
        if((isset($_POST["email"]))&& ($_POST["email"]!= '')){
            $data["email"]= $_POST["email"];
//          $usuarioNR = new UsuarioNR($data);
            $correcto = $this->modelo->suscribir($data);
             echo $correcto;
        }  
    }
    
      public function EliminarSuscribir(){
        
        if((isset($_POST["email"]))&& ($_POST["email"]!= '')){
            $data["email"]= $_POST["email"];
//          $usuarioNR = new UsuarioNR($data);
            $correcto = $this->modelo->EliminarSuscribir($data);
             echo $correcto;
        }  
    }
}

