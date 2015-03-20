var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){
    
    $(function(){
        
     $("#galeria a").lightBox();   
    });
    
    //Cuando se pulsa en hacer favorito se obtiene el id del evento y se añade como favorito.
    $(".noFavorito").click(function(){
       
       var Id_evento = $("#detallesEvento .numeroEvento").attr("id");
       
       incluirFavorito(Id_evento);
       
        return false;  
    });
    
    //Cuando se pulsa en eliminar favorito se obtiene el id del evento y se elimina como favorito.
    $(".favorito").click(function(){
       
       var Id_evento = $("#detallesEvento .numeroEvento").attr("id");
     
       
       eliminarFavorito(Id_evento);
       
        return false;  
    });
    
    //Cuando se pulsa en asistir se obtiene el id del evento y se añade a los evento que el usuario asistirá.
    $("#aAsistir").click(function(){
       
       var Id_evento = $("#detallesEvento .numeroEvento").attr("id");
      
       
       indicarAsistencia(Id_evento);
       
        return false;  
    });
    
    //Cuando se pulsa en eliminar asistencia se obtiene el id del evento y se elimina la asistencia del usuario al evento.
    $("a#aAsistirBandera").click(function(){
       
       var Id_evento = $("#detallesEvento .numeroEvento").attr("id");
      
       eliminarAsistencia(Id_evento);
       
        return false;  
    });
    
    //Cuando se pulsa en comentar se obtiene el id del evento y se guarda el comentario.
    $("#formComentario").submit(function(){
       
       var Id_evento = $("#detallesEvento .numeroEvento").attr("id");
      
       guardarComentario(Id_evento);
       
       $("#miComentario").val("");
       
        return false;  
    });
});

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
                
                $(".noFavorito").parent().parent().hide();
                $(".favorito").parent().parent().fadeToggle(); 
                
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
                
                  $(".favorito").parent().parent().hide();
                  $(".noFavorito").parent().parent().fadeToggle();
                
            }else{
                
              alert("Error de acceso al servidor.");
                
                
            }
             
        }
    });
    
}

/**
* indicarAsistencia
*
* Se comunica con el controlador para añadir la asistencia del usuario al evento.
* @param {int} idEvento Identificador del evento.
*/
function indicarAsistencia(idEvento){
    
      var data = "idEvento="+idEvento;
    
    
    $.ajax({
        url:URL_BASE+"Administrador/indicarAsistencia/",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            
            if(resp == true){
                
                  $("#aAsistir").parent().hide();
                  $("#aAsistirBandera").parent().fadeToggle();
                
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
               
                   $("#aAsistirBandera").parent().hide();
                   $("#aAsistir").parent().fadeToggle();
                
            }else{
                
              alert("Error de acceso al servidor.");
                
                
            }
             
        }
    });
    
}

/**
* guardarComentario
*
* Obtiene los datos del nuevo comentario y se comunica con el controlador para añadirlo. 
* @param {int} idEvento Identificador del evento.
*/
function guardarComentario(idEvento){
    
    var texto =$("#miComentario").val();  
    
    var data = "idEvento="+idEvento+"&texto="+texto;
    
    
    $.ajax({
        url:URL_BASE+"Administrador/guardarComentario",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
          
            if(resp == true){
               
               alert("Comentario guardado correctamente.Este se publicará una vez que el propietario lo acepte. ");  
                
            }else{
                if(resp == 'Datos incompletos'){
                    alert("Campo incompleto");
                }else{
                
                     alert("Error de acceso al servidor.");
                 }   
                
            }
             
        }
    });
    
}