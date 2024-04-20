async function resgatarEndereco(cep) {
    try {
        let response = await fetch("../get_cep.php?cep=" + cep);
        if (!response.ok) throw new Error(response.statusText);
        let endereco = await response.json();
        return endereco;
    }
    catch (e) {
        console.error(e);
        return;
    }
}

async function resgatarEnderecos() {
    try {
        let response = await fetch("../get_cep.php");
        if (!response.ok) throw new Error(response.statusText);
        let enderecos = await response.json();
        return enderecos;
    }
    catch (e) {
        console.error(e);
        return;
    }
}
