<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../controller/EntregadorController.php");
require_once(__DIR__ . "/../include/header.php");

$entregadorCont = new EntregadorController();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$entregador = $id ? $entregadorCont->buscarPorId($id) : new Entregador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entregador->setNome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
    $entregador->setEndereco(filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS));
    $entregador->setTelefone(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS));
    $entregador->setSalarioBase(filter_input(INPUT_POST, 'salarioBase', FILTER_VALIDATE_FLOAT));
    $entregador->setComissao(filter_input(INPUT_POST, 'comissao', FILTER_VALIDATE_FLOAT));
    $entregador->setPlacaMoto(filter_input(INPUT_POST, 'placaMoto', FILTER_SANITIZE_SPECIAL_CHARS));
    $entregador->setModeloMoto(filter_input(INPUT_POST, 'modeloMoto', FILTER_SANITIZE_SPECIAL_CHARS));

    $erros = $entregadorCont->salvar($entregador);
    if (empty($erros)) {
        header("Location: listarEntregadores.php");
        exit();
    }

    if (!empty($erros)) {
        echo "<div class='error'>";
        foreach ($erros as $erro) {
            echo "<p>" . htmlspecialchars($erro) . "</p>";
        }
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Alterar' : 'Criar' ?> Entregador - Pizzaria Vovô Alberto</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <main>
        <h3><?= $id ? 'Alterar' : 'Criar Novo' ?> Entregador</h3>

        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($entregador->getNome() ?? '') ?>">

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" value="<?= htmlspecialchars($entregador->getEndereco() ?? '') ?>">

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($entregador->getTelefone() ?? '') ?>">

            <label for="salarioBase">Salário Base:</label>
            <input type="number" name="salarioBase" id="salarioBase" step="0.01" value="<?= htmlspecialchars($entregador->getSalarioBase() ?? '') ?>">

            <label for="comissao">Comissão:</label>
            <input type="number" name="comissao" id="comissao" step="0.01" value="<?= htmlspecialchars($entregador->getComissao() ?? '') ?>">

            <label for="placaMoto">Placa da Moto:</label>
            <input type="text" name="placaMoto" id="placaMoto" value="<?= htmlspecialchars($entregador->getPlacaMoto() ?? '') ?>">

            <label for="modeloMoto">Modelo da Moto:</label>
            <input type="text" name="modeloMoto" id="modeloMoto" value="<?= htmlspecialchars($entregador->getModeloMoto() ?? '') ?>">

            <input type="submit" value="Salvar">
        </form>
    </main>
</body>
</html>

<?php include_once(__DIR__ . "/../include/footer.php"); ?>