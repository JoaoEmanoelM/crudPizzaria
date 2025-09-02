<?php
require_once(__DIR__ . '/../model/Atendente.php');
require_once(__DIR__ . '/../dao/AtendenteDAO.php');

class AtendenteController {
    private ?Atendente $atendente;
    private ?AtendenteDAO $atendenteDAO;

    public function __construct(){
        $this->atendente = new Atendente();
        $this->atendenteDAO = new AtendenteDAO();
    }

    public function listar(){

        return $this->atendenteDAO->listar();

    }


}
?>