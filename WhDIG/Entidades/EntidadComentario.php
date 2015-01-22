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
    
    /**
    * ObtenerIdentificador
    *
    * Obtiene el identificador del comentario.
    *
    * @return int $identificador Identificador del comentario.
    */
    public function obtenerIdentificador(){
        return $this->identificador;
    }
    
    /**
    * ObtenerTexto
    *
    * Obtiene el texto del comentario.
    *
    * @return String $texto Texto del comentario.
    */
    public function obtenerTexto(){
        return $this->texto;
    }
    
    /**
    * CambiarTexto
    *
    * Modifica el texto del comentario.
    * 
    *@param String $texto Texto del comentario.
    */
    public function cambiarTexto($texto){
        $this->texto = $texto;
    }
    
    /**
    * ObtenerAceptado
    *
    * Obtiene si el comentario ha sido aceptado.
    *
    * @return Boolean $aceptado 1/0.
    */
    public function obtenerAceptado(){
        return $this->aceptado;
    }
    
    /**
    * CambiarAceptado
    *
    * Modifica el estado del comentario aceptado/no aceptado.
    * 
    *@param int $aceptado 1/0
    */
    public function cambiarAceptado($aceptado){
        $this->aceptado = $aceptado;
    }
    
    /**
    * ObtenerIdRespuesta
    *
    * Obtiene el identificador del comentario al que ha respondido.
    *
    * @return int $id_respuesta.
    */
    public function obtenerIdRespuesta(){
        return $this->id_respuesta;
    }
    
    /**
    * CambiarIdRespuesta
    *
    * Modifica el identificador del comentario al que hace respuesta.
    * 
    *@param int $id_respuesta Identificador comentario.
    */
    public function cambiarIdRespuesta($id_respuesta){
        $this->id_respuesta = $id_respuesta;
    }
    
    /**
    * ObtenerEvento
    *
    * Obtiene el evento al que pertenece el comentario.
    *
    * @return EntidadEvento $evento.
    */
    public function obtenerEvento(){
        return $this->evento;
    }
    
    /**
    * CambiarEvento
    *
    * Modifica el Evento del comentario.
    * 
    *@param EntidadEvento $evento
    */
    public function cambiarEvento($evento){
        $this->evento = $evento;
    }
    
    /**
    * ObtenerUsuario
    *
    * Obtiene el usuario al que pertenece el comentario.
    *
    * @return EntidadUsuarioRegistrado $usuario.
    */
    public function obtenerUsuario(){
        return $this->usuario;
    }
    
    /**
    * CambiarUsuario
    *
    * Modifica el Usuario del comentario.
    * 
    *@param EntidadUsuarioRegistrado $usuario
    */
    public function cambiarUsuario($usuario){
        $this->evento = $usuario;
    }
}

