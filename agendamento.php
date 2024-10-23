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
            <option value="André">André</option>
            <option value="Jean">Jean</option>
            <option value="Gabriel">Gabriel</option>
            <option value="Kauan">Kauan</option>
            <option value="xxxx">xxxx</option>
        </select>
        <br><br>

        <label for="servico">Escolha o serviço:</label>
        <br>
        <select id="servico" name="servico" required>
            <option value="corte">Máquina</option>
            <option value="tesoura">Corte na tesoura</option>
            <option value="barba">Barba</option>
            <option value="navalhado">Corte navalhado</option>
            <option value="combo">Cabelo e Barba</option>
            <option value="platinado">Platinado</option>
        </select>
        <br><br>

        <label for="dia">Data:</label>
        <br>
        <input type="date" name="dia" id="dia" required>
        <br><br>

        <label for="horario">Escolha o horário:</label>
        <br>
        <select id="horario" name="horario" required>
            <option value="09:00">09:00</option>
            <option value="10:00">10:00</option>
            <option value="11:00">11:00</option>
            <option value="14:00">14:00</option>
            <option value="15:00">15:00</option>
            <option value="16:00">16:00</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
        </select>
        <br><br>

        <input type="submit" value="Agendar">
    </form>
    </div>
</body>
</html>
