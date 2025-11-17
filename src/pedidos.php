<?php
// src/pedidos.php

include(__DIR__ . '/includes/header.php');
include(__DIR__ . '/includes/db_connect.php'); 

echo "<title>Gerenciar Pedidos</title>";

// Bloco de feedback
$feedback = $_GET['feedback'] ?? '';
$feedback_class = '';
if ($feedback) {
    $feedback_class = 'alert-success';
    if (strpos($feedback, 'Erro') !== false) {
        $feedback_class = 'alert-danger';
    }
}

// Busca os pedidos
try {
    $sql = "SELECT 
                ped.id, 
                ped.total, 
                ped.status, 
                ped.data_pedido,
                c.nome AS nome_cliente,
                f.nome AS nome_funcionario
            FROM 
                pedidos AS ped
            LEFT JOIN 
                clientes AS c ON ped.cliente_id = c.id
            LEFT JOIN 
                funcionarios AS f ON ped.funcionario_id = f.id
            ORDER BY 
                ped.data_pedido DESC";
            
    $stmt = $pdo->query($sql);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Erro ao buscar pedidos: ' . $e->getMessage() . '</div>';
    $pedidos = [];
}
?>

<main>
    <div class="header-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Gerenciar Pedidos</h1>
        <a href="pedidos_novo.php" class="btn">Registrar Novo Pedido</a>
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
                    <th style="padding: 1rem; text-align: left;">Pedido #</th>
                    <th style="padding: 1rem; text-align: left;">Data</th>
                    <th style="padding: 1rem; text-align: left;">Cliente</th>
                    <th style="padding: 1rem; text-align: left;">Funcionário</th>
                    <th style="padding: 1rem; text-align: left;">Total</th>
                    <th style="padding: 1rem; text-align: left;">Status</th>
                    </tr>
            </thead>
            <tbody>
                <?php if (empty($pedidos)): ?>
                    <tr>
                        <td colspan="6" style="padding: 1rem; text-align: center;">Nenhum pedido registrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 1rem; font-weight: bold;">#<?php echo $pedido['id']; ?></td>
                            <td style="padding: 1rem;"><?php echo date('d/m/Y H:i', strtotime($pedido['data_pedido'])); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($pedido['nome_cliente'] ?? 'N/D'); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($pedido['nome_funcionario'] ?? 'N/D'); ?></td>
                            <td style="padding: 1rem;">R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></td>
                            <td style="padding: 1rem;"><?php echo htmlspecialchars($pedido['status']); ?></td>
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