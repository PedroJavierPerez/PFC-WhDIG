var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){
    
    $("input#btnAceptarNegocio").click(function(){
  
      var Id_negocio = $(this).parent().parent().parent().attr("id");
     
      aceptarNegocio(Id_negocio);
       
        return false;  
    });
    
    
    $("input#btnRechazarNegocio").click(function(){
  
       var Id_negocio = $(this).parent().parent().parent().attr("id");
     
      rechazarNegocio(Id_negocio);
       
        return false;  
    });
    
    $("input#btnEnviarCorreo").click(function(){
      
      var Id_negocio = $(this).parent().parent().parent().attr("id");
      
      mostrarFormularioCorreo(Id_negocio);
       
        return false;  
    });
    
    $("input#btnCancelarCorreo").click(function(){
        
        var Id_negocio = $(this).parent().parent().parent().attr("id");
        
      ocultarFormularioCorreo(Id_negocio);
       
        return false;  
    });
    
    $("div#formCorreo form").submit(function(){
        
        var Id_negocio = $(this).parent().parent().attr("id");
         
      enviarCorreoInformativo(Id_negocio);
       
        return false;  
    });
    
//    $(window).resize(function(e) {
//  
//     controlarBotones();
//
//     });
    
    
});

function aceptarNegocio(Id_negocio){
    
     var data ="idNegocio="+Id_negocio;
    
    $.ajax({
        url:URL_BASE+"UsuarioRegistrado/aceptarNegocio",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
               
               $("article#"+Id_negocio).remove();
                   if($("article").size()==0){
                       
                       mostrarNoEventosAsistir();
                   }
                
            }else{
               
              alert("Error de acceso al servidor.");
           
                
            }
             
        }
    });    
}


function rechazarNegocio(Id_negocio){
    
     var data ="idNegocio="+Id_negocio;
    
    $.ajax({
        url:URL_BASE+"UsuarioRegistrado/rechazarNegocio",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
          
            if(resp == true){
               
                $("article#"+Id_negocio).remove();
                   if($("article").size()==0){
                       
                       mostrarNoEventosAsistir();
                   }
                
            }else{
               
              alert("Error de acceso al servidor.");
           
                
            }
             
        }
    });    
}

/**
* mostrarNoEventosAsistir
*
* En el caso de no existir eventos a los que el usuario vaya a asistir se muestra el mensaje.
*/
function mostrarNoEventosAsistir(){
    
    string = "<p class=titulo2 id=tituloNegociosAlta>Alta de negocios</p>\n <div id=noEventosAsistir>\n\
                <p class='NoFiltro'>No existen negocios para dar de alta.</p>\n\
            </div>";
    
    document.getElementById("eventos").innerHTML = string;
}


function mostrarFormularioCorreo(Id_negocio){
  
//     var viewportwidth = window.innerWidth;
     $("#"+Id_negocio+" div#formCorreo").fadeToggle();
     $("#"+Id_negocio+" #bot div.tdEnviarCorreo").hide();
//     if(viewportwidth <= 409){
//     $("#"+Id_negocio+" #bot div.tdCancelarCorreo").fadeToggle().css("display","block");
//     }else{
     $("#"+Id_negocio+" #bot div.tdCancelarCorreo").fadeToggle().css("display","inline");   
//     }
     $("#"+Id_negocio+" div#formCorreo #inp").val("");
     $("#"+Id_negocio+" div#formCorreo #textoCorreo").val("");
    
}

function ocultarFormularioCorreo(Id_negocio){
    
//    var viewportwidth = window.innerWidth;
      $("#"+Id_negocio+" div#formCorreo").hide();
      $("#"+Id_negocio+" #bot div.tdCancelarCorreo").hide();
//      if(viewportwidth <= 409){
//     $("#"+Id_negocio+" #bot div.tdEnviarCorreo").fadeToggle().css("display","block");
//     }else{
     $("#"+Id_negocio+" #bot div.tdEnviarCorreo").fadeToggle().css("display","inline");   
//     }
     
     
    
}

function enviarCorreoInformativo(Id_negocio){
    var email = $("#"+Id_negocio+" li a").attr("id");
    var asunto = $("#"+Id_negocio+" div#formCorreo #inp").val();
    var texto = $("#"+Id_negocio+" div#formCorreo #textoCorreo").val();
    
        var data ="email="+email+"&asunto="+asunto+"&texto="+texto;
    
    $.ajax({
        url:URL_BASE+"UsuarioRegistrado/enviarCorreoInformativo",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
                
               ocultarFormularioCorreo(Id_negocio);
                
                
                   }else{
               
              alert("Error de acceso al servidor.");
           
                
            }
             
        }
    });
    
    
}

