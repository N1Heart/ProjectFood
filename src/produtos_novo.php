<?php
// src/produtos_novo.php

// 1. Lógica PRIMEIRO
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$nome = "";
$descricao = "";
$preco_custo = "";
$preco_venda = "";
$fornecedor_id = "";
$errors = [];

// 2. Busca os fornecedores para o dropdown
try {
    $stmt_fornecedores = $pdo->query("SELECT id, nome_empresa FROM fornecedores ORDER BY nome_empresa ASC");
    $fornecedores = $stmt_fornecedores->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errors[] = "Erro ao buscar fornecedores: " . $e->getMessage();
    $fornecedores = [];
}

// 3. Processamento do POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco_custo = trim($_POST['preco_custo']);
    $preco_venda = trim($_POST['preco_venda']);
    $fornecedor_id = trim($_POST['fornecedor_id']);

    if (empty($nome)) { $errors[] = "O nome do produto é obrigatório."; }
    if (empty($preco_venda)) { $errors[] = "O preço de venda é obrigatório."; }
    if (empty($fornecedor_id)) { $fornecedor_id = null; } // Permite fornecedor nulo

    if (empty($errors)) {
        // Inicia a transação
        $pdo->beginTransaction();
        
        try {
            // 1. Insere o produto
            $sql_prod = "INSERT INTO produtos (nome, descricao, preco_custo, preco_venda, fornecedor_id) 
                         VALUES (?, ?, ?, ?, ?)";
            $stmt_prod = $pdo->prepare($sql_prod);
            $stmt_prod->execute([$nome, $descricao, $preco_custo, $preco_venda, $fornecedor_id]);
            
            // 2. Pega o ID do produto que acabamos de criar
            $produto_id = $pdo->lastInsertId();
            
            // 3. Cria a entrada de estoque inicial (com 0)
            $sql_est = "INSERT INTO estoque (produto_id, quantidade) VALUES (?, 0)";
            $stmt_est = $pdo->prepare($sql_est);
            $stmt_est->execute([$produto_id]);
            
            // 4. Se tudo deu certo, confirma a transação
            $pdo->commit();
            
            header("Location: estoque.php?feedback=" . urlencode("Produto cadastrado com sucesso!"));
            exit;
            
        } catch (PDOException $e) {
            // 5. Se algo deu errado, desfaz tudo
            $pdo->rollBack();
            $errors[] = "Erro ao cadastrar produto: " . $e->getMessage();
        }
    }
}

// 4. HTML SÓ AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Novo Produto</title>";
?>
<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Novo Produto</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="produtos_novo.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Produto *</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="fornecedor_id">Fornecedor</label>
                <select id="fornecedor_id" name="fornecedor_id" class="form-group" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                    <option value="">-- Nenhum --</option>
                    <?php foreach ($fornecedores as $f): ?>
                        <option value="<?php echo $f['id']; ?>">
                            <?php echo htmlspecialchars($f['nome_empresa']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="preco_custo">Preço de Custo (Ex: 10.50)</label>
                <input type="number" step="0.01" id="preco_custo" name="preco_custo" value="<?php echo htmlspecialchars($preco_custo); ?>">
            </div>

            <div class="form-group">
                <label for="preco_venda">Preço de Venda * (Ex: 15.99)</label>
                <input type="number" step="0.01" id="preco_venda" name="preco_venda" value="<?php echo htmlspecialchars($preco_venda); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;"><?php echo htmlspecialchars($descricao); ?></textarea>
            </div>
            
            <button type="submit" class="btn">Cadastrar Produto</button>
            <a href="estoque.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>