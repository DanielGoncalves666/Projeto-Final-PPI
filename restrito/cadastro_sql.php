<?php

require "../conexaoMySQL.php";
$pdo = mysqlConnect();

$tipo = $_POST['tipo'];

$sqlPessoa = <<<SQL
INSERT INTO pessoa(nome, sexo, email, telefone, cep, logradouro, cidade, estado)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)
SQL;

if ($tipo == "funcionario") {
    // Pessoa
    $nome = $_POST['nome'] ?? "";
    $sexo = $_POST['sexo'] ?? "";
    $email = $_POST['email'] ?? "";
    $tel = $_POST['tel'] ?? "";
    $cep = $_POST['cep'] ?? "";
    $rua = $_POST['rua'] ?? "";
    $cidade = $_POST['cidade'] ?? "";
    $estado = $_POST['estado'] ?? "";

    // Funcionario
    $dataContrato = $_POST['dataContrato'] ?? "";
    $salario = $_POST['salario'] ?? "";
    $senha = $_POST['senha'] ?? "";
    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

    $sqlFuncionario = <<<SQL
    INSERT INTO funcionario(dataContrato, salario, senhaHash, codigo)
    VALUES (?, ?, ?, ?)
    SQL;

    try {
        $pdo->beginTransaction();

        $stmt1 = $pdo->prepare($sqlPessoa);
        $stmt1->execute([$nome, $sexo, $email, $tel, $cep, $rua, $cidade, $estado]);

        $idPessoa = $pdo->lastInsertId();
        $stmt2 = $pdo->prepare($sqlFuncionario);
        $stmt2->execute([$dataContrato, $salario, $senhaHash, $idPessoa]);

        if (isset($_POST['medico'])) {
            $especialidade = $_POST['especialidade'] ?? "";
            $crm = $_POST['crm'] ?? "";

            $sqlMedico = <<<SQL
            INSERT INTO medico(especialidade, crm, codigo)
            VALUES (?, ?, ?)
            SQL;

            $stmt3 = $pdo->prepare($sqlMedico);
            $stmt3->execute([$especialidade, $crm, $idPessoa]);
        }

        $pdo->commit();
    }
    catch (PDOException $e) {
        $pdo->rollBack();
        header("Location: cadastro_funcionarios.php");
        exit('Erro: ' . $e->getMessage());
    }

    header("Location: cadastro_funcionarios.php");
    exit();
}
else if ($tipo == "paciente") {
    // Pessoa
    $nome = $_POST['nome'] ?? "";
    $sexo = $_POST['sexo'] ?? "";
    $email = $_POST['email'] ?? "";
    $tel = $_POST['tel'] ?? "";
    $cep = $_POST['cep'] ?? "";
    $rua = $_POST['rua'] ?? "";
    $cidade = $_POST['cidade'] ?? "";
    $estado = $_POST['estado'] ?? "";

    // Paciente
    $peso = $_POST['peso'] ?? "";
    $altura = $_POST['altura'] ?? "";
    $tiposanguineo = $_POST['tiposangue'] ?? "";

    $sqlPaciente = <<<SQL
    INSERT INTO paciente(peso, altura, tiposanguineo, codigo)
    VALUES (?, ?, ?, ?)
    SQL;

    try {
        $pdo->beginTransaction();

        $stmt1 = $pdo->prepare($sqlPessoa);
        $stmt1->execute([$nome, $sexo, $email, $tel, $cep, $rua, $cidade, $estado]);

        $idPessoa = $pdo->lastInsertId();
        $stmt2 = $pdo->prepare($sqlPaciente);
        $stmt2->execute([$peso, $altura, $tiposanguineo, $idPessoa]);

        $pdo->commit();
    }
    catch (PDOException $e) {
        $pdo->rollBack();
        header("Location: cadastro_pacientes.php");
        exit('Erro: ' . $e->getMessage());
    }

    header("Location: cadastro_pacientes.php");
    exit();
}
else {
    exit('Tipo inválido para cadastro.');
}
