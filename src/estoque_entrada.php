<?php
// src/estoque_entrada.php

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

// 2. Processamento do POST (quando adiciona quantidade)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantidade_adicionar = $_POST['quantidade'] ?? 0;
    
    if (!is_numeric($quantidade_adicionar) || $quantidade_adicionar <= 0) {
        $errors[] = "A quantidade a adicionar deve ser um número positivo.";
    }

    if (empty($errors)) {
        try {
            // Esta é a query mágica: ela soma a quantidade atual + a nova
            $sql = "UPDATE estoque SET quantidade = quantidade + ? WHERE produto_id = ?";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$quantidade_adicionar, $produto_id])) {
                header("Location: estoque.php?feedback=" . urlencode("Estoque atualizado com sucesso!"));
                exit;
            } else {
                $errors[] = "Erro ao atualizar o estoque.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao atualizar: " . $e->getMessage();
        }
    }
}

// 3. Busca os dados (GET)
if ($_SERVER["REQUEST_METHOD"] != "POST" || !empty($errors)) {
    try {
        // Busca o nome do produto e a quantidade atual
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
}

// 4. HTML SÓ AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Dar Entrada no Estoque</title>";
?>
<link rel="stylesheet" href="styles.css">
<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Dar Entrada no Estoque</h1>
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
        
        <form action="estoque_entrada.php?id=<?php echo $produto_id; ?>" method="POST">
            <div class="form-group">
                <label for="quantidade">Quantidade a Adicionar *</label>
                <input type="number" id="quantidade" name="quantidade" min="1" required>
            </div>
            
            <button type="submit" class="btn">Adicionar ao Estoque</button>
            <a href="estoque.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>