// sidebar.js
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('-translate-x-full');

    // Adiciona ou remove o listener para fechar ao clicar fora
    if (!sidebar.classList.contains('-translate-x-full')) {
        document.addEventListener('click', handleClickOutside);
    } else {
        document.removeEventListener('click', handleClickOutside);
    }
}

function handleClickOutside(event) {
    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('menu-toggle');

    // Verifica se o clique foi fora do menu e do botão de abertura
    if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
        sidebar.classList.add('-translate-x-full');
        document.removeEventListener('click', handleClickOutside);
    }
}
