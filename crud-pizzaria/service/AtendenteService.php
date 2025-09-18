<?php
require_once(__DIR__ . '/../dao/AtendenteDAO.php');

class AtendenteService {
    private $atendenteDAO;

    public function __construct() {
        $this->atendenteDAO = new AtendenteDAO();
    }

    public function listar() {
        return $this->atendenteDAO->listar();
    }

    public function salvar($atendente) {
        return $this->atendenteDAO->salvar($atendente);
    }

    public function excluir($id) {
        return $this->atendenteDAO->excluir($id);
    }
}
?>