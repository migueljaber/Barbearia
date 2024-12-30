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
$servico_id = $_POST['servico'];
$dia = $_POST['dia'];
$horario_inicial = $_POST['horario'];  // O primeiro horário escolhido
$quantidade = (int) $_POST['quantidade']; // Quantidade de cortes
$usuario_id = $_SESSION['id'];  // ID do usuário logado

// Define a duração de cada corte (em minutos)
$duracao_corte = 30; // Suponha que cada corte leve 30 minutos

// Verifica se houve erro na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Converte o horário inicial para um formato DateTime
$horario_atual = new DateTime($horario_inicial);

// Função para verificar se o barbeiro está disponível para todos os horários necessários
function verificar_disponibilidade($conexao, $barbeiro, $dia, $horario_atual, $quantidade, $duracao_corte) {
    for ($i = 0; $i < $quantidade; $i++) {
        $horario_str = $horario_atual->format('H:i:s');
        $sql_verificar = "SELECT * FROM agendamentos WHERE barbeiro = '$barbeiro' AND dia = '$dia' AND horario = '$horario_str'";
        $resultado = $conexao->query($sql_verificar);

        if ($resultado->num_rows > 0) {
            return false; // Se algum horário já estiver ocupado, retorna falso
        }
        // Avança para o próximo horário
        $horario_atual->modify("+$duracao_corte minutes");
    }
    return true; // Todos os horários estão disponíveis
}

// Função para adicionar múltiplos agendamentos
function adicionar_agendamentos($conexao, $usuario_id, $barbeiro, $dia, $horario_atual, $quantidade, $duracao_corte, $servico_id) {
    for ($i = 0; $i < $quantidade; $i++) {
        $horario_str = $horario_atual->format('H:i:s');
        $sql = "INSERT INTO agendamentos (usuario_id, barbeiro, dia, horario, servico_id) 
                VALUES ('$usuario_id', '$barbeiro', '$dia', '$horario_str', '$servico_id')";
        
        if ($conexao->query($sql) === TRUE) {
            // Agendamento realizado
        } else {
            echo "Erro ao agendar: " . $conexao->error;
            return false;
        }
        // Avança para o próximo horário
        $horario_atual->modify("+$duracao_corte minutes");
    }
    return true;
}

// Verifica se há horários consecutivos disponíveis
if (verificar_disponibilidade($conexao, $barbeiro, $dia, $horario_atual, $quantidade, $duracao_corte)) {
    // Se os horários estão disponíveis, insere os agendamentos
    if (adicionar_agendamentos($conexao, $usuario_id, $barbeiro, $dia, $horario_atual, $quantidade, $duracao_corte, $servico_id)) {
        echo "Agendamentos realizados com sucesso!";
        header('Location: sucesso.php');
    }
} else {
    echo "Não há horários consecutivos disponíveis para a quantidade de cortes selecionada.";
}

$conexao->close();
?>
