<?php

    Class Vista{
        
    /**
    * render
    *
    * Renderiza la vista.
    *
    * @param Controlador $controlador El controlador de la vista
    * @param String $view nombre de la vista. 
    */
        function render($controlador, $view){
            $controlador = get_class($controlador);
            require './Vistas/'.$controlador.'/'.$view.'.php';
        }
    }

