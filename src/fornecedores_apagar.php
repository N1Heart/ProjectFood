<?php
// src/fornecedores_apagar.php

// 1. Lógica primeiro (auth e db)
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$fornecedor_id = $_GET['id'] ?? 0;

if (!$fornecedor_id) {
    header("Location: fornecedores.php?feedback=" . urlencode("Erro: ID do fornecedor não fornecido."));
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM fornecedores WHERE id = ?");
    $stmt->execute([$fornecedor_id]);

    header("Location: fornecedores.php?feedback=" . urlencode("Fornecedor apagado com sucesso."));
    exit;

} catch (PDOException $e) {
    // 💡 IMPORTANTE: No futuro, se um produto estiver ligado a este fornecedor,
    // o banco de dados pode bloquear a exclusão (dependendo de como
    // configuramos a FOREIGN KEY em 'produtos').
    
    $feedback = "Erro ao apagar fornecedor: " . $e->getMessage();
    if ($e->getCode() == 23000) {
        $feedback = "Erro: Não é possível apagar este fornecedor pois ele está ligado a um ou mais produtos no estoque.";
    }
    
    header("Location: fornecedores.php?feedback=" . urlencode($feedback));
    exit;
}

// Nenhum HTML aqui.
?>