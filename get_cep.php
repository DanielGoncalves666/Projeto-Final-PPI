<?php

require "conexaoMySQL.php";
$pdo = mysqlConnect();

$cep = $_GET['cep'] ?? '';

$sql = 0;
if ($cep != '') {
    $sql = <<<SQL
        SELECT *
        FROM base_enderecos
        WHERE cep = ?
    SQL;
}
else {
    $sql = <<<SQL
        SELECT *
        FROM base_enderecos
    SQL;
}

try {
    $endereco = 0;
    if ($cep != '') {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cep]);
        $endereco = $stmt->fetch(PDO::FETCH_OBJ);
    }
    else
    {
        $endereco = $pdo->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($endereco);
}
catch (Exception $e)
{
    exit('Falha inesperada: ' . $e->getMessage());
}
