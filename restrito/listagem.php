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
    <script src="./resgate_dados.js" defer></script>
    <script src="./listagem.js" defer></script>
    <link rel="stylesheet" href="./restrito.css">
    <title>Listagem</title>
  </head>
  <body>
    <header>
      <h1>Clínica MedComp</h1>
    </header>

    <nav>
      <a href="index.php">Home</a>
      <a href="cadastro_pacientes.php">Cadastro de Pacientes</a>
      <a href="cadastro_funcionarios.php">Cadastro de Funcionários</a>
      <a href="listagem.php" id="atual">Listagem de Dados</a>
      <a href="logout.php">Sair</a>
    </nav>

    <main id="listagem-container">
      <div id="listagem-filter-container" data-codigo="<?php echo $_SESSION['codigo']; ?>" data-medico="<?php echo $_SESSION['medico']; ?>">
        <div>
          <input type="radio" name="dadoTipo" id="funcionarios" value="funcionarios" checked>
          <label for="funcionarios">Funcionários</label>
        </div>
        <div>
          <input type="radio" name="dadoTipo" id="pacientes" value="pacientes">
          <label for="pacientes">Pacientes</label>
        </div>
        <div>
          <input type="radio" name="dadoTipo" id="enderecos" value="enderecos">
          <label for="enderecos">Endereços</label>
        </div>
        <div>
          <input type="radio" name="dadoTipo" id="agendamentos" value="agendamentos">
          <label for="agendamentos">Agendamentos</label>
        </div>
        <div>
          <input type="radio" name="dadoTipo" id="meusAgendamentos" value="meusAgendamentos">
          <label for="meusAgendamentos">Meus Agendamentos</label>
        </div>

        <!-- <button type="submit">Filtrar</button> -->
      </div>

      <div id="entradas-listagem-container">
        <div class="entrada-listagem hide" id="exemplo-funcionario">
          <h3>Nome:</h3>
          <div class="entrada-listagem-grupo">
            <p>Código:</p>
            <p>Sexo:</p>
            <p>Email:</p>
            <p>Telefone:</p>
          </div>

          <div class="entrada-listagem-grupo">
            <p>CEP:</p>
            <p>Logradouro:</p>
            <p>Cidade:</p>
            <p>Estado:</p>
          </div>

          <div class="entrada-listagem-grupo">
            <p>Data de Contratação: </p>
            <p>Salário:</p>
            <p>Senha Hash:</p>
            <p>Código:</p>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <address>Av. João Naves de Ávila, 2121 - Santa Mônica, Uberlândia - MG, 38408-100.</address>
    </footer>
  </body>
</html>
