<?php
include("conexao.php");

$barbeiro = $_POST['barbeiro'];
$dia = $_POST['dia'];

// Consulta os horários já ocupados
$sql = "SELECT horario FROM agendamentos WHERE barbeiro = '$barbeiro' AND dia = '$dia'";
$resultado = $conexao->query($sql);

$horarios_ocupados = [];
if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $horarios_ocupados[] = $row['horario'];
    }
}

// Defina os horários disponíveis (ajuste conforme as necessidades)
$horarios_disponiveis = [
    "09:00", "10:00", "11:00", "12:00", 
    "13:00", "14:00", "15:00", "16:00", "17:00", "18:00"
];

// Filtra os horários ocupados
foreach ($horarios_disponiveis as $horario) {
    if (!in_array($horario, $horarios_ocupados)) {
        echo "<option value='$horario'>$horario</option>";
    } else {
        echo "<option value='$horario' disabled>$horario (Ocupado)</option>";
    }
}

$conexao->close();
?>
