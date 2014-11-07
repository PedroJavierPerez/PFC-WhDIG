<?php

class EntidadComentario{
    
    private $identificador;
    private $texto;
    private $aceptado;
    private $id_respuesta;
    private $evento;

    public function nuevoComentario($id = NULL,$texto = NULL,$aceptado = NULL,$id_rep = NULL,$evento = NULL){
        $this->identificador = $id;
        $this->texto = $texto;
        $this->aceptado = $aceptado;
        $this->identificador = $id_rep;
        $this->evento = $evento;
      
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
}

