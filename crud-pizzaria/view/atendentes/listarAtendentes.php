<?php
require_once(__DIR__ . "/../../controller/AtendenteController.php");
require_once(__DIR__ . "/../include/header.php");

$atendenteCont = new AtendenteController();
$lista = $atendenteCont->listar();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Atendentes - Pizzaria Vovô Alberto</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <main>
        <h3>Atendentes</h3>
        <div>
            <a href="../../index.php"><img src="../../img/botao-de-inicio.png" alt="Inicio"></a>
            ||
            <a href="formAtendente.php"><img src="../../img/adicionar-usuario.png" alt="criarAtendente"></a>            
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
                    <th>Ações</th>
                </tr>
                <?php foreach ($lista as $atendente): ?>
                    <tr>
                        <td><?= htmlspecialchars($atendente->getId()) ?></td>
                        <td><?= htmlspecialchars($atendente->getNome()) ?></td>
                        <td><?= htmlspecialchars($atendente->getEndereco()) ?></td>
                        <td><?= htmlspecialchars($atendente->getTelefone()) ?></td>
                        <td><?= htmlspecialchars($atendente->getSalarioBase()) ?></td>
                        <td><?= htmlspecialchars($atendente->getComissao()) ?></td>
                        <td>
                            <a href="formAtendente.php?id=<?= htmlspecialchars($atendente->getId()) ?>">
                                <img src="https://e7.pngegg.com/pngimages/461/1024/png-clipart-computer-icons-editing-edit-icon-cdr-angle-thumbnail.png" alt="Editar" style="max-width: 30px;">
                            </a>
                            <a href="excluirAtendente.php?id=<?= htmlspecialchars($atendente->getId()) ?>" onclick="return confirm('Tem certeza que deseja excluir este atendente?');">
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