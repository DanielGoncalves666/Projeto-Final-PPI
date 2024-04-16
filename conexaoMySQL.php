<?php
function mySQLConnect()
{
    $db_host = "sql206.infinityfree.com";
    $db_username = "if0_36114516";
    $db_password = "r64nzvAnD5";
    $db_name = "if0_36114516_medcomp";

    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

    $options = [
        PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // ativa o modo de erros para lançar exceções    
        PDO::ATTR_PERSISTENT    => true, // ativa o uso de conexões persistentes para maior eficiência
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // altera o modo padrão do método fetch para FETCH_ASSOC
      ];

    try
    {
        $pdo = new PDO($dsn,$db_username, $db_password, $options);
        return $pdo;
    }
    catch(Exception $e)
    {
        exit('Ocorreu uma falha na conexão com o BD: ' . $e->getMessage());
    }
}


?>