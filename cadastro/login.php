<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="logi.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>login</title>
</head>
<body>
    <div class="main-login">
          <!-- Botão de Voltar -->
          <a href="../index.php" class="btn-voltar">
            <i class='bx bx-left-arrow-alt'></i> Voltar
        </a>
    <div class="left-login">
        <h1>FAÇA PARTE DO NOSSO TIME</h1>
        <img src="../imagens/animate-log.svg" class="left-image" alt="barber">
    </div>
    
    <div class="right-login">
        <div class="wrapper">
            <h1>LOGIN</h1>
            <form action="../testLogin.php" method="POST">
            <div class="textfield">
                <label for="usuario">E-mail</label>
                <input type="text" id="email" name="email" placeholder="Nome">
            </div>
    
            <div class="textfield">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Senha">
            </div>
    
            <div class="lembrar-esqueceu">
                <label><input type="checkbox"> Lembrar senha</label>
                
            </div>
    
            <button type="submit" name="submit" id="submit" class="btn">Login</button>
            </form>
    
            <div class="registrar-link">
                <p>Não tem conta?          <a href="../cadastro/cadastro.php">Cadastrar</a></p>
            </div>
        </div>
    </div> 
</div>
</body>
</html>