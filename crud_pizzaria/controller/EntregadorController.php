<?php
require_once(__DIR__ . '/../model/Entregador.php');
require_once(__DIR__ . '/../dao/EntregadorDAO.php');

class EntregadorController {
    private ?Entregador $entregador;
    private ?EntregadorDAO $entregadorDAO;

    public function __construct(){
        $this->entregador = new Entregador();
        $this->entregadorDAO = new EntregadorDAO();
    }

    public function listar(){

        return $this->entregadorDAO->listar();

    }


}
?>