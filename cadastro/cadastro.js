$(document).ready(function() {
    // Aplicar máscaras ao CPF e número de telefone
    $('#cpf').mask('000.000.000-00');
    $('#numero').mask('(00) 00000-0000');

    // Monitorar os campos de senha para validação em tempo real
    $('#senha, #confirmar_senha').on('input', function() {
        validarSenhas();
    });

    // Interceptar o envio do formulário para validar antes de enviar
    $('#cadastroForm').submit(function(event) {
        if (!validarFormulario()) {
            event.preventDefault(); // Previne o envio do formulário se a validação falhar
        }
    });
});

function validarSenhas() {
    var senha = $('#senha').val();
    var confirmarSenha = $('#confirmar_senha').val();

    // Remover qualquer mensagem anterior de validação
    $('#senha_status').remove(); // Remove a mensagem antiga, se houver

    // Verificar se as senhas coincidem
    if (senha !== confirmarSenha) {
        $('#confirmar_senha').after('<span id="senha_status" style="color: red;">✖ As senhas não coincidem</span>');
        return false;
    } else {
        $('#confirmar_senha').after('<span id="senha_status" style="color: green;">✔ As senhas coincidem</span>');
        return true;
    }
}

function validarFormulario() {
    var nome = $('#nome').val();
    var cpf = $('#cpf').val();
    var email = $('#email').val();
    var numero = $('#numero').val();
    var senhaValida = validarSenhas(); // Valida se as senhas coincidem
    var camposPreenchidos = true;

    // Limpar mensagens antigas
    $('.error-message').remove();

    // Verificar se os campos estão preenchidos
    if (nome === '' || cpf === '' || email === '' || numero === '') {
        $('#cadastroForm').before('<p class="error-message" style="color: red;">✖ Por favor, preencha todos os campos obrigatórios.</p>');
        camposPreenchidos = false;
    }

    return senhaValida && camposPreenchidos;
}
