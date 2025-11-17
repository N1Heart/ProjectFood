<?php
// src/logout.php

// Sempre inicie a sessão para poder destruí-la
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destrói todas as variáveis da sessão
$_SESSION = [];

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header("Location: login.php");
exit();
?>