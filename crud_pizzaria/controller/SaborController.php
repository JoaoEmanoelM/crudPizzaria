<?php
require_once(__DIR__ . '/../service/SaborService.php');

class SaborController {
    private $saborService;

    public function __construct() {
        $this->saborService = new SaborService();
    }

    public function listar() {
        return $this->saborService->listar();
    }

    public function salvar($sabor) {
        return $this->saborService->salvar($sabor);
    }

    public function excluir($id) {
        return $this->saborService->excluir($id);
    }
}
?>