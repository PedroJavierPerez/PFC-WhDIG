var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){

    // Cuando el usuario pulsa la opción SALIR se cierra la sesión
    $("#salir").click(function(){
        
     location.href= URL_BASE+"UsuarioRegistrado/cerrarSesion";
     return false;
    });
    
    // Cuando el usuario pulsa la opción MI CUENTA le redirige a esa página. 
    $("#miCuenta").click(function(){
        
     location.href= URL_BASE+"UsuarioRegistrado/miCuenta";
     return false;
    });
    
    // Cuando el usuario pulsa la opción INICIO le redirige a esa página.
    $("#inicio").click(function(){
        
     location.href= URL_BASE+"UsuarioRegistrado";
     return false;
    });
    
    // Cuando el usuario pulsa la opción ASISTENCIA A EVENTOS le redirige a esa página.
    $("#asistencia").click(function(){
        
     location.href= URL_BASE+"UsuarioRegistrado/asistenciaEventos";
     return false;
    });
    
    // Cuando el usuario pulsa la opción OLVIDAR CONTRASEÑA le redirige a esa página.
    $("#olvidarContrasena a").click(function(){
        
     location.href= URL_BASE+"UsuarioNoRegistrado/olvidarContrasena";
     return false;
    });

}); 
