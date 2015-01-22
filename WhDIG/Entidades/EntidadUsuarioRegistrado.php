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
    
public function __construct($array) {
    parent::__construct($array);
    
        $this->nombre = $array["Nombre"];
        $this->localidad = $array["Localidad"];
        $this->genero = $array["Genero"];
        $this->contrasena = $array["Contrasena"];
        $this->provincia = $array["Provincia"];
        $this->detallesEvento = NULL;
        $this->recibirInformacion = $array["RecibirInformacion"];
        $this->comentarios = NULL;
        $this->fechaNacimiento = $array["FechaNacimiento"];
}
    
    /**
    * obtenerNombre
    *
    * Obtiene el nombre del usuario.
    *
    * @return String $nombre Nombre del usuario
    */
    public function obtenerNombre(){
        return $this->nombre;
    }
    
     /**
    * CambiarNombre
    *
    * Modifica el nombre del usuario.
    *
    *@param String $nombre Nombre del usuario.  
    */
    public function cambiarNombre($nombre){
        $this->nombre = $nombre;
    }
    /**
    * obtenerContrasena
    *
    * Obtiene la contraseña del usuario.
    *
    * @return String $contrasena Contraseña del usuario
    */
    public function obtenerContrasena(){
        return $this->contrasena;
    }
    
     /**
    * CambiarContrasena
    *
    * Modifica la contraseña del usuario.
    *
    *@param String $contrasena Contraseña del usuario.  
    */
    public function cambiarContrasena($contrasena){
        $this->contrasena = $contrasena;
    }
    
    /**
    * obtenerGenero
    *
    * Obtiene el genero del usuario.
    *
    * @return char $genero Genero del usuario
    */
    public function obtenerGenero(){
        return $this->genero;
    }
    
     /**
    * CambiarGenero
    *
    * Modifica el genero del usuario.
    *
    *@param char $genero Genero del usuario.  
    */
    public function cambiarGenero($genero){
        $this->genero = $genero;
    }
    
    /**
    * obtenerFechaNacimiento
    *
    * Obtiene la fecha de nacimiento del usuario.
    *
    * @return String $fechaNacimiento Fecha de nacimiento del usuario
    */
    public function obtenerFechaNacimiento(){
        return $this->fechaNacimiento;
    }
    
     /**
    * CambiarFechaNacimiento
    *
    * Modifica la fecha de nacimiento del usuario.
    *
    *@param String $fecha Fecha de nacimiento del usuario.  
    */
    public function cambiarFechaNacimiento($fecha){
        $this->fechaNacimiento = $fecha;
    }
    
    /**
    * obtenerProvincia
    *
    * Obtiene la provincia del usuario.
    *
    * @return String $provincia Provincia del usuario
    */
    public function obtenerProvincia(){
        return $this->provincia;
    }
    
     /**
    * CambiarProvincia
    *
    * Modifica la provincia del usuario.
    *
    *@param String $provincia Provincia del usuario.  
    */
    public function cambiarProvincia($provincia){
        $this->provincia = $provincia;
    }
    
    /**
    * obtenerLocalidad
    *
    * Obtiene la localidad del usuario.
    *
    * @return String $localidad Localidad del usuario
    */
    public function obtenerLocalidad(){
        return $this->localidad;
    }
    
     /**
    * CambiarLocalidad
    *
    * Modifica la localidad del usuario.
    *
    *@param String $localidad Localidad del usuario.  
    */
    public function cambiarLocalidad($localidad){
        $this->localidad = $localidad;
    }
    
    /**
    * obtenerRecibirInformacion
    *
    * Obtiene si el usuario quiere o no recibir información al correo.
    *
    * @return int $recibirInformacion 1/0
    */
    public function obtenerRecibirInformacion(){
        return $this->recibirInformacion;
    }
    
     /**
    * CambiarRecibirInformacion
    *
    * Modifica si el usuario desea recibir información.
    *
    *@param int $recibirInformacion 1/0.  
    */
    public function cambiarRecibirInformacion($recibirInformacion){
        $this->recibirInformacion = $recibirInformacion;
    }
    
    /**
    * obtenerDetallesEvento
    *
    * Obtiene el los detalles de los eventos del usuario del usuario.
    *
    * @return Array<EntidadDetallesEvento> $detallesEvento
    */
    public function obtenerDetallesEvento(){
        return $this->detallesEvento;
    }
    
     /**
    * CambiarDetallesEvento
    *
    * Modifica los detalles de evento del usuario.
    *
    *@param Array<EntidadDetallesEvento> $detalles  
    */
    public function cambiarDetallesEvento($detalles){
        $this->detallesEvento = $detalles;
    }
    
    /**
    * obtenerComentarios
    *
    * Obtiene los comentarios del usuario.
    *
    * @return Array<EntidadComentario>
    */
    public function obtenerComentarios(){
        return $this->comentarios;
    }
    
     /**
    * CambiarComentarios
    *
    * Modifica los comentarios del usuario.
    *
    *@param Array<EntidadComentario> $comentarios  
    */
    public function cambiarComentarios($comentarios){
        $this->comentarios = $comentarios;
    }
}

