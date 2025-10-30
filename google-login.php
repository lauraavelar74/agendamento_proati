<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

// Carrega variáveis do .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client_id = $_ENV['GOOGLE_CLIENT_ID'];
$redirect_uri = $_ENV['GOOGLE_REDIRECT_URI'];

// URL de autenticação do Google
$auth_url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code',
    'scope' => 'email profile',
    'access_type' => 'offline',
    'prompt' => 'select_account'
]);

echo "<a href='$auth_url'>Login com Google</a>";
