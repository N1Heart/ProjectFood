<?php
// src/includes/auth_check.php

// Inicia a sessão (ou continua a sessão existente)
// É crucial que session_start() venha ANTES de qualquer output HTML.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica se a variável de sessão 'funcionario_id' NÃO existe
if (!isset($_SESSION['funcionario_id'])) {
    
    // Se não existe (usuário não logado),
    // destrói qualquer sessão que possa existir
    session_destroy();
    
    // Redireciona para a página de login e para o script
    header("Location: login.php?erro=restrito");
    exit();
}

// Se a sessão existe, o script continua e a página protegida é carregada.
// Podemos guardar os dados do usuário em variáveis para acesso fácil
$funcionario_logado_id = $_SESSION['funcionario_id'];
$funcionario_logado_nome = $_SESSION['funcionario_nome'];

?>