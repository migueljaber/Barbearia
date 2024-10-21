<?php
session_start();

if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Acessa
    include_once('conexao.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta para buscar o usuário com o email e senha
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

    // Executa a consulta
    $result = $conexao->query($sql);

    // Verifica se encontrou o usuário
    if(mysqli_num_rows($result) < 1) {
        // Se não encontrou nenhum usuário, redireciona para erro
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: erro.php');
    } else {
        // Se encontrou, recupera os dados do usuário
        $row = $result->fetch_assoc();
        $nivel = $row['nivel']; // Recupera o campo 'nivel' do usuário

        // Armazena o email, senha e nível na sessão
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['nivel'] = $nivel;

        // Verifica o nível e redireciona para a página correta
        if ($nivel == "adm") {
            header('Location: select.php');
        } elseif ($nivel == "cliente") {
            header('Location: inicio.php'); // Redireciona clientes para a página inicial
        }
    }
} else {
    // Se não submeteu ou campos vazios, redireciona para erro
    header('Location: erro.php');
}
?>