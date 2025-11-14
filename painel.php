<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: google-login.php");
    exit;
}

// Página que será incluída no painel
$page = $_GET['page'] ?? 'inicio';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>laura</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }
        aside.sidebar {
            width: 220px;
            background: #f2f2f2;
            padding: 20px;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        aside.sidebar ul {
            list-style: none;
            padding: 0;
        }
        aside.sidebar ul li {
            margin-bottom: 10px;
        }
        aside.sidebar ul li a {
            text-decoration: none;
            color: #333;
            padding: 8px 12px;
            display: block;
            border-radius: 5px;
        }
        aside.sidebar ul li a:hover {
            background-color: #d8b6f0;
            color: #fff;
        }
        main.content {
            flex: 1;
            padding: 20px;
        }
        h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <h2>Olá, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
    <ul>
        <li><a href="painel.php?page=inicio">Início</a></li>
        <li><a href="novo_agendamentos.php">Novo Agendamento</a></li>
        <li><a href="painel.php?page=lista">Lista de Agendamentos</a></li>
        <li><a href="logout.php">Sair</a></li>
    </ul>
</aside>

<main class="content">
    <?php
    switch ($page) {
        case 'novo':
            if (file_exists('novo_agendamentos.php')) {
                include 'novo_agendamentos.php';
            } else {
                echo "<p>Página de Novo Agendamento não encontrada.</p>";
            }
            break;

        case 'lista':
            if (file_exists('lista_agendamentos.php')) {
                include 'lista_agendamentos.php';
            } else {
                echo "<p>Página de Lista de Agendamentos não encontrada.</p>";
            }
            break;

        default:
            echo "<h2>Bem-vindo ao Painel</h2>";
            echo "<p>Use o menu lateral para navegar pelo sistema.</p>";
    }
    ?>
</main>

</body>
</html>
