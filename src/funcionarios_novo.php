<?php
// src/funcionarios_novo.php

// 1. Protege a página e inclui o cabeçalho
include(__DIR__ . '/includes/header.php');
include(__DIR__ . '/includes/db_connect.php'); // Precisamos do $pdo

$nome = "";
$email = "";
$senha = "";
$cargo = "Indefinido"; // Cargo padrão
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];
    $cargo = trim($_POST['cargo']);

    // --- 1. Validação ---
    if (empty($nome)) { $errors[] = "O campo nome é Obrigatório."; }
    if (empty($email)) { $errors[] = "O campo email é obrigatório"; }
    if (empty($senha)) { $errors[] = "O campo senha é obrigatório"; }
    if (strlen($senha) < 6) { $errors[] = "A senha deve ter no mínimo 6 caracteres."; }
    if (empty($cargo)) { $errors[] = "O campo cargo é obrigatório."; }

    // --- 2. Verificação de E-mail Duplicado ---
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM funcionarios WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = "Este email já está cadastrado";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao verificar o e-mail: " . $e->getMessage();
        }
    }

    // --- 3. Inserção no Banco ---
    if (empty($errors)) {
        try {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, email, senha, cargo) VALUES (?, ?, ?, ?)");
            
            if ($stmt->execute([$nome, $email, $senha_hash, $cargo])) {
                $success = "Funcionário cadastrado com sucesso!";
                // Limpa o formulário
                $nome = ""; $email = ""; $senha = ""; $cargo = "Indefinido";
            } else {
                $errors[] = "Erro ao cadastrar. Tente novamente";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}

echo "<title>Novo Funcionário</title>";
?>
<link rel="stylesheet" href="./styles.css">
<main>
    <div class="form-container" >
        <h1>Cadastrar Novo Funcionário</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert" style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
                <p><?php echo htmlspecialchars($success); ?></p>
            </div>
        <?php endif; ?>
        
        <form action="funcionarios_novo.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label><br>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha (min. 6 caracteres):</label><br>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo</label>
                <select id="cargo" name="cargo" class="form-group" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                    <option value="Admin" <?php echo ($cargo == 'Admin') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="Estoquista" <?php echo ($cargo == 'Estoquista') ? 'selected' : ''; ?>>Estoquista</option>
                    <option value="Vendedor" <?php echo ($cargo == 'Vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                    <option value="Indefinido" <?php echo ($cargo == 'Indefinido') ? 'selected' : ''; ?>>Indefinido</option>
                </select>
            </div>
            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </div>
</main>

