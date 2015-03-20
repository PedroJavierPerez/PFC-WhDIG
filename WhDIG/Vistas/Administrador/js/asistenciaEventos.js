var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){
    
    //Cuando se pulsa en hacer favorito se obtiene el id del evento y se añade como favorito.
    $(".noFavorito").click(function(){
       
       var Id_evento = $(this).parents(".divArticle").attr("id");
       
       incluirFavorito(Id_evento);
       
        return false;  
    });
    
    
    //Cuando se pulsa en eliminar favorito se obtiene el id del evento y se elimina como favorito.
    $(".favorito").click(function(){
       
       var Id_evento = $(this).parents(".divArticle").attr("id");
     
       
       eliminarFavorito(Id_evento);
       
        return false;  
    });
    
    //Cuando se pulsa en eliminar sistencia se obtiene el id del evento y se elimina la asistencia.
    $("a#aAsistirBandera").click(function(){
       
       var Id_evento = $(this).parents(".divArticle").attr("id");
      
       eliminarAsistencia(Id_evento);
       
        return false;  
    });
    
    //Cuando se pulsa sobre un evento, se obtiene el id y mustra sus detalles.
    $("#eventos a.enlaceEvento").click(function(e){
        
        var Id_evento = $(this).attr("id");
       
        mostrarDetallesEvento(Id_evento);
        
        return false;
    });
    
   
});


/**
* mostrarDetallesEvento
*
* Se comunica con el controlador para redirigir a la página de detalles del evento seleccionado.
* @param {int} id_evento Identificador de evento
*/
function mostrarDetallesEvento(id_evento){
   location.href= URL_BASE+"Administrador/detallesEvento/"+id_evento;   
   
}

/**
* incluirFavorito
*
* Se comunica con el controlador para añadir el evento como uno de los favoritos del usuario.
* @param {int} idEvento Identificador del evento.
*/
function incluirFavorito(idEvento){
    
      var data = "idEvento="+idEvento;
    
    
    $.ajax({
        url:URL_BASE+"Administrador/incluirFavorito/",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
           
            if(resp == true){
                
                $("div#"+idEvento+" .noFavorito").parent().parent().hide();
                $("div#"+idEvento+" .favorito").parent().parent().fadeToggle(); 
                
            }else{
                
              alert("Error de acceso al servidor.");
                
                
            }
             
        }
    });
    
}

/**
* eliminarFavorito
*
* Se comunica con el controlador para eliminar el evento como favorito del usuario.
* @param {int} idEvento Identificador del evento.
*/
function eliminarFavorito(idEvento){
    
      var data = "idEvento="+idEvento;
    
    
    $.ajax({
        url:URL_BASE+"Administrador/eliminarFavorito/",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
                
                  $("div#"+idEvento+" .favorito").parent().parent().hide();
                  $("div#"+idEvento+" .noFavorito").parent().parent().fadeToggle();
                
            }else{
                
              alert("Error de acceso al servidor.");
                
                
            }
             
        }
    });
    
}

/**
* eliminarAsistencia
*
* Se comunica con el controlador para eliminar la asistencia del usuario al evento.
* @param {int} idEvento Identificador del evento.
*/
function eliminarAsistencia(idEvento){
    
      var data = "idEvento="+idEvento;
    
    
    $.ajax({
        url:URL_BASE+"Administrador/eliminarAsistencia",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
               
                   $("div#"+idEvento+".divArticle").parent().remove();
                   if($("div.divEvento").size()==0){
                       
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
    
    string = "<div id=noEventosAsistir>\n\
                <p class='NoFiltro'>No existen eventos a los que vaya a asistir.</p>\n\
            </div>";
    
    document.getElementById("eventos").innerHTML = string;
}
    

