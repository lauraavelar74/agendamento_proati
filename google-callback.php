<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

// Carrega variáveis do .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client_id = $_ENV['GOOGLE_CLIENT_ID'];
$client_secret = $_ENV['GOOGLE_CLIENT_SECRET'];
$redirect_uri = $_ENV['GOOGLE_REDIRECT_URI'];

// Verifica se recebeu o código
if (!isset($_GET['code'])) {
    exit("Código não recebido.");
}

$code = $_GET['code'];

// Troca o código pelo token usando cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://oauth2.googleapis.com/token");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'code' => $code,
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'redirect_uri' => $redirect_uri,
    'grant_type' => 'authorization_code'
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

$response = curl_exec($ch);
if(curl_errno($ch)){
    exit('Erro no cURL: ' . curl_error($ch));
}
curl_close($ch);

$token = json_decode($response, true);
if(isset($token['error'])){
    exit("Erro ao obter token: " . $token['error_description']);
}

$access_token = $token['access_token'] ?? null;
if (!$access_token) {
    exit("Token não recebido.");
}

// Pega informações do usuário
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $access_token);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$userinfo_response = curl_exec($ch);
if(curl_errno($ch)){
    exit('Erro no cURL ao buscar usuário: ' . curl_error($ch));
}
curl_close($ch);

$user = json_decode($userinfo_response, true);
if (!isset($user['id'])) {
    exit("Erro: dados do usuário não recebidos.");
}

// Conecta ao banco
try {
    $pdo = new PDO("mysql:host=localhost;dbname=agendamentos;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Erro ao conectar ao banco: " . $e->getMessage());
}

// Verifica se o usuário já existe pelo google_id
$stmt = $pdo->prepare("SELECT * FROM users WHERE google_id = ?");
$stmt->execute([$user['id']]); // tabela users
$existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing_user) {
    $user_id = $existing_user['id'];
} else {
    // Insere novo usuário
    $stmt = $pdo->prepare("INSERT INTO users (google_id, nome, email) VALUES (?, ?, ?)");
    $stmt->execute([$user['id'], $user['name'], $user['email']]);
    $user_id = $pdo->lastInsertId();
}

// Cria sessão
$_SESSION['user_id'] = $user_id;
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];

// Redireciona para o painel
header("Location: painel.php");
exit;
