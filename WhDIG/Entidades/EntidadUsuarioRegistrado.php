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
    
    
    public function obtenerNombre(){
        return $this->nombre;
    }
    
    public function cambiarNombre($nombre){
        $this->nombre = $nombre;
    }
    
    public function obtenerContrasena(){
        return $this->contrasena;
    }
    
    public function cambiarContrasena($contrasena){
        $this->contrasena = $contrasena;
    }
    
    public function obtenerGenero(){
        return $this->genero;
    }
    
    public function cambiarGenero($genero){
        $this->genero = $genero;
    }
    
    public function obtenerFechaNacimiento(){
        return $this->fechaNacimiento;
    }
    
    public function cambiarFechaNacimiento($fecha){
        $this->fechaNacimiento = $fecha;
    }
    
    public function obtenerProvincia(){
        return $this->provincia;
    }
    
    public function cambiarProvincia($provincia){
        $this->provincia = $provincia;
    }
    
    public function obtenerLocalidad(){
        return $this->localidad;
    }
    
    public function cambiarLocalidad($localidad){
        $this->localidad = $localidad;
    }
    
    public function obtenerRecibirInformacion(){
        return $this->recibirInformacion;
    }
    
    public function cambiarRecibirInformacion($recibirInformacion){
        $this->recibirInformacion = $recibirInformacion;
    }
    
    public function obtenerDetallesEvento(){
        return $this->detallesEvento;
    }
    
    public function cambiarDetallesEvento($detalles){
        $this->detallesEvento = $detalles;
    }
    
    public function obtenerComentarios(){
        return $this->comentarios;
    }
    
    public function cambiarComentarios($comentarios){
        $this->comentarios = $comentarios;
    }
}

