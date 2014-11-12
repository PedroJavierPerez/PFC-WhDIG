<?php

    Class Vista{
        
        function render($controlador, $view){
            $controlador = get_class($controlador);
            require './Vistas/'.$controlador.'/'.$view.'.php';
        }
    }

