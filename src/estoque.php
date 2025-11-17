<?php
// src/estoque.php

include(__DIR__ . '/includes/header.php');
include(__DIR__ . '/includes/db_connect.php'); 

echo "<title>Controle de Estoque</title>";

// Bloco de feedback
$feedback = $_GET['feedback'] ?? '';
$feedback_class = '';
if ($feedback) {
    $feedback_class = 'alert-success';
    if (strpos($feedback, 'Erro') !== false) {
        $feedback_class = 'alert-danger';
    }
}

// 2. Busca os produtos com suas quantidades e fornecedores
try {
    // Esta é a nossa consulta mais complexa até agora
    $sql = "SELECT 
                p.id, 
                p.nome AS nome_produto, 
                p.preco_venda, 
                e.quantidade, 
                f.nome_empresa AS nome_fornecedor
            FROM 
                produtos AS p
            LEFT JOIN 
                estoque AS e ON p.id = e.produto_id
            LEFT JOIN 
                fornecedores AS f ON p.fornecedor_id = f.id
            ORDER BY 
                p.nome ASC";
            
    $stmt = $pdo->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Erro ao buscar produtos: ' . $e->getMessage() . '</div>';
    $produtos = [];
}
?>

<main>
    <div class="header-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Controle de Estoque</h1>
        <a href="produtos_novo.php" class="btn">Novo Produto</a>
    </div>

    <?php if ($feedback): ?>
        <div class="alert <?php echo $feedback_class; ?>">
            <?php echo htmlspecialchars($feedback); ?>
        </div>
    <?php endif; ?>

    <div class="table-container" style="background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 700px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f0f0;">
                    <th style="padding: 1rem; text-align: left;">Produto</th>
                    <th style="padding: 1rem; text-align: left;">Fornecedor</th>
                    <th style="padding: 1rem; text-align: left;">Preço Venda</th>
                    <th style="padding: 1rem; text-align: center;">Qtd. em Estoque</th>
                    <th style="padding: 1rem; text-align: left;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produtos)): ?>
                    <tr>
                        <td colspan="5" style="padding: 1rem; text-align: center;">Nenhum produto cadastrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($produtos as $p): ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($p['nome_produto']); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($p['nome_fornecedor'] ?? 'N/D'); ?></td>
                            <td style="padding: 1rem;">R$ <?php echo number_format($p['preco_venda'], 2, ',', '.'); ?></td>
                            <td style="padding: 1rem; text-align: center; font-weight: bold; <?php echo ($p['quantidade'] <= 0) ? 'color: #dc3545;' : ''; ?>">
                                <?php echo $p['quantidade'] ?? 0; ?>
                            </td>
                            <td style="padding: 1rem;">
                                <a href="estoque_entrada.php?id=<?php echo $p['id']; ?>" style="color: #28a745; text-decoration: none; font-weight: bold;">[Entrada]</a>
                                <a href="estoque_saida.php?id=<?php echo $p['id']; ?>" style="color: #ffc107; text-decoration: none; font-weight: bold; margin-left: 10px;">[Baixa]</a>
                                <a href="produtos_editar.php?id=<?php echo $p['id']; ?>" style="color: #007bff; text-decoration: none; font-weight: bold; margin-left: 10px;">Editar</a>
                                <a href="produtos_apagar.php?id=<?php echo $p['id']; ?>" 
                                   style="color: #dc3545; text-decoration: none; font-weight: bold; margin-left: 10px;"
                                   onclick="return confirm('Tem certeza que deseja apagar este PRODUTO? Isso também apagará seu registro de estoque.');">
                                   Apagar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php
include(__DIR__ . '/includes/footer.php');
?>