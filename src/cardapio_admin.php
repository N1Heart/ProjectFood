<?php
// src/cardapio_admin.php

include(__DIR__ . '/includes/header.php');
include(__DIR__ . '/includes/db_connect.php'); 

echo "<title>Gerenciar Cardápio</title>";

// Bloco de feedback
$feedback = $_GET['feedback'] ?? '';
$feedback_class = '';
if ($feedback) {
    $feedback_class = 'alert-success';
    if (strpos($feedback, 'Erro') !== false) {
        $feedback_class = 'alert-danger';
    }
}

// --- MODIFICADO: Busca também a coluna 'imagem_url' ---
try {
    $stmt = $pdo->query("SELECT id, nome, descricao, preco, imagem_url, disponivel 
                         FROM cardapio_pratos 
                         ORDER BY nome ASC");
    $pratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Erro ao buscar pratos: ' . $e->getMessage() . '</div>';
    $pratos = [];
}
?>

<main>
    <div class="header-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Gerenciar Cardápio</h1>
        <a href="cardapio_novo.php" class="btn">Novo Prato</a>
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
                    <th style="padding: 1rem; text-align: left; width: 100px;">Imagem</th>
                    <th style="padding: 1rem; text-align: left;">Prato</th>
                    <th style="padding: 1rem; text-align: left;">Descrição</th>
                    <th style="padding: 1rem; text-align: left;">Preço</th>
                    <th style="padding: 1rem; text-align: left;">Disponível</th>
                    <th style="padding: 1rem; text-align: left;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pratos)): ?>
                    <tr>
                        <td colspan="6" style="padding: 1rem; text-align: center;">Nenhum prato cadastrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pratos as $prato): ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            
                            <td style="padding: 0.5rem;">
                                <?php if (!empty($prato['imagem_url'])): ?>
                                    <img src="/<?php echo htmlspecialchars($prato['imagem_url']); ?>" 
                                         alt="<?php echo htmlspecialchars($prato['nome']); ?>" 
                                         style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
                                <?php else: ?>
                                    <span style="color: #999; font-size: 0.9em;">Sem Imagem</span>
                                <?php endif; ?>
                            </td>

                            <td style="padding: 1rem;"><?php echo htmlspecialchars($prato['nome']); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($prato['descricao']); ?></td>
                            <td style="padding: 1rem;">R$ <?php echo number_format($prato['preco'], 2, ',', '.'); ?></td>
                            <td style="padding: 1rem; color: <?php echo $prato['disponivel'] ? '#28a745' : '#dc3545'; ?>;">
                                <?php echo $prato['disponivel'] ? 'Sim' : 'Não'; ?>
                            </td>
                            <td style="padding: 1rem;">
                                <a href="cardapio_editar.php?id=<?php echo $prato['id']; ?>" style="color: #007bff; text-decoration: none; font-weight: bold;">Editar</a>
                                <a href="cardapio_apagar.php?id=<?php echo $prato['id']; ?>" 
                                   style="color: #dc3545; text-decoration: none; font-weight: bold; margin-left: 15px;"
                                   onclick="return confirm('Tem certeza que deseja apagar este prato?');">
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
