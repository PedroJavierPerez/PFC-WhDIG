<?php

    class Modelo{
        
        function __construct() {
            $this->db = new ConexionMySQLi(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        }


    }

