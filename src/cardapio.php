<?php
// src/cardapio_publico.php

// NÃO inclui auth_check.php. É PÚBLICO.
include(__DIR__ . '/includes/db_connect.php'); 

try {
    // Busca apenas pratos que estão marcados como "Disponível"
    $sql = "SELECT nome, descricao, preco, imagem_url 
            FROM cardapio_pratos
            WHERE disponivel = 1
            ORDER BY nome ASC";
    $stmt = $pdo->query($sql);
    $pratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $pratos = [];
    $erro = "Erro ao carregar o cardápio.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosso Cardápio</title>
    <link rel="stylesheet" href="/assets/css/styles.css"> 
    <style>
        /* Estilos específicos para o cardápio público */
        body { background-color: #f4f4f4; }
        .cardapio-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 1rem;
        }
        .cardapio-container h1 {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }
        .prato-item {
            background: #fff;
            display: flex; /* Para alinhar imagem e texto */
            margin-bottom: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            overflow: hidden; /* Para a imagem se ajustar ao radius */
        }
        .prato-imagem {
            width: 150px;
            height: 120px;
            object-fit: cover;
            flex-shrink: 0; /* Impede que a imagem encolha */
        }
        .prato-info {
            padding: 1rem 1.5rem;
            flex-grow: 1;
        }
        .prato-info h2 {
            margin: 0 0 0.5rem 0;
            color: #333;
        }
        .prato-info p {
            margin: 0 0 0.5rem 0;
            color: #666;
            font-size: 0.9em;
        }
        .prato-info .preco {
            font-size: 1.2rem;
            font-weight: bold;
            color: #4CAF50;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>

    <div class="cardapio-container">
        <h1>Nosso Cardápio</h1>
        
        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php elseif (empty($pratos)): ?>
            <div class="alert" style="text-align: center;">Nenhum prato disponível no momento.</div>
        <?php else: ?>
            <?php foreach ($pratos as $prato): ?>
                <div class="prato-item">
                    
                    <?php if (!empty($prato['imagem_url'])): ?>
                        <img src="/<?php echo htmlspecialchars($prato['imagem_url']); ?>" 
                             alt="<?php echo htmlspecialchars($prato['nome']); ?>" 
                             class="prato-imagem">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/150x120.png?text=Prato" 
                             alt="Sem imagem" 
                             class="prato-imagem">
                    <?php endif; ?>

                    <div class="prato-info">
                        <h2><?php echo htmlspecialchars($prato['nome']); ?></h2>
                        <p><?php echo htmlspecialchars($prato['descricao']); ?></p>
                        <div class="preco">R$ <?php echo number_format($prato['preco'], 2, ',', '.'); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>