<?php
// src/fornecedores_editar.php

// 1. Lógica PRIMEIRO
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$fornecedor_id = $_GET['id'] ?? 0;
if (!$fornecedor_id) {
    header("Location: fornecedores.php?feedback=" . urlencode("Erro: ID do fornecedor não fornecido."));
    exit;
}

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
            $sql = "UPDATE fornecedores SET nome_empresa = ?, cnpj = ?, contato_nome = ?, telefone = ?, email = ?, endereco = ? 
                    WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$nome_empresa, $cnpj, $contato_nome, $telefone, $email, $endereco, $fornecedor_id])) {
                header("Location: fornecedores.php?feedback=" . urlencode("Fornecedor atualizado com sucesso!"));
                exit;
            } else {
                $errors[] = "Erro ao atualizar o fornecedor.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $errors[] = "Este CNPJ ou E-mail já está sendo usado por outro fornecedor.";
            } else {
                $errors[] = "Erro ao atualizar: " . $e->getMessage();
            }
        }
    }
}

// 3. Busca os dados (GET)
if ($_SERVER["REQUEST_METHOD"] != "POST" || !empty($errors)) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE id = ?");
        $stmt->execute([$fornecedor_id]);
        $f = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($f) {
            $nome_empresa = $f['nome_empresa'];
            $cnpj = $f['cnpj'];
            $contato_nome = $f['contato_nome'];
            $telefone = $f['telefone'];
            $email = $f['email'];
            $endereco = $f['endereco'];
        } else {
            header("Location: fornecedores.php?feedback=" . urlencode("Erro: Fornecedor não encontrado."));
            exit;
        }
    } catch (PDOException $e) {
        header("Location: fornecedores.php?feedback=" . urlencode("Erro ao buscar fornecedor: " . $e->getMessage()));
        exit;
    }
}

// 4. HTML SÓ AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Editar Fornecedor</title>";
?>
<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Editar Fornecedor</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="fornecedores_editar.php?id=<?php echo $fornecedor_id; ?>" method="POST">
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
            
            <button type="submit" class="btn">Salvar Alterações</button>
            <a href="fornecedores.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>