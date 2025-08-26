<?php
require_once(__DIR__ . '/../util/Connection.php');
require_once(__DIR__ . '/../model/Sabor.php');

class SaborDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getConnection();
    }

    public function listar() {
        $stmt = $this->conn->query("SELECT * FROM sabors");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar(Sabor $sabor) {
        // TODO: implementar INSERT ou UPDATE
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM sabors WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>