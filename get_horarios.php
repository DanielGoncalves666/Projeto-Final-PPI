<?php
    require "conexaoMySQL.php";

    $pdo = mySQLConnect();

    $nomeMedico = $_GET("nome");
    $data = $_GET("data");

    $sql = <<<SQL
        SELECT horario
        FROM agenda INNER JOIN ( SELECT medico.codigo as medCod
                                FROM medico INNER JOIN pessoa
                                ON medico.codigo = pessoa.codigo
                                WHERE pessoa.nome = ?
                                )
        ON agenda.codigoMedico = medCod
        WHERE dia = ?
        SQL;

    $resposta = [];
    try
    {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nomeMedico, $data]);

        $response = fetchAll(PDO::FETCH_OBJ);

        foreach ($item as $response)
            $resposta[] = $item->horario;

        if(! $response)
            $resposta[] = -1;
    }
    catch(Exception $e)
    {
        exit("Falha Inesperada: " . $e->get_message());
    }


    header('Content-type: application/json');
    echo json_encode($response);
?>