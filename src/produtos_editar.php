<?php
// src/produtos_editar.php

// 1. Lógica PRIMEIRO
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$produto_id = $_GET['id'] ?? 0;
if (!$produto_id) {
    header("Location: estoque.php?feedback=" . urlencode("Erro: ID do produto não fornecido."));
    exit;
}

$nome = ""; $descricao = ""; $preco_custo = ""; $preco_venda = ""; $fornecedor_id_atual = "";
$errors = []; $fornecedores = [];

// 2. Busca os fornecedores para o dropdown
try {
    $stmt_fornecedores = $pdo->query("SELECT id, nome_empresa FROM fornecedores ORDER BY nome_empresa ASC");
    $fornecedores = $stmt_fornecedores->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errors[] = "Erro ao buscar fornecedores: " . $e->getMessage();
}

// 3. Processamento do POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco_custo = trim($_POST['preco_custo']);
    $preco_venda = trim($_POST['preco_venda']);
    $fornecedor_id_atual = trim($_POST['fornecedor_id']);

    if (empty($nome)) { $errors[] = "O nome do produto é obrigatório."; }
    if (empty($preco_venda)) { $errors[] = "O preço de venda é obrigatório."; }
    if (empty($fornecedor_id_atual)) { $fornecedor_id_atual = null; }

    if (empty($errors)) {
        try {
            // Aqui só atualizamos o PRODUTO. O estoque não é alterado.
            $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco_custo = ?, preco_venda = ?, fornecedor_id = ? 
                    WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([$nome, $descricao, $preco_custo, $preco_venda, $fornecedor_id_atual, $produto_id])) {
                header("Location: estoque.php?feedback=" . urlencode("Produto atualizado com sucesso!"));
                exit;
            } else {
                $errors[] = "Erro ao atualizar o produto.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erro ao atualizar: " . $e->getMessage();
        }
    }
}

// 4. Busca os dados (GET)
if ($_SERVER["REQUEST_METHOD"] != "POST" || !empty($errors)) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$produto_id]);
        $p = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($p) {
            $nome = $p['nome'];
            $descricao = $p['descricao'];
            $preco_custo = $p['preco_custo'];
            $preco_venda = $p['preco_venda'];
            $fornecedor_id_atual = $p['fornecedor_id'];
        } else {
            header("Location: estoque.php?feedback=" . urlencode("Erro: Produto não encontrado."));
            exit;
        }
    } catch (PDOException $e) {
        header("Location: estoque.php?feedback=" . urlencode("Erro ao buscar produto: " . $e->getMessage()));
        exit;
    }
}

// 5. HTML SÓ AGORA
include(__DIR__ . '/includes/header.php');
echo "<title>Editar Produto</title>";
?>
<main>
    <div class="form-container" style="max-width: 600px;">
        <h1>Editar Produto</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="produtos_editar.php?id=<?php echo $produto_id; ?>" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Produto *</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="fornecedor_id">Fornecedor</label>
                <select id="fornecedor_id" name="fornecedor_id" class="form-group" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                    <option value="">-- Nenhum --</option>
                    <?php foreach ($fornecedores as $f): ?>
                        <option value="<?php echo $f['id']; ?>" <?php echo ($f['id'] == $fornecedor_id_atual) ? 'selected' : ''; ?>>
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
            
            <button type="submit" class="btn">Salvar Alterações</button>
            <a href="estoque.php" style="margin-left: 15px;">Cancelar</a>
        </form>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>