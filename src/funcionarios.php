<?php
// src/funcionarios.php

// 1. Protege a página e inclui o cabeçalho
include(__DIR__ . '/includes/header.php');
include(__DIR__ . '/includes/db_connect.php'); // Precisamos do $pdo

echo "<title>Gerenciar Funcionários</title>";

// Bloco de feedback
$feedback = $_GET['feedback'] ?? '';
$feedback_class = '';
if ($feedback) {
    $feedback_class = 'alert-success';
    if (strpos($feedback, 'Erro') !== false) {
        $feedback_class = 'alert-danger';
    }
}

// 2. Busca todos os funcionários
try {
    $stmt = $pdo->query("SELECT id, nome, email, cargo FROM funcionarios ORDER BY nome ASC");
    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Erro ao buscar funcionários: ' . $e->getMessage() . '</div>';
    $funcionarios = [];
}
?>
<link rel="stylesheet" href="./styles.css">
<main >
    <div class="header-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Gerenciar Funcionários</h1>
        <a href="funcionarios_novo.php" class="btn">Novo Funcionário</a>
    </div>

    <?php if ($feedback): ?>
        <div class="alert <?php echo $feedback_class; ?>">
            <?php echo htmlspecialchars($feedback); ?>
        </div>
    <?php endif; ?>

    <div class="table-container" style="background: #fff; padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f0f0;">
                    <th style="padding: 1rem; text-align: left;">Nome</th>
                    <th style="padding: 1rem; text-align: left;">Email</th>
                    <th style="padding: 1rem; text-align: left;">Cargo</th>
                    <th style="padding: 1rem; text-align: left;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($funcionarios)): ?>
                    <tr>
                        <td colspan="4" style="padding: 1rem; text-align: center;">Nenhum funcionário cadastrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($funcionarios as $func): ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($func['nome']); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($func['email']); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($func['cargo']); ?></td>
                            <td style="padding: 1rem;">
                                <a href="funcionarios_editar.php?id=<?php echo $func['id']; ?>" style="color: #007bff; text-decoration: none; font-weight: bold;">Editar</a>
                                
                                <?php if ($func['id'] != $_SESSION['funcionario_id']): ?>
                                    <a href="funcionarios_apagar.php?id=<?php echo $func['id']; ?>" 
                                       style="color: #dc3545; text-decoration: none; font-weight: bold; margin-left: 15px;"
                                       onclick="return confirm('Tem certeza que deseja apagar este funcionário?');">
                                       Apagar
                                    </a>
                                <?php else: ?>
                                    <span style="color: #999; margin-left: 15px;">(Você)</span>
                                <?php endif; ?>
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