var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";


$(document).ready(function(){
    
    $(function(){
        
     $("#galeria a").lightBox();   
    });
    
      //Obtiene la contraseña y email de usuario para validar y iniciar sesión.
    $("#formAutentificar").submit(function(){ 
   
        autentificar();
        return false;
    });
    
    $("#btnRegistrarse").click(function(){
        
      location.href= URL_BASE+"UsuarioNoRegistrado/registrarse/";
    });
    
});

/**
* autentificar
*
* Se comunica con el servidor para autentificar a un usuario con la contraseña y email obtenidos.
*/
function autentificar(){
    
    var email = $("#email").val();
    var pass = $("#contrasena").val();
   
//    var data = "email= "+email+" &pass= "+pass;
 var data = { 

                "email" : email, 
                "pass" : pass 

        };
    
    $.ajax({
        url:URL_BASE+"UsuarioNoRegistrado/autenticar",
        type:"POST",
        data: data,
//        async : true,
//        cache: false,
        beforeSend: function() {
            
            console.log("enviando datos a DB");

        },
        success: function(resp) {
         
            if(resp== true){
                
                location.href= URL_BASE+"UsuarioRegistrado";
            }else{
                if(resp == false){
                alert("Usuario o contraseña incorrecta");
            }else{
               
                alert("Error de acceso al servidor.");  
            }
            }
   
     
   
    }
        
                    
    });
            
    
}