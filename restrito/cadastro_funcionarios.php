<?php
  require "../conexaoMySQL.php";
  require "session_verification.php";  
    
    session_start();
    exitWhenNotLoggedIn();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./restrito.css">
    <title>Cadastro de Funcionários</title>
  </head>
  <body>
    <header>
      <h1>Clínica MedComp</h1>
    </header>

    <nav>
      <a href="index.php">Home</a>
      <a href="cadastro_pacientes.php">Cadastro de Pacientes</a>
      <a href="cadastro_funcionarios.php" id="atual">Cadastro de Funcionários</a>
      <a href="listagem.php">Listagem de Dados</a>
      <a href="logout.php">Sair</a>
    </nav>

    <main>
      <div id="cadastro-form">
        <h2>Cadastrar Novo Funcionário</h2>
        <form action="cadastro_sql.php" method="post">
          <input type="hidden" name="tipo" value="funcionario">
          <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required class="longInput">
          </div>
  
          <div>
            <label for="sexo">Sexo:</label>
            <div>
              <input type="radio" id="masculino" name="sexo" value="Masculino" checked>
              <label for="masculino">Masculino</label>
              <input type="radio" id="feminino" name="sexo" value="Feminino">
              <label for="feminino">Feminino</label>
            </div>
          </div>
  
          <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required class="longInput">
          </div>
  
          <div>
            <label for="tel">Telefone:</label>
            <input type="tel" id="tel" name="tel" required>
          </div>
  
          <div>
            <label for="dataContrato">Data de Contrato:</label>
            <input type="date" id="dataContrato" name="dataContrato">
          </div>
  
          <div>
            <label for="salario">Salário:</label>
            <input type="number" id="salario" name="salario">
          </div>
  
          <div>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha">
          </div>
  
          <div>
            <label for="medico">Medico:</label>
            <input type="checkbox" id="medico" name="medico">
          </div>
  
          <div>      
            <label for="especialidade">Especialidade:</label>
            <input type="text" id="especialidade" name="especialidade">
          </div>
  
          <div>
            <label for="crm">CRM:</label>
            <input type="text" id="crm" name="crm" pattern="[0-9]{6}/[A-Z]{2}">
          </div>
  
          <div>
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" required>
          </div>
  
          <div>
            <label for="rua">Logradouro:</label>
            <input type="text" id="rua" name="rua" required class="longInput">
          </div>
  
          <div>
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required>
          </div>
  
          <div>
            <label for="estado">Estado:</label>
            <select id="estado" name="estado">
              <option value="">Selecione</option>
              <option value="AC">AC</option>
              <option value="AL">AL</option>
              <option value="AM">AM</option>
              <option value="AP">AP</option>
              <option value="BA">BA</option>
              <option value="CE">CE</option>
              <option value="DF">DF</option>
              <option value="ES">ES</option>
              <option value="GO">GO</option>
              <option value="MA">MA</option>
              <option value="MG">MG</option>
              <option value="MS">MS</option>
              <option value="MT">MT</option>
              <option value="PA">PA</option>
              <option value="PB">PB</option>
              <option value="PE">PE</option>
              <option value="PI">PI</option>
              <option value="PR">PR</option>
              <option value="RJ">RJ</option>
              <option value="RN">RN</option>
              <option value="RO">RO</option>
              <option value="RR">RR</option>
              <option value="RS">RS</option>
              <option value="SC">SC</option>
              <option value="SE">SE</option>
              <option value="SP">SP</option>
              <option value="TO">TO</option>
            </select>
          </div>
  
          <button type="submit">Cadastrar</button>
        </form>

      </div>
    </main>
    <footer>
      <address>Av. João Naves de Ávila, 2121 - Santa Mônica, Uberlândia - MG, 38408-100.</address>
    </footer>

    <script src="./resgate_dados.js"></script>
    <script>
      var cepRegex = /^\d{5}-?\d{3}$/;
      document.addEventListener("DOMContentLoaded", function() {
          let form = document.querySelector("form");
          document.getElementById("cep").addEventListener("keyup", function() {
              let cep = document.getElementById("cep").value;
              if (cepRegex.test(cep))
              {
                  resgatarEndereco(cep)
                      .then(endereco => {
                        if (endereco === false) throw new Error("Endereço não existe na base de dados");
                        form.rua.value = endereco.logradouro;
                        form.cidade.value = endereco.cidade;
                        form.estado.value = endereco.estado;
                      })
                      .catch(erro => {
                        form.rua.value    = '';
                        form.cidade.value = '';
                        form.estado.value = '';
                      });
              }
          })

          function toggleMedicFields(event) {
              let especialidade = document.getElementById("especialidade").parentNode;
              let crm = document.getElementById("crm").parentNode;
              if (event.target.checked) {
                  especialidade.style.display = "flex";
                  crm.style.display = "flex";
              }
              else {
                  especialidade.style.display = "none";
                  crm.style.display = "none";
              }
          }

          document.getElementById("medico").addEventListener("change", toggleMedicFields);

          toggleMedicFields({ target: {checked: false }});
      });
    </script>
  </body>
</html>
