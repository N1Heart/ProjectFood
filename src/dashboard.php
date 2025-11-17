<?php
// src/dashboard.php

// 1. O Cabeçalho AGORA cuida de TUDO (session, auth_check, html)
include(__DIR__ . '/includes/header.php');

// Define o título da página (opcional, mas bom)
echo "<title>Dashboard</title>";
?>

<main>
    <h1>Dashboard</h1>
    <h2>Bem-vindo, <?php echo htmlspecialchars($funcionario_logado_nome); ?>!</h2>
    
    <p>Você está logado no sistema.</p>
    
    <p>Use o menu de navegação acima para gerenciar o sistema.</p>
    
    <a href="funcionarios_novo.php" class="btn" style="background-color: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">
        Cadastrar Novo Funcionário
    </a>
</main>

<?php
// 3. O Rodapé
include(__DIR__ . '/includes/footer.php');
?>
</a>
</main>

<?php
// 3. O Rodapé
include(__DIR__ . '/includes/footer.php');
?>