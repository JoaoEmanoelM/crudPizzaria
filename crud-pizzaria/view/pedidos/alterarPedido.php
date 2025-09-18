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

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$pedido = $pedidoCont->buscarPorId($id);

if (!$pedido) {
    echo "<p class='error'>Pedido não encontrado!</p>";
    exit();
}

$qtdSabores = 1;
if ($pedido->getSabor3()) $qtdSabores = 3;
elseif ($pedido->getSabor2()) $qtdSabores = 2;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pedido->setSabor1(filter_input(INPUT_POST, 'sabor1', FILTER_VALIDATE_INT) ?: null);
    $pedido->setSabor2(filter_input(INPUT_POST, 'sabor2', FILTER_VALIDATE_INT) ?: null);
    $pedido->setSabor3(filter_input(INPUT_POST, 'sabor3', FILTER_VALIDATE_INT) ?: null);
    $tamanho = filter_input(INPUT_POST, 'tamanho', FILTER_SANITIZE_SPECIAL_CHARS);
    $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_SPECIAL_CHARS);
    $telefoneCliente = filter_input(INPUT_POST, 'telefoneCliente', FILTER_SANITIZE_SPECIAL_CHARS);
    $metodoPagamento = filter_input(INPUT_POST, 'metodoPagamento', FILTER_SANITIZE_SPECIAL_CHARS);
    $pedido->setTamanho($tamanho ? trim($tamanho) : null);
    $pedido->setEndereco($endereco ? trim($endereco) : null);
    $pedido->setTelefoneCliente($telefoneCliente ? trim($telefoneCliente) : null);
    $pedido->setMetodoPagamento($metodoPagamento ? trim($metodoPagamento) : null);
    $pedido->setId_Atendente(filter_input(INPUT_POST, 'atendente', FILTER_VALIDATE_INT) ?: null);
    $pedido->setId_Entregador(filter_input(INPUT_POST, 'entregador', FILTER_VALIDATE_INT) ?: null);

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
    if (!preg_match('/^\(\d{2}\) 9\d{4}-\d{4}$/', $pedido->getTelefoneCliente())) {
        $erros[] = "Telefone inválido! Use o formato (XX) 9XXXX-XXXX";
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
        $erros = $pedidoCont->alterar($pedido);
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
    <title>Alterar Pedido - Pizzaria Vovô Alberto</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <main>
        <h3>Alterar Pedido #<?= htmlspecialchars($pedido->getId()) ?></h3>

        <form action="" method="post">
            <label for="qtdSabores">Quantidade de Sabores:</label>
            <select name="qtdSabores" id="qtdSabores" onchange="criaSelectSabor()">
                <option value="">Selecione a quantidade de sabores</option>
                <option value="1" <?= $qtdSabores == 1 ? 'selected' : '' ?>>1</option>
                <option value="2" <?= $qtdSabores == 2 ? 'selected' : '' ?>>2</option>
                <option value="3" <?= $qtdSabores == 3 ? 'selected' : '' ?>>3</option>
            </select>

            <div id="campoSabores">
                <!-- Pre-filled flavors will be loaded via JS -->
            </div>

            <label for="tamanho">Tamanho da Pizza:</label>
            <select name="tamanho" id="tamanho">
                <option value="">Selecione o tamanho da pizza</option>
                <option value="M" <?= $pedido->getTamanho() == 'M' ? 'selected' : '' ?>>Média</option>
                <option value="G" <?= $pedido->getTamanho() == 'G' ? 'selected' : '' ?>>Grande</option>
                <option value="X" <?= $pedido->getTamanho() == 'X' ? 'selected' : '' ?>>Gigante</option>
                <option value="F" <?= $pedido->getTamanho() == 'F' ? 'selected' : '' ?>>Família</option>
            </select>

            <label for="endereco">Endereço para Entrega:</label>
            <input type="text" name="endereco" id="endereco" value="<?= htmlspecialchars($pedido->getEndereco()) ?>" placeholder="Número e rua">

            <label for="telefoneCliente">Telefone para Contato:</label>
            <input type="text" name="telefoneCliente" id="telefoneCliente" value="<?= htmlspecialchars($pedido->getTelefoneCliente()) ?>" placeholder="(XX) 9XXXX-XXXX">

            <label for="metodoPagamento">Método de Pagamento:</label>
            <select name="metodoPagamento" id="metodoPagamento">
                <option value="">Selecione o método de pagamento</option>
                <option value="D" <?= $pedido->getMetodoPagamento() == 'D' ? 'selected' : '' ?>>Débito</option>
                <option value="C" <?= $pedido->getMetodoPagamento() == 'C' ? 'selected' : '' ?>>Crédito</option>
                <option value="M" <?= $pedido->getMetodoPagamento() == 'M' ? 'selected' : '' ?>>Dinheiro</option>
                <option value="P" <?= $pedido->getMetodoPagamento() == 'P' ? 'selected' : '' ?>>Pix</option>
            </select>

            <label for="atendente">Atendente:</label>
            <select name="atendente" id="atendente">
                <option value="">Selecione o atendente</option>
                <?php foreach ($atendentes as $a): ?>
                    <option value="<?= $a->getId() ?>" <?= $pedido->getId_Atendente() == $a->getId() ? 'selected' : '' ?>><?= htmlspecialchars($a->getNome()) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="entregador">Entregador:</label>
            <select name="entregador" id="entregador">
                <option value="">Selecione o entregador</option>
                <?php foreach ($entregadores as $e): ?>
                    <option value="<?= $e->getId() ?>" <?= $pedido->getId_Entregador() == $e->getId() ? 'selected' : '' ?>><?= htmlspecialchars($e->getNome()) ?></option>
                <?php endforeach; ?>
            </select>

            <input type="submit" value="Atualizar Pedido">
        </form>
    </main>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            criaSelectSabor(true);
        });

        function criaSelectSabor(prefill = false) {
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
                    if (prefill) {
                        const existingSabors = [
                            <?= $pedido->getSabor1() ? "'{$pedido->getSabor1()}'" : 'null' ?>,
                            <?= $pedido->getSabor2() ? "'{$pedido->getSabor2()}'" : 'null' ?>,
                            <?= $pedido->getSabor3() ? "'{$pedido->getSabor3()}'" : 'null' ?>
                        ];
                        for (let i = 1; i <= numSabores; i++) {
                            const select = document.querySelector(`#sabor${i}`);
                            if (select && existingSabors[i-1]) {
                                select.value = existingSabors[i-1];
                            }
                        }
                    }
                } else {
                    console.error("Container #campoSabores not found in the DOM");
                }
            })
            .catch(error => {
                console.error("Erro ao criar campos de sabores:", error);
            });
        }
    </script>
</body>
</html>

<?php include_once(__DIR__ . "/../include/footer.php"); ?>