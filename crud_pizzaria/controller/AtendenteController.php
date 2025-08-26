<?php
require_once(__DIR__ . '/../service/AtendenteService.php');

class AtendenteController {
    private $atendenteService;

    public function __construct() {
        $this->atendenteService = new AtendenteService();
    }

    public function listar() {
        return $this->atendenteService->listar();
    }

    public function salvar($atendente) {
        return $this->atendenteService->salvar($atendente);
    }

    public function excluir($id) {
        return $this->atendenteService->excluir($id);
    }
}
?>