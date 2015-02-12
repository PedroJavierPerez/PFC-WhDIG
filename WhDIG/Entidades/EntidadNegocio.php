<?php

class EntidadNegocio{
    
    private $identificador;
    private $nombre;
    private $localidad;
    private $direccion;
    private $codigoPostal;
    private $provincia;
    private $telefono;
    private $propietario;
    private $tipo;
    
    public function __construct($array){
        $this->identificador = $array["Id_negocio"];
        $this->nombre = $array["Nombre"];
        $this->localidad = $array["Localidad"];
        $this->direccion = $array["Calle"].", ".$array["Numero"];
        $this->codigoPostal = $array["CodigoPostal"];
        $this->provincia = $array["Provincia"];
        $this->telefono = $array["Telefono"];
        $this->tipo = $array["Tipo"];
        $this->propietario = NULL;
    }

    /**
    * ObtenerIdentificador
    *
    * Obtiene el identificador del negocio.
    *
    * @return int $identificador Identificador del negocio.
    */
    public function obtenerIdentificador(){
        return $this->identificador;
    }
    
    /**
    * ObtenerNombre
    *
    * Obtiene el Nombre del negocio.
    *
    * @return String $nombre Nombre del negocio.
    */
    public function obtenerNombre(){
        return $this->nombre;
    }
    
    /**
    * CambiarNombre
    *
    * Modifica el nombre del negocio.
    *
    *@param String $nombre Nombre del negocio.  
    */
    public function cambiarNombre($nombre){
        $this->nombre = $nombre;
    }
    
    /**
    * ObtenerLocalidad
    *
    * Obtiene la localidad donde se encuentra el negocio .
    *
    * @return String $localidad 
    */
    public function obtenerLocalidad(){
        return $this->localidad;
    }
    
    /**
    * CambiarLocalidad
    *
    * Modifica la localidad del negocio.
    *
    *@param String $localidad Localidad del negocio.  
    */
    public function cambiarLocalidad($localidad){
        $this->localidad = $localidad;
    }
    
    /**
    * ObtenerDireccion
    *
    * Obtiene la dirección del negocio.
    *
    * @return String $direccion Dirección del negocio.
    */
    public function obtenerDireccion(){
        return $this->direccion;
    }
    
    /**
    * CambiarDireccion
    *
    * Modifica la dirección del negocio.
    *
    *@param String $direccion Dirección del negocio.  
    */
    public function cambiarDireccion($direccion){
        $this->direccion = $direccion;
    }
    
    /**
    * ObtenerCodigoPostal
    *
    * Obtiene el codigo postal del negocio.
    *
    * @return int $codigoPostal 
    */
    public function obtenerCodigoPostal(){
        return $this->codigoPostal;
    }
    
    /**
    * CambiarCodigoPostal
    *
    * Modifica el código postal del negocio.
    *
    *@param String $codigoPostal Código postal del negocio.  
    */
    public function cambiarCodigoPostal($codigoPostal){
        $this->codigoPostal = $codigoPostal;
    }
    
    /**
    * obtenerProvincia
    *
    * Obtiene la provincia donde se encuentra el negocio.
    *
    * @return String $provincia Provincia del negocio.
    */
    public function obtenerProvincia(){
        return $this->provincia;
    }
    
    /**
    * CambiarProvincia
    *
    * Modifica la provincia del negocio.
    *
    *@param String $provincia Provincia del negocio.  
    */
    public function cambiarProvincia($provincia){
        $this->provincia = $provincia;
    }
    
    /**
    * obtenerTelefono
    *
    * Obtiene el teléfono del negocio.
    *
    * @return String $telefono Teléfono del negocio.
    */
    public function obtenerTelefono(){
        return $this->telefono;
    }
    
    /**
    * obtenerTipo
    *
    * Obtiene el tipo de negocio.
    *
    * @return String $tipo Tipo de negocio.
    */
    public function obtenerTipo(){
        return $this->tipo;
    }
    
    /**
    * CambiarTelefono
    *
    * Modifica el teléfono del negocio.
    *
    *@param String $telefono Teléfono del negocio.  
    */
    public function cambiarTelefono($telefono){
        $this->telefono = $telefono;
    }
    
    /**
    * obtenerPropietario
    *
    * Obtiene el propietario del negocio.
    *
    * @return EntidadPropietario $propietario
    */
    public function obtenerPropietario(){
        return $this->propietario;
    }
    
    /**
    * cambiarPropietario
    *
    * Modifica el propietario del negocio.
    *
    *@param EntidadPropietario $propietario Propietario del negocio.  
    */
    public function cambiarPropietario($propietario){
        $this->propietario = $propietario;
    }
}

