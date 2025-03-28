document.addEventListener('DOMContentLoaded', function () {
    const formPagamento = document.getElementById('form-pagamento');

    // Validação do formulário antes do envio
    formPagamento.addEventListener('submit', function (event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        // Captura os valores dos campos
        const quantidade = document.getElementById('quantidade').value;
        const nome = document.getElementById('nome').value;
        const email = document.getElementById('email').value;

        // Validações simples
        if (quantidade <= 0) {
            alert('A quantidade de ingressos deve ser maior que zero.');
            return;
        }

        if (nome.trim() === '') {
            alert('Por favor, insira seu nome.');
            return;
        }

        if (!validateEmail(email)) {
            alert('Por favor, insira um e-mail válido.');
            return;
        }

        // Simulação de pagamento (pode ser substituído por uma chamada AJAX para o backend)
        simularPagamento(quantidade, nome, email);
    });

    // Função para validar e-mail
    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Função para simular o pagamento
    function simularPagamento(quantidade, nome, email) {
        console.log('Simulando pagamento...');

        // Exibe uma mensagem de sucesso
        alert('Pagamento simulado com sucesso! Redirecionando para a confirmação...');

        // Redireciona para a página de confirmação (ou envia os dados para o backend)
        window.location.href = `confirmacao.php?quantidade=${quantidade}&nome=${nome}&email=${email}`;
    }
});