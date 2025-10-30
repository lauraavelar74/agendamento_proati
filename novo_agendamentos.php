<?php
require_once 'conexao.php';

$mensagem = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $data = $_POST['data_agendamento'];
    $horario = $_POST['horario'];
    $periodo = $_POST['periodo'];

    try {
        $sql = "INSERT INTO agenda (nome, email, data_agendamento, horario, periodo)
                VALUES (:nome, :email, :data_agendamento, :horario, :periodo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':data_agendamento' => $data,
            ':horario' => $horario,
            ':periodo' => $periodo
        ]);

        $mensagem = "Agendamento cadastrado com sucesso!";
    } catch (PDOException $e) {
        $mensagem = "Erro ao cadastrar: " . $e->getMessage();
    }
}
?>

<h1>Novo Agendamento</h1>

<!-- Tabelas / Cards -->
<table class="tabela-principal">
    <tr>
        <td onclick="window.location='multilaser_computador.php'">Multilaser</td>
        <td onclick="window.location='multilaser_tablets.php'">Tablets</td>
    </tr>
    <tr>
        <td onclick="window.location='info1.php'">Sala de Computador 1</td>
        <td onclick="window.location='info2.php'">Sala de Computador 2</td>
    </tr>
    <tr>
        <td colspan="2" onclick="window.location='info3.php'">Sala de Computador 3</td>
    </tr>
</table>




<?php if(!empty($mensagem)) : ?>
    <p class="<?= strpos($mensagem, 'Erro') === false ? 'mensagem-sucesso' : 'mensagem-erro' ?>">
        <?= htmlspecialchars($mensagem) ?>
    </p>
<?php endif; ?>

<style>
    h1 {
        color: #6a1b9a;
        text-align: center;
    }

    /* Estilo da tabela principal */
    .tabela-principal {
        margin: 20px auto;
        border-collapse: collapse;
        text-align: center;
    }

    .tabela-principal td {
        border: 1px solidrgb(204, 240, 0);
        background-color:rgb(12, 4, 18);
        color: #fff;
        padding: 40px 20px; /* altura maior */
        font-weight: bold;
        border-radius: 8px;
        width: 200px;
        height: 100px;
        transition: background-color 0.3s, transform 0.2s;
        cursor: pointer;
    }

    .tabela-principal td:hover {
        background-color: #c189e8;
        transform: translateY(-5px);
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        max-width: 400px;
        margin: 20px auto;
    }

    form label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    form input, form select {
        padding: 8px;
        width: 100%;
        margin-top: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    form button {
        margin-top: 15px;
        padding: 10px 20px;
        background-color: #d8b6f0;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    form button:hover {
        background-color: #c189e8;
    }

    .mensagem-sucesso {
        color: green;
        font-weight: bold;
        margin-top: 15px;
        text-align: center;
    }

    .mensagem-erro {
        color: red;
        font-weight: bold;
        margin-top: 15px;
        text-align: center;
    }
</style>
