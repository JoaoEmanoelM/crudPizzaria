<?php
require_once(__DIR__ . '/../service/EntregadorService.php');

class EntregadorController {
    private $entregadorService;

    public function __construct() {
        $this->entregadorService = new EntregadorService();
    }

    public function listar() {
        return $this->entregadorService->listar();
    }

    public function salvar($entregador) {
        return $this->entregadorService->salvar($entregador);
    }

    public function excluir($id) {
        return $this->entregadorService->excluir($id);
    }
}
?>