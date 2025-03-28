// JavaScript para randomizar a cor da letra
    const menuItems = document.querySelectorAll('#menu li a');

    // Função que gera uma cor aleatória
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
}

menuItems.forEach(item => {
    item.addEventListener('mouseover', () => {
        item.style.color = getRandomColor();
    });

    item.addEventListener('mouseout', () => {
        item.style.color = '#f5ca0a'; // Retorna à cor original
    });
});
