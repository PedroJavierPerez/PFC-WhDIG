var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){
    
    //Cuando se pulsa en un input se selecciona el texto.
    $(".inp").click(function(e){
        
            this.select();
        
      });
     
    //Comprueba que las contraseñas coinciden y modifica los datos del usuario.
    $("#formMiCuenta").submit(function(){ 
            
            var pass = $("#contrasena").val();
            var verificarPass = $("#verificarContrasena").val();
            
            if(pass === verificarPass){
                modificarDatosUsuario();
      
                return false;
            }else{
                alert("La contraseña no coincide"); 
                return false;
            }
            
        });
    
    //inhabilita el email para que no se pueda modificar.
    document.getElementById("email").disabled = true;
    
    
    //Cuando se cambia el input provincia carga los municipios de esa provincia.
    $("input[name=prov]").change(function(){
       
        cambioProvincia();  
    });
    
    // Cuando se pulsa en eliminar cuenta se muestra el formulario para confirmar la eliminación.
    $("a#eliminarCuenta").click(function(){
  
       $("#formMiCuenta").parent().hide();
       $("#formEliminarCuenta").parent().fadeToggle();
       
        return false;  
    });
    
    //Cuando se pulsa eliminar cuenta del formulario, se comunica con el controlador para realizar la eliminación.
    $("#formEliminarCuenta").submit(function(){
        
        
        eliminarCuentaUsuario();
        
        return false;
    });
});


/**
* modificarDatosUsuario
*
* Obtiene los nuevos datos del usuario y se comunica con el controlador para modificarlos.
* Muestra el mensaje correspondiente.
*/
function modificarDatosUsuario(){
    
    var email = $("#email").val();
    var nombre = $("#nombre").val();
    var pass = $("#contrasena").val();
    var genero = obtenerRadioButton(document.getElementsByName("genero"));
    var localidad = $("input[name=loc]").val();
    var provincia = $("input[name=prov]").val();
    var fecha = $("#fecha").val();
    var informacion = obtenerCheckbox(document.getElementsByName("informacion"));
            
    var data = "email="+email+"&nombre="+nombre+"&pass="+pass+"&genero="+genero+"&localidad="+localidad+"&provincia="+provincia+"&fecha="+fecha+"&informacion="+informacion;
    
    
    $.ajax({
        url:URL_BASE+"Administrador/modificarDatosUsuario/",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == 'Fecha no valida'){
             alert("La fecha de nacimiento no es válida");
                }else{
                    if(resp == 'Datos incompletos'){
                        alert("Campos incompletos");
                    }else{
                        if(resp == 'email no valido'){
                            alert("El email no es válido");
                        }else{
                            if(resp == true){
                                 alert("Datos modificados correctamente."); 
                
                            }else{
                
                            alert("Los datos del usuario no fueron Modificados. Error de acceso al servidor.");
                            }  
                        } 
                    }
                } 
        }
    });
}

/**
* eliminarCuentaUsuario
*
* Comprueba que la contraseña es la correcta y elimina la cuenta.
* Muestra el mensaje correspondiente en caso de error.
*/
function eliminarCuentaUsuario(){
    
    var pass = $("#contrasenaEliminarCuenta").val();
        
    var data ="pass="+pass;
    
    $.ajax({
        url:URL_BASE+"Administrador/eliminarCuentaUsuario",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
               location.href= URL_BASE+"Administrador/cerrarSesion"; 
                
            }else{
                if(resp == false){
                 alert("Contraseña incorrecta");
                 
                }else{
                    if(resp == 'Datos incompletos'){
                    alert("Campo contraseña incompleto");
                  }else{
                        alert("La cuenta no se eliminó. Error de acceso al servidor.");
                   } 
                }    
            }
             
        }
    });
    
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
        url:URL_BASE+"Administrador/cargarLocalidadesProvincias",
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