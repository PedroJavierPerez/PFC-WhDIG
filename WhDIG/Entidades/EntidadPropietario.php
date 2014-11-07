<?php

class EntidadPropietario extends EntidadUsuarioRegistrado{
    
    private $negocios;
    
    public function nuevoPropietario($email = NULL,$nombre = NULL,$localidad = NULL,$genero = NULL,$contrasena = NULL, $provincia = NULL,$detalles = NULL,$recibirInformacion = NULL,$comentarios = NULL,$fechaNacimiento = NULL,$negocios = NULL){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->localidad = $localidad;
        $this->genero = $genero;
        $this->contrasena = $contrasena;
        $this->provincia = $provincia;
        $this->detallesEvento = $detalles;
        $this->recibirInformacion = $recibirInformacion;
        $this->comentarios = $comentarios;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->negocios = $negocios;
    }
    
    public function obtenerNegocios(){
        return $this->negocios;
    }
    
    public function cambiarNegocios($negocios){
        $this->negocios = $negocios;
    }

}

