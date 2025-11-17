<?php
// src/cardapio_apagar.php

// 1. Lógica primeiro (auth e db)
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$prato_id = $_GET['id'] ?? 0;

if (!$prato_id) {
    header("Location: cardapio_admin.php?feedback=" . urlencode("Erro: ID do prato não fornecido."));
    exit;
}

try {
    // --- ADICIONADO: Etapa 1: Buscar o caminho da imagem ---
    $stmt = $pdo->prepare("SELECT imagem_url FROM cardapio_pratos WHERE id = ?");
    $stmt->execute([$prato_id]);
    $prato = $stmt->fetch(PDO::FETCH_ASSOC);

    // --- ADICIONADO: Etapa 2: Apagar o arquivo de imagem do servidor ---
    if ($prato && !empty($prato['imagem_url']) && file_exists(__DIR__ . '/' . $prato['imagem_url'])) {
        unlink(__DIR__ . '/' . $prato['imagem_url']);
    }

    // --- MODIFICADO: Etapa 3: Apagar o registro do banco ---
    $stmt = $pdo->prepare("DELETE FROM cardapio_pratos WHERE id = ?");
    $stmt->execute([$prato_id]);

    header("Location: cardapio_admin.php?feedback=" . urlencode("Prato apagado com sucesso."));
    exit;

} catch (PDOException $e) {
    $feedback = "Erro ao apagar prato: " . $e->getMessage();
    header("Location: cardapio_admin.php?feedback=" . urlencode($feedback));
    exit;
}
?>