<?php
session_start();

// Verifique se o usuário está logado corretamente e se a sessão contém o 'id' e 'email'
if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    // Se não estiver logado, redirecionar para a página de login
    header('Location: cadastro/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="javascript.js" defer></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="style.css">
   
    <title>Barbearia</title>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="imagens/logo.png" alt="Logo">
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="#inicio">Home</a></li>
            <li><a href="#sobre">Sobre</a></li>
            <li><a href="#serv">Serviços</a></li>
            <li><a href="#contato">Contato</a></li>
        </ul>
        <div class="responsivo" id="responsivo">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <!-- Verifica se o ID do usuário está definido antes de exibir o botão de usuário -->
        <?php if (isset($_SESSION['id'])): ?>
            <a href="editaruser.php?id=<?php echo $_SESSION['id']; ?>" class="btn btn-warning">Usuário</a>
        <?php endif; ?>
        <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        <button class="btn-pedido"><a href="./pedidos.php">Meus pedidos</a></button>
    </nav>

    <main>
        <section class="inicio" id="inicio">
            <div class="inicio">
                <div class="flex">
                    <div class="texto">
                        <div class="tit">
                            <h1>BARBEARIA FERNANDES</h1>
                        </div>
                        <p>Onde tradição e estilo se encontram no coração de Bangu</p>
                    </div>
                    <img src="imagens/animate-inicio.svg" class="image" alt="animate">
                </div>
            </div>
        </section>

        <section class="sobre" id="sobre">
            <div class="container">
                <div class="tit-sobre">
                    <h1>NOSSA <span>HISTÓRIA</span></h1>
                    <p>
                        Bem-vindo à Barbearia Fernandes, um ícone de tradição e qualidade no coração de Bangu, Zona Oeste do Rio de Janeiro. Fundada há mais de 20 anos por André Luís Fernandes, nossa barbearia orgulha-se do sobrenome "Fernandes", que simboliza o compromisso e a excelência familiar. Desde o início, nosso objetivo sempre foi criar uma experiência única e acolhedora para cada cliente, combinando técnica refinada com um toque pessoal. Como pioneiros na região, mantemos um padrão elevado de atendimento. O amor por Bangu é visível em cada detalhe, com nossas paredes adornadas por memorabilia do Bangu Atlético Clube, refletindo nossa conexão com a comunidade e o time local. Na Barbearia Fernandes, você encontra mais do que um corte de cabelo; encontra um pedaço da história de Bangu e um vínculo com a tradição da família Fernandes. Venha nos visitar e descubra por que somos um ponto de encontro da comunidade e um símbolo de orgulho local.
                    </p>
                </div>
            </div>
        </section>

        <section class="equipe" id="serv">
            <h2 class="titulo">NOSSOS <span>SERVIÇOS</span></h2>
            <div class="card-group">
                <div class="card">
                    <img src="./imagens/./maquina.jpg" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title">Máquina</h3>
                        <p class="card-text">Na Barbearia Fernandes, oferecemos cortes rápidos e modernos na máquina por apenas R$22, garantindo praticidade e um acabamento impecável.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="./imagens/./tesoura.jpg" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title">Corte na tesoura</h3>
                        <p class="card-text">Na Barbearia Fernandes, realizamos cortes detalhados na tesoura por R$30, proporcionando um acabamento personalizado e refinado para cada cliente.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="./imagens/./barba.jpg" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title">Barba</h3>
                        <p class="card-text">Na Barbearia Fernandes, oferecemos um serviço de barba impecável por apenas R$20, garantindo contornos perfeitos e um acabamento cuidadoso.</p>
                    </div>
                </div>
            </div>

            <div class="card-group">
                <div class="card">
                    <img src="./imagens/./navalhado.jpeg" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title">Corte navalhado</h3>
                        <p class="card-text">Na Barbearia Fernandes, o corte navalhado é realizado com precisão e estilo por R$30, proporcionando um acabamento perfeito e um visual sofisticado.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="./imagens/./completo.jpeg" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title">Barba e cabelo</h3>
                        <p class="card-text">Na Barbearia Fernandes, oferecemos o pacote completo de barba e cabelo por R$50, unindo qualidade e estilo em uma única experiência de cuidado pessoal.</p>
                    </div>
                </div>
                <div class="card">
                    <img src="./imagens/./platinado.jpeg" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title">Platinado</h3>
                        <p class="card-text">Na Barbearia Fernandes, o serviço de platinado custa R$90, transformando seu visual com um descolorido impecável e moderno.</p>
                    </div>
                </div>
            </div>
            <br>
            <button class="btn-agendar">
                <a href="agendamento.php">Agendar serviço</a>
            </button>
        </section>
        <h1 class="localizacao-titulo">NOSSA <span>LOCALIZAÇÃO</span></h1>
        <hr>
        <p class="local">Rua Rio da Prata, 51 - Bangu</p>



            <section class="formulario" id="formulario">
                <div class="interface">
                <h2 class="titulo">FALE <span>CONOSCO</span></h2>
                <form name="form_msg" id="form_msg" action="https://api.web3forms.com/submit" method="POST">
                <input type="hidden" name="access_key" value="52dfeaa9-afae-455a-87ff-21cb2ebbfebe">
                <input type="text" name="nome" id="nome" placeholder="Nome" required>
                <input type="email" name="email" id="email" placeholder="E-mail" required>
                <textarea name="mensagem" id="mensagem" placeholder="Mensagem" required></textarea>
                <div class="advance-enviar"><input type="submit" value="ENVIAR"></div>
                </form>
                </div>
            </section>

    </main>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Advance. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
