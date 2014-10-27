<?php

    require 'config.php';

    $url = (isset($_GET["url"])) ? $_GET["url"] : "Index/index";

    $url = explode("/", $url);

    if(isset($url[0])){$controlador = $url[0];}
    if((isset($url[1]))&&($url[1]!='')){$metodo = $url[1];}
    if((isset($url[2]))&&($url[2]!='')){$parametros = $url[2];}

    spl_autoload_register(function($class){ 
        if(file_exists(LIBS.$class.".php")){
            require LIBS.$class.".php";
        }  
    });
    
    $dir = './Controladores/'.$controlador.'.php';
    if(file_exists($dir)){
        require $dir;
        $controlador = new $controlador();
        
        if(isset($metodo)){
            if(method_exists($controlador, $metodo)){
                if(isset($parametros)){
                    $controlador->{$metodo}($parametros);
                }else{
                    $controlador->{$metodo}();
                }
            }else{
                echo 'Error, no existe el metodo';
            }
        }else{
           $controlador->index();
        }
       
    }else{
        echo 'Error';
    }
    