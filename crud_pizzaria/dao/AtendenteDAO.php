<?php
require_once(__DIR__ . '/../util/Connection.php');
require_once(__DIR__ . '/../model/Atendente.php');

class AtendenteDAO {
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();
    }

    public function listar() {
        $sql = "SELECT * FROM atendente ORDER BY nome";    
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);

        $atendentes= $this->map($resultado);
        return $atendentes;
    }

    public function map($resultado){

        $atendentes = array();

        foreach($resultado as $r){
            $atendente = new Atendente();
            $atendente->setId($r['id']);
            $atendente->setNome($r['nome']);
            $atendente->setEndereco($r['endereco']);
            $atendente->setTelefone($r['telefone']);
            $atendente->setSalarioBase($r['salarioBase']);
            $atendente->setComissao($r['comissao']);
            
            
            array_push($atendentes, $atendente);

        }

        return $atendentes;
    }
}
?>