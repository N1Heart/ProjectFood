<?php
// src/clientes.php

// 1. Protege a página e inclui o cabeçalho
include(__DIR__ . '/includes/header.php');

include(__DIR__ . '/includes/db_connect.php'); // Precisamos do $pdo

echo "<title>Gerenciar Clientes</title>";

// Bloco de feedback (para quando um cliente for criado, editado ou apagado)
$feedback = $_GET['feedback'] ?? '';
$feedback_class = '';
if ($feedback) {
    $feedback_class = 'alert-success';
    if (strpos($feedback, 'Erro') !== false) {
        $feedback_class = 'alert-danger';
    }
}

// 2. Busca todos os clientes
try {
    $stmt = $pdo->query("SELECT id, nome, email, telefone FROM clientes ORDER BY nome ASC");
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Erro ao buscar clientes: ' . $e->getMessage() . '</div>';
    $clientes = []; // Garante que $clientes é um array
}
?>
<main>
    <div class="header-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Gerenciar Clientes</h1>
        <a href="clientes_novo.php" class="btn">Novo Cliente</a>
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
                    <th style="padding: 1rem; text-align: left;">Telefone</th>
                    <th style="padding: 1rem; text-align: left;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($clientes)): ?>
                    <tr>
                        <td colspan="4" style="padding: 1rem; text-align: center;">Nenhum cliente cadastrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($cliente['nome']); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($cliente['email']); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                            <td style="padding: 1rem;">
                                <a href="clientes_editar.php?id=<?php echo $cliente['id']; ?>" style="color: #007bff; text-decoration: none; font-weight: bold;">Editar</a>
                                <a href="clientes_apagar.php?id=<?php echo $cliente['id']; ?>" 
                                   style="color: #dc3545; text-decoration: none; font-weight: bold; margin-left: 15px;"
                                   onclick="return confirm('Tem certeza que deseja apagar este cliente? Esta ação não pode ser desfeita.');">
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