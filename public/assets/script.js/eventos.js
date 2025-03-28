document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.letreiroEventos');
    const letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    function gerarLetraAleatoria() {
        return letras[Math.floor(Math.random() * letras.length)];
    }

    function criarLetrasAleatorias() {
        for (let i = 0; i < 50; i++) { // Ajuste o número de letras conforme necessário
            const p = document.createElement('p');
            p.className = 'letra';
            p.textContent = gerarLetraAleatoria();
            p.style.left = `${Math.random() * 100}%`; // Posição aleatória horizontal
            p.style.animationDuration = `${Math.random() * 5 + 3}s`; // Duração aleatória da animação
            container.appendChild(p);
        }
    }

    criarLetrasAleatorias();
});
