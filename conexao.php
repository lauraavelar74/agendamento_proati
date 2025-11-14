<?php
// Configurações do banco
$host = $_ENV[$HOST];
$db   = $_ENV[$DB];
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// DSN (Data Source Name) do PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    // Conexão PDO
    $pdo = new PDO($dsn, $user, $pass);
    // Ativa mensagens de erro do PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Mostra mensagem de erro caso falhe
    die("Erro na conexão: " . $e->getMessage());
}
?>
