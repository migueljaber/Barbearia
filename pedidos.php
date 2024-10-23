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
        .appointments {
            max-width: 600px;
            margin: 20px auto;
            background-color: #E6CC82;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .appointments h2 {
            color: #333;
        }
        .appointment-item {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 3px;
            text-align: left;
            position: relative; /* Para posicionamento do botão */
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
    </style>
</head>
<body>
    <div class="appointments">
        <h1>Meus Agendamentos</h1>
        <?php
        session_start();
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

        // Realiza a consulta dos agendamentos do usuário
        $sql = "SELECT * FROM agendamentos WHERE usuario_id = '$usuario_id'";
        $result = $conexao->query($sql);

        // Verifica se há agendamentos
        if ($result->num_rows > 0) {
            echo "<div class='appointment-list'>";
            // Exibe cada agendamento encontrado
            while ($row = $result->fetch_assoc()) {
                $agendamento_id = $row['id'];
                $barbeiro = $row['barbeiro'];
                $servico = $row['servico'];
                $dia = $row['dia'];
                $horario = $row['horario'];
                echo "<div class='appointment-item'>";
                echo "<strong>Barbeiro:</strong> $barbeiro<br>";
                echo "<strong>Serviço:</strong> $servico<br>";
                echo "<strong>Dia:</strong> $dia<br>";
                echo "<strong>Horário:</strong> $horario<br>";
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
