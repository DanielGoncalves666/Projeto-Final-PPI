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
            SELECT medico.codigo
            FROM medico INNER JOIN pessoa ON medico.codigo = pessoa.codigo
            WHERE nome = ?
            SQL;

        $sql2 = <<<SQL
            INSERT INTO agenda (dia, horario, nome, sexo, email, codigoMedico)
            VALUES (?, ?, ?, ?, ?, ?) 
            SQL;

        try{
            $stmt1 = $pdo->prepare($sql);
            $stmt1->execute([$medico]);
            
            $codigoMedico = $stmt1->fetchColumn();

            if(!$codigoMedico)
            {
                $response = new RequestResponse(false, "Nenhum médico com esse nome");
            }
            else
            {
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->execute([$data, $horario, $nome, $sexo, $email, $codigoMedico]);

                $response = new RequestResponse(true, "Agendamento concluído!");
            }
        }
        catch(Exception $e)
        {
            $response = new RequestResponse(false, "Falha no banco de dados: " . $e->getMessage());
        }
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
?>