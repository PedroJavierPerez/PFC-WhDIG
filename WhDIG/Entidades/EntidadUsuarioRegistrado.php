<?php

class EntidadUsuarioRegistrado extends UsuarioAbstracto{
    
    private $nombre;
    private $contrasena;
    private $genero;
    private $fechaNacimiento;
    private $provincia;
    private $localidad;
    private $recibirInformacion;
    private $detallesEvento;
    private $comentarios;

    public function nuevoUsuarioRegistrado($email = NULL,$nombre = NULL,$localidad = NULL,$genero = NULL,$contrasena = NULL, $provincia = NULL,$detalles = NULL,$recibirInformacion = NULL,$comentarios = NULL,$fechaNacimiento = NULL){
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
    }
    
    public function obtenerNombre(){
        return $this->nombre;
    }
    
    public function cambiarNombre($email){
        $this->nombre = $nombre;
    }
    
    public function obtenerContrasena(){
        return $this->contrasena;
    }
    
    public function cambiarContrasena($contrasena){
        $this->contrasena = $contrasena;
    }
    
    public function obtenerGenero(){
        return $this->genero;
    }
    
    public function cambiarGenero($genero){
        $this->genero = $genero;
    }
    
    public function obtenerFechaNacimiento(){
        return $this->fechaNacimiento;
    }
    
    public function cambiarFechaNacimiento($fecha){
        $this->fechaNacimiento = $fecha;
    }
    
    public function obtenerProvincia(){
        return $this->provincia;
    }
    
    public function cambiarProvincia($provincia){
        $this->provincia = $provincia;
    }
    
    public function obtenerLocalidad(){
        return $this->localidad;
    }
    
    public function cambiarLocalidad($localidad){
        $this->localidad = $localidad;
    }
    
    public function obtenerRecibirInformacion(){
        return $this->recibirInformacion;
    }
    
    public function cambiarRecibirInformacion($recibirInformacion){
        $this->recibirInformacion = $recibirInformacion;
    }
    
    public function obtenerDetallesEvento(){
        return $this->detallesEvento;
    }
    
    public function cambiarDetallesEvento($detalles){
        $this->detallesEvento = $detalles;
    }
    
    public function obtenerComentarios(){
        return $this->comentarios;
    }
    
    public function cambiarComentarios($comentarios){
        $this->comentarios = $comentarios;
    }
}

