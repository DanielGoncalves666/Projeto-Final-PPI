<?php
    require "session_verification.php";  
    
    session_start();
    exitWhenNotLoggedIn();
?>

<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <title>Home - Restrito</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="restrito.css">
    </head>
    <body>
        <header>
            <h1>Clínica MedComp</h1>
        </header>
        <nav>
          <a href="index.php" id="atual">Home</a>
          <a href="cadastro_pacientes.php">Cadastro de Pacientes</a>
          <a href="cadastro_funcionarios.php">Cadastro de Funcionários</a>
          <a href="listagem.php">Listagem de Dados</a>
          <a href="logout.php">Sair</a>
        </nav>
        <main>
            <h2>Seja Bem-Vindo, <?php echo $_SESSION['user'] ?>.</h2>
        </main>
        <footer>
            <address>Av. João Naves de Ávila, 2121 - Santa Mônica, Uberlândia - MG, 38408-100.</address>
        </footer>
    </body>
</html>
