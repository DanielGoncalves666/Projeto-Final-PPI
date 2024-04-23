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

    $codigo = '';
    $medico = false;
    function checkLogin($pdo, $email, $senha)
    {
        $sql = <<<SQL
            SELECT funcionario.senhaHash, pessoa.codigo
            FROM pessoa
            INNER JOIN funcionario
            ON pessoa.codigo = funcionario.codigo
            WHERE email = ?
        SQL;

        $sqlCheckMedico = <<<SQL
        SELECT * FROM medico WHERE codigo = ?
        SQL;

        global $codigo, $medico;

        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);

            $row = $stmt->fetch(PDO::FETCH_NUM);
            $hashSenha = $row[0];
            $codigo = $row[1];

            $stmtCheck = $pdo->prepare($sqlCheckMedico);
            $stmtCheck->execute([$codigo]);

            if ($stmtCheck->rowCount() > 0) {
                $medico = true;
            }

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
        $cookie_params = session_get_cookie_params(); // recupera os parâmetros da sessão
        $cookieParams['httponly'] = true; // impede acesso ao cookie por meio de javascript
    
        // redefine os parâmetros de sessão como sendo os presentes em $cookie_params
        session_set_cookie_params($cookieParams);

        session_start();
        
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $email;
        $_SESSION['codigo'] = $codigo;
        $_SESSION['medico'] = $medico ? "true" : "false";

        $response = new RequestResponse(true, "restrito/index.php");
    }
    else
    {
        $response = new RequestResponse(false,"");
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    echo json_encode($response);
?>
