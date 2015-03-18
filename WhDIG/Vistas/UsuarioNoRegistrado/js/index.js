var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";


$(document).ready(function(){
 
 regurlaPorcentajeSectionEventos();
 
 $(window).resize(function(e) {
  
 regurlaPorcentajeSectionEventos();
 
 });
 
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
        
        return false;
    });
    
 //Obtiene el valor del imput eliminar suscribir y permite eliminar la suscripción del usuario.
    $("#formEliminarSuscribir").submit(function(){ 
        eliminarSuscribir();
        $("#NIemail").val("");
        return false;
    });
    
 //Cuando se pulsa un evento se muestran los detalles de ese evento.
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
    
  //Cuando se pulsa en el input registrarse se redirige a esta página.Para moviles
    $("#btnRegistrarse").click(function(){
        
      location.href= URL_BASE+"UsuarioNoRegistrado/registrarse/";
    });
    
   //Cuando se pulsa en el input registrarse se redirige a esta página. 
    $("#btnRegistrarseForm").click(function(){
        
      location.href= URL_BASE+"UsuarioNoRegistrado/registrarse/";
    });

    //Cuando se pulsa en el numero de pagina cambia el color del numero y muestra la nueva página.
    $(" #eventos #divPag a").click(function(e){
        
        var numPag = $(this).attr("id");
       
        cambiarPagina(numPag);
        
        return false;
    });
    
    var numPag = $("#divPag").attr("class");
    if(document.getElementById("divPag")){
    document.getElementById(numPag).style.color = '#FF0000';
    }
}); 


// FUNCIONES

/**
* cambiarPagina
*
* Se comunica con el controlador para redirigir a la página de eventos seleccionada.
* @param {int} numPag Numero de página seleccionado.
*/
function cambiarPagina(numPag){
//    numPag = (Id_evento -1) * 2;
    
      location.href= URL_BASE+"UsuarioNoRegistrado/index/"+numPag;
    
}

/**
* mostrarDetallesEvento
*
* Se comunica con el controlador para redirigir a la página de detalles del evento seleccionado.
* @param {int} id_evento Identificador de evento.
*/
function mostrarDetallesEvento(id_evento){
   location.href= URL_BASE+"UsuarioNoRegistrado/detalles/"+id_evento;
    
   
}


/**
* cambioProvincia
*
* Obtiene la provincia seleccionada y se comunica con el controlador para buscar las localidades de esta.
* Modifica estas en la vista
*/
function cambioProvincia(){
      var id1 = $('input[name=pro]').val();
        $("input[name=ciu]").val('');
       document.getElementById("ciud").disabled = false;
       
       var data = "provincia="+id1;
       
       if(id1 != ''){
        $.ajax({
        url:URL_BASE+"UsuarioNoRegistrado/cargarLocalidadesProvincias/",
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

/**
* opcionesFiltrado
*
* Obtiene las opciones de filtrado y se comunica con el controlador para buscar los eventos que cumplen estas.
* Modifica estas en la vista.
*/
function opcionesFiltrado(){
    var fechaI = $("#fechaInicio").val();
    var fechaF = $("#fechaFin").val();
    var provincia = $('input[name=pro]').val();
    var municipio = $('input[name=ciu]').val();
    var tipo = $('input[name=tip]').val();
    var local = $('input[name=loc]').val();
    
    if((fechaI === '')&&(fechaF === '')&&(provincia === '')&&(municipio === '')&&(tipo === '')&&(local === '')){
        location.href= URL_BASE+"UsuarioRegistrado";
    }
    
    var data = { 

                "fechaI" : fechaI, 
                "fechaF" : fechaF,
                "provincia" : provincia,
                "municipio" : municipio,
                "tipo" : tipo,
                "local" : local

        };
    
        $.ajax({
        url:URL_BASE+"UsuarioNoRegistrado/filtrarEventos",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp === "Fecha no valida"){
                alert("Formato de la fecha no válido.");
            }else{
            var eventos = eval(resp);
            
            var string = '';
            
            if(eventos != "false"){
                
            for(var i in eventos){
                
           var des = eventos[i].descripcion;
           var desString = des.toString();
           var subDesString = desString.substring(0, 297);
           string += "<a id='"+eventos[i].id+"' href='UsuarioNoRegistrado/detalles/"+eventos[i].id+"'><article>\n\
                <hgroup><h4 class='titulo'>"+eventos[i].nombre+" ("+eventos[i].provincia+")</h4></hgroup>\n\
                <p>\n\
                <ul>\n\
                <li>"+subDesString+"...</li>\n\
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
    }
    });
     
}

/**
* suscribir
*
* Obtiene el email del usuario y se comunica con el controlador para realizar la suscripción de este.
* Muestra el mensaje que corresponda.
*/
function suscribir(){
    
    var email = $("#Iemail").val();
    
    var data = "email="+email;
    
    $.ajax({
        url:URL_BASE+"UsuarioNoRegistrado/suscribir",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
                alert("En breve recibirá un email para confirmar la suscripción.");
                $("#Iemail").val("");
            }else{
                if(resp == 'email no valido'){
                    alert("El email no es válido");
                }else{
                    if(resp == false){
                         alert("El email introducido ya esta suscrito");
                         $("#Iemail").val("");
                    }else{
                        alert("Error de acceso al servidor.");
                    }
            }
            }
            
        }
    });
}

/**
* eliminarSuscribir
*
* Obtiene el email del usuario y se comunica con el controlador para realizar la eliminación de la suscripción de este.
* Muestra el mensaje que corresponda.
*/
function eliminarSuscribir(){
    
    var email = $("#NIemail").val();
    
    var data = "email="+email;
    
    $.ajax({
        url:URL_BASE+"UsuarioNoRegistrado/confirmarEliminarSuscripcion",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            if(resp == true){
                alert("En breve recibirá un email para eliminar la suscripción.");
            }else{
                if( resp== false){
                alert("El email intruducido no esta suscrito.");
            }else{
                alert("Error al eliminar suscripción");
            }
            }
            
        }
    });
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

/**
* regurlaPorcentajeSectionEventos
*
* Al cambiar el tamaño de la página se recalcula el tamaño de la section eventos en funcion del tamaño del aside.
*/
function regurlaPorcentajeSectionEventos(){
    
    var anchoWrap = $("#wrap").innerWidth();
    var anchoAside = $("aside").outerWidth(true);
    var viewportwidth = window.innerWidth;
    
     if(viewportwidth > 768){
         var PorAside = (anchoAside * 100)/anchoWrap;
         var PorEventos = 100- PorAside-0.6;

         $("#eventos").css("width",+PorEventos+"%");
    }else{
        $("#eventos").css("width","100%");
    }
}

