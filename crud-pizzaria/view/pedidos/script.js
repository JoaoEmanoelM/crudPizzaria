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