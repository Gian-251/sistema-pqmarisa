// Função para gerar cores aleatórias em formato hexadecimal
function gerarCorAleatoria() {
    const letras = '0123456789ABCDEF';
    let cor = '#';
    for (let i = 0; i < 6; i++) {
        cor += letras[Math.floor(Math.random() * 16)];
    }
    return cor;
}

// Função que altera a cor das letras de cada parágrafo a cada ciclo de animação
function aplicarCoresAleatorias() {
    const palavras = document.querySelectorAll('.letreiro p');
    palavras.forEach((palavra) => {
        // Aplica uma cor aleatória para cada palavra
        palavra.style.color = gerarCorAleatoria();
    });
}

// Chama a função a cada ciclo da animação
setInterval(aplicarCoresAleatorias, 3000); // Troca de cor a cada 2 segundos