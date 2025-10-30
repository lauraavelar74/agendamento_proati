<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

// Carrega variáveis do .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Pega valores do .env
$client_id = $_ENV['GOOGLE_CLIENT_ID'];
$redirect_uri = $_ENV['GOOGLE_REDIRECT_URI'];

// Monta a URL de autenticação Google
$auth_url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code',
    'scope' => 'email profile',
    'access_type' => 'offline',
    'prompt' => 'select_account'
]);

// Redireciona para a página de login do Google
header("Location: $auth_url");
exit;
