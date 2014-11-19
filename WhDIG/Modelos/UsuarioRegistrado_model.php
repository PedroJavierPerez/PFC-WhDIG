<?php


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
    
}

