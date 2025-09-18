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

    public function salvar(Entregador $entregador): array {
        $erros = $this->validarEntregador($entregador);
        if (count($erros) > 0) {
            return $erros;
        }

        $erro = $this->entregadorDAO->salvar($entregador);
        if ($erro) {
            $erros[] = "Erro ao salvar o entregador!";
            if (defined('AMB_DEV') && AMB_DEV) {
                $erros[] = $erro->getMessage();
            }
        }
        return $erros;
    }

    public function excluir(int $id): array {
        $erros = [];
        $erro = $this->entregadorDAO->excluir($id);
        if ($erro) {
            $erros[] = "Erro ao excluir o entregador!";
            if (defined('AMB_DEV') && AMB_DEV) {
                $erros[] = $erro->getMessage();
            }
        }
        return $erros;
    }

    private function validarEntregador(Entregador $entregador): array {
        $erros = [];
        if (empty($entregador->getNome())) $erros[] = "Nome é obrigatório!";
        return $erros;
    }

    public function buscarPorId(int $id): ?Entregador {
        return $this->entregadorDAO->buscarPorId($id);
    }
}
?>