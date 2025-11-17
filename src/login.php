<?php
// src/login.php

// Inicia a sessão
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Se o usuário JÁ ESTÁ LOGADO, redireciona para o dashboard
if (isset($_SESSION['funcionario_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Inclui a conexão com o banco
require_once(__DIR__ . '/includes/db_connect.php');

$erro_login = '';

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'] ?? '';
    $senha_formulario = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha_formulario)) {
        $erro_login = "Por favor, preencha o e-mail e a senha.";
    } else {
        try {
            // 1. Busca o funcionário pelo e-mail
            $sql = "SELECT id, nome, senha FROM funcionarios WHERE email = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email]);
            $funcionario = $stmt->fetch();

            // 2. Verifica se o funcionário existe E se a senha está correta
            if ($funcionario && password_verify($senha_formulario, $funcionario['senha'])) {
                
                // --- LOGIN BEM-SUCEDIDO ---
                
                // Regenera o ID da sessão para segurança
                session_regenerate_id(true);
                
                // Armazena os dados do usuário na sessão
                $_SESSION['funcionario_id'] = $funcionario['id'];
                $_SESSION['funcionario_nome'] = $funcionario['nome'];
                
                // Redireciona para o dashboard
                header("Location: dashboard.php");
                exit();

            } else {
                // Senha ou e-mail incorretos
                $erro_login = "E-mail ou senha inválidos.";
            }

        } catch (PDOException $e) {
            $erro_login = "ERRO DE DEBUG: " . $e->getMessage();
            // Em um app real, você logaria $e->getMessage() em um arquivo de erro
        }
    }
}

// Inclui o cabeçalho HTML
// Vamos criar um header simples, já que a página de login não tem menu
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Sistema</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        /* Estilo básico para a página de login - coloque no seu styles.css */
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #333; }
        .login-container { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .login-container h1 { text-align: center; margin-bottom: 1.5rem; }
        .login-container form div { margin-bottom: 1rem; }
        .login-container label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        .login-container input { width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .login-container button { width: 100%; padding: 0.75rem; background-color: #b85c5cff; color: white; border: none; border-radius: 5px; font-size: 1rem; font-weight: bold; cursor: pointer; }
        .login-container .error { color: #dc3545; background: #f8d7da; border: 1px solid #f5c6cb; padding: 0.75rem; border-radius: 5px; margin-bottom: 1rem; text-align: center; }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Login</h1>

        <?php if (!empty($erro_login)): ?>
            <div class="error"><?php echo htmlspecialchars($erro_login); ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['erro']) && $_GET['erro'] == 'restrito'): ?>
            <div class="error">Você precisa fazer login para acessar essa página.</div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
    </div>

</body>
</html>