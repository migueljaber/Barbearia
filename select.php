<?php
session_start();
include_once("./conexao.php");

// Verifica se o nível de acesso do usuário é "adm"
if ($_SESSION['nivel'] !== 'adm') {
    // Se o usuário não for administrador, redireciona para uma página de erro ou inicial
    header('Location: cadastro/login.php');
    exit();
}

// A partir daqui, somente o administrador tem acesso
?>
<?php
// Lógica de busca
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM usuarios WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' or nivel LIKE '%$data%' or numero LIKE '%$data%' ORDER BY id ASC";
} else {
    $sql = "SELECT * FROM usuarios ORDER BY id ASC";
}
$result = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Administração</title>
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
        #agendamentos{
            margin-right: 15px;
        }
        .nivel-dropdown {
            background-color: #2c2c2c;
            color: white;
            border: 1px solid #d39400;
            border-radius: 5px;
            padding: 5px;
        }
        .nivel-dropdown option {
            background-color: #2c2c2c;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #2c2c2c;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Página do Administrador</a>
        </div>
        <a href="./select2.php" id="agendamentos" class="btn btn-warning">Agendamentos</a>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <br>
    <?php echo "<h1>Bem-vindo, Administrador!</h1>"; ?>
    <br>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-warning" style="background: linear-gradient(45deg, #ffb300, #d39400);">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nível</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Senha</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Número</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$user_data['id']."</td>";
                    echo "<td>";
                    // Dropdown para selecionar o nível (adm ou cliente)
                    echo "<select class='nivel-dropdown' onchange=\"atualizarNivel(".$user_data['id'].", this.value)\">";
                    echo "<option value='cliente' ".($user_data['nivel'] == 'cliente' ? "selected" : "").">Cliente</option>";
                    echo "<option value='adm' ".($user_data['nivel'] == 'adm' ? "selected" : "").">Administrador</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "<td>".$user_data['nome']."</td>";
                    echo "<td>".$user_data['email']."</td>";
                    echo "<td>".$user_data['senha']."</td>";
                    echo "<td>".$user_data['cpf']."</td>";
                    echo "<td>".$user_data['numero']."</td>";
                    echo "<td>
                       
                        <a class='btn btn-sm btn-danger' href='delete.php?id=".$user_data['id']."' title='Deletar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        </a>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        window.location = 'select.php?search=' + search.value;
    }

    // Função para atualizar o nível do usuário via AJAX
    function atualizarNivel(userId, novoNivel) {
        $.ajax({
            url: 'atualizar_nivel.php',
            type: 'POST',
            data: {
                id: userId,
                nivel: novoNivel
            },
            success: function(response) {
                alert('Nível atualizado com sucesso!');
            },
            error: function() {
                alert('Erro ao atualizar nível.');
            }
        });
    }
</script>
</html>
