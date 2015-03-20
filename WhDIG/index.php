<?php
    
    require 'config.php';
    require_once 'APP/Sesion.php';
    
    Sesion::init();
    if(isset($_GET["url"])){ 
        $url =$_GET["url"];
        $urlAux = explode("/", $url);
        if((!Sesion::exist()) && ($urlAux[0] !== 'UsuarioNoRegistrado')){
            if(isset($urlAux[1])){
                if(($urlAux[1] !== 'autenticar')&&($urlAux[1] !== 'recuperarContrasena')){
                    $url = "UsuarioNoRegistrado/index";
                }
            }else{
                $url = "UsuarioNoRegistrado/index";
            }
            
        }else{
            if(Sesion::exist()){
                if((Sesion::getValue("administrador") == 1)&&($urlAux[0] !== 'Administrador')){
                    $url = "Administrador/index"; 
                }else{
                    if((Sesion::getValue("administrador") == 0)&&($urlAux[0] !== 'UsuarioRegistrado')){
                    $url = "UsuarioRegistrado/index"; 
                    }
                }
            }
        }
        
    }else{
        if(Sesion::exist()){
            if(Sesion::getValue("administrador") == 1){
               $url = "Administrador/index"; 
            }else{
        $url = "UsuarioRegistrado/index";  
            }
        }else{
        $url = "UsuarioNoRegistrado/index";
        }
    }
    $url = explode("/", $url);
    
    
    if(isset($url[0])){$controlador = $url[0];}
    if((isset($url[1]))&&($url[1]!='')){$metodo = $url[1];}
    if((isset($url[2]))&&($url[2]!='')){$parametros = $url[2];}

    spl_autoload_register(function($class){ 
        if(file_exists(APP.$class.".php")){
            require APP.$class.".php";
        }  
    });
    $contr = $controlador;
    $dir = './Controladores/'.$controlador.'.php';
    if(file_exists($dir)){
        require $dir;
        $controlador = new $controlador();
        
        if(isset($metodo)){
            if(method_exists($controlador, $metodo)){
                if(isset($parametros)){
                    $controlador->{$metodo}($parametros);
                }else{
//                    if($contr == "Index"){
                    $controlador->{$metodo}();
//                    }else{
//                     echo 'Error, Para este metodo se necesitan parametros';  
//            }
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
    