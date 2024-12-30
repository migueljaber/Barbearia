<?php
include_once('conexao.php'); // Inclui a conexão com o banco de dados

// Verifica se os dados foram enviados via POST
if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id']; // ID do agendamento
    $novoStatus = $_POST['status']; // Novo status (Pendente ou Concluído)

    // Atualiza o status no banco de dados
    $sql = "UPDATE agendamentos SET status = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('si', $novoStatus, $id); // 'si' -> String (status), Integer (ID)

    if ($stmt->execute()) {
        echo "Status atualizado com sucesso!";
    } else {
        // Exibe a mensagem de erro caso haja um problema
        echo "Erro ao atualizar o status: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Dados inválidos.";
}
?>
