// Selecionando os botões
const btnRadical = document.getElementById('btnRadical');
const btnInfantil = document.getElementById('btnInfantil');
const brinquedoInfo = document.getElementById('brinquedoInfo');

// Lista de brinquedos radicais e suas frases
const radicais = [
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/radical1.png", frase: "Sinta o coração acelerar em cada curva! 🎢💥" },
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/radical2.png", frase: "Desafie a gravidade e encare a adrenalina! 🚀🔥" },
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/radical3.png", frase: "Para os mais corajosos, a aventura começa aqui! 🏎️⚡" },
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/radical4.png", frase: "Rodopios e quedas que vão te tirar o fôlego! 🎡💨" },
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/radical5.png", frase: "Se você gosta de emoções extremas, esse brinquedo é para você! 🤯🌪️" },
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/radical6.png", frase: "Prepare-se para uma experiência radical sem igual! 🌀🚨" }
];

// Lista de brinquedos familiares e suas frases
const familiares = [
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/familiar1.png", frase: "Diversão para todas as idades, em um só lugar! 👨‍👩‍👧‍👦🎠" },
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/familiar2.png", frase: "Momentos mágicos para toda a família compartilhar! ✨🎡" },
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/familiar3.png", frase: "Aventura e diversão para pais e filhos! 👶🎉" },
    { img: "http://localhost/sistema-pqmarisa/public/assets/img/atraçõesPag/familiar4.png", frase: "Juntos em uma jornada de alegria e descobertas! 👨‍👩‍👦🌈" }
];

// Função para exibir brinquedos radicais (um por vez)
btnRadical.addEventListener('click', function() {
    const index = Math.floor(Math.random() * radicais.length); // Escolher aleatoriamente um brinquedo
    const brinquedo = radicais[index];
    brinquedoInfo.innerHTML = `
        <img src="${brinquedo.img}" alt="Brinquedo Radical">
        <p>${brinquedo.frase}</p>
    `;
});

// Função para exibir brinquedos familiares (um por vez)
btnInfantil.addEventListener('click', function() {
    const index = Math.floor(Math.random() * familiares.length); // Escolher aleatoriamente um brinquedo
    const brinquedo = familiares[index];
    brinquedoInfo.innerHTML = `
        <img src="${brinquedo.img}" alt="Brinquedo Familiar">
        <p>${brinquedo.frase}</p>
    `;
});
