///////////////////////////////////////////
// Funções para montar entradas na lista //
///////////////////////////////////////////

function addEntradaEndereco(endereco) {
    let container_entradas = document.getElementById("entradas-listagem-container");
    let novaEntrada = document.createElement("div");
    novaEntrada.classList.add("entrada-listagem");

    let cep = document.createElement("b");
    cep.textContent = `CEP: ${endereco.cep}`;
    novaEntrada.appendChild(cep);

    let grupoDiv = document.createElement("div");
    grupoDiv.classList.add('entrada-listagem-grupo');

    for (dadoKey of ["logradouro", "cidade", "estado"]) {
        let p = document.createElement("p");
        p.textContent = `${dadoKey}: ` + endereco[dadoKey];
        grupoDiv.appendChild(p);
    }

    novaEntrada.appendChild(grupoDiv);

    container_entradas.appendChild(novaEntrada);
}

////////////////////////////////////////
// Funções para colocar dados no DOM  //
////////////////////////////////////////

function displayFilter(index) {
    let container_entradas = document.getElementById("entradas-listagem-container");
    container_entradas.innerHTML = "";

    switch(index) {
    case 0:
        break;
    case 1:
        break;
    case 2:
        resgatarEnderecos()
            .then(enderecos => enderecos.forEach(addEntradaEndereco))
            .catch(e => console.error(e));
        break;
    case 3:
        break;
    case 4:
        break;
    }
}

let radioInputs = document.querySelectorAll('input[name="dadoTipo"]');

for (const radioInput of radioInputs) {
    radioInput.addEventListener('change', function(e) {
        let filterOptions = Array.from(document.querySelectorAll('input[name="dadoTipo"]'));
        let index = filterOptions.indexOf(e.target);
        // alert(index);

        displayFilter(index);
    })
}

let selected;
radioInputs.forEach(radioInput => {
    if (radioInput.checked)
        selected = radioInput;
})

displayFilter(Array.from(radioInputs).indexOf(selected));
