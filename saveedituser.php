<?php
    
    include_once('./conexao.php');
    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $numero = $_POST['numero'];
        
        $sqlInsert = "UPDATE usuarios 
        SET nome='$nome',email='$email',numero='$numero' WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        print_r($result);
    }
    header('Location: inicio.php');

?>