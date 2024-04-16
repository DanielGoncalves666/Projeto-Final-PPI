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

    function checkLogin($pdo, $email, $senha)
    {
        $sql = <<<SQL
            SELECT funcionario.senhaHash
            FROM pessoa INNER JOIN funcionario
            ON pessoa.codigo = funcionario.codigo
            WHERE email = ?
        SQL;

        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);

            $hashSenha = $stmt->fetchColumn();

            if(!$hashSenha)
            {
                // se negativo, nenhuma correspondência com email foi encontrada
                return false;
            }
      
            return password_verify($senha, $hashSenha);
        }
        catch(Exception $e)
        {
            exit("Falha Inesperada: " . $e->get_message());
        }
    }

    
    $pdo = mySQLConnect();

    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";

    if(checkLogin($pdo,$email,$senha))
    {
        $response = new RequestResponse(true, "./restrito/index.html");
    }
    else
    {
        $response = new RequestResponse(false,"");
    }

    echo json_encode($response);
?>