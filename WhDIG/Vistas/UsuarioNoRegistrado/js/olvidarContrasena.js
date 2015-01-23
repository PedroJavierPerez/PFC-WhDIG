var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";


$(document).ready(function(){
    
    
  //Obtiene el email del usuario y envia la contraseña por correo.
    $("#formEliminarCuenta").submit(function(){ 
            
        var email = $("#inputEmail").val();
         
         recuperarContrasena(email);
         
         return false;
            
    });
    
    
    
});

/**
* recuperarContrasena
*
* Obtiene el email del usuario y se comunica con el controlador para cambiar y enviar la contraseña por correo.
* Muestra el mensaje que corresponda.
* @param {String} email Email del usuario.
*/
function recuperarContrasena(email){
    
        var data = "email="+email;
    
    $.ajax({
        url:URL_BASE+"UsuarioNoRegistrado/recuperarContrasena",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
                alert("En breve recibirá un email donde obtendra su nueva contraseña");
                $("#inputEmail").val("");
            }else{
                if(resp == 'email no valido'){
                    alert("El email no es válido");
                }else{
                    if(resp == false){
                         alert("El email introducido no esta registrado");
                         $("#Iemail").val("");
                    }else{
                        alert("Error de acceso al servidor.");
                    }
            }
            }
            
        }
    });
    
}


