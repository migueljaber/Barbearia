<?php
include_once('conexao.php');

if (isset($_POST['id']) && isset($_POST['nivel'])) {
    $id = $_POST['id'];
    $novoNivel = $_POST['nivel']; // Recebe 'adm' ou 'cliente'

    // Atualiza o nível do usuário no banco de dados
    $sql = "UPDATE usuarios SET nivel = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('si', $novoNivel, $id); // Bind do novo nível e do ID

    if ($stmt->execute()) {
        echo "Nível atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o nível: " . $conexao->error;
    }

    $stmt->close();
} else {
    echo "Dados inválidos.";
}
?>
