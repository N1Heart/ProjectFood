<?php
// src/clientes_editar.php

include(__DIR__ . '/includes/header.php');
include(__DIR__ . '/includes/db_connect.php');

$cliente_id = $_GET['id'] ?? 0;
if (!$cliente_id) {
    header("Location: clientes.php?feedback=" . urlencode("Erro: ID do cliente não fornecido."));
    exit;
}

$nome = "";
$email = "";
$telefone = "";
$endereco = "";
$errors = [];

// Processamento do formulário (quando o usuário SALVA)
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
            $sql = "UPDATE clientes SET nome = ?, email = ?, telefone = ?, endereco = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$nome, $email, $telefone, $endereco, $cliente_id])) {
                header("Location: clientes.php?feedback=" . urlencode("Cliente atualizado com sucesso!"));
                exit;
            } else {
                $errors[] = "Erro ao atualizar o cliente.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $errors[] = "Este e-mail já está sendo usado por outro cliente.";
            } else {
                $errors[] = "Erro ao atualizar: " . $e->getMessage();
            }
        }
    }
}

// Busca os dados do cliente para preencher o formulário (quando o usuário ABRE a página)
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    try {
        $stmt = $pdo->prepare("SELECT nome, email, telefone, endereco FROM clientes WHERE id = ?");
        $stmt->execute([$cliente_id]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            $nome = $cliente['nome'];
            $email = $cliente['email'];
            $telefone = $cliente['telefone'];
            $endereco = $cliente['endereco'];
        } else {
            header("Location: clientes.php?feedback=" . urlencode("Erro: Cliente não encontrado."));
            exit;
        }
    } catch (PDOException $e) {
        header("Location: clientes.php?feedback=" . urlencode("Erro ao buscar cliente: " . $e->getMessage()));
        exit;
    }
}

echo "<title>Editar Cliente</title>";
?>
<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Editar Cliente</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="clientes_editar.php?id=<?php echo $cliente_id; ?>" method="POST">
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
            
            <button type="submit" class="btn">Salvar Alterações</button>
            <a href="clientes.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>