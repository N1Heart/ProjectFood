<?php
// src/includes/db_connect.php

// --- LEITURA DAS VARIÁVEIS DE AMBIENTE (do docker-compose.yml) ---
// getenv() lê uma variável de ambiente definida no 'environment' do serviço 'web'
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');

// --- Fallback (opcional, mas bom para depuração) ---
// Se getenv() falhar, usa um valor padrão.
$host = $host ?: 'db';
$dbname = $dbname ?: 'meu_projeto_db';
$username = $username ?: 'usuario_projeto';
$password = $password ?: 'senha_projeto';
$charset = 'utf8mb4';

// --- DSN (Data Source Name) ---
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

// Opções do PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Tenta criar a instância da conexão PDO
    $pdo = new PDO($dsn, $username, $password, $options);
    
} catch (\PDOException $e) {
    // Se a conexão falhar, exibe o erro.
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>