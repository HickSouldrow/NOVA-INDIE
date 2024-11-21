<?php if (isset($_SESSION['usuario'])): ?>
    <div class="relative ml-4 flex items-center">
        <button onclick="toggleDropdown()" class="focus:outline-none">
            <img src="assets/img/perfil.svg" alt="Perfil" class="w-9 h-9 fill-purple-700">
        </button>
        
        <div id="dropdown-menu" class="hidden absolute right-0 mt-28 w-48 bg-gray-800 rounded-md shadow-lg z-50">
            <a href="perfil.php" class="block px-4 py-2 text-sm text-white hover:bg-purple-600">Gerenciar Perfil</a>
            <a href="index.php?logout=true" class="block px-4 py-2 text-sm text-white hover:bg-purple-600">Deslogar</a>
            
            <!-- Verifica se o usuário é administrador -->
            <?php if ($_SESSION['isAdmin']): ?>
                <div class="border-t border-gray-600 mt-2"></div>
                <span class="block px-4 py-2 text-xs text-gray-400">Administração</span>
                <a href="CRUD_template.php?tabela=cliente" class="block px-4 py-2 text-sm text-white hover:bg-purple-600">Clientes</a>
                <a href="CRUD_template.php?tabela=jogo" class="block px-4 py-2 text-sm text-white hover:bg-purple-600">Jogos</a>
                <a href="CRUD_template.php?tabela=genero" class="block px-4 py-2 text-sm text-white hover:bg-purple-600">Gêneros</a>
                <!-- Adicione outros links de CRUD conforme necessário -->
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <a href="login.php" class="text-purple-700 font-bold underline ml-6 hover:text-purple-600 text-lg">Entrar</a>
<?php endif; ?>