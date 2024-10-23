<?php

    include_once('conexao.php');
    if(!empty($_GET['id']))
    {

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM usuarios WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    if(!empty($_GET['agenda_id']))
    {

        $agenda_id = $_GET['agenda_id'];

        $sqlSelect = "SELECT *  FROM agendamentos WHERE id=$agenda_id";

        $result = $conexao->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM agendamentos WHERE id=$agenda_id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: select.php');
   
?>