<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon_io/favicon-32x32.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('assets/img/background.png');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
    background-color: #1f1f1f;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    border: 2px solid #9b59b6; 
    box-shadow: 0 0 10px 2px #9b59b6, 0 0 10px 2px #9b59b6;
}
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(62%) sepia(19%) saturate(546%) hue-rotate(223deg) brightness(95%) contrast(86%);
            color: #6b46c1; 
            border-radius: 50%; 
            padding: 5px;
        }

        .btn-submit:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }
    </style>
</head>
<body class="bg-neutral-900 text-white">

    <?php include 'includes/header.php'; ?>

    <main class="mx-auto max-w-7xl px-8 py-10 mt-16">
        <div class="container mx-auto p-8 bg-gray-900 rounded-xl shadow-2xl max-w-3xl">
            <!-- Avatar e Nome do Usuário -->
            <div class="flex items-center justify-center flex-col mb-8">
                <img src="assets/img/perfil.svg" alt="Avatar do Usuário" class="w-32 h-32 rounded-full border-4 border-purple-600 mb-4 transform transition-transform duration-500 ease-in-out hover:scale-110">
                <h2 class="text-3xl font-semibold text-purple-800"><?php echo htmlspecialchars($nickname); ?></h2>
                <p class="text-lg text-gray-400"><?php echo htmlspecialchars($email); ?></p>
            </div>

            <!-- Informações do Usuário -->
            <div class="bg-gray-800 rounded-lg p-6">
                <p class="text-2xl font-medium text-purple-700 mb-4">Informações do Usuário</p>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300">Nome:</label>
                        <p class="text-lg text-purple-300"><?php echo htmlspecialchars($nome); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300">Nickname:</label>
                        <p class="text-lg text-purple-300"><?php echo htmlspecialchars($nickname); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300">Data de Nascimento:</label>
                        <p class="text-lg text-purple-300"><?php echo htmlspecialchars($dataNasc); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300">CPF:</label>
                        <p class="text-lg text-purple-300"><?php echo htmlspecialchars($cpf); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300">E-mail:</label>
                        <p class="text-lg text-purple-300"><?php echo htmlspecialchars($email); ?></p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300">Senha:</label>
                        <p class="text-lg text-purple-300">
                            <span id="senhaMasked"><?php echo str_repeat('*', strlen($senha)); ?></span>
                        </p>
                    </div>
                </div>

                <!-- Botão Editar -->
                <div class="mt-6 text-center">
                    <button onclick="openModal()" class="text-lg font-semibold text-purple-600 hover:underline transform transition-transform duration-300 hover:scale-105">Editar Informações</button>
                </div>
            </div>

            <!-- Logout -->
            <div class="mt-8 text-center">
                <a href="index.php?logout=true" class="text-lg font-semibold text-red-500 hover:underline transform transition-transform duration-300 hover:scale-105">Sair</a>
            </div>
        </div>
    </main>

    <!-- Modal para Editar Informações -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3 class="text-2xl font-semibold text-purple-600 mb-8">Editar Informações</h3>
            <form method="POST" action="perfil_update.php" class="space-y-4" onsubmit="return validateForm()">
            <input type="hidden" name="tabela" value="usuario"> <!-- Nome da tabela -->
                <div>
                    <label for="nome" class="text-sm font-semibold text-gray-300">Nome:</label>
                    <input type="text" name="nome" id="nome" class="w-full p-2 rounded-md bg-gray-800 text-gray-100" value="<?php echo htmlspecialchars($nome); ?>" required>
                </div>
                <div>
                    <label for="dataNasc" class="text-sm font-semibold text-gray-300">Data de Nascimento:</label>
                    <input type="date" name="dataNasc" id="dataNasc" class="w-full p-2 rounded-md bg-gray-800 text-gray-100" value="<?php echo htmlspecialchars($dataNasc); ?>" required>
                </div>
                <div>
                    <label for="cpf" class="text-sm font-semibold text-gray-300">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="w-full p-2 rounded-md bg-gray-800 text-gray-100" value="<?php echo htmlspecialchars($cpf); ?>" required>
                </div>
                <div>
                    <label for="senha" class="text-sm font-semibold text-gray-300">Senha:</label>
                    <input type="password" name="senha" id="senha" class="w-full p-2 rounded-md bg-gray-800 text-gray-100"  value="<?php echo htmlspecialchars($senha); ?>" required>
                </div>
                <div class="mb-8">
                    <label for="confirmarSenha" class="text-sm font-semibold text-gray-300">Confirmar Senha:</label>
                    <input type="password" name="confirmarSenha" id="confirmarSenha" class="w-full p-2 rounded-md bg-gray-800 text-gray-100"  value="<?php echo htmlspecialchars($senha); ?>" required>
                </div>
                <div class="text-center">
    <button type="submit" id="submitBtn" 
        class="btn-submit text-lg font-semibold text-purple-600 mt-8 border-2 border-purple-600 bg-transparent py-1.5 px-5 rounded-lg transform transition-all duration-300 
        hover:text-white hover:bg-purple-600 hover:border-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 active:bg-purple-700 
        hover:shadow-lg hover:shadow-purple-500/50 focus:shadow-lg focus:shadow-purple-500/50 
        disabled:opacity-50 disabled:pointer-events-none">
        Salvar Alterações
    </button>
    <button type="button" onclick="closeModal()" 
        class="ml-32 text-lg font-semibold text-red-600 border-2 border-red-600 bg-transparent py-1.5 px-5 rounded-lg transform transition-all duration-300 
        hover:text-white hover:bg-red-600 hover:border-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 active:bg-red-700 
        hover:shadow-lg hover:shadow-red-500/50 focus:shadow-lg focus:shadow-red-500/50">
        Cancelar
    </button>
</div>
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script>
    // Funções para abrir e fechar o modal
    function openModal() {
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    // Validação de senhas
    function validateForm() {
        var senha = document.getElementById("senha").value;
        var confirmarSenha = document.getElementById("confirmarSenha").value;
        var submitBtn = document.getElementById("submitBtn");

        // Se as senhas não coincidirem, desativa o botão de envio
        if (senha !== confirmarSenha) {
            submitBtn.disabled = true;
        } else {
            submitBtn.disabled = false;
        }
    }

    // Ao carregar a página, ativa o botão de envio, já que não há alteração na senha
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("submitBtn").disabled = false;
    });

    // Atualiza o botão de envio baseado nas senhas
    document.getElementById("senha").addEventListener("input", validateForm);
    document.getElementById("confirmarSenha").addEventListener("input", validateForm);
</script>

</body>
</html>
