<?php
// src/includes/header.php

// Verificamos se o auth_check já foi incluído (para evitar erros)
// Se a sessão não existir (alguém acessou o header.php direto),
// o auth_check.php vai cuidar de redirecionar.
if (!isset($_SESSION['funcionario_id'])) {
    require_once(__DIR__ . '/auth_check.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    
    <style>
        nav.main-nav {
            background-color: #333;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 10px;
        }
        nav.main-nav .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0; padding: 0;
        }
        nav.main-nav .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        nav.main-nav .nav-links a:hover {
            text-decoration: underline;
        }
        nav.main-nav .user-info a {
            color: #ffc107; /* Cor de destaque para sair */
            text-decoration: none;
        }
    </style>
</head>
<body>

<header>
    <nav class="main-nav">
        <div class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="fornecedores.php">Fornecedores</a></li>
            <li><a href="cardapio_admin.php">Cardápio</a></li>
            <li><a href="pedidos.php">Pedidos</a></li>
            <li><a href="estoque.php">Estoque</a></li>
            <li><a href="funcionarios.php">Funcionários</a></li>
        </div>
        
        <div class="user-info">
            <span>Olá, <?php echo htmlspecialchars($_SESSION['funcionario_nome']); ?>!</span>
            <a href="logout.php" style="margin-left: 15px;">Sair</a>
        </div>
    </nav>
</header>

<div class="page-content" style="padding: 2rem;">