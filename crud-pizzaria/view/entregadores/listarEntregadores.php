<?php
require_once(__DIR__ . "/../../controller/EntregadorController.php");
require_once(__DIR__ . "/../include/header.php");

$entregadorCont = new EntregadorController();
$lista = $entregadorCont->listar();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Entregadores - Pizzaria Vovô Alberto</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <main>
        <h3>Entregadores</h3>
        <div>
            <a href="formEntregador.php">Criar Novo Entregador</a>
        </div>
        <div class="table-container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Salário Base</th>
                    <th>Comissão</th>
                    <th>Placa Moto</th>
                    <th>Modelo Moto</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($lista as $entregador): ?>
                    <tr>
                        <td><?= htmlspecialchars($entregador->getId()) ?></td>
                        <td><?= htmlspecialchars($entregador->getNome()) ?></td>
                        <td><?= htmlspecialchars($entregador->getEndereco()) ?></td>
                        <td><?= htmlspecialchars($entregador->getTelefone()) ?></td>
                        <td><?= htmlspecialchars($entregador->getSalarioBase()) ?></td>
                        <td><?= htmlspecialchars($entregador->getComissao()) ?></td>
                        <td><?= htmlspecialchars($entregador->getPlacaMoto()) ?></td>
                        <td><?= htmlspecialchars($entregador->getModeloMoto()) ?></td>
                        <td>
                            <a href="formEntregador.php?id=<?= htmlspecialchars($entregador->getId()) ?>">
                                <img src="https://e7.pngegg.com/pngimages/461/1024/png-clipart-computer-icons-editing-edit-icon-cdr-angle-thumbnail.png" alt="Editar">
                            </a>
                            <a href="excluirEntregador.php?id=<?= htmlspecialchars($entregador->getId()) ?>" onclick="return confirm('Tem certeza que deseja excluir este entregador?');">
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