<?php

    class Modelo{
        
        function __construct() {
            $this->db = new ConexionMySQLi(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }

          function buscarNegocio($where, $completo = false){
        
        if($completo == false){
       return $this->db->select("*","negocio","Id_negocio = '".$where."'");
        }else{
          return $this->db->select("*","negocio",$where);  
        }
    }
        
        
    }

