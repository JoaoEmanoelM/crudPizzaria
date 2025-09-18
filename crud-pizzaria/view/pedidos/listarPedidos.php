<?php
require_once(__DIR__ . "/../../controller/PedidoController.php");
require_once(__DIR__ . "/../include/header.php");

$pedidoCont = new PedidoController();
$lista = $pedidoCont->listar();

if (empty($lista)) {
    echo "<p class='error'>Nenhum pedido encontrado. Verifique se há registros na tabela 'pedidos' ou se a consulta está funcionando corretamente.</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Pedidos - Pizzaria Vovô Alberto</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <main>
        <h3>Pedidos Anteriores</h3>
        <div>
            <a href="criarPedido.php">Criar Novo Pedido</a> |
            <a href="../atendentes/listarAtendentes.php">Gerenciar Atendentes</a> |
            <a href="../entregadores/listarEntregadores.php">Gerenciar Entregadores</a>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Sabor 1</th>
                    <th>Sabor 2</th>
                    <th>Sabor 3</th>
                    <th>Tamanho</th>
                    <th>Endereço para Entrega</th>
                    <th>Contato</th>
                    <th>Método de Pagamento</th>
                    <th>Atendente</th>
                    <th>Entregador</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($lista as $pedido): ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido->getId()) ?></td>
                        <td><?= htmlspecialchars($pedido->getSabor1() ?? '-') ?></td>
                        <td><?= htmlspecialchars($pedido->getSabor2() ?? '-') ?></td>
                        <td><?= htmlspecialchars($pedido->getSabor3() ?? '-') ?></td>
                        <td><?= htmlspecialchars($pedido->getTamanho()) ?></td>
                        <td><?= htmlspecialchars($pedido->getEndereco()) ?></td>
                        <td><?= htmlspecialchars($pedido->getTelefoneCliente()) ?></td>
                        <td><?= htmlspecialchars($pedido->getMetodoPagamento()) ?></td>
                        <td><?= htmlspecialchars($pedido->getAtendente()->getNome()) ?></td>
                        <td><?= htmlspecialchars($pedido->getEntregador()->getNome()) ?></td>
                        <td>
                            <a href="alterarPedido.php?id=<?= htmlspecialchars($pedido->getId()) ?>">
                                <img src="https://e7.pngegg.com/pngimages/461/1024/png-clipart-computer-icons-editing-edit-icon-cdr-angle-thumbnail.png" alt="Editar">
                            </a>
                            <a href="excluirPedido.php?id=<?= htmlspecialchars($pedido->getId()) ?>" onclick="return confirm('Tem certeza que deseja excluir este pedido?');">
                                <img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt="Excluir" style="max-width: 30px;">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
</body>
</html>

<?php include_once(__DIR__ . "/../include/footer.php"); ?>