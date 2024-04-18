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
    <title>Cadastro de Pacientes</title>
  </head>
  <body>
    <header>
      <h1>Clínica MedComp</h1>
    </header>

    <nav>
      <a href="index.php">Home</a>
      <a href="cadastro_pacientes.php" id="atual">Cadastro de Pacientes</a>
      <a href="cadastro_funcionarios.php">Cadastro de Funcionários</a>
      <a href="listagem.php">Listagem de Dados</a>
      <a href="logout.php">Sair</a>
    </nav>

    <main>
      <div id="cadastro-form">
        <h2>Cadastrar Novo Paciente</h2>
        <form action="cadastrar_paciente.php" method="post">
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
            <input type="text" id="email" name="email" required class="longInput">
          </div>
  
          <div>
            <label for="tel">Telefone:</label>
            <input type="tel" id="tel" name="tel" required>
          </div>
  
          <div>
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" required>
          </div>
  
          <div>
            <label for="logradouro">Logradouro:</label>
            <input type="text" id="logradouro" name="logradouro" required class="longInput">
          </div>
  
          <div>
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required>
          </div>
  
          <div>
            <label for="estado">Estado:</label>
            <select id="estado" name="estado" required>
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
  
          <div>
            <label for="peso">Peso:</label>
            <input type="number" step="any" id="peso" name="peso" required>
          </div>
  
          <div>
            <label for="altura">Altura:</label>
            <input type="number" step="any" id="altura" name="altura" required>
          </div>
  
          <div> 
            <label for="tiposangue">Tipo Sanguíneo:</label>
            <select id="tiposangue" name="tiposangue" required>
              <option value="">Selecione</option>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
            </select>
          </div>
  
          <button type="submit">Cadastrar</button>
        </form>
      </div>
    </main>
    <footer>
      <address>Av. João Naves de Ávila, 2121 - Santa Mônica, Uberlândia - MG, 38408-100.</address>
    </footer>
  </body>
</html>
