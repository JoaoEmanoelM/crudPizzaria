<?php
require_once (__DIR__ . "/../../controller/SaborController.php");
require_once (__DIR__ . "/../../controller/AtendenteController.php");
require_once (__DIR__ . "/../../controller/EntregadorController.php");

$saborCont = new SaborController();
$entregadorCont = new EntregadorController();
$atendenteCont = new AtendenteController();

$entregadores = $entregadorCont->listar();
$atendentes = $atendenteCont->listar();
$sabores = $saborCont->listar();
?>
<h3><?= $id ? "Alterar Pedido #" . $pedido->getId() : "Criar Pedido"?></h3>
<form action="" method="post">
    <label for="qtdSabores">Quantidade de Sabores:</label>
    <select name="qtdSabores" id="qtdSabores" onload="criaSelectSabor()" onchange="criaSelectSabor()">
        <option value="">Selecione a quantidade de sabores</option>
        <option value="1" <?= isset($_POST['qtdSabores']) && $_POST['qtdSabores'] == 1 ? "selected": ""?>>1</option>
        <option value="2" <?= isset($_POST['qtdSabores']) && $_POST['qtdSabores'] == 2 ? "selected": ""?>>2</option>
        <option value="3" <?= isset($_POST['qtdSabores']) && $_POST['qtdSabores'] == 3 ? "selected": ""?>>3</option>
    </select>
    <div id="campoSabores"></div>
    <label for="tamanho">Tamanho da Pizza:</label>
    <select name="tamanho" id="tamanho">
        <option value="">Selecione o tamanho da pizza</option>
        <option value="M" <?= isset($_POST['tamanho']) && $_POST['tamanho'] == "M" ? "selected": ""?>>Média</option>
        <option value="G" <?= isset($_POST['tamanho']) && $_POST['tamanho'] == "G" ? "selected": ""?>>Grande</option>
        <option value="X" <?= isset($_POST['tamanho']) && $_POST['tamanho'] == "X" ? "selected": ""?>>Gigante</option>
        <option value="F" <?= isset($_POST['tamanho']) && $_POST['tamanho'] == "F" ? "selected": ""?>>Família</option>
    </select>
    <label for="endereco">Endereço para Entrega:</label>
    <input type="text" name="endereco" id="endereco" placeholder="Número e rua" value="<?= isset($_POST['endereco']) ? $_POST['endereco'] : null?>">
    <label for="telefoneCliente">Telefone para Contato:</label>
    <input type="tel" name="telefoneCliente" id="telefoneCliente" placeholder="(XX) 9XXXX-XXXX" maxlength="15" onkeyup="handlePhone(event)" value="<?= isset($_POST['telefoneCliente']) ? $_POST['telefoneCliente'] : null ?>">
    <label for="metodoPagamento">Método de Pagamento:</label>
    <select name="metodoPagamento" id="metodoPagamento">
        <option value="">Selecione o método de pagamento</option>
        <option value="D" <?= isset($_POST['metodoPagamento']) && $_POST['metodoPagamento'] == "D" ? "selected" : null ?>>Débito</option>
        <option value="C" <?= isset($_POST['metodoPagamento']) && $_POST['metodoPagamento'] == "C" ? "selected" : null ?>>Crédito</option>
        <option value="M" <?= isset($_POST['metodoPagamento']) && $_POST['metodoPagamento'] == "M" ? "selected" : null ?>>Dinheiro</option>
        <option value="P" <?= isset($_POST['metodoPagamento']) && $_POST['metodoPagamento'] == "P" ? "selected" : null ?>>Pix</option>
    </select>
    <label for="atendente">Atendente:</label>
    <select name="atendente" id="atendente">
        <option value="">Selecione o atendente</option>
        <?php foreach ($atendentes as $a): ?>
            <option value="<?= $a->getId() ?>" <?= isset($_POST['atendente']) ? "selected" : "" ?>><?= htmlspecialchars($a->getNome()) ?></option>
        <?php endforeach; ?>
    </select>
    <a href="../atendentes/formAtendente.php">Cadastrar Novo Atendente</a>
    <label for="entregador">Entregador:</label>
    <select name="entregador" id="entregador">
        <option value="">Selecione o entregador</option>
        <?php foreach ($entregadores as $e): ?>
            <option value="<?= $e->getId() ?>" <?= isset($_POST['entregador']) ? "selected" : "" ?> ><?= htmlspecialchars($e->getNome()) ?></option>
        <?php endforeach; ?>
    </select>
    <a href="../entregadores/formEntregador.php">Cadastrar Novo Entregador</a>
    <a href="../pedidos/listarPedidos.php"><button type="button">Voltar</button></a>
    <input type="submit" value="Enviar Pedido">
</form>
</main>
<script>
function criaSelectSabor() {
    const qtdSabores = document.querySelector('#qtdSabores').value;
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
const handlePhone = (event) => {
    let input = event.target
    input.value = phoneMask(input.value)
}
const phoneMask = (value) => {
    if (!value) return ""
    value = value.replace(/\D/g,'')
    value = value.replace(/(\d{2})(\d)/,"($1) $2")
    value = value.replace(/(\d)(\d{4})$/,"$1-$2")
    return value
}
</script>
</body>