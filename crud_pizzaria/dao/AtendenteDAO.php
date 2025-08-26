<?php
require_once(__DIR__ . '/../util/Connection.php');
require_once(__DIR__ . '/../model/Atendente.php');

class AtendenteDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getConnection();
    }

    public function listar() {
        $stmt = $this->conn->query("SELECT * FROM atendentes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar(Atendente $atendente) {
        // TODO: implementar INSERT ou UPDATE
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM atendentes WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>