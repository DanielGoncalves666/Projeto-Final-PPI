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
        exit("Falha Inesperada: " . $e->getMessage());
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
?>