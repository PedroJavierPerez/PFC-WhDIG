<?php

class EntidadEstadisticasEvento{
    
    private $id;
    private $nuMujeres;
    private $nuHombres;
    private $nuLocales;
    private $nuForasteros;
    private $evento;
    private $propietario;
    
    public function __construct($array){
        $this->id = $array["Id_estadisticas"];
        $this->nuMujeres = $array["Mujeres"];
        $this->nuHombres = $array["Hombres"];
        $this->nuLocales = $array["Locales"];
        $this->nuForasteros = $array["Forasteros"];
        $this->evento = NULL;
        $this->propietario = NULL;
       
    }
    
    public function obtenerIdEstadisticas(){
        return $this->id;
    }
    
    public function obtenerNuMujeres(){
        return $this->nuMujeres;
    }
    
    public function cambiarNuMujeres($mujeres){
        $this->nuMujeres = $mujeres;
    }
    
    public function obtenerNuHombres(){
        return $this->nuHombres;
    }
    
    public function cambiarNuHombres($hombres){
        $this->nuHombres = $hombres;
    }
    
    public function obtenerNuLocales(){
        return $this->nuLocales;
    }
    
    public function cambiarNuLocales($locales){
        $this->nuLocales = $locales;
    }
    
    public function obtenerNuForasteros(){
        return $this->nuForasteros;
    }
    
    public function cambiarNuForasteros($forasteros){
        $this->nuForasteros = $forasteros;
    }
    
    public function obtenerEvento(){
        return $this->evento;
    }
    
    public function cambiarEvento($evento){
        $this->evento = $evento;
    }
    
    public function obtenerPropietario(){
        return $this->propietario;
    }
    
    public function cambiarPropietario($propietario){
        $this->propietario = $propietario;
    }
    
    public function numeroAsistentes(){
        return $this->nuMujeres + $this->nuHombres;
    }
}

