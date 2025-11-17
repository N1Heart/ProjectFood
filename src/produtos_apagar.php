<?php
// src/produtos_apagar.php

// 1. Lógica primeiro (auth e db)
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$produto_id = $_GET['id'] ?? 0;

if (!$produto_id) {
    header("Location: estoque.php?feedback=" . urlencode("Erro: ID do produto não fornecido."));
    exit;
}

try {
    // Graças ao "ON DELETE CASCADE", apagar o produto
    // também apaga a linha correspondente na tabela "estoque".
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$produto_id]);

    header("Location: estoque.php?feedback=" . urlencode("Produto apagado com sucesso."));
    exit;

} catch (PDOException $e) {
    // Pode dar erro se o produto estiver ligado a um "pedido" no futuro
    $feedback = "Erro ao apagar produto: " . $e->getMessage();
    header("Location: estoque.php?feedback=" . urlencode($feedback));
    exit;
}
?>