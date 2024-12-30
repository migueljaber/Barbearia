<?php
session_start();

// Verifique se o usuário está logado corretamente e se a sessão contém o 'id' e 'email'
if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    // Se não estiver logado, redirecionar para a página de login
    header('Location: cadastro/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Agendamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(imagens/fundo.png);
            padding: 20px;
            text-align: center;
        }
        .btn-voltar {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            background: #ffb300;
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, transform 0.2s;
        }

        .btn-voltar:hover {
            background: #d59500;
            transform: translateY(-2px);
        }

        .btn-voltar i {
            margin-right: 5px;
            font-size: 18px;
        }
        .appointments {
            max-width: 600px;
            margin: 20px auto;
            background-color: #E6CC82;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .appointments h1 {
            color: #333;
        }
        .appointment-item {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 3px;
            text-align: left;
            position: relative;
        }
        .delete-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .total-cost {
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }
    </style>
</head>
<body>
        <a href="./inicio.php" class="btn-voltar">
            <i class='bx bx-left-arrow-alt'></i> Voltar
        </a>
    <div class="appointments">
        <h1>Meus Agendamentos</h1>
        <?php
       
        include("conexao.php");

        // Verifica se o cliente está logado
        if (!isset($_SESSION['id'])) {
            header("Location: cadastro/login.php");
            exit;
        }

        // Obtém o ID do usuário logado
        $usuario_id = $_SESSION['id'];

        // Verifica se o formulário de cancelamento foi submetido
        if (isset($_POST['cancelar_agendamento'])) {
            $agendamento_id = $_POST['agendamento_id'];

            // Executa o cancelamento do agendamento no banco de dados
            $sql_delete = "DELETE FROM agendamentos WHERE id = '$agendamento_id' AND usuario_id = '$usuario_id'";
            if ($conexao->query($sql_delete) === TRUE) {
                echo "<p>Agendamento cancelado com sucesso.</p>";
            } else {
                echo "<p>Erro ao cancelar agendamento: " . $conexao->error . "</p>";
            }
        }

        // Realiza a consulta dos agendamentos do usuário que NÃO estão com status "Concluído"
        $sql = "SELECT a.id, a.barbeiro, a.dia, a.horario, s.nome AS servico_nome, s.preco AS servico_preco
                FROM agendamentos a
                JOIN servicos s ON a.servico_id = s.id
                WHERE a.usuario_id = '$usuario_id' AND a.status != 'Concluído'";
        $result = $conexao->query($sql);

        // Verifica se há agendamentos
        if ($result->num_rows > 0) {
            echo "<div class='appointment-list'>";
            // Exibe cada agendamento encontrado
            while ($row = $result->fetch_assoc()) {
                $agendamento_id = $row['id'];
                $barbeiro = $row['barbeiro'];
                $servico = $row['servico_nome'];
                $preco_servico = $row['servico_preco'];
                $dia = date('d/m/Y', strtotime($row['dia']));  // Formata a data para dd/mm/yyyy
                $horario = $row['horario'];
                $valor_total = $preco_servico;  // Sem quantidade

                echo "<div class='appointment-item'>";
                echo "<strong>Barbeiro:</strong> $barbeiro<br>";
                echo "<strong>Serviço:</strong> $servico<br>";
                echo "<strong>Preço do Serviço:</strong> R$" . number_format($preco_servico, 2, ',', '.') . "<br>";
                echo "<strong>Dia:</strong> $dia<br>";  // Exibe a data formatada como dia/mês/ano
                echo "<strong>Horário:</strong> $horario<br>";
                echo "<div class='total-cost'><strong>Valor Total:</strong> R$" . number_format($valor_total, 2, ',', '.') . "</div>";
                // Botão de delete
                echo "<form method='post' action='pedidos.php'>";
                echo "<input type='hidden' name='agendamento_id' value='$agendamento_id'>";
                echo "<button type='submit' class='delete-button' name='cancelar_agendamento'>Cancelar</button>";
                echo "</form>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>Você não tem agendamentos.</p>";
        }

        $conexao->close();
        ?>
    </div>
</body>
</html>
