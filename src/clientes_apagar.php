<?php
// src/clientes_apagar.php

// 1. Protege a página (inicia sessão e auth)
include(__DIR__ . '/includes/header.php');
include(__DIR__ . '/includes/db_connect.php');

$cliente_id = $_GET['id'] ?? 0;

if (!$cliente_id) {
    header("Location: clientes.php?feedback=" . urlencode("Erro: ID do cliente não fornecido."));
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
    $stmt->execute([$cliente_id]);

    header("Location: clientes.php?feedback=" . urlencode("Cliente apagado com sucesso."));
    exit;

} catch (PDOException $e) {
    // Tratamento de erro (ex: se o cliente tiver pedidos ligados a ele e o BD bloquear)
    header("Location: clientes.php?feedback=" . urlencode("Erro ao apagar cliente: " . $e->getMessage()));
    exit;
}

// Nenhum HTML é necessário, pois este arquivo apenas processa e redireciona.
// O footer.php não é chamado aqui.
?>