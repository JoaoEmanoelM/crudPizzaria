<?php
require_once(__DIR__ . "/../../controller/PedidoController.php");
require_once(__DIR__ . "/../../controller/SaborController.php");
require_once(__DIR__ . "/../../controller/AtendenteController.php");
require_once(__DIR__ . "/../../controller/EntregadorController.php");
require_once(__DIR__ . "/../include/header.php");

$saborCont = new SaborController();
$entregadorCont = new EntregadorController();
$atendenteCont = new AtendenteController();
$pedidoCont = new PedidoController();

$entregadores = $entregadorCont->listar();
$atendentes = $atendenteCont->listar();
$sabores = $saborCont->listar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pedido = new Pedido();
    $pedido->setSabor1(isset($_POST['sabor1']) && is_numeric($_POST['sabor1']) ? (int)$_POST['sabor1'] : null);
    $pedido->setSabor2(isset($_POST['sabor2']) && is_numeric($_POST['sabor2']) ? (int)$_POST['sabor2'] : null);
    $pedido->setSabor3(isset($_POST['sabor3']) && is_numeric($_POST['sabor3']) ? (int)$_POST['sabor3'] : null);
    $tamanho = isset($_POST['tamanho']) ? htmlspecialchars(trim($_POST['tamanho'])) : null;
    $endereco = isset($_POST['endereco']) ? htmlspecialchars(trim($_POST['endereco'])) : null;
    $telefoneCliente = isset($_POST['telefoneCliente']) ? htmlspecialchars(trim($_POST['telefoneCliente'])) : null;
    $metodoPagamento = isset($_POST['metodoPagamento']) ? htmlspecialchars(trim($_POST['metodoPagamento'])) : null;
    $pedido->setTamanho($tamanho);
    $pedido->setEndereco($endereco);
    $pedido->setTelefoneCliente($telefoneCliente);
    $pedido->setMetodoPagamento($metodoPagamento);
    $pedido->setId_Atendente(isset($_POST['atendente']) && is_numeric($_POST['atendente']) ? (int)$_POST['atendente'] : null);
    $pedido->setId_Entregador(isset($_POST['entregador']) && is_numeric($_POST['entregador']) ? (int)$_POST['entregador'] : null);

    $erros = [];
    if (!$pedido->getSabor1()) {
        $erros[] = "Selecione pelo menos um sabor!";
    }
    if (!in_array($pedido->getTamanho(), ['M', 'G', 'X', 'F'], true)) {
        $erros[] = "Tamanho inválido!";
    }
    if (empty($pedido->getEndereco())) {
        $erros[] = "Endereço é obrigatório!";
    }
    if (!in_array($pedido->getMetodoPagamento(), ['D', 'C', 'M', 'P'], true)) {
        $erros[] = "Método de pagamento inválido!";
    }
    if (!$pedido->getId_Atendente()) {
        $erros[] = "Selecione um atendente!";
    }
    if (!$pedido->getId_Entregador()) {
        $erros[] = "Selecione um entregador!";
    }

    if (empty($erros)) {
        $erros = $pedidoCont->inserir($pedido);
        if (empty($erros)) {
            header("Location: listarPedidos.php");
            exit();
        }
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
    <title>Criar Pedido - Pizzaria Vovô Alberto</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <main>
        <h3>Criar Novo Pedido</h3>

        <form action="" method="post">
            <label for="qtdSabores">Quantidade de Sabores:</label>
            <select name="qtdSabores" id="qtdSabores" onchange="criaSelectSabor()">
                <option value="">Selecione a quantidade de sabores</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>

            <div id="campoSabores"></div>

            <label for="tamanho">Tamanho da Pizza:</label>
            <select name="tamanho" id="tamanho">
                <option value="">Selecione o tamanho da pizza</option>
                <option value="M">Média</option>
                <option value="G">Grande</option>
                <option value="X">Gigante</option>
                <option value="F">Família</option>
            </select>

            <label for="endereco">Endereço para Entrega:</label>
            <input type="text" name="endereco" id="endereco" placeholder="Número e rua">

            <label for="telefoneCliente">Telefone para Contato:</label>
            <input type="text" name="telefoneCliente" id="telefoneCliente" placeholder="(XX) 9XXXX-XXXX">

            <label for="metodoPagamento">Método de Pagamento:</label>
            <select name="metodoPagamento" id="metodoPagamento">
                <option value="">Selecione o método de pagamento</option>
                <option value="D">Débito</option>
                <option value="C">Crédito</option>
                <option value="M">Dinheiro</option>
                <option value="P">Pix</option>
            </select>

            <label for="atendente">Atendente:</label>
            <select name="atendente" id="atendente">
                <option value="">Selecione o atendente</option>
                <?php foreach ($atendentes as $a): ?>
                    <option value="<?= $a->getId() ?>"><?= htmlspecialchars($a->getNome()) ?></option>
                <?php endforeach; ?>
            </select>
            <a href="formAtendente.php">Cadastrar Novo Atendente</a>

            <label for="entregador">Entregador:</label>
            <select name="entregador" id="entregador">
                <option value="">Selecione o entregador</option>
                <?php foreach ($entregadores as $e): ?>
                    <option value="<?= $e->getId() ?>"><?= htmlspecialchars($e->getNome()) ?></option>
                <?php endforeach; ?>
            </select>
            <a href="formEntregador.php">Cadastrar Novo Entregador</a>

            <input type="submit" value="Enviar Pedido">
        </form>
    </main>

    <script>
        function criaSelectSabor() {
            const qtdSabores = parseInt(document.querySelector('#qtdSabores').value, 10) || 1;
            const numSabores = Math.max(1, qtdSabores);

            fetch("../../index.php?classe=Sabor&acao=criaSelectForm", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "text/html"
                },
                body: JSON.stringify({ qtdSabores: numSabores })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status} ${response.statusText}`);
                }
                return response.text();
            })
            .then(html => {
                const container = document.querySelector("#campoSabores");
                if (container) {
                    container.innerHTML = html;
                } else {
                    console.error("Container #campoSabores not found in the DOM");
                    alert("Erro: Contêiner para sabores não encontrado.");
                }
            })
            .catch(error => {
                console.error("Erro ao criar campos de sabores:", error);
                alert(`Falha ao carregar os sabores: ${error.message}. Verifique a conexão com o servidor.`);
            });
        }
    </script>
</body>
</html>

<?php include_once(__DIR__ . "/../include/footer.php"); ?>