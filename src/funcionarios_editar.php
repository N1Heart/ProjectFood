<?php
// src/funcionarios_editar.php

// 1. LÓGICA PRIMEIRO
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$funcionario_id = $_GET['id'] ?? 0;
if (!$funcionario_id) {
    header("Location: funcionarios.php?feedback=" . urlencode("Erro: ID do funcionário não fornecido."));
    exit;
}

$nome = "";
$email = "";
$cargo = "";
$errors = [];

// 2. PROCESSAMENTO DO FORMULÁRIO (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $cargo = trim($_POST['cargo']);
    $senha = $_POST['senha']; // Pega a senha, pode estar vazia

    if (empty($nome)) { $errors[] = "O campo nome é obrigatório."; }
    if (empty($email)) { $errors[] = "O campo email é obrigatório."; }
    if (empty($cargo)) { $errors[] = "O campo cargo é obrigatório."; }
    
    // Valida a senha APENAS se ela foi preenchida
    if (!empty($senha) && strlen($senha) < 6) {
        $errors[] = "A senha, se preenchida, deve ter no mínimo 6 caracteres.";
    }

    // Verifica se o email já existe (mas ignora o email do PRÓPRIO usuário)
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM funcionarios WHERE email = ? AND id != ?");
            $stmt->execute([$email, $funcionario_id]);
            if ($stmt->fetch()) {
                $errors[] = "Este email já está sendo usado por outro funcionário.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao verificar e-mail: " . $e->getMessage();
        }
    }

    // Se passou em tudo, atualiza o banco
    if (empty($errors)) {
        try {
            // Se a senha estiver VAZIA, não atualizamos a senha
            if (empty($senha)) {
                $sql = "UPDATE funcionarios SET nome = ?, email = ?, cargo = ? WHERE id = ?";
                $params = [$nome, $email, $cargo, $funcionario_id];
            } else {
                // Se a senha estiver PREENCHIDA, geramos um novo HASH
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $sql = "UPDATE funcionarios SET nome = ?, email = ?, cargo = ?, senha = ? WHERE id = ?";
                $params = [$nome, $email, $cargo, $senha_hash, $funcionario_id];
            }
            
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute($params)) {
                header("Location: funcionarios.php?feedback=" . urlencode("Funcionário atualizado com sucesso!"));
                exit;
            } else {
                $errors[] = "Erro ao atualizar o funcionário.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao atualizar: " . $e->getMessage();
        }
    }
}

// 3. BUSCA OS DADOS (GET)
// Se não for POST (ou se o POST deu erro), busca os dados atuais no banco
if ($_SERVER["REQUEST_METHOD"] != "POST" || !empty($errors)) {
    try {
        $stmt = $pdo->prepare("SELECT nome, email, cargo FROM funcionarios WHERE id = ?");
        $stmt->execute([$funcionario_id]);
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($funcionario) {
            $nome = $funcionario['nome'];
            $email = $funcionario['email'];
            $cargo = $funcionario['cargo'];
        } else {
            header("Location: funcionarios.php?feedback=" . urlencode("Erro: Funcionário não encontrado."));
            exit;
        }
    } catch (PDOException $e) {
        header("Location: funcionarios.php?feedback=" . urlencode("Erro ao buscar funcionário: " . $e->getMessage()));
        exit;
    }
}

// 4. HTML SÓ COMEÇA AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Editar Funcionário</title>";
?>
<link rel="stylesheet" href="./styles.css">
<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Editar Funcionário</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="funcionarios_editar.php?id=<?php echo $funcionario_id; ?>" method="POST">
            <div class="form-group">
                <label for="nome">Nome *</label><br>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email *</label><br>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo *</label>
                <select id="cargo" name="cargo" class="form-group" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                    <option value="Admin" <?php echo ($cargo == 'Admin') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="Estoquista" <?php echo ($cargo == 'Estoquista') ? 'selected' : ''; ?>>Estoquista</option>
                    <option value="Vendedor" <?php echo ($cargo == 'Vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                    <option value="Indefinido" <?php echo ($cargo == 'Indefinido') ? 'selected' : ''; ?>>Indefinido</option>
                </select>
            </div>
            <div class="form-group">
                <label for="senha">Nova Senha</label><br>
                <input type="password" id="senha" name="senha">
                <small style="display: block; margin-top: 5px; color: #777;">Deixe em branco para não alterar a senha.</small>
            </div>
            
            <button type="submit" class="btn">Salvar Alterações</button>
            <a href="funcionarios.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

