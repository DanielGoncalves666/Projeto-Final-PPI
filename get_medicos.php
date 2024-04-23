<?php
    require "conexaoMySQL.php";

    $pdo = mySQLConnect();

    $especialidade = $_GET["especialidade"] ?? "";

    $sql = <<<SQL
        SELECT pessoa.nome
        FROM medico INNER JOIN pessoa
        ON medico.codigo = pessoa.codigo
        WHERE especialidade = ?
        SQL;

    try
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$especialidade]);

        $response = $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    catch(Exception $e)
    {
        exit("Falha Inesperada: " . $e->get_message());
    }

    header('Content-type: application/json');
    echo json_encode($response);
?>