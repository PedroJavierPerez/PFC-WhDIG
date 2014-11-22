<?php

class EntidadComentario{
    
    private $identificador;
    private $texto;
    private $aceptado;
    private $id_respuesta;
    private $evento;
    private $usuario;

    public function __construct($array) {
        
        $this->identificador = $array["Id_comentario"];
        $this->texto = $array["Texto"];
        $this->aceptado = $array["Aceptado"];
        $this->id_respuesta = $array["Id_respuesta"];
        $this->evento = NULL;
        $this->usuario = NULL;
      
    }
    
    public function obtenerIdentificador(){
        return $this->identificador;
    }
    
    
    public function obtenerTexto(){
        return $this->texto;
    }
    
    public function cambiarTexto($texto){
        $this->texto = $texto;
    }
    
    public function obtenerAceptado(){
        return $this->aceptado;
    }
    
    public function cambiarAceptado($aceptado){
        $this->aceptado = $aceptado;
    }
    
    public function obtenerIdRespuesta(){
        return $this->id_respuesta;
    }
    
    public function cambiarIdRespuesta($id_respuesta){
        $this->id_respuesta = $id_respuesta;
    }
    
    public function obtenerEvento(){
        return $this->evento;
    }
    
    public function cambiarEvento($evento){
        $this->evento = $evento;
    }
    
     public function obtenerUsuario(){
        return $this->evento;
    }
    
    public function cambiarUsuario($evento){
        $this->evento = $evento;
    }
}

