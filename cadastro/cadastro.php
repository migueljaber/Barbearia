<?php

if (isset($_POST['submit'])) {
    if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['email']) && 
        !empty($_POST['numero']) && !empty($_POST['senha']) && !empty($_POST['confirmar_senha'])) {

        if ($_POST['senha'] !== $_POST['confirmar_senha']) {
            echo "<script>alert('As senhas não coincidem. Por favor, tente novamente.');</script>";
        } else {
            include_once('./conexao.php');

            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $numero = $_POST['numero'];
            $senha = $_POST['senha'];

            // Preparar a consulta para verificar a existência de CPF, email ou número
            $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE cpf = ? OR email = ? OR numero = ?");
            $stmt->bind_param('sss', $cpf, $email, $numero);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>alert('Já existe um usuário com esse CPF, email ou número de telefone. Por favor, tente novamente.');</script>";
            } else {
                // Preparar a inserção
                $stmt_insert = $conexao->prepare("INSERT INTO usuarios(nome, cpf, email, numero, senha) VALUES (?, ?, ?, ?, ?)");
                $stmt_insert->bind_param('sssss', $nome, $cpf, $email, $numero, $senha);
                
                if ($stmt_insert->execute()) {
                    header('Location: login.php');
                } else {
                    echo "<script>alert('Erro ao cadastrar. Por favor, tente novamente.');</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Por favor, preencha todos os campos.');</script>";
    }
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
              <!-- Botão de Voltar -->
        <a href="../index.php" class="btn-voltar">
            <i class='bx bx-left-arrow-alt'></i> Voltar
        </a>
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
                    <label></label>
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
