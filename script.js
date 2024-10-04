// Animações de Scroll
window.sr = ScrollReveal({ reset: true });

sr.reveal('.inicio', {
    duration: 2000,
    origin: 'top',
    distance: '50px'
});

sr.reveal('.sobre', {
    duration: 2000,
    origin: 'left',
    distance: '50px'
});

sr.reveal('.servicos', {
    duration: 2000,
    origin: 'right',
    distance: '50px'
});

// Animação de fade-in ao rolar
const fadeInElements = document.querySelectorAll('.fade-in');

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, {
    threshold: 0.5
});

fadeInElements.forEach(el => {
    observer.observe(el);
});

const menuButton = document.getElementById('menu-button');
const navLinks = document.getElementById('nav-links');

// Função para alternar o estado do menu
menuButton.addEventListener('click', () => {
    navLinks.classList.toggle('open');
    menuButton.classList.toggle('open');
});

// Fechar o menu ao clicar em um link de navegação
const navItems = document.querySelectorAll('.nav-links a');
navItems.forEach(item => {
    item.addEventListener('click', (e) => {
        e.stopPropagation();
        navLinks.classList.remove('open');
        menuButton.classList.remove('open');
    });
});

// Fechar o menu ao clicar fora dele
document.addEventListener('click', (e) => {
    if (!menuButton.contains(e.target) && !navLinks.contains(e.target)) {
        navLinks.classList.remove('open');
        menuButton.classList.remove('open');
    }
});
