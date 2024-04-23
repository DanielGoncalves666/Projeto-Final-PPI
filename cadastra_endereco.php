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

    $cep = $_POST["cep"] ?? "";
    $logradouro = $_POST["logradouro"] ?? "";
    $cidade = $_POST["cidade"] ?? "";
    $estado = $_POST["estado"] ?? "";

    $response = null;
    if($cep == "" || $logradouro == "" || $cidade == "" || $estado == "")
    {
        $response = new RequestResponse(false,"Falha: Algum dos campos estava vazio.");
    }
    else
    {
        try{
            $sql = <<<SQL
                SELECT count(*)
                FROM base_enderecos
                WHERE base_enderecos.cep = ?
            SQL;
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$cep]);
    
            $qtd = $stmt->fetchColumn();

            if((int) $qtd >= 1)
            {
                $response = new RequestResponse(false,"Falha: CEP já existente.");
            }
            else
            {
                $sqlInsert = <<<SQL
                    INSERT INTO base_enderecos
                    VALUES (?,?,?,?)
                SQL;
    
                $stmt2 = $pdo->prepare($sqlInsert);
                $stmt2->execute([$cep, $logradouro, $cidade, $estado]);
    
                $response = new RequestResponse(true,'Sucesso!');
            }
        }
        catch(Exception $e)
        {
            $response = new RequestResponse(false, "Falha ao acessar o banco de dados.");
        }
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($response);
?>