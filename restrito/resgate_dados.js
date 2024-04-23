async function resgatarEndereco(cep) {
    try {
        let response = await fetch("get_cep.php?cep=" + cep);
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
        let response = await fetch("get_cep.php");
        if (!response.ok) throw new Error(response.statusText);
        let enderecos = await response.json();
        return enderecos;
    }
    catch (e) {
        console.error(e);
        return;
    }
}

async function resgatarFuncionarios() {
    try {
        let response = await fetch("get_pessoa.php?tipo=funcionario");
        if (!response.ok) throw new Error(response.statusText);
        let funcionarios = await response.json();
        return funcionarios;
    }
    catch (e) {
        console.error(e);
    }
}

async function resgatarPacientes() {
    try {
        let response = await fetch("get_pessoa.php?tipo=paciente");
        if (!response.ok) throw new Error(response.statusText);
        let pacientes = await response.json();
        return pacientes;
    }
    catch (e) {
        console.error(e);
    }
}

async function resgatarAgendamentos(){
    try{
        let response = await fetch("get_agendamentos.php");
        if(!response.ok) throw new Error(response.statusText);
        let agendamentos = await response.json();

        return agendamentos;
    }
    catch (e)
    {
        console.error(e);
    }
}

async function resgatarMeusAgendamentos(){
    try{
        let response = await fetch("get_agendamentos.php?meu=sim");
        if(!response.ok) throw new Error(response.statusText);
        let meusAgendamentos = await response.json();

        return meusAgendamentos;
    }
    catch(e)
    {
        console.error(e);
    }
}