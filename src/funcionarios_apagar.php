<?php
// src/funcionarios_apagar.php

// 1. Lógica primeiro (auth e db)
require_once(__DIR__ . '/includes/auth_check.php');
require_once(__DIR__ . '/includes/db_connect.php');

$funcionario_id = $_GET['id'] ?? 0;

if (!$funcionario_id) {
    header("Location: funcionarios.php?feedback=" . urlencode("Erro: ID do funcionário não fornecido."));
    exit;
}

// 2. 🚨 TRAVA DE SEGURANÇA: Não permita que o usuário apague a si mesmo!
if ($funcionario_id == $_SESSION['funcionario_id']) {
    header("Location: funcionarios.php?feedback=" . urlencode("Erro: Você não pode apagar o seu próprio usuário."));
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM funcionarios WHERE id = ?");
    $stmt->execute([$funcionario_id]);

    header("Location: funcionarios.php?feedback=" . urlencode("Funcionário apagado com sucesso."));
    exit;

} catch (PDOException $e) {
    header("Location: funcionarios.php?feedback=" . urlencode("Erro ao apagar funcionário: " . $e->getMessage()));
    exit;
}

// Nenhum HTML aqui.
?>