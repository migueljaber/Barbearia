<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url("imagens/fundo.png");
            color: #f8d7da;
            text-align: center;
            padding: 80px;
        }
        .container {
            border: 1px solid #f5c6cb;
            background: rgba(255, 255, 255, 0.1);;
            padding: 60px;
            display: inline-block;
            border-radius: 10px;
            margin-top: 50px;
        }
        h1 {
            font-size: 35px;
            color: yellow;
        }
        p {
            font-size: 18px;
            padding-bottom: 10px;
        }
        a {
            color: black;
            text-decoration: none;
            font-weight: bold;
            font-size: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
        button{
            padding: 15px;
            border-radius: 15px;
            width: 100%;
            background-color: #d59500;
            border: none;
        }

        button:hover{
            background-color: #f7a21b;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Erro de Acesso</h1>
        <p>Houve um problema ao acessar o sistema.<br>
        Por favor, verifique suas credenciais ou tente novamente mais tarde.</p>
        <button><a href="cadastro/login.php">Voltar para a página de login</a></button>
    </div>
</body>
</html>
