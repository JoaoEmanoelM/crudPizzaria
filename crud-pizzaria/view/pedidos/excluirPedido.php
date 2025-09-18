<?php
require_once(__DIR__ . "/../../controller/PedidoController.php");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$pedidoCont = new PedidoController();

if ($id) {
    $erros = $pedidoCont->excluir($id);
    if (empty($erros)) {
        header("Location: listarPedidos.php");
        exit();
    } else {
        echo "<p class='error'>Erro ao excluir: " . implode(", ", $erros) . "</p>";
    }
} else {
    echo "<p class='error'>ID inválido!</p>";
}
?>