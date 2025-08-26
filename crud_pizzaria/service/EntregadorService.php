<?php
require_once(__DIR__ . '/../dao/EntregadorDAO.php');

class EntregadorService {
    private $entregadorDAO;

    public function __construct() {
        $this->entregadorDAO = new EntregadorDAO();
    }

    public function listar() {
        return $this->entregadorDAO->listar();
    }

    public function salvar($entregador) {
        return $this->entregadorDAO->salvar($entregador);
    }

    public function excluir($id) {
        return $this->entregadorDAO->excluir($id);
    }
}
?>