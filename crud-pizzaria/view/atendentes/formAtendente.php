<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../../controller/AtendenteController.php");
require_once(__DIR__ . "/../include/header.php");

$atendenteCont = new AtendenteController();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$atendente = $id ? $atendenteCont->buscarPorId($id) : new Atendente();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $atendente->setNome(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS));
    $atendente->setEndereco(filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS));
    $atendente->setTelefone(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS));
    $atendente->setSalarioBase(filter_input(INPUT_POST, 'salarioBase', FILTER_VALIDATE_FLOAT));
    $atendente->setComissao(filter_input(INPUT_POST, 'comissao', FILTER_VALIDATE_FLOAT));

    $erros = $atendenteCont->salvar($atendente);
    if (empty($erros)) {
        header("Location: listarAtendentes.php");
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
    <title><?= $id ? 'Alterar' : 'Criar' ?> Atendente - Pizzaria Vovô Alberto</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <main>
        <h3><?= $id ? 'Alterar' : 'Criar Novo' ?> Atendente</h3>

        <form action="" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($atendente->getNome() ?? '') ?>">

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" value="<?= htmlspecialchars($atendente->getEndereco() ?? '') ?>">

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?= htmlspecialchars($atendente->getTelefone() ?? '') ?>">

            <label for="salarioBase">Salário Base:</label>
            <input type="number" name="salarioBase" id="salarioBase" step="0.01" value="<?= htmlspecialchars($atendente->getSalarioBase() ?? '') ?>">

            <label for="comissao">Comissão:</label>
            <input type="number" name="comissao" id="comissao" step="0.01" value="<?= htmlspecialchars($atendente->getComissao() ?? '') ?>">

            <input type="submit" value="Salvar">
        </form>
    </main>
</body>
</html>

<?php include_once(__DIR__ . "/../include/footer.php"); ?>