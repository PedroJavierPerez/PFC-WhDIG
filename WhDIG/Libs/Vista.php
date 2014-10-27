<?php

    Class Vista{
        
        function render($view){
            $controlador = get_class($this);
            require './Vistas/'.$controlador.'/'.$view.'.php';
        }
    }

