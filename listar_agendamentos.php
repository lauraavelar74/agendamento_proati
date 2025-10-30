<?php
require_once 'conexao.php';

try {
    // Buscar todos os agendamentos da tabela agenda
    $sql = "SELECT * FROM agenda";
    $stmt = $pdo->query($sql);
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($agendamentos) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Período</th>
                <th>Criado em</th>
              </tr>";

        foreach ($agendamentos as $a) {
            echo "<tr>
                    <td>{$a['id']}</td>
                    <td>{$a['nome']}</td>
                    <td>{$a['email']}</td>
                    <td>{$a['data_agendamento']}</td>
                    <td>{$a['horario']}</td>
                    <td>{$a['periodo']}</td>
                    <td>{$a['criado_em']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Nenhum agendamento encontrado.";
    }
} catch (PDOException $e) {
    echo "Erro ao buscar agendamentos: " . $e->getMessage();
}
?>
