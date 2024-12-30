<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Acessa
    include_once('conexao.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta para buscar o usuário com o email e senha
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

    // Executa a consulta
    $result = $conexao->query($sql);

    // Verifica se encontrou o usuário
    if (mysqli_num_rows($result) < 1) {
        // Se não encontrou nenhum usuário, redireciona para a página de erro
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: erro.php');
        exit();
    } else {
        // Se encontrou o usuário, recupera os dados
        $row = $result->fetch_assoc();
        $id = $row['id'];        // Recupera o ID do usuário
        $nome = $row['nome'];    // Recupera o nome do usuário
        $nivel = $row['nivel'];  // Recupera o nível do usuário

        // Armazena o ID, nome, email, senha e nível na sessão
        $_SESSION['id'] = $id;         // Armazena o ID na sessão
        $_SESSION['nome'] = $nome;     // Armazena o nome na sessão
        $_SESSION['email'] = $email;   // Armazena o email na sessão
        $_SESSION['senha'] = $senha;   // Armazena a senha na sessão (opcional)
        $_SESSION['nivel'] = $nivel;   // Armazena o nível na sessão

        // Verifica o nível do usuário e redireciona para a página correspondente
        if ($nivel == "adm") {
            header('Location: select.php');
            exit(); // Redireciona para página de admin
        } elseif ($nivel == "cliente") {
            header('Location: inicio.php'); // Redireciona clientes para a página inicial
            exit();
        }
    }
} else {
    // Se não submeteu o formulário ou campos estão vazios, redireciona para erro
    header('Location: erro.php');
    exit();
}
?>
