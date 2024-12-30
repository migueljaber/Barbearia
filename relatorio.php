<?php
session_start();
include_once('conexao.php');

if ($_SESSION['nivel'] !== 'adm') {
    // Se o usuário não for administrador, redireciona para uma página de erro ou inicial
    header('Location: cadastro/login.php');
    exit();
}

// Definir valores padrão para as variáveis de data
$dataInicio = isset($_GET['data_inicio']) ? DateTime::createFromFormat('d/m/Y', $_GET['data_inicio'])->format('Y-m-d') : date('Y-m-01'); // Primeiro dia do mês
$dataFim = isset($_GET['data_fim']) ? DateTime::createFromFormat('d/m/Y', $_GET['data_fim'])->format('Y-m-d') : date('Y-m-d'); // Dia atual

// Definir mensagem de erro
$noDataMessage = "<div class='alert alert-warning text-center'>Nenhum dado encontrado para o período selecionado.</div>";

// Consulta para obter o total de ganhos e o número de vendas para serviços "Concluídos"
$sql = "SELECT agendamentos.dia, SUM(servicos.preco) AS total_ganhos, COUNT(agendamentos.id) AS total_vendas
        FROM agendamentos
        JOIN servicos ON agendamentos.servico_id = servicos.id
        WHERE agendamentos.status = 'Concluído'
        AND agendamentos.dia BETWEEN '$dataInicio' AND '$dataFim'
        GROUP BY agendamentos.dia
        ORDER BY agendamentos.dia ASC";

$result = $conexao->query($sql);

// Inicializando arrays para armazenar os dados
$datas = [];
$ganhos = [];
$vendas = [];
$totalGeral = 0; // Para somatório total de ganhos

// Populando os arrays com os resultados da consulta
if ($result && $result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = date('d/m/Y', strtotime($row['dia'])); // Formato dd/mm/yyyy
        $ganhos[] = $row['total_ganhos'];
        $vendas[] = $row['total_vendas'];
        $totalGeral += $row['total_ganhos']; // Somatório dos ganhos
    }
} 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Relatório</title>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Flatpickr CSS para o calendário -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            background-color: #181818;
            color: #ffffff;
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


        h1 {
            color: #f1c40f;
            text-align: center;
        }
        .filter-container {
            background-color: #222;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 40px;
        }
        .btn-filter, .btn-print {
            background-color: #f1c40f;
            color: #000;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-filter:hover, .btn-print:hover {
            background-color: #d4ac0d;
        }
        .chart-container {
            background-color: #1f1f1f;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Relatório de Agendamentos e Ganhos</h1>
    <a href="./select2.php" class="btn-voltar">
            <i class='bx bx-left-arrow-alt'></i> Voltar
        </a>
    <!-- Botão de Imprimir -->
    <div class="text-end">
        <button class="btn-print" onclick="window.print();">
            <i class="bi bi-printer-fill"></i> Imprimir
        </button>
    </div>

    <!-- Filtros de data -->
    <div class="filter-container">
        <form method="GET" action="relatorio.php">
            <div class="row">
                <div class="col-md-5">
                    <label for="data_inicio" class="form-label">Data Início:</label>
                    <input type="text" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo date('d/m/Y', strtotime($dataInicio)); ?>" required>
                </div>
                <div class="col-md-5">
                    <label for="data_fim" class="form-label">Data Fim:</label>
                    <input type="text" class="form-control" id="data_fim" name="data_fim" value="<?php echo date('d/m/Y', strtotime($dataFim)); ?>" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn-filter">Filtrar</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Exibição dos gráficos -->
    <?php if ($result && $result->num_rows > 0): ?>
        <div class="chart-container">
            <canvas id="vendasChart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="ganhosChart"></canvas>
        </div>

        <!-- Tabela de Vendas e Ganhos -->
        <div class="table-container">
            <h2>Tabela de Agendamentos e Ganhos</h2>
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Total de Agendamentos</th>
                        <th>Total de Ganhos (R$)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $index => $data): ?>
                        <tr>
                            <td><?php echo $data; ?></td>
                            <td><?php echo $vendas[$index]; ?></td>
                            <td>R$ <?php echo number_format($ganhos[$index], 2, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2" style="font-weight: bold;">Total Geral</td>
                        <td style="font-weight: bold;">R$ <?php echo number_format($totalGeral, 2, ',', '.'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <?php echo $noDataMessage; ?>
    <?php endif; ?>
</div>

<!-- Script para Flatpickr e validação das datas -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    const dataInicioInput = flatpickr("#data_inicio", {
        dateFormat: "d/m/Y",
        defaultDate: "<?php echo date('d/m/Y'); ?>"
    });

    const dataFimInput = flatpickr("#data_fim", {
        dateFormat: "d/m/Y",
        defaultDate: "<?php echo date('d/m/Y'); ?>",
        onOpen: function(selectedDates, dateStr, instance) {
            const dataInicio = document.getElementById('data_inicio').value;
            instance.set('minDate', dataInicio); // Impedir que a data de fim seja anterior à data de início
        }
    });
</script>

<!-- Scripts para gerar os gráficos com Chart.js -->
<script>
    var ctxVendas = document.getElementById('vendasChart').getContext('2d');
    var vendasChart = new Chart(ctxVendas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($datas); ?>,
            datasets: [{
                label: 'Total de Vendas',
                data: <?php echo json_encode($vendas); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                hoverBackgroundColor: '#f1c40f',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, grid: { color: '#444' } },
                x: { grid: { color: '#444' } }
            }
        }
    });

    var ctxGanhos = document.getElementById('ganhosChart').getContext('2d');
    var ganhosChart = new Chart(ctxGanhos, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($datas); ?>,
            datasets: [{
                label: 'Total de Ganhos (R$)',
                data: <?php echo json_encode($ganhos); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                hoverBackgroundColor: '#f1c40f',
                pointBackgroundColor: '#f1c40f',
                pointBorderColor: '#fff',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, grid: { color: '#444' } },
                x: { grid: { color: '#444' } }
            }
        }
    });
</script>

</body>
</html>
