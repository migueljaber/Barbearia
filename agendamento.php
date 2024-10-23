<?php
session_start();

if (!isset($_SESSION['id'])) {
    // Se o ID do usuário não estiver na sessão, redirecione para uma página de login ou erro
    header("Location: cadastro/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="agendamento.css">
    <title>Agendar Serviço</title>
</head>
<body>
    <div class="agendarservico">
    <h1>Agendar Serviço</h1>

    <form action="agendarservico.php" method="POST">
        <label for="barbeiro">Escolha o Barbeiro:</label>
        <br>
        <select id="barbeiro" name="barbeiro" required>
            <option value="semselecao"></option>
            <option value="André">André</option>
            <option value="Jean">Jean</option>
            <option value="Gabriel">Gabriel</option>
            <option value="Patrick">Patrick</option>
        </select>
        <br><br>

        <label for="servico">Escolha o serviço:</label>
        <br>
        <select id="servico" name="servico" required>
            <option value="semselecao"></option>
            <option value="Máquina">Máquina - R$22,00</option>
            <option value="Tesoura">Corte na tesoura - R$30,00</option>
            <option value="Barba">Barba - R$22,00</option>
            <option value="navalhado">Corte navalhado - R$30,00</option>
            <option value="combo">Cabelo e Barba - R$50,00</option>
            <option value="platinado">Platinado - R$80,00</option>
        </select>
        <br><br>

        <label for="dia">Data:</label>
        <br>
        <input type="date" name="dia" id="dia" required>
        <br><br>

        <label for="horario">Escolha o horário:</label>
        <br>
        <select id="horario" name="horario" required>
        <option value="semselecao"></option>
            <option value="13:00">13:00</option>
            <option value="13:30">13:30</option>
            <option value="14:00">14:00</option>
            <option value="14:30">14:30</option>
            <option value="15:00">15:00</option>
            <option value="15:30">15:30</option>
            <option value="16:00">16:00</option>
            <option value="16:30">16:30</option>
            <option value="17:00">17:00</option>
            <option value="17:30">17:30</option>
            <option value="18:00">18:00</option>
            <option value="18:30">18:30</option>
            <option value="19:00">19:00</option>
            <option value="19:30">19:30</option>
            <option value="20:00">20:00</option>
            <option value="20:30">20:30</option>
            <option value="21:00">21:00</option>
        </select>
        <br><br>

        <button type="submit" value="Agendar">Agendar</button>
    </form>
    </div>
</body>
</html>
