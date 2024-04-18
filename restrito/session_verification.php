<?php
    function exitWhenNotLoggedIn()
    { 
        // caso loggedIn esteja definida no vetor de variáveis de sessão e não seja null
        // (ela é definida como true), isset retorna true. Ou seja, quando ela não está definido o acesso
        // não é permitido.
        if (!isset($_SESSION['loggedIn'])) {
            header("Location: ../login.html");
            exit();  
        }
    }
?>