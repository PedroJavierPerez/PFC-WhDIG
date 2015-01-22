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
    
    /**
    * ObtenerIdentificador
    *
    * Obtiene el identificador del evento.
    *
    * @return int $identificador Identificador del evento.
    */
    public function obtenerIdentificador(){
        return $this->identificador;
    }
    
    /**
    * ObtenerFecha
    *
    * Obtiene la fecha del evento.
    *
    * @return date $fecha Fecha evento.
    */
    public function obtenerFecha(){
        return $this->fecha;
    }
    
    /**
    * CambiarFecha
    *
    * Modifica la fecha del evento.
    *
    *@param Date $fecha Fecha del evento.  
    */
    public function cambiarFecha($fecha){
        $this->fecha = $fecha;
    }
    
    /**
    * ObtenerHora
    *
    * Obtiene la hora del evento.
    *
    * @return String $hora hora del evento.
    */
    public function obtenerHora(){
        return $this->hora;
    }
    
    /**
    * CambiarHora
    *
    * Modifica la hora del evento.
    *
    *@param String $hora Hora del evento.  
    */
    public function cambiarHora($hora){
        $this->hora = $hora;
    }
    
    /**
    * ObtenerDescripcion
    *
    * Obtiene la descripción del evento.
    *
    * @return String $descripción del evento.
    */
    public function obtenerDescripcion(){
        return $this->descripcion;
    }
    
    /**
    * CambiarDescripcion
    *
    * Modifica la descripción del evento.
    *
    *@param String $descripcion Descripción del evento.  
    */
    public function cambiarDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    
    /**
    * ObtenerNombre
    *
    * Obtiene el nombre del evento.
    *
    * @return String $nombre del evento.
    */
    public function obtenerNombre(){
        return $this->nombre;
    }
    
    /**
    * CambiarNombre
    *
    * Modifica el nombre del evento.
    *
    *@param String $nombre Nombre del evento.  
    */
    public function cambiarNombre($nombre){
        $this->nombre = $nombre;
    }
    
    /**
    * ObtenerNegocio
    *
    * Obtiene el negocio al que pertenece el evento.
    *
    * @return EntidadNegocio $negocio
    */
    public function obtenerNegocio(){
        return $this->negocio;
    }
    
    /**
    * CambiarNegocio
    *
    * Modifica el negocio al que pertenece el evento.
    *
    *@param EntidadEvento $negocio   
    */
    public function cambiarNegocio($negocio){
        $this->negocio = $negocio;
    }
    
    /**
    * ObtenerComentarios
    *
    * Obtiene los comentarios del evento.
    *
    * @return Array><EntidadComentario> Comentarios del evento.
    */
    public function obtenerComentarios(){
        return $this->comentarios;
    }
    
    /**
    * CambiarComentarios
    *
    * Modifica los comentarios del evento.
    *
    *@param Array<EntidadComentario> $comentarios   
    */
    public function cambiarComentarios($comentarios){
        $this->comentarios = $comentarios;
    }
    
    /**
    * ObtenerEstadisticas
    *
    * Obtiene las estadisticas del evento.
    *
    * @return EntidadEstadisticasEvento $estadisticas.
    */
    public function obtenerEstadisticas(){
        return $this->estadisticas;
    }
    
    /**
    * CambiarEstadisticas
    *
    * Modifica las estadisticas del evento.
    *
    *@param EntidadEstadisticas $estadisticas  
    */
    public function cambiarEstadisticas($estadisticas){
        $this->estadisticas = $estadisticas;
    }
    
    /**
    * ObtenerFoto
    *
    * Obtiene el nombre de la foto del evento incluido el formato.
    *
    * @return String $foto Nombre de la foto.
    */
     public function obtenerFoto(){
        return $this->foto;
    }
    
    /**
    * CambiarFoto
    *
    * Modifica el nombre de la foto del evento.
    *
    *@param String $foto Nombre de la foto.  
    */
    public function cambiarFoto($foto){
        $this->foto = $foto;
    }
    
    /**
    * ObtenerTipo
    *
    * Obtiene el tipo del evento.
    *
    * @return String $tipo Tipo del evento.
    */
    public function obtenerTipo(){
        return $this->tipo;
    }
    
    /**
    * CambiarTipo
    *
    * Modifica el tipo del evento.
    *
    *@param String $tipo Tipo del evento.  
    */
    public function cambiarTipo($tipo){
        $this->tipo = $tipo;
    }
    
    /**
    * ObtenerDetallesEventoUsuario
    *
    * Obtiene los detalles del evento para cada uno de los usuarios hora del evento.
    *
    * @return Array<EntidadDetallesEvento> $detallesEventoUsuario
    */
    public function obtenerDetallesEventoUsuario(){
        return $this->detallesEventoUsuario;
    }
    
    /**
    * CambiarDetallesEventoUsuario
    *
    * Modifica los detalles de evento de los usuario.
    *
    *@param Array<EntidadDetallesEvento> $detalles
    */
    public function cambiarDetallesEventoUsuario($detalles){
        $this->detallesEventoUsuario = $detalles;
    }
    
}

