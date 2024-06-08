<?php
// Inicie a sessão
session_start();

// Destrua todas as variáveis de sessão
session_unset();

// Destrua a sessão
session_destroy();

// Redirecione o usuário para a página de login (index.php)
header("Location: ../index.php");
exit;
?>