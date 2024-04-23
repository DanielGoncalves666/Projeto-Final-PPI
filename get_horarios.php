<?php
    require "conexaoMySQL.php";

    $pdo = mySQLConnect();

    $nomeMedico = $_GET["nome"] ?? "";
    $data = $_GET["data"] ?? "";

    if($nomeMedico == "" || $data == "")
        exit("Nome do médico ou data vazios.");

    $sql = <<<SQL
        SELECT agenda.horario
        FROM agenda INNER JOIN medico ON agenda.codigoMedico = medico.codigo
                    INNER JOIN pessoa ON medico.codigo = pessoa.codigo
        WHERE pessoa.nome = ? AND agenda.dia = ?
        SQL;

    $resposta = [];
    try
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nomeMedico, $data]);
       
        $response = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        if(! $response)
            $resposta[] = -1;
        else{
            foreach ($response as $item)
                $resposta[] = $item->horario;
        }

    }
    catch(Exception $e)
    {
        exit("Falha Inesperada: " . $e->getMessage());
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($resposta);
?>