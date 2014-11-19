var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){
    
    
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
    
    document.getElementById("email").disabled = true;
    
    
    //Cuando se cambia el input provincia carga los municipios de esa provincia.
    $("input[name=prov]").change(function(){
       
        cambioProvincia();  
    });
    
    $("#eliminarCuenta").click(function(){
       
       $("#formMiCuenta").parent().hide();
       $("#formEliminarCuenta").parent().fadeToggle();
       
        return false;  
    });
    
    $("#formEliminarCuenta").submit(function(){
        
        
        eliminarCuentaUsuario();
        
        return false;
    });
});

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
        url:URL_BASE+"UsuarioRegistrado/modificarDatosUsuario/",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
               alert("Datos modificados correctamente."); 
                
            }else{
                
              alert("Los datos del usuario no fueron Modificados. Error de acceso al servidor.");
                
                
            }
             
        }
    });
}

function eliminarCuentaUsuario(){
    
    var pass = $("#contrasenaEliminarCuenta").val();
        
    var data ="pass="+pass;
    
    $.ajax({
        url:URL_BASE+"UsuarioRegistrado/eliminarCuentaUsuario",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
               location.href= URL_BASE+"UsuarioRegistrado/cerrarSesion"; 
                
            }else{
                if(resp == false){
                 alert("Contraseña incorrecta");
                 
                }else{
              alert("Los datos del usuario no fueron Modificados. Error de acceso al servidor.");
          } 
                
            }
             
        }
    });
    
}

function obtenerRadioButton(ctrl){
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}

function obtenerCheckbox(ctrl){
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked){
            return ctrl[i].value;
        }else{
        return 0;
        }
}

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