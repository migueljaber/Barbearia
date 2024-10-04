<?php

if(isset($_POST['submit']))
{
   
    include_once('./conexao.php');

    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $numero = $_POST['numero'];
    $senha = $_POST['senha'];

    $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, cpf, email, numero, senha) 
    VALUES ('$nome', '$cpf', '$email', '$numero', '$senha')");

    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cads.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="cad.css">

    <title>Cadastro</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="cadastro.js"></script>
</head>
<body>
    <div class="main-login">
        <div class="left-login">
            <h1>FAÇA PARTE DA FAMILIA FERNANDES</h1>
            <img src="../imagens/animate-cad.svg" class="left-image" alt="barber">
        </div>
    
        <div class="right-login">
            <div class="wrapper">
                <h1>CADASTRO</h1>
                <form action="./cadastro.php" method="POST" onsubmit="return validarFormulario()">
                <div class="input-columns">
                    <div class="col">
                        <div class="textfield">
                            <label for="usuario">Nome</label>
                            <input type="text" id="nome" name="nome" placeholder="Nome">
                        </div>
                    </div>
                    <div class="col">
                        <div class="textfield">
                            <label for="cpf">CPF</label>
                            <input type="text" id="cpf" name="cpf" placeholder="CPF">
                        </div>
                    </div>
                </div>
                <div class="input-columns">
                    <div class="col">
                        <div class="textfield">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="col">
                        <div class="textfield">
                            <label for="numero">Número</label>
                            <input type="text" id="numero" name="numero" placeholder="Número">
                        </div>
                    </div>
                </div>
                <div class="input-columns">
                    <div class="col">
                        <div class="textfield">
                            <label for="senha">Senha</label>
                            <input type="password" id="senha" name="senha" placeholder="Senha">
                        </div>
                    </div>
                    <div class="col">
                        <div class="textfield">
                            <label for="confirmar_senha">Confirmar Senha</label>
                            <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirmar Senha">
                        </div>
                    </div>
                </div>
                <div class="lembrar-esqueceu">
                    <label><input type="checkbox"> Lembrar senha</label>
                </div>

                <button type="submit" name="submit" id="submit" class="btn">Cadastrar</button>
                </form>

                <div class="registrar-link">
                    <p>Já tem conta? <a href="../cadastro/login.html">Entrar</a></p>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>
