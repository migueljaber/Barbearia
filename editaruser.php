<?php
    session_start();
    include_once('conexao.php');

    if (!empty($_GET['id'])) {
        $id = $_GET['id'];  

        $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
        $result = $conexao->query($sqlSelect);

        if ($result->num_rows > 0) {
            
            while ($user_data = mysqli_fetch_assoc($result)) {
                $nome = $user_data['nome'];
                $email = $user_data['email'];
                $numero = $user_data['numero'];
            }
        } else {

            header('Location: inicio.php');
        }
    } else {
        // Se o 'id' não for passado na URL, redireciona para a página inicial
        header('Location: inicio.php');
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    

    <title>Cadastro</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="cadastro/cadastro.js"></script>
</head>
<body>
    <div class="main-login">
        
    
        <div class="right-login">
              <!-- Botão de Voltar -->
        <a href="inicio.php" class="btn-voltar">
            <i class='bx bx-left-arrow-alt'></i> Voltar
        </a>
            <div class="wrapper">
                <h1>Editar Usuário</h1>
                <form action="./saveedituser.php" method="POST" onsubmit="return validarFormulario()">
                <div class="input-columns">
                    <div class="col">
                        <div class="textfield">
                            <label for="usuario">Nome</label>
                            <input type="text" id="nome" name="nome" value="<?php echo $nome;?>" required>
                        </div>
                    </div>
                    
                </div>
                <div class="input-columns">
                    <div class="col">
                        <div class="textfield">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" value="<?php echo $email;?>" required>
                        </div>
                    </div>
                </div>
                <div class="input-columns">
                    <div class="col">
                        <div class="textfield">
                            <label for="numero">Número</label>
                            <input type="text" id="numero" name="numero" value="<?php echo $numero;?>" required>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id" value=<?php echo $id;?>>
                <button type="submit" name="update" id="submit" class="btn">Editar</button>
                </form>
            </div>
        </div> 
    </div>
</body>
</html>