var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){
    
    $(function(){
        
     $("#galeria a").lightBox();   
    });
    
    $(".noFavorito").click(function(){
       
       var Id_evento = $("#detallesEvento .numeroEvento").attr("id");
       
       incluirFavorito(Id_evento);
       
        return false;  
    });
    
    $(".favorito").click(function(){
       
       var Id_evento = $("#detallesEvento .numeroEvento").attr("id");
     
       
       eliminarFavorito(Id_evento);
       
        return false;  
    });
    
    $("#aAsistir").click(function(){
       
       var Id_evento = $("#detallesEvento .numeroEvento").attr("id");
      
       
       indicarAsistencia(Id_evento);
       
        return false;  
    });
    
    $("#aAsistirBandera").click(function(){
       
       var Id_evento = $("#detallesEvento .numeroEvento").attr("id");
      
       eliminarAsistencia(Id_evento);
       
        return false;  
    });
});


function incluirFavorito(idEvento){
    
      var data = "idEvento="+idEvento;
    
    
    $.ajax({
        url:URL_BASE+"UsuarioRegistrado/incluirFavorito/",
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

function eliminarFavorito(idEvento){
    
      var data = "idEvento="+idEvento;
    
    
    $.ajax({
        url:URL_BASE+"UsuarioRegistrado/eliminarFavorito/",
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

function indicarAsistencia(idEvento){
    
      var data = "idEvento="+idEvento;
    
    
    $.ajax({
        url:URL_BASE+"UsuarioRegistrado/indicarAsistencia/",
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

function eliminarAsistencia(idEvento){
    
      var data = "idEvento="+idEvento;
    
    
    $.ajax({
        url:URL_BASE+"UsuarioRegistrado/eliminarAsistencia",
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