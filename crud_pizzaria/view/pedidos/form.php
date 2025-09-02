<?php 

    require_once (__DIR__ . "/../../controller/SaborController.php");
    require_once (__DIR__ . "/../../controller/AtendenteController.php");
    require_once (__DIR__ . "/../../controller/EntregadorController.php");
    $saborCont = new saborController();
    $entregadorCont = new EntregadorController();
    $atendenteCont = new AtendenteController();

    $entregadores = $entregadorCont->listar();
    $atendentes = $atendenteCont->listar();
    $sabores = $saborCont->listar();

?>
    
    <form action="" method="post">

        <select name="qtdSabores" id="qtdSabores" onblur="criaSelectSabor()">
            <option value="">Selecione a quantidade de sabores</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>

        <br><br>

        <div id="campoSabores">
            
        </div>

        <br><br>

        <select name="tamanho" id="tamanho">
            <option value="">Selecione o tamanho da pizza</option>
            <option value="M">Média</option>
            <option value="G">Grande</option>
            <option value="X">Gigante</option>
            <option value="F">Família</option>
        </select>

        <br><br>

        <label for="endereco">Endereço para entrega:</label>
        <input type="text" name="endereco" placeholder="Número e rua">

        <br><br>

        <label for="telefoneCliente">Telefone para contato:</label>
        <input type="text" name="telefoneCliente" placeholder="(XX) 9XXXX-XXXX">

        <br><br>

        <select name="metodoPagamento" id="metodoPagamento">
            <option value="">Selecione o método de pagamento</option>
            <option value="D">Débito</option>
            <option value="C">Crédito</option>
            <option value="M">Dinheiro</option> <!-- utilizei M pra referenciar dinheiro (money) -->
            <option value="P">Pix</option>
        </select>

        <br><br>

       <select name="atendente" id="atendente">

            <option value="">Selecione o atendente que realizou o pedido:</option>

            <?php
            
            foreach($atendentes as $a): 
                
                echo "<option value='".$a->getId()."'>". $a->getNome() . "</option>";    
            
            endforeach

            ?>

       </select>

        <br><br>

       <select name="entregador" id="entregador">

            <option value="">Selecione o entregador que realizará a entrega:</option>

            <?php
            
            foreach($entregadores as $e): 
                
                echo "<option value='".$e->getId()."'>". $e->getNome() . "</option>";    
            
            endforeach

            ?>

       </select>
            
       <br><br>

       <input type="submit" value="Enviar">
    </form>

    <script>
        
        function criaSelectSabor() {
        
        let qtdSabores = document.querySelector('#qtdSabores').value;

        fetch("../../index.php?classe=Sabor&acao=criaSelectForm", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ "qtdSabores": qtdSabores })
        })
        .then(res => res.text())
        .then(html => {
            // Atualiza apenas o container específico
            const container = document.querySelector("#campoSabores");
            if (container) container.innerHTML = html;
        })
        .catch(erro => console.error("Erro ao criar campos:", erro));
    }

    </script>

</body>
</html>