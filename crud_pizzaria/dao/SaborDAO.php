<?php
require_once(__DIR__ . '/../util/Connection.php');
require_once(__DIR__ . '/../model/Sabor.php');

class SaborDAO {

    private PDO $conexao;

    public function __construct() {
        $this->conexao = Connection::getConnection();
    }

    public function listar() {
        $sql = "SELECT * FROM sabores ORDER BY nome";    
        $stm = $this->conexao->prepare($sql);
        $stm->execute();
        $resultado = $stm->fetchAll();

        $sabores = $this->map($resultado);
        return $sabores;
    }

    public function map($resultado){

        $sabores = array();

        foreach($resultado as $r){
            $sabor = new Sabor();
            $sabor->setNome($r['nome']);
            
            array_push($sabores, $sabor);

        }

        return $sabores;
    }

}
?>