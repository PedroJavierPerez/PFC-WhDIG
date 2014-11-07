<?php

class EntidadDetallesEvento{
    
    private $favorito;
    private $asistir;
    private $evento;
    
    public function nuevoDetallesEvento($favorito = NULL,$asistir = NULL,$evento = NULL){
        $this->favorito = $favorito;
        $this->asistir = $asistir;
        $this->evento = $evento;
       
    }
    
    public function obtenerFavorito(){
        return $this->favorito;
    }
    
    public function cambiarfavorito($favorito){
        $this->favorito = $favorito;
    }
    
   public function obtenerAsistir(){
        return $this->asistir;
    }
    
    public function cambiarAsistir($asistir){
        $this->asistir = $asistir;
    }
    
    public function obtenerEvento(){
        return $this->evento;
    }
    
    public function cambiarEvento($evento){
        $this->evento = $evento;
    }
    
   

}

