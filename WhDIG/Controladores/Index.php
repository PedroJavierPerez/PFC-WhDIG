<?php

    class Index extends Controlador{
        
        function __construct() {
            parent::__construct();
        }
        
        function index(){
            
            $this->vista->render($this,'index');
        }
    }

