<?php

require_once './Entidades/EntidadEvento.php';
require_once './Entidades/EntidadNegocio.php';

class Evento extends Controlador{
    
    
    function __construct() {
        parent::__construct();
    }
    
    function index(){}
    
    function detalles($id){
        $encontrado = $this->modelo->comprobarEvento($id);
        if($encontrado){
            $this->vista->detallesEvento = $this->cargarDetallesEvento($id);
            $this->vista->idEvento=$id;
            $this->vista->render($this,'detallesEventoUNR');
        }else{
           echo "No existe evento ".$id; 
        }
        }
   

    public function cargarDetallesEvento($id){
        
        $objetoEvento = $this->modelo->buscarDetallesEvento($id);
        
        $objetoEventoFormateado = $this->cambiarFechaHora($objetoEvento);
                
        return $objetoEventoFormateado[0];
    }


    


}

