<?php
// src/register.php

// Inicia a sessão e inclui a conexão com o banco
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/includes/db_connect.php'); // Nosso arquivo de conexão PDO

$nome = "";
$email = "";
$senha = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // --- 1. Validação (Exatamente como você fez) ---
    if (empty($nome)) {
        $errors[] = "O campo nome é Obrigatório.";
    }
    if (empty($email)) {
        $errors[] = "O campo email é obrigatório";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Formato do email inválido";
    }
    if (empty($senha)) {
        $errors[] = "O campo senha é obrigatório";
    } elseif (strlen($senha) < 6) {
        $errors[] = "A senha deve ter no mínimo 6 caracteres.";
    }

    // --- 2. Verificação de E-mail Duplicado (Adaptado para PDO) ---
    if (empty($errors)) {
        try {
            // Mudamos 'usuarios' para 'funcionarios'
            $stmt = $pdo->prepare("SELECT id FROM funcionarios WHERE email = ?");
            $stmt->execute([$email]);
            $user_exists = $stmt->fetch();

            if ($user_exists) {
                $errors[] = "Este email já está cadastrado";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao verificar o e-mail: " . $e->getMessage();
        }
    }

    // --- 3. Inserção no Banco (Adaptado para PDO) ---
    if (empty($errors)) {
        try {
            // Geramos o hash da senha (como você fez)
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

            // Mudamos 'usuarios' para 'funcionarios' e adicionamos 'cargo'
            $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, email, senha, cargo) VALUES (?, ?, ?, ?)");
            
            // Adicionamos 'Admin' como o cargo padrão para o primeiro usuário
            if ($stmt->execute([$nome, $email, $senha_hash, 'Admin'])) {
                // Sucesso! Redireciona para o login com a mensagem
                header("Location: login.php?success=1");
                exit;
            } else {
                $errors[] = "Erro ao cadastrar. Tente novamente";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}

// O HTML do formulário (como o seu, mas com os includes corretos)
// NÃO vamos incluir o header.php completo, pois ele tem o auth_check
// Vamos fazer um cabeçalho simples como na página de login.
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Usuário</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f0f2f5; }
        .form-container { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 450px; }
        .form-container h1 { text-align: center; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        .form-group input { width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .btn { width: 100%; padding: 0.75rem; background-color: #5cb85c; color: white; border: none; border-radius: 5px; font-size: 1rem; font-weight: bold; cursor: pointer; }
        .alert { padding: 1rem; margin-bottom: 1rem; border-radius: 5px; }
        .alert-danger { color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; }
        .alert-danger p { margin: 0; }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Cadastre-se</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <form action="register.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome) ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha (min. 6 caracteres):</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn">Cadastrar</button>
    </form>
    <p style="text-align: center; margin-top: 10px;">
        Já tem uma conta? <a href="login.php">Faça o login</a>
    </p>
</div>

</body>
</html>