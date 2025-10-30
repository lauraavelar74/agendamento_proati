<?php
session_start();

// Bloqueia acesso se não estiver logado
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

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fafafa;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #6a1b9a;
            margin-bottom: 25px;
        }

        /* Container em duas colunas */
        .container {
            display: flex;
            justify-content: center;
            gap: 50px;
        }

        /* Tabela de computadores */
        table {
            border-collapse: collapse;
            width: 420px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table th {
            background: #d8b6f0;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        table td {
            border: 1px solid #d8b6f0;
            padding: 8px;
            text-align: center;
        }

        select {
            padding: 6px;
            border: 1px solid #b38adf;
            border-radius: 5px;
        }

        /* Box de informações */
        .info-box {
            width: 300px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .info-box h2 {
            text-align: center;
            color: #6a1b9a;
        }

        .info-box label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        .info-box select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #bbb;
        }

        .voltar {
            text-align: center;
            margin-top: 25px;
        }
        .voltar a {
            padding: 10px 20px;
            background: #d8b6f0;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }
        .voltar a:hover {
            background: #b874de;
        }
    </style>
</head>
<body>

<h1>Multilaser - Sala de Computadores</h1>

<div class="container">

    <!-- Tabela antiga (mantida) -->
    <table>
        <tr>
            <th>Computador</th>
            <th>Funcionamento</th>
            <th>Uso</th>
        </tr>

        <?php for ($i = 1; $i <= 40; $i++): ?>
            <tr>
                <td>Computador <?= $i ?></td>

                <td>
                    <select>
                        <option>Funcionando</option>
                        <option>Não Funcionando</option>
                    </select>
                </td>

                <td>
                    <select>
                        <option>Usando</option>
                        <option>Não Usando</option>
                    </select>
                </td>
            </tr>
        <?php endfor; ?>
    </table>

    <!-- Lado direito = Turno + Sala Usada -->
    <div class="info-box">
        <h2>Informações</h2>

        <label>Turno:</label>
        <select>
            <option>Manhã</option>
            <option>Tarde</option>
            <option>Noite</option>
        </select>

        <label>Sala Usada (Turma):</label>
        <select>
            <option>6º Ano</option>
            <option>7º Ano</option>
            <option>8º Ano</option>
            <option>9º Ano</option>
        </select>
    </div>

</div>

<div class="voltar">
    <a href="novo_agendamentos.php">← Voltar</a>
</div>

</body>
</html>
