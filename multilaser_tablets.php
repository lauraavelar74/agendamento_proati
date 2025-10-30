<?php
session_start();

// Se quiser impedir acesso sem login:
if (!isset($_SESSION['user_id'])) {
    header("Location: google-login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Multilaser - Sala de Computadores</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fafafa;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #6a1b9a;
            margin-bottom: 20px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
        }
        table th, table td {
            border: 1px solid #d8b6f0;
            padding: 10px;
            text-align: center;
        }
        table th {
            background: #d8b6f0;
            color: #fff;
        }
        select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #c7c7c7;
        }
        .voltar {
            text-align: center;
            margin-top: 20px;
        }
        .voltar a {
            text-decoration: none;
            padding: 10px 20px;
            background: #d8b6f0;
            border-radius: 5px;
            color: #fff;
        }
        .voltar a:hover {
            background: #c189e8;
        }
    </style>
</head>
<body>

<h1>Multilaser - Sala de Computadores</h1>

<table>
    <tr>
        <th>Computador</th>
        <th>Funcionamento</th>
        <th>Uso</th>
    </tr>

    <?php 
    for ($i = 1; $i <= 40; $i++): 
    ?>
    <tr>
        <td>Computador <?= $i ?></td>

        <td>
            <select>
                <option value="funcionando">Funcionando</option>
                <option value="nao_funcionando">Não Funcionando</option>
            </select>
        </td>

        <td>
            <select>
                <option value="usando">Usando</option>
                <option value="nao_usando">Não Usando</option>
            </select>
        </td>
    </tr>
    <?php endfor; ?>

</table>

<div class="voltar">
    <a href="novo_agendamentos.php">← Voltar</a>
</div>

</body>
</html>
