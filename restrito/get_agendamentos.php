<?php

require "../conexaoMySQL.php";
require "session_verification.php";  

session_start();
exitWhenNotLoggedIn();

$pdo = mysqlConnect();

$meusAgendamentos = $_GET["meus"] ?? ""; // qualquer coisa diferente de vazio indica que são os 
                                         // agendamentos do médico

if($meusAgendamentos == "")
{
    // todos os agendamentos

    $sql = <<<SQL
        SELECT (dia, horario, nome, sexo, email, medNome, medEspec)
        FROM agenda INNER JOIN (SELECT (pessoa.nome as medNome, medico.especialidade as medEspec, medico.codigo as medCodigo)
                                FROM medico INNER JOIN pessoa
                                ON medico.codigo = pessoa.codigo)
        ON agenda.codigoMedico = medCodigo
        SQL;

    try{
        $stmt = $pdo->query($sql);

        $agendamentos = $stmt->fetchAll();
    }
    catch(Exception $e)
    {
        exit("Erro: " . $e.get_message());
    }

}
else
{
    $medico = $_SESSION['medico'];
    
    if($medico)
    {
        // é um médico
        $codigo = $_SESSION['codigo'];
    
        $sql = <<<SQL
            SELECT (dia, horario, nome, sexo, email)
            FROM agenda INNER JOIN medico
            ON agenda.codigoMedico = ?
            SQL;

        try
        {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$codigo]);

            $agendamentos = $stmt->fetchAll();
        }
        catch(Exception $e)
        {
            exit("Erro: " . $e.get_message());
        }

    }
    else
    {
        exit("Funcionáro não é um médico.");
    }
}

header('Content-type: application/json');
echo json_encode($agendamentos);

?>