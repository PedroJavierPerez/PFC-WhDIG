<?php

class Sesion{
    
    /**
    * init
    *
    * Inicia la sesión.
    */
    static function init(){
        
        @session_start();
    }
    
    /**
    * destroy
    *
    * Destruye la sesión.
    */
    static function destroy(){
            session_destroy();
    }
    
    /**
    * getValue
    *
    * Obtiene el valor de una variable.
    * @param String $var Variable de la sesión.
    */
    static function getValue($var){
        return $_SESSION[$var];
    }
    
    /**
    * setValue
    *
    * Modificar variable sesión.
    * @param String $var Variable de la sesión.
    * @param String $val Nuevo valor. 
    */
    static function setValue($var, $val){
        $_SESSION[$var]=$val;
    }
    
    /**
    * unsetValue
    *
    * Destruye variable concreta de la sesión.
    * @param String $var Variable de la sesión.
    */
    static function unsetValue($var){
        if(isset($_SESSION[$var])){
            unset($_SESSION[$var]);
        }
    }
    
    /**
    * exist
    *
    * Comprueba que existe sesión.
    * @return Boolean Indica si existe sesión.
    */
    static function exist(){
        if(sizeof($_SESSION)> 0){
            return true;
        }else{
            return false;
        }
    }
}

