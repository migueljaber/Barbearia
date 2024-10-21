<?php
    include_once('conexao.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $nome = $user_data['nome'];
                $senha = $user_data['senha'];
                $email = $user_data['email'];
                $numero = $user_data['numero'];
                $cpf = $user_data['cpf'];
            }
        }
        else
        {
            header('Location: select.php');
        }
    }
    else
    {
        header('Location: select.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cads.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="cadastro/cads.css">

    <title>Cadastro</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="cadastro/cadastro.js"></script>
</head>
<body>
    <div class="main-login">
        <div class="left-login">
            <h1>FAÇA PARTE DA FAMILIA FERNANDES</h1>
            <img src="imagens/animate-cad.svg" class="left-image" alt="barber">
        </div>
    
        <div class="right-login">
              <!-- Botão de Voltar -->
        <a href="select.php" class="btn-voltar">
            <i class='bx bx-left-arrow-alt'></i> Voltar
        </a>
            <div class="wrapper">
                <h1>CADASTRO</h1>
                <form action="./saveEdit.php" method="POST" onsubmit="return validarFormulario()">
                <div class="input-columns">
                    <div class="col">
                        <div class="textfield">
                            <label for="usuario">Nome</label>
                            <input type="text" id="nome" name="nome" value="<?php echo $nome;?>" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="textfield">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" value="<?php echo $cpf;?>" required>
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
                    <div class="col">
                        <div class="textfield">
                            <label for="numero">Número</label>
                            <input type="text" id="numero" name="numero" value="<?php echo $numero;?>" required>
                        </div>
                    </div>
                </div>
                <div class="input-columns">
                    <div class="col">
                        <div class="textfield">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" value="<?php echo $senha;?>" required>
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