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
    
    /**
    * ObtenerIdEstadisticas
    *
    * Obtiene el identificador de estadisticas.
    *
    * @return int $id 
    */
    public function obtenerIdEstadisticas(){
        return $this->id;
    }
    
    /**
    * ObtenerNuMujeres
    *
    * Obtiene el numero de mujeres que asiste al evento $nuMujeres.
    *
    * @return int $nuMujeres.
    */
    public function obtenerNuMujeres(){
        return $this->nuMujeres;
    }
    
     /**
    * CambiarNuMujeres
    *
    * Modificar numero de mujeres $nuMujeres.
    *
    *@param int $mujeres Numero de mujeres.  
    */
    public function cambiarNuMujeres($mujeres){
        $this->nuMujeres = $mujeres;
    }
    
    /**
    * ObtenerNuHombres
    *
    * Obtiene el numero de hombres que asiste al evento $nuHombres.
    *
    * @return int $nuHombres.
    */
    public function obtenerNuHombres(){
        return $this->nuHombres;
    }
    
     /**
    * CambiarNuHombres
    *
    * Modificar numero de hombres $nuHombres.
    *
    *@param int $hombres Numero de hombres.  
    */
    public function cambiarNuHombres($hombres){
        $this->nuHombres = $hombres;
    }
    
    /**
    * ObtenerNuLocales
    *
    * Obtiene el numero de usuarios locales que asiste al evento $nuLocales.
    *
    * @return int $nuLocales.
    */
    public function obtenerNuLocales(){
        return $this->nuLocales;
    }
    
     /**
    * CambiarNuLocales
    *
    * Modificar numero de locales $nuLocales.
    *
    *@param int $locales Numero de locales.  
    */
    public function cambiarNuLocales($locales){
        $this->nuLocales = $locales;
    }
    
    /**
    * ObtenerNuForasteros
    *
    * Obtiene el numero de usuario forasteros que asiste al evento $nuForasteros.
    *
    * @return int $nuForasteros.
    */
    public function obtenerNuForasteros(){
        return $this->nuForasteros;
    }
    
     /**
    * CambiarNuForasteros
    *
    * Modificar numero de forasteros $nuForasteros.
    *
    *@param int $forasteros Numero de forasteros.  
    */
    public function cambiarNuForasteros($forasteros){
        $this->nuForasteros = $forasteros;
    }
    
    /**
    * ObtenerEvento
    *
    * Obtiene el evento al que pertenecen las estadisticas $evento.
    *
    * @return int $nuMujeres.
    */
    public function obtenerEvento(){
        return $this->evento;
    }
    
     /**
    * CambiarEvento
    *
    * Modificar el evento al que pertenecen las estadisticas.
    *
    *@param EntidadEvento $evento Evento.  
    */
    public function cambiarEvento($evento){
        $this->evento = $evento;
    }
    
    /**
    * ObtenerPropietario
    *
    * Obtiene el propietario que publico el evento $propietario.
    *
    * @return EntidadPropietario $propietario.
    */
    public function obtenerPropietario(){
        return $this->propietario;
    }
    
     /**
    * CambiarPropietario
    *
    * Modificar Propietario del evento $propietario.
    *
    *@param int $propietario Propietario.  
    */
    public function cambiarPropietario($propietario){
        $this->propietario = $propietario;
    }
    
     /**
    * numeroAsistentes
    *
    * Realiza la suma de mujeres + hombres para calcular los asistentes al evento.
    *
    *@return int Numero de asistentes.  
    */
    public function numeroAsistentes(){
        return $this->nuMujeres + $this->nuHombres;
    }
}

