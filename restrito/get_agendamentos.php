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
        SELECT agenda.dia, agenda.horario, agenda.nome, agenda.sexo, agenda.email, medico.especialidade as medEspec, pessoa.nome as medNome
        FROM agenda INNER JOIN medico ON agenda.codigoMedico = medico.codigo
                    INNER JOIN pessoa ON medico.codigo = pessoa.codigo;
        SQL;
    
    try{
        $stmt = $pdo->query($sql);
        $agendamentos = $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    catch(Exception $e)
    {
        exit("Erro: " . $e->get_message());
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
            SELECT dia, horario, nome, sexo, email
            FROM agenda INNER JOIN medico
            ON agenda.codigoMedico = medico.codigo
            WHERE medico.codigo = ?
            SQL;

        try
        {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$codigo]);

            $agendamentos = $stmt->fetchAll();
        }
        catch(Exception $e)
        {
            exit("Erro: " . $e->getMessage());
        }

    }
    else
    {
        exit("Funcionáro não é um médico.");
    }
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
echo json_encode($agendamentos);

?>