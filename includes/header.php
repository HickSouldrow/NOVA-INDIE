<?php
@session_start();
include('conexoes/config.php');

// Variáveis padrão para visitante
$nickname = 'Visitante';
$email = 'não disponível';

if (isset($_SESSION['CodCliente'])) {
    $codCliente = $_SESSION['CodCliente']; 
}
// Verifica se o usuário está logado (sessão ativa)
if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])) {
    // Usuário logado, utiliza dados da sessão
    $nickname = $_SESSION['usuario']['nickname'];
    $email = $_SESSION['usuario']['email'];

    
} elseif (isset($_SESSION['CodCliente'])) {
    // Caso o cliente esteja identificado pelo CodCliente na sessão
    $desenvolvedoraId = $_SESSION['CodCliente']; // Aqui você assume que 'CodCliente' foi armazenado na sessão

    // Recupera os dados do banco com base no CodCliente
// Consultar as novas informações (nome, cpf, dataNasc)
$sqlDesenvolvedoraInfo = "SELECT nickname, email, nome, cpf, dataNasc, senha FROM cliente WHERE CodCliente = ?";
$stmtDesenvolvedoraInfo = $conn->prepare($sqlDesenvolvedoraInfo);
$stmtDesenvolvedoraInfo->bind_param("i", $desenvolvedoraId);
$stmtDesenvolvedoraInfo->execute();
$resultDesenvolvedoraInfo = $stmtDesenvolvedoraInfo->get_result();

// Verifica se existe algum resultado
if ($resultDesenvolvedoraInfo->num_rows > 0) {
    $desenvolvedoraInfo = $resultDesenvolvedoraInfo->fetch_assoc();
    $nickname = $desenvolvedoraInfo['nickname'];
    $email = $desenvolvedoraInfo['email'];
    $nome = $desenvolvedoraInfo['nome'];   
    $cpf = $desenvolvedoraInfo['cpf'];    
    $dataNasc = $desenvolvedoraInfo['dataNasc']; 
    $senha = $desenvolvedoraInfo['senha'];
}

} else {
    // Caso o usuário não esteja logado, mantém as variáveis padrão
    $nickname = 'Visitante';
    $email = 'não disponível';
}

// Verifica se existe uma sessão ou um cookie de usuário para autenticação persistente
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

// Variável para indicar se o usuário está logado
$isLoggedIn = isset($_SESSION['usuario']);
?>

<header>
<nav class="fixed w-full z-50 top-0 px-8 py-4 flex items-center justify-between border-b border-purple-600" style="background-color: #101014">
    <!-- Botão de menu lateral -->
    <button id="menu-toggle" onclick="toggleSidebar()" class="focus:outline-none">
        <img src="assets/img/menu.svg" alt="Menu" class="w-8 h-8">
    </button>

    <!-- Menu Lateral -->
    <aside id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-gradient-to-b from-purple-700 to-purple-900 text-white transform -translate-x-full transition-transform duration-300 ease-in-out z-60 shadow-lg">
    <div class="flex flex-col h-full">
        <!-- Botão de Retorno -->
        <div class="p-4 flex items-center justify-between border-b border-purple-500">
            <button id="menu-toggle" onclick="toggleSidebar()" class="focus:outline-none">
                <img src="assets/img/return.svg" alt="Fechar Menu" class="w-8 h-8">
            </button>
        </div>

        <!-- Seção: Carrinho -->
        <nav class="p-4 border-b border-purple-500">
            <ul>
                <li>
                    <a href="carrinho.php" class="block py-2 px-3 rounded-md hover:bg-purple-700 transition">
                        Ver Carrinho
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Seção: Do Momento -->
        <nav class="p-4 border-b border-purple-500">
            <h3 class="text-sm font-semibold uppercase text-gray-300 mb-2">Do Momento</h3>
            <ul class="space-y-2">
                <li>
                    <a href="ofertas.php" class="block py-2 px-3 rounded-md hover:bg-purple-700 transition">
                        Ofertas
                    </a>
                </li>
                <li>
                    <a href="novidades.php" class="block py-2 px-3 rounded-md hover:bg-purple-700 transition">
                        Lançamentos
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Seção: Jogos -->
        <nav class="p-4 border-b border-purple-500">
            <h3 class="text-sm font-semibold uppercase text-gray-300 mb-2">Jogos</h3>
            <ul class="space-y-2">
                <li>
                    <a href="meusJogos.php" class="block py-2 px-3 rounded-md hover:bg-purple-700 transition">
                        Meus Jogos
                    </a>
                </li>
                <li>
                    <a href="ReqMinimos.php" class="block py-2 px-3 rounded-md hover:bg-purple-700 transition">
                        Requisitos Mínimos
                    </a>
                </li>
                <li>
                    <a href="classificacaoindicativa.php" class="block py-2 px-3 rounded-md hover:bg-purple-700 transition">
                        Classificação Indicativa
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Seção: Outros -->
        <nav class="p-4">
            <h3 class="text-sm font-semibold uppercase text-gray-300 mb-2">Outros</h3>
            <ul class="space-y-2">
                <li>
                    <a href="termos.php" class="block py-2 px-3 rounded-md bg-purple-800 hover:bg-purple-700 transition">
                        Termos de Uso
                    </a>
                </li>
                <li>
                    <a href="sobreNos.php" class="block py-2 px-3 rounded-md bg-purple-800 hover:bg-purple-700 transition">
                        Sobre Nós
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>


    <!-- Logo e Título Centralizados -->
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
        <img src="assets/img/perfil.svg" alt="Perfil" class="w-10 h-10 rounded-full border-2 border-purple-600 hover:scale-105 transition-all duration-300">
    </button>
    <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-64 bg-gray-800 rounded-lg shadow-lg z-50 text-white p-6 transform scale-95 opacity-0 transition-all duration-300 ease-in-out">
    <div class="flex flex-col items-center gap-4 mb-4">
            <img src="assets/img/perfil.svg" alt="Perfil" class="w-16 h-16 rounded-full border-4 border-purple-600">
            <div class="text-center">
            <p class="font-semibold text-lg text-purple-600"><?php echo htmlspecialchars($nickname); ?></p>
            <p class="text-sm text-gray-400"><?php echo htmlspecialchars($email); ?></p>
</div>
                
        </div>
        <div class="border-t-2 border-purple-600 mb-4"></div> <!-- Separador roxo -->

       <!-- Gerenciar Perfil e Tabelas -->
<div class="mb-4">
    <a href="perfil.php" class="block px-4 py-2 text-sm text-gray-400 hover:bg-purple-600 rounded mb-2">Gerenciar Perfil</a>

    <?php if ($codCliente == 1 || $codCliente == 5): ?>
        <a onclick="toggleSubmenu()" class="block px-4 py-2 text-sm text-gray-400 hover:bg-purple-600 rounded mb-2">Gerenciar Tabelas</a>
        <div id="tabelas-submenu" class="hidden mt-2 bg-gray-700 rounded-lg">
            <a href="CRUD_template.php?tabela=jogo" class="block px-4 py-2 text-sm text-gray-400 hover:text-white rounded">Gerenciar Jogos</a>
            <a href="CRUD_template.php?tabela=desenvolvedora" class="block px-4 py-2 text-sm text-gray-400 hover:text-white rounded">Gerenciar Desenvolvedoras</a>
            <a href="CRUD_template.php?tabela=genero" class="block px-4 py-2 text-sm text-gray-400 hover:text-white rounded">Gerenciar Gêneros</a>
            <a href="CRUD_template.php?tabela=categoria" class="block px-4 py-2 text-sm text-gray-400 hover:text-white rounded">Gerenciar Categorias</a>
            <a href="CRUD_template.php?tabela=reqminimos" class="block px-4 py-2 text-sm text-gray-400 hover:text-white rounded">Gerenciar Requisitos Mínimos</a>
            <a href="CRUD_template.php?tabela=MeioPagamento" class="block px-4 py-2 text-sm text-gray-400 hover:text-white rounded">Gerenciar Meios de Pagamento</a>
            <a href="CRUD_template.php?tabela=cliente" class="block px-4 py-2 text-sm text-gray-400 hover:text-white rounded">Gerenciar Clientes</a>
            <a href="CRUD_template.php?tabela=notafiscal" class="block px-4 py-2 text-sm text-gray-400 hover:text-white rounded">Gerenciar Notas Fiscais</a>
        </div>
    <?php endif; ?>
    
    <a href="index.php?logout=true" class="block px-4 py-2 text-sm text-gray-400 hover:bg-purple-600 rounded">Deslogar</a>
</div>


        <!-- Personalização da Pesquisa -->
        <div class="border-t-2 border-purple-600 mb-4"></div> <!-- Separador roxo -->
        <div class="mb-2">
            <p class="font-semibold text-sm text-gray-400">Personalização da Pesquisa</p>
            <div class="flex items-center justify-between">
                <a class="block px-4 py-2 text-sm text-gray-400 mt-4">Idioma</a>
                <p class="text-sm text-gray-400 bg-gray-700 mt-4 rounded px-4 py-1">Português</p>
            </div>
        </div>

        <!-- Mais Configurações -->
        <a class="block px-4 py-2 text-sm text-gray-400 hover:bg-purple-600 rounded mb-2">Mais configurações</a>

        <!-- Ajuda -->
        <a href="suporte.php" class="block px-4 py-2 text-sm text-gray-400 hover:bg-purple-600 rounded mb-2">Ajuda</a>
        <p class="px-4 py-2 text-xs text-gray-400">ID do Cliente: <?php echo htmlspecialchars($desenvolvedoraId); ?></p>

        <!-- Política de Privacidade e Termos de Serviço -->
        <div class="border-t-2 border-purple-600 mt-4 pt-4">
            <a href="privacidade.php" class="block px-4 py-2 text-xs text-gray-400 hover:text-white">Política de Privacidade</a>
            <a href="termos.php" class="block px-4 py-2 text-xs text-gray-400 hover:text-white">Termos de Uso</a>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="ml-6 mt-2.5">
    <a href="login.php" class="text-purple-700 font-bold hover:text-purple-800 text-lg underline">Entrar</a>
</div>

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

    if (dropdownMenu.classList.contains('hidden')) {
        // Abrir o menu com animação
        dropdownMenu.classList.remove('hidden');
        setTimeout(() => {
            dropdownMenu.classList.remove('opacity-0', 'scale-95');
            dropdownMenu.classList.add('opacity-100', 'scale-100');
        }, 10); // Pequeno atraso para garantir que a transição seja aplicada
    } else {
        // Fechar o menu com animação
        dropdownMenu.classList.remove('opacity-100', 'scale-100');
        dropdownMenu.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            dropdownMenu.classList.add('hidden');
        }, 300); // Tempo para a animação de fechamento (igual ao `duration-300`)
    }
}

// Fecha o menu suspenso se o usuário clicar fora dele
document.addEventListener('click', function (event) {
    const dropdown = document.getElementById('dropdown-menu');
    const toggleButton = document.querySelector('[onclick="toggleDropdown()"]');

    if (dropdown && !dropdown.contains(event.target) && !toggleButton.contains(event.target)) {
        dropdown.classList.remove('opacity-100', 'scale-100');
        dropdown.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            dropdown.classList.add('hidden');
        }, 300);
    }
});

// Alternar submenu de Tabelas
function toggleSubmenu() {
    const submenu = document.getElementById('tabelas-submenu');
    submenu.classList.toggle('hidden');
}
</script>
