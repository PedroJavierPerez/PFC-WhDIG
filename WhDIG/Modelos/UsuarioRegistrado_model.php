<?php
require_once './Entidades/EntidadEstadisticasEvento.php';
require_once './Entidades/EntidadComentario.php';
require_once './Entidades/EntidadDetallesEvento.php';


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
       
       $objetosEvento[]=$this->crearObjetoEvento($evento[0]);
       
       return $objetosEvento;
     }
    
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
     
     public function buscarEvento($idEvento) {
         $evento = $this->db->select("*","evento","Id_evento = '".$idEvento."'");
         return $this->crearObjetoEvento($evento[0]);
         
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
     
     public function incluirNuevoComentario($datosComentario) {
         
          return $this->db->insert("comentario",$datosComentario);
         
     }
     
     public function buscarDetallesEventosUsuarioAsistir($email) {
         
         return $this->db->select("*","evento_usuario","Email = '".$email."' AND Asistir = '1'");
              
     }
     
     
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
     
     
     public function crearObjetoEvento($evento) {
         
       $objetoEvento = new EntidadEvento($evento);
       $negocio = $this->buscarNegocio($evento["Id_negocio"]);
       $objetoNegocio = new EntidadNegocio($negocio[0]);
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
     
     
     public function modificarEstadisticasEvento($datosEstadisticas, $evento) {
         
         $where = "Id_estadisticas = '".$evento->obtenerEstadisticas()->obtenerIdEstadisticas()."'";
         return $this->db->update("estadisticas",$datosEstadisticas,$where);
         
         
     }
     
      public function buscarDetallesEventoUsuario($id_evento,$email) {
         
         return $this->db->select("*","evento_usuario","Email = '".$email."' AND Id_evento = '".$id_evento."'");
              
     }
     
    
}

