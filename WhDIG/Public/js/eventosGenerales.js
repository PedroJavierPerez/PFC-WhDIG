var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){


    $("#salir").click(function(){
        
     location.href= URL_BASE+"UsuarioRegistrado/cerrarSesion";
     return false;
    });
    
    $("#miCuenta").click(function(){
        
     location.href= URL_BASE+"UsuarioRegistrado/miCuenta";
     return false;
    });
    
    $("#inicio").click(function(){
        
     location.href= URL_BASE+"UsuarioRegistrado";
     return false;
    });

}); 
