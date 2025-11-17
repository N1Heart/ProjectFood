<?php
// src/fornecedores.php

include(__DIR__ . '/includes/header.php');

include(__DIR__ . '/includes/db_connect.php'); 

echo "<title>Gerenciar Fornecedores</title>";

// Bloco de feedback
$feedback = $_GET['feedback'] ?? '';
$feedback_class = '';
if ($feedback) {
    $feedback_class = 'alert-success';
    if (strpos($feedback, 'Erro') !== false) {
        $feedback_class = 'alert-danger';
    }
}

// Busca todos os fornecedores
try {
    $stmt = $pdo->query("SELECT id, nome_empresa, cnpj, contato_nome, telefone, email 
                         FROM fornecedores 
                         ORDER BY nome_empresa ASC");
    $fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Erro ao buscar fornecedores: ' . $e->getMessage() . '</div>';
    $fornecedores = [];
}
?>
<main>
    <div class="header-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Gerenciar Fornecedores</h1>
        <a href="fornecedores_novo.php" class="btn">Novo Fornecedor</a>
    </div>

    <?php if ($feedback): ?>
        <div class="alert <?php echo $feedback_class; ?>">
            <?php echo htmlspecialchars($feedback); ?>
        </div>
    <?php endif; ?>

    <div class="table-container" style="background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f0f0;">
                    <th style="padding: 1rem; text-align: left;">Empresa</th>
                    <th style="padding: 1rem; text-align: left;">CNPJ</th>
                    <th style="padding: 1rem; text-align: left;">Contato</th>
                    <th style="padding: 1rem; text-align: left;">Telefone</th>
                    <th style="padding: 1rem; text-align: left;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($fornecedores)): ?>
                    <tr>
                        <td colspan="5" style="padding: 1rem; text-align: center;">Nenhum fornecedor cadastrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($fornecedores as $f): ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($f['nome_empresa']); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($f['cnpj']); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($f['contato_nome']); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($f['telefone']); ?></td>
                            <td style="padding: 1rem;">
                                <a href="fornecedores_editar.php?id=<?php echo $f['id']; ?>" style="color: #007bff; text-decoration: none; font-weight: bold;">Editar</a>
                                <a href="fornecedores_apagar.php?id=<?php echo $f['id']; ?>" 
                                   style="color: #dc3545; text-decoration: none; font-weight: bold; margin-left: 15px;"
                                   onclick="return confirm('Tem certeza que deseja apagar este fornecedor?');">
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