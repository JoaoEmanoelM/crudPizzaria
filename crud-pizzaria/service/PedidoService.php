<?php

require_once(__DIR__ . "/../model/Pedido.php");

class PedidoService {

    public function validarPedido(Pedido $pedido) {
        $erros = array();

        if(! $pedido->getSabor1()) {
            array_push($erros, "Informe ao menos 1 sabor!");
        }

        if(! $pedido->getTamanho()) {
            array_push($erros, "Informe o tamanho da pizza!");
        }

        if(! $pedido->getEndereco()) {
            array_push($erros, "Informe o endereço da entrega!");
        }

        if(! $pedido->getTelefoneCliente()) {
            array_push($erros, "Informe um telefone de contato!");
        }

        if(! $pedido->getMetodoPagamento()) {
            array_push($erros, "Informe o método de pagamento!");
        }
        
        if(! $pedido->getId_atendente()) {
            array_push($erros, "Informe o atendente que realizou o pedido!");
        }

        return $erros;
    }
}