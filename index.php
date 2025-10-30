<?php
session_start();
if (!empty($_SESSION['user'])) {
    header('Location: painel.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Proati - Início</title>
    <style>
        body { font-family: Arial; display:flex; align-items:center; justify-content:center; height:100vh; background:#f6f6f8; margin:0; }
        .card { background:#fff; padding:30px; border-radius:8px; box-shadow:0 6px 18px rgba(0,0,0,0.06); text-align:center; width:360px; }
        .btn-google { display:inline-block; padding:10px 16px; border-radius:6px; border:1px solid #ddd; cursor:pointer; text-decoration:none; color:#444; font-weight:600; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Bem-vindo ao Proati</h2>
        <p>Acesse com sua conta Google</p>
        <a class="btn-google" href="login.php">Entrar com Google</a>
    </div>
</body>
</html>
