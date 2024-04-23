<?php

require "../conexaoMySQL.php";
require "session_verification.php";  

session_start();
exitWhenNotLoggedIn();

$pdo = mysqlConnect();

$tipo = $_GET['tipo'] ?? '';

if ($tipo != 'funcionario' && $tipo != 'paciente')
{
    exit('Tipo invalido requisitado.');
}

// OBS.: não precisamos tratar a entrada aqui pois apenas dois valores são válidos, funcionario e paciente

$sql = 0;
if ($tipo == 'paciente') {
    $sql = <<<SQL
        SELECT *
        FROM pessoa INNER JOIN $tipo ON pessoa.codigo = $tipo.codigo
    SQL;
}
else
{
    $sql = <<<SQL
        SELECT *
        FROM pessoa LEFT JOIN medico ON pessoa.codigo = medico.codigo INNER JOIN $tipo ON pessoa.codigo = $tipo.codigo
    SQL;
}

try {
    $stmt = $pdo->query($sql);
    $pessoas = $stmt->fetchAll(PDO::FETCH_OBJ);

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($pessoas);
}
catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
}
