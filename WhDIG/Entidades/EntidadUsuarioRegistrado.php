<?php



class EntidadUsuarioRegistrado extends UsuarioAbstracto{
    
    private $nombre;
    private $contrasena;
    private $genero;
    private $fechaNacimiento;
    private $provincia;
    private $localidad;
    private $recibirInformacion;
    private $esPropietario;
    private $esAdministrador;
    private $detallesEvento;
    private $comentarios;
    private $negocios;
    
public function __construct($array) {
    parent::__construct($array);
    
        $this->nombre = $array["Nombre"];
        $this->localidad = $array["Localidad"];
        $this->genero = $array["Genero"];
        $this->contrasena = $array["Contrasena"];
        $this->provincia = $array["Provincia"];
        $this->detallesEvento = NULL;
        $this->recibirInformacion = $array["RecibirInformacion"];
        $this->esPropietario = $array["Propietario"];
        $this->esAdministrador = $array["Administrador"];
        $this->comentarios = NULL;
        $this->fechaNacimiento = $array["FechaNacimiento"];
        $this->negocios = NULL;
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
    
      /**
    * obtenerNegocios
    *
    * Obtiene los negocios pertenecientes al propietario.
    *
    * @return Array<EntidadNegocio> $negocios
    */
    public function obtenerNegocios(){
        return $this->negocios;
    }
    
    /**
    * CambiarNegocios
    *
    * Modifica los negocios pertenecientes al propietario.
    *
    *@param Array<EntidadNegocio> $negocios Negocios del propietario.  
    */
    public function cambiarNegocios($negocios){
        $this->negocios = $negocios;
    }
    
    /**
    * obtenerEsPropietario
    *
    * Obtiene si el usuario es propietario.
    *
    * @return int $esPropietario 1/0
    */
    public function obtenerEsPropietario(){
        return $this->esPropietario;
    }
    
     /**
    * CambiarEsPropietario
    *
    * Modifica si el usuario es Propietario.
    *
    *@param char $esPropietario 1/0.  
    */
    public function cambiarEsPropietario($esPropietario){
        $this->esPropietario = $esPropietario;
    }
    
    /**
    * obtenerEsAdministrador
    *
    * Obtiene si el usuario es Administrador.
    *
    * @return int $esAdministrador 1/0
    */
    public function obtenerEsAdministrador(){
        return $this->esAdministrador;
    }
    
     /**
    * CambiarEsAdministrador
    *
    * Modifica si el usuario es Administrador.
    *
    *@param char $esAdministrador 1/0.  
    */
    public function cambiarEsAdministrador($esAdministrador){
        $this->esAdministrador = $esAdministrador;
    }
}

