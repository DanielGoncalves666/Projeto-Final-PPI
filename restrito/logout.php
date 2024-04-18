<?php

session_start();
session_unset(); // apaga variáveis de sessão
session_destroy(); // destrói a sessão
setcookie(session_name(), "", 1, "/");
// Faz com que na resposta contenha um header que causa a exclusão do cookie de sessão

header('Location: ../index.html');
exit();
?>