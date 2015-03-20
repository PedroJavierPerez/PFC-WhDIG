<?php
require_once './Entidades/EntidadEstadisticasEvento.php';
require_once './Entidades/EntidadComentario.php';
require_once './Entidades/EntidadDetallesEvento.php';


class UsuarioRegistrado_model extends ModeloUsuario{
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
    * buscarUsuario
    *
    * Busca el usuario con el email dado.
    *
    * @param String $email Email del usuario.
    * @return EntidadUsuarioRegistrado Usuario que coincide con el email.
    */
    public function buscarUsuario($email){
        
        $usuario = $this->db->select("*","usuario","Email = '".$email."'");
        if(isset($usuario)){
            $objetoUsuario = new EntidadUsuarioRegistrado($usuario[0]);
            return $objetoUsuario;
        }
    }
    
    /**
    * modificarDatosUsuario
    *
    * Modifica los datos de un usuario registrado.
    *
    * @param Array<String> $datosUsuario
    * @return Boolean Indica si se modificó correctamente el usuario.
    */
    public function modificarDatosUsuario($datosUsuario){
        
       return $this->db->update("usuario",$datosUsuario,"Email = '".$datosUsuario["Email"]."'");
        
    }
    
    /**
    * eliminarCuentaUsuario
    *
    * Elimina la cuenta de un usuario.
    *
    * @param Array<String> $usuario Email y contraseña del usuario.
    * @return Boolean Indica si se eliminó la cuenta correctamente.
    */
    public function eliminarCuentaUsuario($usuario) {
        
        $where = "Email = '".$usuario["Email"]."' AND Contrasena='".$usuario["Contrasena"]."'";
        return $this->db->delete("usuario",$where,True);
        
    }
    
    /**
    * buscarDetallesEvento
    *
    * Busca los detalles de un evento pasado el identificador.
    *
    * @param int $id Identificador del evento.
    * @return Array<EntidadEvento> Array con un solo evento.
    */
     public function buscarDetallesEvento($id){
         
       $evento = $this->db->select("*","evento","Id_evento = '".$id."' ORDER BY Id_evento DESC");
       
       $objetosEvento[]=$this->crearObjetoEvento($evento[0]);
       
       return $objetosEvento;
     }
    
     /**
    * buscarEventosHoy
    *
    * Obtiene los eventos que coinciden con la fecha actual.
    *
    * @return Array<EntidadEvento> Eventos que coinciden con la fecha actual.
    */
     public function buscarEventosHoy() {
         
         $dateAtual= date("Y-m-d");
         $eventos = $this->db->select("*","evento","Fecha = '".$dateAtual."' ORDER BY Hora");
       
       if(isset($eventos)){
           foreach ($eventos as $evento) {
             
               
               $arrayEventos[] = $this->crearObjetoEvento($evento);    
         
           }
         return $arrayEventos;
       }
     }
     
     /**
    * buscarEvento
    *
    * Busca el evento al que pertenece el identificador.
    *
    * @param int $idEvento Identificador del evento.
    * @return EntidadEvento Evento al que pertenece el identificador.
    */
     public function buscarEvento($idEvento) {
         $evento = $this->db->select("*","evento","Id_evento = '".$idEvento."'");
         return $this->crearObjetoEvento($evento[0]);
         
     }
     
     /**
    * buscarComentariosEvento
    *
    * Obtiene los comentarios que pertenecen a un evento y estan aceptados por el propietario.
    *
    * @param int $idEvento Identificador del evento.
    * @return Array<EntidadComentario> Comentarios pertenecientes al evento.
    */
     public function buscarComentariosEvento($idEvento) {
         
         $where = "Id_evento = '".$idEvento."' AND Aceptado = '1' ORDER BY Id_comentario DESC";
         $comentarios = $this->db->select("*","comentario",$where);
         
         if(isset($comentarios)){
           foreach ($comentarios as $comentario) {
             $objetoComentario = new EntidadComentario($comentario);
             $objetoUsuario = $this->buscarUsuario($comentario["Email"]);
             if(isset($objetoUsuario)){
                 $objetoEvento = $this->buscarEvento($idEvento);
                 $objetoComentario->cambiarEvento($objetoEvento);
                 $objetoComentario->cambiarUsuario($objetoUsuario);
                 $objetosComentarios[]=$objetoComentario;
             }
           }        
          return $objetosComentarios;
         
         }else{
             return NULL;
         }
     }
     
     /**
    * comprobarUsuarioEvento
    *
    * Comprueba que un usuario ya tiene relación con un evento en la DB.
    *
    * @param Array<String> $usuarioEvento Email del usuario e identificador de evento.
    * @return Boolean Indica si hay relación entre usuario y evento.
    */
     public function comprobarUsuarioEvento($usuarioEvento) {
         
         $where = "Id_evento = '".$usuarioEvento["Id_evento"]."' AND Email = '".$usuarioEvento["Email"]."'";
         return $this->db->check("Email","evento_usuario",$where,True);
         
     }
     
     /**
    * modificarAsistencia
    *
    * Modifica la asistencia de un usuario a un evento.
    *
    * @param Array<String> Email, Identificador evento y aistencia.
    * @param Boolean $bandera Indica si ya existe relación entre email y evento.
    * @return Boolean Indica si se modificó la asistencia correctamente.
    */
     public function modificarAsistencia($usuarioEvento,$bandera = False) {
         
         if($bandera == False){
            $asistencia["Asistir"] = $usuarioEvento["Asistir"];
            $where = "Email = '".$usuarioEvento["Email"]."' AND Id_evento = '".$usuarioEvento["Id_evento"]."'";
            return $this->db->update("evento_usuario",$asistencia,$where);
         }else{
             return $this->db->insert("evento_usuario",$usuarioEvento);
         }
     }
     
     /**
    * modificarFavorito
    *
    * Modifica la opción favorito de un usuario a un evento.
    *
    * @param Array<String> Email, Identificador evento y favorito.
    * @param Boolean $bandera Indica si ya existe relación entre email y evento.
    * @return Boolean Indica si se modificó la opción favorito correctamente.
    */
      public function modificarFavorito($usuarioEvento,$bandera = False) {
         
         if($bandera == False){
             $favorito["Favorito"] = $usuarioEvento["Favorito"];
             $where = "Email = '".$usuarioEvento["Email"]."' AND Id_evento = '".$usuarioEvento["Id_evento"]."'";
             return $this->db->update("evento_usuario",$favorito,$where);
         }else{
             return $this->db->insert("evento_usuario",$usuarioEvento);
         }
     }
     
      /**
    * incluirNuevoComentario
    *
    * Incluye un nuevo comentario.
    *
    * @param Array<String> Datos del nuevo evento.
    * @return Boolean Indica si el comentario se añadió correctamente.
    */
     public function incluirNuevoComentario($datosComentario) {
         
          return $this->db->insert("comentario",$datosComentario);
         
     }
     
      /**
    * buscarDetallesEventosUsuarioAsistir
    *
    * Obtiene los identificadores de los eventos a los que el usuario tiene activa la opción asistir.
    *
    * @param String $email Email del usuario.
    * @return Array<String> Identificadores de los eventos a los que el usuario tiene activa la opción asistir.
    */
     public function buscarDetallesEventosUsuarioAsistir($email) {
         
         return $this->db->select("*","evento_usuario","Email = '".$email."' AND Asistir = '1'");
              
     }
     
       /**
    * buscarEventosAsistir
    *
    * Obtiene los eventos a los que el usuario tiene activa la opción asistir.
    *
    * @param String $where Condición para la busqueda en la DB.
    * @return Array<EntidadEvento> Eventos con la opción asistir activa por parte del usuaio.
    */
     public function buscarEventosAsistir($where) {
         
         $eventos = $this->db->select("*","evento",$where);
         
         if (isset($eventos)) {
             
            foreach ($eventos as $evento) {
             
               
               $arrayEventos[] = $this->crearObjetoEvento($evento);    
         
            }
            return $arrayEventos;
         
         }  else {
             return null;
         }
     }
     
       /**
    * crearObjetoEvento
    *
    * Crea un objeto de tipo evento.
    *
    * @param Array<String> $evento Datos del evento.
    * @return EntidadEvento Objeto evento.
    */
     public function crearObjetoEvento($evento) {
         
       $objetoEvento = new EntidadEvento($evento);
       $negocio = $this->buscarNegocio($evento["Id_negocio"]);
       $objetoNegocio = $this->crearObjetoNegocio($negocio[0]);
       $objetoEvento->cambiarNegocio($objetoNegocio);
       $estadisticas = $this->buscarEstadisticas($evento["Id_estadisticas"]);
       $objetoEstadisticas = new EntidadEstadisticasEvento($estadisticas[0]);
       $objetoEvento->cambiarEstadisticas($objetoEstadisticas);
       $detallesEventoUsuario = $this->buscarDetallesEventoUsuario($evento["Id_evento"],$_SESSION["email"]);
       
       if(isset($detallesEventoUsuario)){
           $objetodetallesEventoUsuario = new EntidadDetallesEvento($detallesEventoUsuario[0]);
       }else{
           $detallesEventoUsuario["Favorito"]=0;
           $detallesEventoUsuario["Asistir"]=0;
           $objetodetallesEventoUsuario = new EntidadDetallesEvento($detallesEventoUsuario);   
       }
           $objetoEvento->cambiarDetallesEventoUsuario($objetodetallesEventoUsuario);
           return $objetoEvento;
     }
     
        /**
    * crearObjetoNegocio
    *
    * Crea un objeto de tipo negocio.
    *
    * @param Array<String> $negocio Datos del evento.
    * @return EntidadNegocio Objeto negocio.
    */
     public function crearObjetoNegocio($negocio) {
         
         $propietario =  $this->buscarUsuario($negocio["Email"]);
         $objetoNegocio = new EntidadNegocio($negocio);
         $objetoNegocio->cambiarPropietario($propietario);
         return $objetoNegocio;
     }
     
       /**
    * modificarEstadisticasEvento
    *
    * Modifica las estadisticas de un evento.
    *
    * @param String $datosEstadisticas datos nuevos de las estadistcas de un evento.
    * @param EntidadEvento $evento Objeto evento al que se modifican la estadisticas.
    * @return Boolean Indica si las estadisticas se modificaron correctamente.
    */
     public function modificarEstadisticasEvento($datosEstadisticas, $evento) {
         
         $where = "Id_estadisticas = '".$evento->obtenerEstadisticas()->obtenerIdEstadisticas()."'";
         return $this->db->update("estadisticas",$datosEstadisticas,$where);
         
         
     }
     
       /**
    * buscarDetallesEventoUsuario
    *
    * Obtiene los detalles de un usuario con un evento(Favorito/asistir).
    *
    * @param int $id_evento Identificador del evento.
    * @param String $email Email del usuario. 
    * @return Array<String> Datos de iteración del usuario con el evento.
    */
      public function buscarDetallesEventoUsuario($id_evento,$email) {
         
         return $this->db->select("*","evento_usuario","Email = '".$email."' AND Id_evento = '".$id_evento."'");
              
     }
     
     /**
    * comprobarUsuario
    *
    * Comprueba que esiste un usuario registrado con un email y contraseña.
    *
    * @param Array<String> $usuario email y contraseña del usuario.
    * @param Boolean $completo Indica si se pasara $usuario como arreglo o se formara el String de condición.
    * @return Boolean Indica si existe el usuario.
    */
    public function comprobarUsuario($usuario,$completo = False){
        
        if($completo){
            
            $where= "Email = '".$usuario["Email"]."' AND Contrasena = '".$usuario["Contrasena"]."'";
            return $this->db->check("Email","usuario",$where,True);
       
        }else{
           return $this->db->check("Email","usuario",$usuario); 
        }
    }
    
    /**
    * modificarContrasenaUsuario
    *
    * Modifica la contraseña del usuario.
    *
    * @param String $email Email del usuario.
    * @param String $contrasena Nueva contraseña
    * @return Boolean Indica si la contraseña se modifico correctamente.
    */
    public function modificarContrasenaUsuario($email,$contrasena){
        
        $datos["Contrasena"]=$contrasena;
        return $this->db->update("usuario",$datos,"Email = '".$email."'");
    }
    
}

