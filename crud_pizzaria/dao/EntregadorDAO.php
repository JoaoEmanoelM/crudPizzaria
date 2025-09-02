<?php
require_once(__DIR__ . '/../util/Connection.php');
require_once(__DIR__ . '/../model/Entregador.php');

class EntregadorDAO {
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();
    }

    public function listar() {
        $sql = "SELECT * FROM entregador ORDER BY nome";    
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        $atendentes= $this->map($resultado);
        return $atendentes;
    }

    public function map($resultado){

        $entregadores = array();

        foreach($resultado as $r){
            $entregador = new Entregador();
            $entregador->setId($r['id']);
            $entregador->setNome($r['nome']);
            $entregador->setEndereco($r['endereco']);
            $entregador->setTelefone($r['telefone']);
            $entregador->setSalarioBase($r['salarioBase']);
            $entregador->setComissao($r['salarioBase']);
            $entregador->setPlacaMoto($r['placaMoto']);
            $entregador->setModeloMoto($r['modeloMoto']);
            
            
            array_push($entregadores, $entregador);

        }

        return $entregadores;
    }
}
?>