<?php
    require "conexaoMySQL.php";

    class RequestResponse
    {
        public $success;
        public $detail;

        function __construct($success, $detail)
        {
            $this->success = $success;
            $this->detail = $detail;
        }
    }

    $pdo = mySQLConnect();

    $nome = $_POST["nome"] ?? "";
    $sexo = $_POST["sexo"] ?? "";
    $email = $_POST["email"] ?? "";
    $data = $_POST["data"] ?? "";
    $horario = $_POST["horario"] ?? "";
    $medico = $_POST["medico"] ?? "";

    if($nome == "" || $sexo == "" || $email == "" || $data == "" || $horario == "" || $medico == "")
    {
        $response = new RequestResponse(false,"Falha: Algum dos campos estava vazio.");
    }
    else
    {
        $sql = <<<SQL
            SELECT codigo
            FROM medico INNER JOIN pessoa
            ON medico.codigo = pessoa.codigo
            WHERE nome = ?
            SQL;

        $sql2 = <<<SQL
            INSERT INTO agenda (dia, horario, nome, sexo, email, codigoMedico)
            VALUES (?, ?, ?, ?, ?, ?) 
            SQL;

        try{
            $stmt1 = $pdo->prepare($sql);
            $stmt1->execute([$medico]);

            $codigoMedico = $fetchColumn();

            if(!$col)
            {
                $response = new RequestResponse(false, "Nenhum médico com esse nome");
            }
            else
            {
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->execute([$dia, $horario, $nome, $sexo, $email, $col]);

                $response = new RequestResponse(true, "Agendamento concluído!");
            }
        }
        catch(Exception $e)
        {
            $response = new RequestResponse(false, "Falha no banco de dados: " . $e->get_message());
        }
    }

    header('Content-type: application/json');
    echo json_encode($response);
?>