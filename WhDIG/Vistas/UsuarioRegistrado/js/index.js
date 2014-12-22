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
    
 //Cuando se pulsa en el munu la opción mi cuenta se actualiza el contenido.
    $("#miCuenta").click(function(){
        cargarMenuMiCuenta();
        
        
        return false;
    });
    
    $("#eventos a").click(function(e){
        
        var Id_evento = $(this).attr("id");
       
        mostrarDetallesEvento(Id_evento);
        
        return false;
    });
    
    $("#eventoshoy a").click(function(e){
        
        var Id_evento = $(this).attr("id");
       
        mostrarDetallesEvento(Id_evento);
        
        return false;
    });

}); 


// FUNCIONES

function mostrarDetallesEvento(id_evento){
   location.href= URL_BASE+"UsuarioRegistrado/detallesEvento/"+id_evento;
    
   
}

function cambioProvincia(){
      var id1 = $('input[name=pro]').val();
        $("input[name=ciu]").val(null);
        document.getElementById("ciu").disabled = false;
       
       var data = "provincia="+id1;
       if(id1 != ''){
        $.ajax({
        url:URL_BASE+"UsuarioRegistrado/cargarLocalidadesProvincias",
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
            document.getElementById("ciu").disabled = false;
            document.getElementById("ciudad").innerHTML = string;
            }else{
                
               document.getElementById("ciu").disabled = true; 
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
        url:URL_BASE+"UsuarioRegistrado/filtrarEventos",
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

function cargarMenuMiCuenta(){
       
       location.href= URL_BASE+"UsuarioRegistrado/miCuenta";
        
}


function buscarDatosUsuario(){
    
        var email = leerCookie("username");
        var data = "email="+email;
    
    
    $.ajax({
        url:"./PHP/buscarDatosUsuario.php",
        type:"POST",
        data: data,
        beforeSend: function() {
            console.log("enviando datos a DB")
        },
        success: function(resp) {
            console.log("resp");
            
            if(resp==="True"){
                location.href= "./inicio.php";
            }else{
                
                alert(resp);
            }
             
        }
    });
    
}

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