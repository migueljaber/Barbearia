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

function validarFormulario() {
    var senha = document.getElementById("senha").value;
    var confirmar_senha = document.getElementById("confirmar_senha").value;

    // Verificar se as senhas coincidem
    if (senha !== confirmar_senha) {
        alert("As senhas não coincidem. Por favor, tente novamente.");
        return false;  // Evita o envio do formulário
    }

    return true; // Permite o envio se tudo estiver correto
}