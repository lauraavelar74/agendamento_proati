<?php
session_start();

// Bloqueia acesso se não estiver logado
if (!isset($_SESSION['user_id'])) {
    header("Location: google-login.php");
    exit;
}

// Número total de computadores
$totalComputadores = 40;
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

.container {
    display: flex;
    justify-content: center;
    gap: 50px;
}

table {
    border-collapse: collapse;
    width: 500px;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    text-align: center;
}

table th {
    background: #d8b6f0;
    color: #fff;
    padding: 10px;
}

table td {
    border: 1px solid #d8b6f0;
    padding: 8px;
}

.status {
    color: white;
    font-weight: bold;
    padding: 4px 8px;
    border-radius: 6px;
}

.verde { background-color: #4CAF50; }    /* Funcionando ou Livre */
.amarelo { background-color: #FFEB3B; color: #000; } /* Em Uso */
.vermelho { background-color: #f44336; } /* Defeito */

.report-btn {
    padding: 6px 12px;
    background: #ff5f5f;
    color: white;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}

.report-btn:hover { background: #d63f3f; }

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

    <!-- Tabela de computadores -->
    <table id="tabela-computadores">
        <tr>
            <th>Computador</th>
            <th>Funcionamento</th>
            <th>Uso</th>
            <th>Ação</th>
        </tr>

        <?php for ($i = 1; $i <= $totalComputadores; $i++): ?>
        <tr id="linha-<?= $i ?>">
            <td>Computador <?= $i ?></td>
            <td>
                <span class="status verde" id="func-<?= $i ?>">Funcionando</span>
            </td>
            <td>
                <span class="status verde" id="uso-<?= $i ?>">Livre</span>
            </td>
            <td>
                <button class="report-btn" onclick="reportarDefeito(<?= $i ?>)">Reportar</button>
            </td>
        </tr>
        <?php endfor; ?>
    </table>

    <!-- Box lateral -->
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

        <label>Quantidade de Multilaser Usados:</label>
        <select id="quantidade-usados" onchange="atualizaUso()">
            <?php for ($q = 1; $q <= $totalComputadores; $q++): ?>
                <option><?= $q ?></option>
            <?php endfor; ?>
        </select>
    </div>

</div>

<div class="voltar">
    <a href="novo_agendamentos.php">← Voltar</a>
</div>

<script>
// Atualiza o status de uso ignorando computadores com defeito
function atualizaUso() {
    const quantidade = parseInt(document.getElementById('quantidade-usados').value);
    let count = 0;

    for (let i = 1; i <= <?= $totalComputadores ?>; i++) {
        const tdUso = document.getElementById('uso-' + i);
        const tdFunc = document.getElementById('func-' + i);

        // Se computador está com defeito, permanece vermelho
        if (tdFunc.textContent === 'Defeito') {
            tdUso.textContent = 'Defeito';
            tdUso.className = 'status vermelho';
            continue;
        }

        // Marca como "Em Uso" se ainda não atingiu a quantidade selecionada
        if (count < quantidade) {
            tdUso.textContent = 'Em Uso';
            tdUso.className = 'status amarelo';
            count++;
        } else {
            tdUso.textContent = 'Livre';
            tdUso.className = 'status verde';
        }
    }
}

// Marca as células de funcionamento e uso como defeito
function reportarDefeito(num) {
    const tdFunc = document.getElementById('func-' + num);
    const tdUso = document.getElementById('uso-' + num);

    tdFunc.textContent = 'Defeito';
    tdFunc.className = 'status vermelho';

    tdUso.textContent = 'Defeito';
    tdUso.className = 'status vermelho';

    // Recalcula os computadores em uso
    atualizaUso();
}

// Inicializa
atualizaUso();
</script>

</body>
</html>
