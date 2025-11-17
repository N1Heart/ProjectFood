<?php
// src/estoque_saida.php

// 1. Lógica PRIMEIRO
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$produto_id = $_GET['id'] ?? 0;
if (!$produto_id) {
    header("Location: estoque.php?feedback=" . urlencode("Erro: ID do produto não fornecido."));
    exit;
}

$nome_produto = "";
$quantidade_atual = 0;
$errors = [];

// 2. Busca os dados atuais (necessário para o POST e para o GET)
try {
    $stmt = $pdo->prepare("SELECT p.nome, e.quantidade 
                          FROM produtos p 
                          JOIN estoque e ON p.id = e.produto_id 
                          WHERE p.id = ?");
    $stmt->execute([$produto_id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        $nome_produto = $produto['nome'];
        $quantidade_atual = $produto['quantidade'];
    } else {
        header("Location: estoque.php?feedback=" . urlencode("Erro: Produto não encontrado no estoque."));
        exit;
    }
} catch (PDOException $e) {
    header("Location: estoque.php?feedback=" . urlencode("Erro ao buscar produto: " . $e->getMessage()));
    exit;
}

// 3. Processamento do POST (quando dá a baixa)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantidade_retirar = $_POST['quantidade'] ?? 0;
    
    if (!is_numeric($quantidade_retirar) || $quantidade_retirar <= 0) {
        $errors[] = "A quantidade a retirar deve ser um número positivo.";
    }

    // 🚨 VALIDAÇÃO DE SEGURANÇA: Não pode retirar mais do que tem
    if ($quantidade_retirar > $quantidade_atual) {
        $errors[] = "Erro: Você não pode retirar $quantidade_retirar unidades. Só existem $quantidade_atual em estoque.";
    }

    if (empty($errors)) {
        try {
            // A query agora SUBTRAI
            $sql = "UPDATE estoque SET quantidade = quantidade - ? WHERE produto_id = ?";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$quantidade_retirar, $produto_id])) {
                header("Location: estoque.php?feedback=" . urlencode("Baixa de estoque realizada com sucesso!"));
                exit;
            } else {
                $errors[] = "Erro ao atualizar o estoque.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao atualizar: " . $e->getMessage();
        }
    }
    // Se houver erros, o script continua e mostra o formulário abaixo
}


// 4. HTML SÓ AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Dar Baixa no Estoque</title>";
?>
<link rel="stylesheet" href="styles.css">
<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Dar Baixa no Estoque</h1>
        <h2 style="margin-bottom: 1rem; font-weight: 400;"><?php echo htmlspecialchars($nome_produto); ?></h2>

        <div style="padding: 1rem; background: #f0f0f0; border-radius: 5px; margin-bottom: 1.5rem;">
            <strong>Quantidade Atual:</strong> <?php echo $quantidade_atual; ?>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="estoque_saida.php?id=<?php echo $produto_id; ?>" method="POST">
            <div class="form-group">
                <label for="quantidade">Quantidade a Retirar *</label>
                <input type="number" id="quantidade" name="quantidade" min="1" max="<?php echo $quantidade_atual; ?>" required>
            </div>
            
            <button type="submit" class="btn" style="background-color: #ffc107; color: #333;">Dar Baixa do Estoque</button>
            <a href="estoque.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>