<?php
session_start();
include("conexao.php");

// Verifica se o cliente está logado
if (!isset($_SESSION['id'])) {
    header("Location: cadastro/login.php");
    exit;
}

// Obtém os dados do formulário
$barbeiro = $_POST['barbeiro'];
$servico = $_POST['servico'];
$dia = $_POST['dia'];
$horario = $_POST['horario'];
$usuario_id = $_SESSION['id'];  // ID do usuário logado

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Insere o agendamento no banco de dados, associando com o ID do usuário logado
$sql = "INSERT INTO agendamentos (usuario_id, barbeiro, dia, servico, horario) VALUES ('$usuario_id', '$barbeiro', '$dia', '$servico', '$horario')";

if ($conexao->query($sql) === TRUE) {
    echo "Agendamento realizado com sucesso!";
} else {
    echo "Erro ao agendar: " . $conexao->error;
}

$conexao->close();
?>
