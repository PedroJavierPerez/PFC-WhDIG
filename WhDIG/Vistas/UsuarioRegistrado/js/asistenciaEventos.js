var URL_BASE = "http://localhost/PFC-WhDIG/WhDIG/";

$(document).ready(function(){
    
    
    $(".noFavorito").click(function(){
       
       var Id_evento = $(this).parents(".divArticle").attr("id");
       
       incluirFavorito(Id_evento);
       
        return false;  
    });
    
    $(".favorito").click(function(){
       
       var Id_evento = $(this).parents(".divArticle").attr("id");
     
       
       eliminarFavorito(Id_evento);
       
        return false;  
    });
    
//    $("#aAsistir").click(function(){
//       
//       var Id_evento = $(this).parents(".divArticle").attr("id");
//      
//       
//       indicarAsistencia(Id_evento);
//       
//        return false;  
//    });
    
    $("a#aAsistirBandera").click(function(){
       
       var Id_evento = $(this).parents(".divArticle").attr("id");
      
       eliminarAsistencia(Id_evento);
       
        return false;  
    });
    
    $("#eventos a.enlaceEvento").click(function(e){
        
        var Id_evento = $(this).attr("id");
       
        mostrarDetallesEvento(Id_evento);
        
        return false;
    });
    
   
});


function mostrarDetallesEvento(id_evento){
   location.href= URL_BASE+"UsuarioRegistrado/detallesEvento/"+id_evento;   
   
}

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
                
                $("div#"+idEvento+" .noFavorito").parent().parent().hide();
                $("div#"+idEvento+" .favorito").parent().parent().fadeToggle(); 
                
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
                
                  $("div#"+idEvento+" .favorito").parent().parent().hide();
                  $("div#"+idEvento+" .noFavorito").parent().parent().fadeToggle();
                
            }else{
                
              alert("Error de acceso al servidor.");
                
                
            }
             
        }
    });
    
}

//function indicarAsistencia(idEvento){
//    
//      var data = "idEvento="+idEvento;
//    
//    
//    $.ajax({
//        url:URL_BASE+"UsuarioRegistrado/indicarAsistencia/",
//        type:"POST",
//        data: data,
//        beforeSend: function() {
//            console.log("enviando datos a DB")
//        },
//        success: function(resp) {
//            
//            if(resp == true){
//                
//                  $("#aAsistir").parent().hide();
//                  $("#aAsistirBandera").parent().fadeToggle();
//                
//            }else{
//                
//              alert("Error de acceso al servidor.");
//                
//                
//            }
//             
//        }
//    });
//    
//}

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


function mostrarNoEventosAsistir(){
    
    string = "<div id=noEventosAsistir>\n\
                <p class='NoFiltro'>No existen eventos a los que vaya a asistir.</p>\n\
            </div>";
    
    document.getElementById("eventos").innerHTML = string;
}
    

