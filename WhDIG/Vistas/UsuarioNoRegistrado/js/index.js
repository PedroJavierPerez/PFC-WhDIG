
$(document).ready(function(){
 
 //Cuando se cambia el input provincia carga los municipios de esa provincia.
    $("input[name=pro]").change(function(){
       
        cambioProvincia();  
    });


 //Cuando se pulsa en el input provincia se selecciona el texto.
    $("input[name=pro]").click(function(){
        $("input[name=pro]").select();
    });

 //Cuando se pulsa en el input ciudad se selecciona el texto.
    $("input[name=ciu]").click(function(){
        $("input[name=ciu]").select();
    });
    
 //Cuando se pulsa en el input tipo se selecciona el texto.
    $("input[name=tip]").click(function(){
        $("input[name=tip]").select();  
    });

 //Cuando se pulsa en el input local se selecciona el texto.
    $("input[name=loc]").click(function(){
        $("input[name=loc]").select();
    });
    
 //Lee los input de filtrado y filtra los eventos según estos.
    $("#formFiltro").submit(function(){
        opcionesFiltrado();
        return false;
    });
    
 //Obtiene el valor del imput suscribir y permite suscribir al usuario.
    $("#formSuscribir").submit(function(){ 
        suscribir();
        $("#Iemail").val("");
        return false;
    });
    
 //Obtiene el valor del imput eliminar suscribir y permite eliminar la suscripción del usuario.
    $("#formEliminarSuscribir").submit(function(){ 
        eliminarSuscribir();
        $("#NIemail").val("");
        return false;
    });

    $("#eventos a").click(function(e){
        
        var Id_evento = $(this).attr("id");
       
        mostrarDetallesEvento(Id_evento);
        
        return false;
    });
    
    
 //Obtiene la contraseña y email de usuario para validar y iniciar sesión.
    $("#formAutentificar").submit(function(){ 
   
        autentificar();
        return false;
    });  
    
    $("#btnRegistrarse").click(function(){
        
      location.href= "./UsuarioNoRegistrado/registrarse/";
    });

}); 


// FUNCIONES

function mostrarDetallesEvento(id_evento){
   location.href= "./UsuarioNoRegistrado/detalles/"+id_evento;
    
   
}



function cambioProvincia(){
      var id1 = $('input[name=pro]').val();
        $("input[name=ciu]").val('');
       document.getElementById("ciud").disabled = false;
       
       var data = "provincia="+id1;
       
       if(id1 != ''){
        $.ajax({
        url:"UsuarioNoRegistrado/cargarLocalidadesProvincias/",
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
            document.getElementById("ciud").disabled = false;
             document.getElementById("ciudad").innerHTML = string;
             
        }else{
            
            document.getElementById("ciud").disabled = true;
        }
           

        }
    });
       }  
}

function opcionesFiltrado(){
    var fechaI = $("#fechaInicio").val();
    var fechaF = $("#fechaFin").val();
    var provincia = $('input[name=pro]').val();
    var municipio = $('input[name=ciu]').val();
    var tipo = $('input[name=tip]').val();
    var local = $('input[name=loc]').val();
    
    var data = { 

                "fechaI" : fechaI, 
                "fechaF" : fechaF,
                "provincia" : provincia,
                "municipio" : municipio,
                "tipo" : tipo,
                "local" : local

        };
    
        $.ajax({
        url:"./UsuarioNoRegistrado/filtrarEventos",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
//            alert(resp);
            var eventos = eval(resp);
            
            var string = '';
            
            if(eventos != "false"){
                
            for(var i in eventos){
                
           
           string += "<a id='"+eventos[i].id+"' href='UsuarioNoRegistrado/detalles/"+eventos[i].id+"'><article>\n\
                <hgroup><h4 class='titulo'>"+eventos[i].nombre+" ("+eventos[i].provincia+")</h4></hgroup>\n\
                <p>\n\
                <ul>\n\
                <li>"+eventos[i].descripcion+"</li>\n\
                <li class='fechalista'>+ Fecha: "+eventos[i].fecha+"</li>\n\
                <li>+ Hora: "+eventos[i].hora+"</li>\n\
                </ul>\n\
                </p>\n\
                </article></a>";
            } 
            document.getElementById("eventos").innerHTML = string;
        }else{
         string +="<p class='NoFiltro'>No se encontraron eventos que cumplan las condiciones de filtrado.</p>";
         document.getElementById("eventos").innerHTML = string;
        }
        }
    });
     
}

function suscribir(){
    
    var email = $("#Iemail").val();
    
    var data = "email="+email;
    
    $.ajax({
        url:"./UsuarioNoRegistrado/suscribir",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
                alert("Suscripción exitosa!");
            }else{
                alert("El email introducido ya esta suscrito");
            }
            
        }
    });
}

function eliminarSuscribir(){
    
    var email = $("#NIemail").val();
    
    var data = "email="+email;
    
    $.ajax({
        url:"./UsuarioNoRegistrado/eliminarSuscribir",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            if(resp == true){
                alert("La suscripción se eliminó correctamente.");
            }else{
                alert("El email intruducido no esta suscrito.");
            }
            
        }
    });
}

function autentificar(){
    
    var email = $("#email").val();
    var pass = $("#contrasena").val();
   
//    var data = "email= "+email+" &pass= "+pass;
 var data = { 

                "email" : email, 
                "pass" : pass 

        };
    
    $.ajax({
        url:"./UsuarioNoRegistrado/autenticar",
        type:"POST",
        data: data,
//        async : true,
//        cache: false,
        beforeSend: function() {
            
            console.log("enviando datos a DB");

        },
        success: function(resp) {
         
            if(resp== true){
                
                location.href= "./UsuarioRegistrado";
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