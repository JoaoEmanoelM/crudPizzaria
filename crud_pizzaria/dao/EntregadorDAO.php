<?php
require_once(__DIR__ . '/../util/Connection.php');
require_once(__DIR__ . '/../model/Entregador.php');

class EntregadorDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getConnection();
    }

    public function listar() {
        $stmt = $this->conn->query("SELECT * FROM entregadors");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar(Entregador $entregador) {
        // TODO: implementar INSERT ou UPDATE
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM entregadors WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>