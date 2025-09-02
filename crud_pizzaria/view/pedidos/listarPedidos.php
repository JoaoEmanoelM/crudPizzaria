<?php
    require_once(__DIR__ . "/../../controller/PedidoController.php");   


    $pedidoCont = new PedidoController();
    $lista = $pedidoCont->listar();

    include_once(__DIR__ . "/../include/header.php");
?>

<h3>Listagem de Alunos</h3> 

<div>
    <a href="criarPedido.php">Criar pedido</a>
</div>

<table border="1">
    <!-- Cabeçalho -->
    <tr>
        <th>ID</th>
        <th>Sabor 1</th>
        <th>Sabor 2</th>
        <th>Sabor 3</th>
        <th>Tamanho</th>
        <th>Endereço para entrega</th>
        <th>Contato</th>
        <th>Método de pagamento</th>
        <th>Atendente que realizou o pedido</th>
        <th>Entregador responsável pela entrega</th>

    </tr>

    <!-- Dados -->
    <?php foreach($lista as $pedido): ?>
        <tr>
            <td><?= $pedido->getId() ?></td>
            <td><?= $pedido->getSabor1() ?></td>
            <td><?= $pedido->getSabor1() ?></td>
            <td><?= $pedido->getSabor3() ?></td>
            <td><?= $pedido->getTamanho() ?></td>
            <td><?= $pedido->getEndereco() ?></td>
            <td><?= $pedido->getTelefoneCliente() ?></td>
            <td><?= $pedido->getMetodoPagamento() ?></td>
            <td><?= $pedido->getAtendente()->getNome() ?></td>
            <td><?= $pedido->getEntregador()->getNome() ?></td>
            <td>
                <a href="alterar.php?id=<?= $aluno->getId() ?>">
                    <img src="../../img/btn_editar.png">
                </a> 
            </td>
            <td></td>
        </tr>
    <?php endforeach; ?>


</table>

<?php
    //Incluir o footer
    include_once(__DIR__ . "/../include/footer.php");   
?>