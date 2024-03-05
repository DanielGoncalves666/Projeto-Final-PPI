// --------------------------------------------------
// Modelo dos dados
// --------------------------------------------------

let Pessoa = {
    'Nome': '',
    group1: {
        'Nome': '',
        'Código': '',
        'Sexo': '',
        'Email': '',
        'Telefone': '',
    },
    group2: {
        'CEP': '',
        'Logradouro': '',
        'Cidade': '',
        'Estado': '',
    },
    group3: {}
}

let Endereco = {
    'CEP': '',
    group1: {
        'Logradouro': '',
        'Cidade': '',
        'Estado': '',
    }
}

let Agendamento = {
    'Data': '',
    'Horário': '',
    group1: {
        'Nome Paciente': '',
        'Sexo': '',
        'Email': '',
    },
    group2: {
        'Médico': '',
        'Código': '',
    }
}

let pacientes = [];
let funcionarios = [];
let enderecos = [];
let agendamentos = [];

// ----------------------------------------
// Geração de dados de teste
// ----------------------------------------

function generateDummyPessoa(i) {
    let p = Object.create(Pessoa)

    p['Nome'] = 'Fulano de Tal';
    p.group1 = {
        'Código': i,
        'Sexo': 'M',
        'Email': '2i8F3@example.com',
        'Telefone': '99999999',
    }

    p.group2 = {
        'CEP': '3333333',
        'Logradouro': 'Rua Fulano',
        'Cidade': 'Uberlândia',
        'Estado': 'MG',
    }
    
    return p
}

function generateDummyFunctionario(i, isMedico) {

    let p = generateDummyPessoa(i);
    p.group3 = {
        'Data de Contratação': '01/01/2000',
        'Salário': 10000.0,
    }

    if (isMedico)
    {
        p['Nome'] = 'Dr. ' + p['Nome'];
        p.group3['Especialidade'] = 'Dermatologia';
        p.group3['CRM'] = '1234567/MG';
    }

    return p
}

function generateDummyPaciente(i) {
    let p = generateDummyPessoa(i);

    p.group3['Peso'] = 70.0;
    p.group3['Altura'] = 1.70;
    p.group3['Tipo Sanguíneo'] = 'O';

    return p;
}

function generateDummyEndereco() {
    let e = Object.create(Endereco)

    e['CEP'] = '1111111';

    e.group1 = {
        'Logradouro': 'Rua Fulano',
        'Cidade': 'Uberlândia',
        'Estado': 'MG',
    }

    return e;
}

function generateDummyAgendamento(i) {
    let a = Object.create(Agendamento)

    a['Data'] = '01/01/2000';
    a['Horário'] = '08:00';

    a.group1 = {
        'Nome Paciente': 'Fulano de Tal',
        'Sexo': 'M',
        'Email': '2i8F3@example.com',
    }

    a.group2 = {
        'Médico': 'Dr. Fulano de Tal',
        'Código': i,
    }

    return a;
}

for (var i = 0; i < 10; i++)
{
    pacientes.push(generateDummyPaciente(i));
    funcionarios.push(generateDummyFunctionario(i+42, (i+42) % 2 == 0));
    enderecos.push(generateDummyEndereco());
    agendamentos.push(generateDummyAgendamento(i+42));
}

agendamentos.push(generateDummyAgendamento(42));

// -------------------------
// Funções para adicionar entradas na lista
// -------------------------

function addEntradaPessoa(pessoa) {
    let container_entradas = document.getElementById("entradas-listagem-container");
    let novaEntrada = document.createElement("div");
    novaEntrada.classList.add("entrada-listagem");

    let nome = document.createElement("b");
    nome.textContent = `Nome: ${pessoa['Nome']}`;
    novaEntrada.appendChild(nome);

    for (let i = 0; i < 3; i++)
    {
        // Check if group is an empty dictionary
        if (!pessoa[`group${i+1}`])
            continue;

        let grupoDiv = document.createElement("div");
        grupoDiv.classList.add('entrada-listagem-grupo');
        for (dadoKey in pessoa[`group${i+1}`]) {
            let p = document.createElement("p");
            p.textContent = `${dadoKey}: ` + pessoa[`group${i+1}`][dadoKey];
            grupoDiv.appendChild(p);
        }

        novaEntrada.appendChild(grupoDiv);
    }

    container_entradas.appendChild(novaEntrada)
}

function addEntradaEndereco(endereco) {
    let container_entradas = document.getElementById("entradas-listagem-container");
    let novaEntrada = document.createElement("div");
    novaEntrada.classList.add("entrada-listagem");

    let cep = document.createElement("b");
    cep.textContent = `CEP: ${endereco['CEP']}`;
    novaEntrada.appendChild(cep);

    let grupoDiv = document.createElement("div");
    grupoDiv.classList.add('entrada-listagem-grupo');

    for (dadoKey in endereco['group1']) {
        let p = document.createElement("p");
        p.textContent = `${dadoKey}: ` + endereco['group1'][dadoKey];
        grupoDiv.appendChild(p);
    }

    novaEntrada.appendChild(grupoDiv);

    container_entradas.appendChild(novaEntrada);
}

function addEntradaAgendamento(agenda, limitar) {
    let container_entradas = document.getElementById("entradas-listagem-container");
    let novaEntrada = document.createElement("div");
    novaEntrada.classList.add("entrada-listagem");

    let data_hora_nome = document.createElement("b");
    if (limitar)
        data_hora_nome.textContent = `${agenda.group1['Nome Paciente']} - ${agenda['Data']} às ${agenda['Horário']}`;
    else
        data_hora_nome.textContent = `${agenda.group2['Médico']} - ${agenda['Data']} às ${agenda['Horário']}`;

    novaEntrada.appendChild(data_hora_nome);

    let grupoDiv = document.createElement("div");
    grupoDiv.classList.add('entrada-listagem-grupo');

    for (dadoKey in agenda.group1) {
        let p = document.createElement("p");
        p.textContent = `${dadoKey}: ` + agenda.group1[dadoKey];
        grupoDiv.appendChild(p);
    }

    novaEntrada.appendChild(grupoDiv);

    grupoDiv = document.createElement("div");
    grupoDiv.classList.add('entrada-listagem-grupo');

    for (dadoKey in agenda.group2) {
        let p = document.createElement("p");
        p.textContent = `${dadoKey}: ` + agenda.group2[dadoKey];
        grupoDiv.appendChild(p);
    }

    novaEntrada.appendChild(grupoDiv);

    container_entradas.appendChild(novaEntrada);
}

/* ---------------------------- */
/* Funções para colocar dados no DOM */
/* ---------------------------- */

// Atualizar container de entradas
function displayFilter(index) {
    let container_entradas = document.getElementById("entradas-listagem-container");
    container_entradas.innerHTML = "";

    switch(index) {
    case 0:
        for (const f of funcionarios) {
            addEntradaPessoa(f);
        }
        break;
    case 1:
        for (const p of pacientes) {
            addEntradaPessoa(p);
        }
        break;
    case 2:
        for (const e of enderecos) {
            addEntradaEndereco(e);
        }
        break;
    case 3:
        for (const a of agendamentos) {
            addEntradaAgendamento(a, false);
        }
        break;
    case 4:
        let agendamentos_meus = agendamentos.filter(a => a.group2['Código'] == '42');
        for (const a of agendamentos_meus) {
            addEntradaAgendamento(a, true);
        }
    }
}

// Registrar função para atualizar display de entradas
let radioInputs = document.querySelectorAll('input[name="dadoTipo"]');

for (const radioInput of radioInputs) {
    radioInput.addEventListener('change', function(e) {
        let filterOptions = Array.from(document.querySelectorAll('input[name="dadoTipo"]'));
        let index = filterOptions.indexOf(e.target);
        // alert(index);

        displayFilter(index);
    })
}

// Carregar filtro inicial
let selected;
radioInputs.forEach(radioInput => {
    if (radioInput.checked)
        selected = radioInput;
})

displayFilter(Array.from(radioInputs).indexOf(selected));
