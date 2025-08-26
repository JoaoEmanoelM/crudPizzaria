<?php

require_once(__DIR__ . "/../dao/PedidoDAO.php");
require_once(__DIR__ . "/../model/Pedido.php");
require_once(__DIR__ . "/../service/PedidoService.php");

class PedidoController {

    private PedidoDAO $pedidoDAO;
    private PedidoService $pedidoService;

    public function __construct() {
        $this->PedidoDAO = new PedidoDAO();
        $this->PedidoService = new PedidoService();        
    }

    public function listar() {
        $lista = $this->PedidoDAO->listar();
        return $lista;
    }

    public function buscarPorId(int $id) {
        $pedido = $this->PedidoDAO->buscarPorId($id);
        return $aluno;
    }

    public function inserir(Pedido $pedido) {
        $erros = $this->PedidoService->validarPedido($pedido);
        if(count($erros) > 0) 
            return $erros;
        
        $erro = $this->PedidoDAO->inserir($pedido);
        if($erro) {
            array_push($erros, "Erro ao salvar o aluno!");
            if(AMB_DEV)
                array_push($erros, $erro->getMessage());
        }

        return $erros;
    }



}