
var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){
    

    
      //Cuando se pulsa en el input verificar contraseña se selecciona el texto.
      $(".inp").click(function(e){
        
            this.select();
        
      });
    
    //Cuando se cambia el input provincia carga los municipios de esa provincia.
    $("input[name=prov]").change(function(){
       
        cambioProvincia();  
    });
    
    //Comprueba que las contraseñas coinciden y realiza el registro.
    $("#formRegistro").submit(function(){ 
            
        var pass = $("#Rcontrasena").val();
        var verificarPass = $("#verificarContrasena").val();

        if(pass === verificarPass){
            registrar();
  //        $("#Iemail").val("");
            return false;
        }else{
            alert("La contraseña no coincide"); 
            return false;
        }
            
    });
    
    
     //Obtiene la contraseña y email de usuario para validar y iniciar sesión.
    $("#formAutentificar").submit(function(){ 
   
        autentificar();
        return false;
    });
    
});

/**
* registrar
*
* Obtiene los datos del nuevo usuario y se comunica con el controlador para realizar el nuevo registro.
* Muestra el mensaje que corresponda en caso de error y en caso contrario redirige a al página usuario registrado.
*/
function registrar(){
    
    var email = $("#Remail").val();
    var nombre = $("#nombre").val();
    var pass = $("#Rcontrasena").val();
    var genero = obtenerRadioButton(document.getElementsByName("genero"));
    var localidad = $("input[name=loc]").val();
    var provincia = $("input[name=prov]").val();
    var fecha = $("#fecha").val();
    var informacion = obtenerCheckbox(document.getElementsByName("informacion"));
            
    var data = "email="+email+"&nombre="+nombre+"&pass="+pass+"&genero="+genero+"&localidad="+localidad+"&provincia="+provincia+"&fecha="+fecha+"&informacion="+informacion;
    
    
    $.ajax({
        url:URL_BASE+"UsuarioNoRegistrado/obtenerDatosNuevoUsuario/",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
         if(resp == 'email no valido'){
                    alert("El email no es válido");
                }else{
                     if(resp == 'Fecha no valida'){
                    alert("La fecha de nacimiento no es válida");
                }else{
            if(resp == true){
                location.href= URL_BASE+"UsuarioRegistrado";
                
            }else{
                if(resp == false){
                    alert("El email ingresado ya esta registrado.");
                }else{
                    alert("El usuario no fue registrado. Error de acceso al servidor.");
                }
            } 
            }
        }  
        }
    });
}

/**
* cambioProvincia
*
* Obtiene la provincia seleccionada y se comunica con el controlador para buscar las localidades de esta.
* Modifica estas en la vista
*/
function cambioProvincia(){
      var id1 = $('input[name=prov]').val();
        $("input[name=loc]").val('');
       document.getElementById("loc").disabled = false;
       
       var data = "provincia="+id1;
       if(id1 != ''){
        $.ajax({
        url:URL_BASE+"UsuarioNoRegistrado/cargarLocalidadesProvincias",
        type:"POST",
//        dataType:"JSON",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
          
            var res = eval(resp);
            
            var string = '';
            if(res != null){
            for(i=0;i<res.length;i++){
                
               string += "<option>"+res[i].nombre+" </option><br>";
            }
            document.getElementById("loc").disabled = false;
            document.getElementById("localidad").innerHTML = string;
            }else{
               document.getElementById("loc").disabled = true; 
            }
            

        }
    });
       }  
}

/**
* obtenerRadioButton
*
* Comprueba que radio button esta seleccionado.
* @param {Array<String>} ctrl Valores del radio button.
* @return {String} Valor seleccionado.
*/
function obtenerRadioButton(ctrl){
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}

/**
* obtenerCheckbox
*
* Comprueba que checkbox esta seleccionado.
* @param {Array<String>} ctrl Valores del checkbox.
* @return {String} Valor seleccionado.
*/
function obtenerCheckbox(ctrl){
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked){
            return ctrl[i].value;
        }else{
        return 0;
        }
}

/**
* autentificar
*
* Se comunica con el servidor para autentificar a un usuario con la contraseña y email obtenidos.
* Muestra el mensaje correspondiente.
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