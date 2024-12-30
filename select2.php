<?php
session_start();
include_once('conexao.php');

if ($_SESSION['nivel'] !== 'adm') {
    // Se o usuário não for administrador, redireciona para uma página de erro ou inicial
    header('Location: cadastro/login.php');
    exit();
}

// Verificar se existe um filtro de pesquisa, barbeiro ou status
$filter = "";
$dia = ""; // Definindo uma variável padrão para evitar o erro de variável indefinida

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $filter = "WHERE usuarios.nome LIKE '%$data%' OR agendamentos.barbeiro LIKE '%$data%'";
} else if (!empty($_GET['barbeiro'])) {
    $barbeiro = $_GET['barbeiro'];
    $filter = "WHERE agendamentos.barbeiro = '$barbeiro'";
} else if (!empty($_GET['dia'])) {
    $dia = $_GET['dia']; // Definir o valor da variável $dia se estiver presente na URL
    $filter = "WHERE agendamentos.dia >= '$dia'";
} else if (!empty($_GET['status'])) {
    $status = $_GET['status'];
    $filter = "WHERE agendamentos.status = '$status'";
}

// Consulta SQL atualizada para aplicar o filtro
$sql = "SELECT agendamentos.id, usuarios.nome AS cliente, agendamentos.barbeiro, agendamentos.horario, agendamentos.dia, servicos.nome AS servico, agendamentos.status
        FROM agendamentos
        JOIN usuarios ON agendamentos.usuario_id = usuarios.id
        JOIN servicos ON agendamentos.servico_id = servicos.id
        $filter
        ORDER BY (agendamentos.dia = '$dia') DESC, agendamentos.dia ASC, agendamentos.horario ASC";

$result = $conexao->query($sql);

// Recuperar a lista de barbeiros e status únicos
$barbeiros_sql = "SELECT DISTINCT barbeiro FROM agendamentos";
$barbeiros_result = $conexao->query($barbeiros_sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Agendamentos - Barbeiro</title>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            background-image: url(./imagens/fundo.png);
            color: white;
            text-align: center;
        }
        .table-bg {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }
        .box-search {
            display: flex;
            justify-content: center;
            gap: .1%;
        }
        .navbar-brand {
            color: #d39400;
        }
        .dropdown-search {
            width: 200px;
            margin-left: 10px;
        }
        .status-btn {
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .status-btn.pendente {
            background-color: #f0ad4e;
            color: white;
        }
        .status-btn.concluido {
            background-color: #5cb85c;
            color: white;
        }
        .status-btn:hover {
            opacity: 0.8;
        }
        .btn-voltar {
    position: absolute;
    top: 65px;
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
    <nav class="navbar navbar-expand-lg" style="background-color: #2c2c2c;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Página do Barbeiro</a>
        </div>
        <div class="d-flex">
            <a href="relatorio.php" class="btn btn-primary me-5">Relatório</a>
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <a href="./select.php" class="btn-voltar">
            <i class='bx bx-left-arrow-alt'></i> Voltar
        </a>
    <br>
    <h1>Bem-vindo, Barbeiro!</h1>
    <br>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar por cliente" id="pesquisar">
        <button onclick="searchData()" class="btn btn-warning" style="background: linear-gradient(45deg, #ffb300, #d39400);">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>

        <!-- Dropdown para selecionar o barbeiro -->
        <select class="dropdown-search form-select" id="barbeiroSelect" onchange="searchBarbeiro()">
            <option value="">Todos os Barbeiros</option>
            <?php
            while ($barbeiro = mysqli_fetch_assoc($barbeiros_result)) {
                echo "<option value='".$barbeiro['barbeiro']."'>".$barbeiro['barbeiro']."</option>";
            }
            ?>
        </select>

        <!-- Dropdown para selecionar status -->
        <select class="dropdown-search form-select" id="statusSelect" onchange="searchStatus()">
            <option value="">Todos os Status</option>
            <option value="Pendente">Pendentes</option>
            <option value="Concluído">Concluídos</option>
        </select>

        <!-- Mini calendário Flatpickr -->
        <input type="text" class="form-control dropdown-search" id="dataSelect" placeholder="Escolher Data">
    </div>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Barbeiro</th>
                    <th scope="col">Horário</th>
                    <th scope="col">Serviço</th>
                    <th scope="col">Data</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="agendamentosTable">
                <?php
                while ($agendamento_data = mysqli_fetch_assoc($result)) {
                    // Converte a data do formato yyyy-mm-dd para dd/mm/yyyy
                    $dataFormatada = date('d/m/Y', strtotime($agendamento_data['dia']));
                    $statusClass = ($agendamento_data['status'] == 'Pendente') ? 'pendente' : 'concluido';
                    echo "<tr>";
                    echo "<td>".$agendamento_data['id']."</td>";
                    echo "<td>".$agendamento_data['cliente']."</td>";
                    echo "<td>".$agendamento_data['barbeiro']."</td>";
                    echo "<td>".$agendamento_data['horario']."</td>";
                    echo "<td>".$agendamento_data['servico']."</td>";
                    echo "<td>".$dataFormatada."</td>"; // Exibe a data formatada
                    echo "<td><button class='status-btn $statusClass' onclick='alterarStatus(".$agendamento_data['id'].", this)'>".$agendamento_data['status']."</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                searchData();
            }
        });

        function searchData() {
            window.location = 'select2.php?search=' + search.value;
        }

        function searchBarbeiro() {
            var barbeiro = document.getElementById('barbeiroSelect').value;
            window.location = 'select2.php?barbeiro=' + barbeiro;
        }

        function searchStatus() {
            var status = document.getElementById('statusSelect').value;
            window.location = 'select2.php?status=' + status;
        }

        // Inicializando o Flatpickr para o campo de data no formato dd/mm/yyyy
        flatpickr("#dataSelect", {
            dateFormat: "d/m/Y", // Formato de data exibido no campo
            onChange: function(selectedDates, dateStr, instance) {
                // Converte a data selecionada para o formato yyyy-mm-dd para o banco de dados
                const dateForDB = selectedDates[0].toISOString().split('T')[0];
                window.location = 'select2.php?dia=' + dateForDB;
            }
        });

        // Função AJAX para alterar o status do agendamento
        function alterarStatus(agendamentoId, btnElement) {
            var novoStatus = (btnElement.innerText === 'Pendente') ? 'Concluído' : 'Pendente';
            
            $.ajax({
                url: 'atualizar_status.php',
                type: 'POST',
                data: { id: agendamentoId, status: novoStatus },
                success: function(response) {
                    // Alterar o texto e a cor do botão após a alteração
                    btnElement.innerText = novoStatus;
                    btnElement.classList.toggle('pendente');
                    btnElement.classList.toggle('concluido');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Adicionado para depurar o erro
                    alert('Erro ao alterar o status.');
                }
            });
        }
    </script>
</body>
</html>
