<?php

require_once(__DIR__ . "/../util/Connection.php");
require_once(__DIR__ . "/../model/Pedido.php");
require_once(__DIR__ . "/../model/Atendente.php");
require_once(__DIR__ . "/../model/Entregador.php");
require_once(__DIR__ . "/../model/Sabor.php");

class PedidoDAO {

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();        
    }

    public function listar() {
        $sql = "SELECT p.*, 
                    a.nome nome_atendente, 
                    e.nome nome_entregador  
                FROM pedidos p
                    JOIN atendente a ON (a.id = p.id_atendente)
                    JOIN entregador e ON (e.id = p.id_entregador)
                ORDER BY p.id";
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->map($result);
    }

    public function buscarPorId(int $id) {
        $sql = "SELECT p.*, 
                    a.nome nome_atendente, 
                    e.nome nome_entregador, 
                    s.nome nome_sabor 
                FROM pedidos p
                    JOIN atendente a ON (a.id = p.id_atendente)
                    JOIN entregador e ON (e.id = p.id_entregador)
                    JOIN sabores s ON (s.id = p.id_sabor)
                WHERE p.id = ?";
        $stm = $this->conexao->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $pedidos = $this->map($result);

        if(count($pedidos) > 0)
            return $pedidos[0];
        else
            return NULL;
    }

    public function inserir(Pedido $pedido) {
        try {
            $sql = "INSERT INTO pedidos (sabor1, sabor2, sabor3, tamanho, endereco, telefoneCliente, metodoPagamento, id_atendente, id_entregador)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stm = $this->conexao->prepare($sql);
            $stm->execute([
                $pedido->getSabor1(),
                $pedido->getSabor2(),
                $pedido->getSabor3(),
                $pedido->getTamanho(),
                $pedido->getEndereco(),
                $pedido->getTelefoneCliente(),
                $pedido->getMetodoPagamento(),
                $pedido->getId_Atendente(),
                $pedido->getId_Entregador()
            ]);
            return NULL;
        } catch(PDOException $e) {
            return $e;
        }
    }

    private function map(array $result) {
        $pedidos = array();
        foreach($result as $r) {
            $pedido = new Pedido();
            $pedido->setId($r["id"]);
            $pedido->setSabor1($r["sabor1"]);
            $pedido->setSabor2($r["sabor2"]);
            $pedido->setSabor3($r["sabor3"]);
            $pedido->setTamanho($r["tamanho"]);
            $pedido->setEndereco($r["endereco"]);
            $pedido->setTelefoneCliente($r["telefoneCliente"]);
            $pedido->setMetodoPagamento($r["metodoPagamento"]);
            
            $atendente = new Atendente();
            $atendente->setId($r["id_atendente"]);
            $atendente->setNome($r["nome_atendente"]);
            $pedido->setAtendente($atendente);

            $entregador = new Entregador();
            $entregador->setId($r["id_entregador"]);
            $entregador->setNome($r["nome_entregador"]);
            $pedido->setEntregador($entregador);

            array_push($pedidos, $pedido);
        }
        return $pedidos;
    }

}