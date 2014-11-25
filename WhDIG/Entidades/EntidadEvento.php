<?php


class EntidadEvento {
    
    private $identificador;
    private $fecha;
    private $hora;
    private $descripcion;
    private $tipo;
    private $nombre;
    private $foto;
    private $negocio;
    private $comentarios;
    private $estadisticas;
    private $detallesEventoUsuario;



    public function __construct($array){
        $this->identificador = $array["Id_evento"];
        $this->fecha = $array["Fecha"];
        $this->hora = $array["Hora"];
        $this->descripcion = $array["Descripcion"];
        $this->nombre = $array["Nombre"];
        $this->foto = $array["Foto"];
        $this->tipo = $array["Tipo"];
        $this->negocio = NULL;
        $this->estadisticas = NULL;
        $this->comentarios = NULL;
        $this->detallesEventoUsuario = NULL;
    }
    
    public function obtenerIdentificador(){
        return $this->identificador;
    }
    
    public function cambiarIdentificador($identificador){
        $this->identificador = $identificador;
    }
    
    public function obtenerFecha(){
        return $this->fecha;
    }
    
    public function cambiarFecha($fecha){
        $this->fecha = $fecha;
    }
    
    public function obtenerHora(){
        return $this->hora;
    }
    
    public function cambiarHora($hora){
        $this->hora = $hora;
    }
    
    public function obtenerDescripcion(){
        return $this->descripcion;
    }
    
    public function cambiarDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    
    public function obtenerNombre(){
        return $this->nombre;
    }
    
    public function cambiarNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function obtenerNegocio(){
        return $this->negocio;
    }
    
    public function cambiarNegocio($negocio){
        $this->negocio = $negocio;
    }
    
    public function obtenerComentarios(){
        return $this->comentarios;
    }
    
    public function cambiarComentarios($comentarios){
        $this->comentarios = $comentarios;
    }
    
    public function obtenerEstadisticas(){
        return $this->estadisticas;
    }
    
    public function cambiarEstadisticas($estadisticas){
        $this->estadisticas = $estadisticas;
    }
    
     public function obtenerFoto(){
        return $this->foto;
    }
    
    public function cambiarFoto($foto){
        $this->foto = $foto;
    }
    
    public function obtenerTipo(){
        return $this->tipo;
    }
    
    public function cambiarTipo($tipo){
        $this->tipo = $tipo;
    }
    
    public function obtenerDetallesEventoUsuario(){
        return $this->detallesEventoUsuario;
    }
    
    public function cambiarDetallesEventoUsuario($detalles){
        $this->detallesEventoUsuario = $detalles;
    }
    
}

