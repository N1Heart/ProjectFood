<?php
// src/clientes_novo.php

// 1. Inicia a sessão e o auth check PRIMEIRO.
// O auth_check.php já inicia a sessão.
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$nome = "";
$email = "";
$telefone = "";
$endereco = "";
$errors = [];

// 2. TODO O PROCESSAMENTO DO FORMULÁRIO VEM AQUI
// Esta lógica agora roda ANTES do header.php ser incluído.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);

    if (empty($nome)) { $errors[] = "O campo nome é obrigatório."; }
    
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Formato de e-mail inválido.";
    }

    if (empty($errors)) {
        try {
            $sql = "INSERT INTO clientes (nome, email, telefone, endereco) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$nome, $email, $telefone, $endereco])) {
                // SUCESSO! O header() agora funciona porque nenhum HTML foi enviado.
                header("Location: clientes.php?feedback=" . urlencode("Cliente cadastrado com sucesso!"));
                exit; // O script para aqui.
            } else {
                $errors[] = "Erro ao cadastrar o cliente.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { 
                $errors[] = "Este e-mail já está cadastrado.";
            } else {
                $errors[] = "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    }
    // Se houver erros, o script NÃO redireciona e continua para
    // exibir o HTML abaixo...
}

// 3. O HTML SÓ COMEÇA AGORA
// Se o script chegou até aqui, significa que não houve redirecionamento.
// (Ou é o primeiro carregamento da página, ou o formulário teve erros).
include(__DIR__ . '/includes/header.php');
echo "<title>Novo Cliente</title>";
?>
<link rel="stylesheet" href="./styles.css">
<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Novo Cliente</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="clientes_novo.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome *</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($endereco); ?>">
            </div>
            
            <button type="submit" class="btn">Cadastrar Cliente</button>
            <a href="clientes.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>