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

    public function salvar(Atendente $atendente): array {
        $erros = $this->validarAtendente($atendente);
        if (count($erros) > 0) {
            return $erros;
        }

        $erro = $this->atendenteDAO->salvar($atendente);
        if ($erro) {
            $erros[] = "Erro ao salvar o atendente!";
            if (defined('AMB_DEV') && AMB_DEV) {
                $erros[] = $erro->getMessage();
            }
        }
        return $erros;
    }

    public function excluir(int $id): array {
        $erros = [];
        $erro = $this->atendenteDAO->excluir($id);
        if ($erro) {
            $erros[] = "Erro ao excluir o atendente!";
            if (defined('AMB_DEV') && AMB_DEV) {
                $erros[] = $erro->getMessage();
            }
        }
        return $erros;
    }

    private function validarAtendente(Atendente $atendente): array {
        $erros = [];
        if (empty($atendente->getNome())) $erros[] = "Nome é obrigatório!";
        return $erros;
    }

    public function buscarPorId(int $id): ?Atendente {
        return $this->atendenteDAO->buscarPorId($id);
    }
}
?>