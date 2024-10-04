$(document).ready(function() {
    // Aplicar máscaras ao CPF e número de telefone
    $('#cpf').mask('000.000.000-00');
    $('#numero').mask('(00) 00000-0000');

    // Interceptar o envio do formulário para validar antes de enviar
    $('form').submit(function(event) {
        if (!validarFormulario()) {
            event.preventDefault(); // Previne o envio do formulário se a validação falhar
        }
    });
});

// Função de validação do formulário
function validarFormulario() {
    var usuario = document.getElementById("usuario").value;
    var cpf = document.getElementById("cpf").value;
    var numero = document.getElementById("numero").value;
    var senha = document.getElementById("senha").value;
    var confirmar_senha = document.getElementById("confirmar_senha").value; // Aqui o ID correto do campo de confirmação de senha
    var regex = /^[a-zA-Z0-9_.-]+$/;

    // Validação do nome de usuário
    if (!regex.test(usuario)) {
        alert("O nome de usuário não pode ter acentos ou caracteres especiais, exceto _ . -");
        return false;
    }

    // Verificar se o nome de usuário tem mais de 28 caracteres
    if (usuario.length > 28) {
        alert("O nome de usuário não pode ter mais de 28 caracteres.");
        return false;
    }

    // Verificar se o CPF tem 14 caracteres (com a máscara aplicada)
    if (cpf.length !== 14) {
        alert("Por favor, insira um CPF válido com 11 dígitos.");
        return false;
    }

    // Verificar se o número de telefone tem 15 caracteres (com a máscara aplicada)
    if (numero.length !== 15) {
        alert("Por favor, insira um número de telefone válido com todos os dígitos.");
        return false;
    }

    // Verificar se as senhas coincidem
    if (senha !== confirmar_senha) {
        alert("As senhas não coincidem. Por favor, tente novamente.");
        return false;
    }

    // Se todas as validações passarem, retornar true
    return true;
}
