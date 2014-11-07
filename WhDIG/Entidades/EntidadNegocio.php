<?php

class EntidadNegocio{
    
    private $identificador;
    private $nombre;
    private $localidad;
    private $direccion;
    private $codigoPostal;
    private $provincia;
    private $telefono;
    private $propietario;
    
    public function __construct($array){
        $this->identificador = $array["Id_negocio"];
        $this->nombre = $array["Nombre"];
        $this->localidad = $array["Localidad"];
        $this->direccion = $array["Calle"].", ".$array["Numero"];
        $this->codigoPostal = $array["CodigoPostal"];
        $this->provincia = $array["Provincia"];
        $this->telefono = $array["Telefono"];
        $this->propietario = NULL;
    }

    public function obtenerIdentificador(){
        return $this->identificador;
    }
    
    
     public function obtenerNombre(){
        return $this->nombre;
    }
    
    public function cambiarNombre($nombre){
        $this->nombre = $nombre;
    }
    
     public function obtenerLocalidad(){
        return $this->localidad;
    }
    
    public function cambiarLocalidad($localidad){
        $this->localidad = $localidad;
    }
    
     public function obtenerDireccion(){
        return $this->direccion;
    }
    
    public function cambiarDireccion($direccion){
        $this->direccion = $direccion;
    }
    
     public function obtenerCodigoPostal(){
        return $this->codigoPostal;
    }
    
    public function cambiarCodigoPostal($codigoPostal){
        $this->codigoPostal = $codigoPostal;
    }
    
     public function obtenerProvincia(){
        return $this->provincia;
    }
    
    public function cambiarProvincia($provincia){
        $this->provincia = $provincia;
    }
    
     public function obtenerTelefono(){
        return $this->telefono;
    }
    
    public function cambiarTelefono($telefono){
        $this->telefono = $telefono;
    }
    
     public function obtenerPropietario(){
        return $this->propietario;
    }
    
    public function cambiarPropietario($propietario){
        $this->propietario = $propietario;
    }
}

