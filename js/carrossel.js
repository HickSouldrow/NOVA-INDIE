let currentIndex = 0;
const slides = document.querySelectorAll(".carousel-item");
const indicators = document.querySelectorAll(".carousel-indicator");
const progressBar = document.getElementById("progress-bar");
const carouselImages = document.getElementById("carousel-images");
let interval;

// Função para mostrar um slide específico com animação de deslizamento e efeito pulsante
function showSlide(index) {
    currentIndex = index;

    // Define a posição de deslocamento usando translateX para animação de deslizamento
    carouselImages.style.transform = `translateX(-${100 * currentIndex}%)`;

    // Atualizar indicadores
    indicators.forEach((indicator, i) => {
        indicator.classList.remove("bg-purple-600");
        indicator.classList.add("bg-gray-500");
        if (i === currentIndex) {
            indicator.classList.add("bg-purple-600");
            indicator.classList.remove("bg-gray-500");
        }
    });

    // Adicionar e remover a animação de pulsar no slide atual
    slides[currentIndex].classList.add("pulse-animation");
    slides[currentIndex].addEventListener("animationend", () => {
        slides[currentIndex].classList.remove("pulse-animation");
    }, { once: true }); // Remove a classe após a animação terminar apenas uma vez

    // Reiniciar o intervalo para a transição automática
    clearInterval(interval);
    interval = setInterval(nextSlide, 5000);
    animateProgressBar();
}

// Função para o próximo slide
function nextSlide() {
    showSlide((currentIndex + 1) % slides.length);
}

// Função para animar a barra de progresso
function animateProgressBar() {
    progressBar.style.transition = "width 5s linear";
    progressBar.style.width = "100%";
}

// Iniciar o carrossel
showSlide(currentIndex);
animateProgressBar();
interval = setInterval(nextSlide, 5000);

// Controle de navegação para a grade de jogos
document.addEventListener('DOMContentLoaded', () => {
    const gamesGrid = document.querySelector('.grid');
    const prevButton = document.getElementById('prev');
    const nextButton = document.getElementById('next');
    let scrollAmount = 0;

    // Tamanho total da grade de jogos
    const totalWidth = gamesGrid.scrollWidth;
    const gridWidth = gamesGrid.clientWidth;

    nextButton.addEventListener('click', () => {
        if (scrollAmount + gridWidth < totalWidth) {
            scrollAmount += 300; // Ajuste o valor conforme necessário
        }
        gamesGrid.scrollTo({ left: scrollAmount, behavior: 'smooth' });
    });

    prevButton.addEventListener('click', () => {
        scrollAmount -= 300; // Ajuste o valor conforme necessário
        if (scrollAmount < 0) scrollAmount = 0; // Previne o deslocamento negativo
        gamesGrid.scrollTo({ left: scrollAmount, behavior: 'smooth' });
    });
});
