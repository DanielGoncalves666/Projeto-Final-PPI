<?php
    require "conexaoMySQL.php";

    $pdo = mySQLConnect();

    $sql = <<<SQL
        SELECT DISTINCT especialidade
        FROM medico
        SQL;

    try
    {
        $stmt = $pdo->query($sql);
        $response = $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    catch(Exception $e)
    {
        exit("Falha Inesperada: " . $e->get_message());
    }

    header('Content-type: application/json');
    echo json_encode($response);
?>