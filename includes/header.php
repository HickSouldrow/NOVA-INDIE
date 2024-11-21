<?php
@session_start();

// Verifica se existe uma sessão ou um cookie de usuário
if (!isset($_SESSION['usuario']) && isset($_COOKIE['usuario'])) {
    $_SESSION['usuario'] = $_COOKIE['usuario'];
}

// Verifica se o usuário está deslogando
if (isset($_GET['logout'])) {
    session_destroy();
    setcookie('usuario', '', time() - 3600, "/"); // Remove o cookie
    header("Location: index.php");
    exit;
}



$isLoggedIn = isset($_SESSION['usuario']);
?>

<header>
    <nav class="fixed w-full z-50 top-0 px-8 py-4 flex items-center justify-between border-b border-purple-600" style="background-color: #101014">
        <!-- Botão de menu lateral -->
        <button id="menu-toggle" onclick="toggleSidebar()" class="focus:outline-none">
            <img src="assets/img/menu.svg" alt="Menu" class="w-8 h-8">
        </button>

        <!-- Menu Lateral -->
        <aside id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-purple-700 text-white transform -translate-x-full transition-transform duration-300 ease-in-out z-60">
            <div class="p-6">
                <button id="menu-toggle" onclick="toggleSidebar()" class="focus:outline-none">
                    <img src="assets/img/return.svg" alt="Menu" class="w-8 h-8">
                </button>
                <ul>
                    <li><a href="ofertas.php" class="block py-2 hover:text-gray-200">Ofertas</a></li>
                    <li><a href="novidades.php" class="block py-2 hover:text-gray-200">Lançamentos</a></li>
                    <li><a href="meusJogos.php" class="block py-2 hover:text-gray-200">Meus Jogos</a></li>
                    <li><a href="carrinho.php" class="block py-2 hover:text-gray-200">Ver Carrinho</a></li>
                    <li><a href="ReqMinimos.php" class="block py-2 hover:text-gray-200">Requisitos Mínimos</a></li>
                    <li><a href="classificacaoindicativa.php" class="block py-2 hover:text-gray-200">Classificação Indicativa</a></li>
                    <li><a href="termos.php" class="block py-2 hover:text-gray-200">Termos de Uso</a></li>
                    <li><a href="sobreNos.php" class="block py-2 hover:text-gray-200">Sobre Nós</a></li>
                    <li><a href="suporte.php" class="block py-2 hover:text-gray-200">Suporte</a></li>
                </ul>
            </div>
        </aside>

        <!-- Logo centralizado -->
        <div class="flex-1 flex justify-center items-center">
            <a href="index.php" class="text-2xl font-bold text-white flex items-center">
                <img src="assets/img/logo.png" alt="NOVA INDIE Logo" class="inline w-10 h-10 mr-2">
                NOVA INDIE
            </a>
        </div>

        <!-- Barra de Pesquisa -->
        <form action="search.php" method="GET" class="flex ml-auto mr-4">
            <input type="text" name="query" placeholder="Pesquisar jogo" class="bg-gray-800 text-white rounded-l px-4 py-2 focus:outline-none">
            <button type="submit" class="bg-purple-700 text-white px-4 py-2 rounded-r">Buscar</button>
        </form>

        <!-- Perfil do Usuário -->
        <?php if ($isLoggedIn): ?>
            <div class="relative ml-6">
                <button onclick="toggleDropdown()" class="focus:outline-none flex items-center">
                    <img src="assets/img/perfil.svg" alt="Perfil" class="w-10 h-10">
                </button>
                <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-64 bg-gray-800 rounded-lg shadow-lg z-50 text-white p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="assets/img/perfil.svg" alt="Perfil" class="w-10 h-10 rounded-full">
                        <div>
                            <p class="font-semibold"><?php echo $_SESSION['nickname'] ?? 'Usuário'; ?></p>
                        </div>
                    </div>
                    <a href="perfil.php" class="block px-4 py-2 text-sm hover:bg-purple-600 rounded">Gerenciar Perfil</a>
                    <a href="#" onclick="toggleSubmenu()" class="block px-4 py-2 text-sm hover:bg-purple-600 rounded">Gerenciar Tabelas</a>
                    <div id="tabelas-submenu" class="hidden mt-2 bg-gray-700 rounded">
                        <a href="CRUD_template.php?tabela=jogo" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">Gerenciar Jogos</a>
                        <a href="CRUD_template.php?tabela=desenvolvedora" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">Gerenciar Desenvolvedoras</a>
                        <a href="CRUD_template.php?tabela=genero" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">Gerenciar Gêneros</a>
                        <a href="CRUD_template.php?tabela=categoria" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">Gerenciar Categorias</a>
                        <a href="CRUD_template.php?tabela=reqminimos" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">Gerenciar Requisitos Mínimos</a>
                        <a href="CRUD_template.php?tabela=MeioPagamento" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">Gerenciar Meios de Pagamento</a>
                        <a href="CRUD_template.php?tabela=cliente" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">Gerenciar Clientes</a>
                        <a href="CRUD_template.php?tabela=notaiscal" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">Gerenciar Notas Fiscais</a>
                    </div>
                    <a href="index.php?logout=true" class="block px-4 py-2 text-sm hover:bg-purple-600 rounded">Deslogar</a>
                </div>
            </div>
        <?php else: ?>
            <a href="login.php" class="text-purple-700 font-bold underline hover:text-purple-600 text-lg">Entrar</a>
        <?php endif; ?>
    </nav>
</header>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }

    function toggleDropdown() {
        const dropdownMenu = document.getElementById('dropdown-menu');
        dropdownMenu.classList.toggle('hidden');
    }

    // Função para alternar a visibilidade do submenu de Tabelas
    function toggleSubmenu() {
        const submenu = document.getElementById('tabelas-submenu');
        submenu.classList.toggle('hidden');
    }

    // Fecha o menu suspenso se o usuário clicar fora dele
    window.onclick = function(event) {
        if (!event.target.matches('[onclick="toggleDropdown()"]') && !event.target.closest('#dropdown-menu')) {
            const dropdowns = document.getElementsByClassName("hidden");
            for (let i = 0; i < dropdowns.length; i++) {
                let openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('hidden')) {
                    openDropdown.classList.add('hidden');
                }
            }
        }
    }
    // Lida com o clique no item "Gerenciar Tabelas"
    document.getElementById('tabelas-toggle').addEventListener('click', function(event) {
        event.preventDefault();  // Impede o redirecionamento
        toggleSubmenu();
    });
</script>


