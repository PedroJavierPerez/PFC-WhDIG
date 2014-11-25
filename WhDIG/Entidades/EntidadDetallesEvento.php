<?php

class EntidadDetallesEvento{
    
    private $favorito;
    private $asistir;
    private $usuario;


    public function __construct($array){
        $this->favorito = $array["Favorito"];
        $this->asistir = $array["Asistir"];
        $this->usuario = NULL;
       
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
    
     public function obtenerUsuario(){
        return $this->usuario;
    }
    
    public function cambiarUsuario($usuario){
        $this->usuario = $usuario;
    }
   

}

