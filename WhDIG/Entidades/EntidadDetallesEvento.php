<?php

class EntidadDetallesEvento{
    
    private $favorito;
    private $asistir;
    private $usuario;
    private $evento;


    public function __construct($array){
        $this->favorito = $array["Favorito"];
        $this->asistir = $array["Asistir"];
        $this->usuario = NULL;
        $this->evento = NULL;
       
    }
    
     /**
    * ObtenerFavorito
    *
    * Obtiene si el evento es favorito o no para un usuario.
    *
    * @return int $favorito 1/0.
    */
    public function obtenerFavorito(){
        return $this->favorito;
    }
    
    /**
    * CambiarFavorito
    *
    * Modifica el estado de favorito.
    * 
    *@param int $favorito 1/0.
    */
    public function cambiarfavorito($favorito){
        $this->favorito = $favorito;
    }
    
     /**
    * ObtenerAsistir
    *
    * Obtiene si el usuario va a asistir al evento o no.
    *
    * @return int $asistir 1/0.
    */
    public function obtenerAsistir(){
        return $this->asistir;
    }
    
     /**
    * CambiarAsistir
    *
    * Modifica el estado de Asistir.
    * 
    *@param int $asistir 1/0.
    */
    public function cambiarAsistir($asistir){
        $this->asistir = $asistir;
    }
    
    /**
    * ObtenerEvento
    *
    * Obtiene el evento al que se hace referencia.
    *
    * @return EntidadEvento $evento.
    */
    public function obtenerEvento(){
        return $this->evento;
    }
    
    /**
    * CambiarEvento
    *
    * Modifica el Evento al cual pertenecen los detalles.
    * 
    *@param EntidadEvento $evento Evento.
    */
    public function cambiarEvento($evento){
        $this->evento = $evento;
    }
    
     /**
    * ObtenerUsuario
    *
    * Obtiene el usuario al que se hace referencia.
    *
    * @return EntidadUsuarioRegistrado $usuario.
    */
    public function obtenerUsuario(){
        return $this->usuario;
    }
    
    /**
    * CambiarUsuario
    *
    * Modifica el Usuario al cual pertenecen los detalles.
    * 
    *@param EntidadUsuarioRegistrado $usuario
    */
    public function cambiarUsuario($usuario){
        $this->usuario = $usuario;
    }
   

}

