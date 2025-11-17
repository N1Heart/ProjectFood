<?php
// src/fornecedores_novo.php

// 1. Lógica PRIMEIRO
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$nome_empresa = "";
$cnpj = "";
$contato_nome = "";
$telefone = "";
$email = "";
$endereco = "";
$errors = [];

// 2. Processamento do POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_empresa = trim($_POST['nome_empresa']);
    $cnpj = trim($_POST['cnpj']);
    $contato_nome = trim($_POST['contato_nome']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $endereco = trim($_POST['endereco']);

    if (empty($nome_empresa)) { $errors[] = "O nome da empresa é obrigatório."; }
    
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Formato de e-mail inválido.";
    }

    if (empty($errors)) {
        try {
            $sql = "INSERT INTO fornecedores (nome_empresa, cnpj, contato_nome, telefone, email, endereco) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$nome_empresa, $cnpj, $contato_nome, $telefone, $email, $endereco])) {
                header("Location: fornecedores.php?feedback=" . urlencode("Fornecedor cadastrado com sucesso!"));
                exit;
            } else {
                $errors[] = "Erro ao cadastrar o fornecedor.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Erro de chave duplicada
                $errors[] = "Este CNPJ ou E-mail já está cadastrado.";
            } else {
                $errors[] = "Erro ao cadastrar: " . $e->getMessage();
            }
        }
    }
}

// 3. HTML SÓ AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Novo Fornecedor</title>";
?>
<link rel="stylesheet" href="styles.css">
<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Novo Fornecedor</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="fornecedores_novo.php" method="POST">
            <div class="form-group">
                <label for="nome_empresa">Nome da Empresa *</label>
                <input type="text" id="nome_empresa" name="nome_empresa" value="<?php echo htmlspecialchars($nome_empresa); ?>" required>
            </div>
            <div class="form-group">
                <label for="cnpj">CNPJ</label>
                <input type="text" id="cnpj" name="cnpj" value="<?php echo htmlspecialchars($cnpj); ?>">
            </div>
            <div class="form-group">
                <label for="contato_nome">Nome do Contato</label>
                <input type="text" id="contato_nome" name="contato_nome" value="<?php echo htmlspecialchars($contato_nome); ?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($endereco); ?>">
            </div>
            
            <button type="submit" class="btn">Cadastrar Fornecedor</button>
            <a href="fornecedores.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>