<?php
require_once __DIR__ . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client_id = $_ENV['GOOGLE_CLIENT_ID'];
$client_secret = $_ENV['GOOGLE_CLIENT_SECRET'];
$redirect_uri = trim($_ENV['GOOGLE_REDIRECT_URI']);

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $token = file_get_contents('https://oauth2.googleapis.com/token', false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query([
                'code' => $code,
                'client_id' => $client_id,
                'client_secret' => $client_secret,
                'redirect_uri' => $redirect_uri,
                'grant_type' => 'authorization_code',
            ]),
        ],
    ]));

    $data = json_decode($token, true);

    if (isset($data['access_token'])) {
        $userInfo = file_get_contents('https://www.googleapis.com/oauth2/v2/userinfo?access_token=' . $data['access_token']);
        $user = json_decode($userInfo, true);
        echo "Bem-vinda, " . htmlspecialchars($user['name']);
//        header('location:/painel.php')
          } else {
        echo "Erro ao obter token de acesso.";
    }
} else {
    echo "Código não recebido.";
}
header('location:/painel.php')
    ?>
