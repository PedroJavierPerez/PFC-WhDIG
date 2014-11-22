<?php
require_once './Entidades/EntidadEstadisticasEvento.php';
require_once './Entidades/EntidadComentario.php';

class UsuarioRegistrado_model extends Modelo{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function buscarUsuario($email){
        
        $usuario = $this->db->select("*","usuario","Email = '".$email."'");
        $objetoUsuario = new EntidadUsuarioRegistrado($usuario[0]);
        return $objetoUsuario;
        
    }
    
    public function modificarDatosUsuario($datosUsuario){
        
       return $this->db->update("usuario",$datosUsuario,"Email = '".$datosUsuario["Email"]."'");
        
    }
    
    public function eliminarCuentaUsuario($usuario) {
        
        $where = "Email = '".$usuario["Email"]."' AND Contrasena='".$usuario["Contrasena"]."'";
        return $this->db->delete("usuario",$where,True);
        
    }
    
     public function buscarDetallesEvento($id){
         
         $evento = $this->db->select("*","evento","Id_evento = '".$id."' ORDER BY Id_evento DESC");
       
      
       $objetoEvento = new EntidadEvento($evento[0]);
       $negocio = $this->buscarNegocio($evento[0]["Id_negocio"]);
       $estadisticas = $this->buscarEstadisticas($evento[0]["Id_estadisticas"]);
       $objetoEstadistica = new EntidadEstadisticasEvento($estadisticas[0]);
       $objetoNegocio = new EntidadNegocio($negocio[0]);
       $objetoEvento->cambiarNegocio($objetoNegocio);
       $objetoEvento->cambiarEstadisticas($objetoEstadistica);
       $objetosEvento[]=$objetoEvento;
       
       return $objetosEvento;
     }
    
     
     public function buscarEvento($idEvento) {
         $evento = $this->db->select("*","evento","Id_evento = '".$idEvento."'");
         $objetoEvento = new EntidadEvento($evento[0]);
         return $objetoEvento;
     }
     
     public function buscarComentariosEvento($idEvento) {
         
         $where = "Id_evento = '".$idEvento."' AND Aceptado = '1' ORDER BY Id_comentario DESC";
         $comentarios = $this->db->select("*","comentario",$where);
         
         if(isset($comentarios)){
         foreach ($comentarios as $comentario) {
             $objetoComentario = new EntidadComentario($comentario);
             $objetoUsuario = $this->buscarUsuario($comentario["Email"]);
             $objetoEvento = $this->buscarEvento($idEvento);
             $objetoComentario->cambiarEvento($objetoEvento);
             $objetoComentario->cambiarUsuario($objetoUsuario);
             $objetosComentarios[]=$objetoComentario;
         }        
         return $objetosComentarios;
         
         }else{
             return NULL;
         }
     }
     
     
     public function comprobarUsuarioEvento($usuarioEvento) {
         
         $where = "Id_evento = '".$usuarioEvento["Id_evento"]."' AND Email = '".$usuarioEvento["Email"]."'";
         return $this->db->check("Email","evento_usuario",$where,True);
         
     }
     
     public function modificarAsistencia($usuarioEvento,$bandera = False) {
         
         if($bandera == False){
         $asistencia["Asistir"] = $usuarioEvento["Asistir"];
         $where = "Email = '".$usuarioEvento["Email"]."' AND Id_evento = '".$usuarioEvento["Id_evento"]."'";
         return $this->db->update("evento_usuario",$asistencia,$where);
         }else{
             return $this->db->insert("evento_usuario",$usuarioEvento);
         }
     }
     
     
      public function modificarFavorito($usuarioEvento,$bandera = False) {
         
         if($bandera == False){
         $favorito["Favorito"] = $usuarioEvento["Favorito"];
         $where = "Email = '".$usuarioEvento["Email"]."' AND Id_evento = '".$usuarioEvento["Id_evento"]."'";
         return $this->db->update("evento_usuario",$favorito,$where);
         }else{
             return $this->db->insert("evento_usuario",$usuarioEvento);
         }
     }
     
}

