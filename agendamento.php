<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Serviço</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2f2841;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 540px;
            margin: 20px auto;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            text-decoration: underline;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        select, input[type="submit"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }
        input[type="date"], input[type="number"]{
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 96.5%;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
            color: #333;
            text-align: right;
        }
        label{
            font-weight: bold;
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
    </style>
</head>
<body>
        <a href="./inicio.php" class="btn-voltar">
            <i class='bx bx-left-arrow-alt'></i> Voltar
        </a>
<div class="container">
    <h1>Agendar Corte de Cabelo</h1>
    <form id="agendamentoForm" action="agendarservico.php" method="POST">
        <label for="barbeiro">Selecione o Barbeiro:</label>
        <select name="barbeiro" id="barbeiro" required>
            <option value="">Selecione...</option>
            <option value="André">André</option>
            <option value="Jean">Jean</option>
            <option value="Gabriel">Gabriel</option>
            <option value="Patrick">Patrick</option>
        </select>

        <label for="dia">Selecione o Dia:</label>
        <input type="date" name="dia" id="dia" required>

        <label for="horario">Selecione o Horário:</label>
        <select name="horario" id="horario" required>
            <option value="">Selecione um barbeiro e dia primeiro</option>
        </select>

        <label for="servico">Selecione o Serviço:</label>
        <select name="servico" id="servico" required>
            <option value="">Selecione...</option>
            <?php
            include("conexao.php");
            $sql_servicos = "SELECT * FROM servicos";
            $result_servicos = $conexao->query($sql_servicos);
            if ($result_servicos->num_rows > 0) {
                while($row = $result_servicos->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "' data-preco='" . $row['preco'] . "'>" . $row['nome'] . " - R$" . $row['preco'] . "</option>";
                }
            }
            ?>
        </select>

        <label for="quantidade">Quantidade de Cortes:</label>
        <input type="number" name="quantidade" id="quantidade" value="1" min="1" max="5" required>

        <!-- Campo para exibir o valor total -->
        <div class="total" id="totalValor">Total: R$0,00</div>

        <input type="submit" value="Agendar">
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Função para atualizar o valor total
        function atualizarValorTotal() {
            var precoServico = parseFloat($('#servico option:selected').data('preco')) || 0;
            var quantidade = parseInt($('#quantidade').val()) || 1;
            var valorTotal = precoServico * quantidade;
            $('#totalValor').text('Total: R$' + valorTotal.toFixed(2));
        }

        // Atualiza o valor total quando o serviço ou a quantidade muda
        $('#servico, #quantidade').on('change', atualizarValorTotal);

        // Atualiza os horários dinamicamente via AJAX
        $('#barbeiro, #dia').on('change', function() {
            var barbeiro = $('#barbeiro').val();
            var dia = $('#dia').val();

            if (barbeiro && dia) {
                $.ajax({
                    url: 'verificar_horarios.php',
                    type: 'POST',
                    data: {
                        barbeiro: barbeiro,
                        dia: dia
                    },
                    success: function(data) {
                        $('#horario').html(data);
                    }
                });
            } else {
                $('#horario').html('<option value="">Selecione um barbeiro e dia primeiro</option>');
            }
        });
    });
    
    document.addEventListener("DOMContentLoaded", function() {
        // Obtém a data de hoje no formato AAAA-MM-DD
        var hoje = new Date().toISOString().split('T')[0];
        // Define o valor mínimo do campo de data para a data de hoje
        document.getElementById("dia").setAttribute("min", hoje);
    });


</script>

</body>
</html>
