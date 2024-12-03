<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - NOVA Indie</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon_io/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
body {
    margin: 0; 
    padding: 0; 
    background-image: url('assets/img/background.png'); 
    background-repeat: no-repeat; 
    background-size: cover; 
    background-attachment: fixed; 
    background-position: center; 
    font-family: Arial; 
}
        .input-field {
            background-color: #282626;
        }
        /* Estilo para o header */
        .header {
            background-color: #282626;
            border-bottom: 2px solid #6B21A8; /* Borda roxa na parte inferior */
        }
        .header img {
            width: 50px;
            height: 50px;

        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(62%) sepia(19%) saturate(546%) hue-rotate(223deg) brightness(95%) contrast(86%);
            color: #6b46c1; /* Fundo roxo */
            border-radius: 50%; /* Ícone arredondado */
            padding: 5px;
        }
        .error-message {
            color: #e53e3e; /* Vermelho para mensagens de erro */
            font-size: 0.875rem; /* Tamanho pequeno */
        }
        .bg-dark-gray {
            background-color: #1f1f1f; /* Um tom mais escuro que o cinza */
        }    


    
    </style>
</head>

<body class="text-white  justify-between">
    <div class = "flex items-center">
<?php include 'includes/header.php'; ?>

    </div>
    <div class="flex flex-col items-center ">

        <!-- Header com logo e nome do site -->
        <header class="flex items-center  bg-dark-gray   px-32 rounded-t-lg shadow-t-lg justify-between w-10/12 max-w-md p-4 mt-32 border-b-4 border-purple-700">
            <div class="flex items-center">
                <img src="assets/img/logo.png" alt="Logo NOVA Indie" class="h-12">
                <h1 class="text-2xl font-bold text-white ml-3">NOVA Indie</h1>
            </div>
            <!-- Menu (caso queira adicionar mais itens) -->
            <nav></nav>
        </header>

        <!-- Formulário de Cadastro -->
        <div class="flex w-10/12 max-w-md mb-40 bg-dark-gray  rounded-lg shadow-lg overflow-hidden transform transition-transform mx-auto">
            <div class="w-full p-6">
                <h2 class="text-xl font-semibold text-center text-purple-600 font-bold mb-4">Sign Up</h2>
                <form id="signup-form" action="processa_cadastro.php" method="post">

                    <!-- Nome Completo -->
                    <div class="mb-3">
                        <label for="nome" class="block text-sm mb-1">Nome completo:</label>
                        <input type="text" name="nome" id="nome" class="input-field w-full p-2 rounded text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required>
                        <small class="error-message" id="nome-error"></small>
                    </div>

                    <!-- Nickname -->
                    <div class="mb-3">
                        <label for="nickname" class="block text-sm mb-1">Nickname (apelido):</label>
                        <input type="text" name="nickname" id="nickname" class="input-field w-full p-2 rounded text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required>
                        <small class="error-message" id="nickname-error"></small>
                    </div>

                    <!-- Data de Nascimento -->
                    <div class="mb-3">
                        <label for="datanasc" class="block text-sm mb-1">Data de Nascimento:</label>
                        <input type="date" name="datanasc" id="datanasc" class="input-field w-full p-2 rounded text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required>
                    </div>

                    <!-- E-mail -->
                    <div class="mb-3">
                        <label for="email" class="block text-sm mb-1">E-mail:</label>
                        <input type="email" name="email" id="email" class="input-field w-full p-2 rounded text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required>
                        <small class="error-message" id="email-error"></small>
                    </div>

                    <!-- CPF -->
                    <div class="mb-3">
                        <label for="cpf" class="block text-sm mb-1">CPF (opcional):</label>
                        <input type="text" name="cpf" id="cpf" class="input-field w-full p-2 rounded text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="000.000.000-00">
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <label for="senha" class="block text-sm mb-1">Senha:</label>
                        <input type="password" name="senha" id="senha" class="input-field w-full p-2 rounded text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required>
                    </div>

                    <!-- Confirmar Senha -->
                    <div class="mb-3">
                        <label for="confirma_senha" class="block text-sm mb-1">Confirmar senha:</label>
                        <input type="password" name="confirma_senha" id="confirma_senha" class="input-field w-full p-2 rounded text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" required>
                        <small class="error-message" id="senha-error"></small>
                    </div>

                    <!-- Botões -->
          <div class="mt-4">
         <button type="reset" class="w-full py-2 px-4 bg-gray-700 hover:bg-gray-600 text-white font-semibold rounded transition-transform duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-600">
        Limpar
        </button>
          <button type="submit" class="w-full py-2 px-4 bg-purple-800 hover:bg-purple-900 text-white font-semibold rounded transition-transform duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-600 mt-4">
        Enviar
        </button>
           </div>
                           <!-- Link para Cadastro -->
                           <p class="mt-6 text-xs text-center text-blue-400 hover:underline">
                    <a href="login.php">Já tem uma conta? Entre agora!</a>
                </p>
                </form>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const nicknameField = document.getElementById('nickname');
        const emailField = document.getElementById('email');
        const senhaField = document.getElementById('senha');
        const confirmaSenhaField = document.getElementById('confirma_senha');
        const submitButton = document.querySelector('button[type="submit"]');

        // Função de validação de nickname e email
        nicknameField.addEventListener('input', () => {
            validateField('nickname', nicknameField.value, 'nickname-error');
        });
        emailField.addEventListener('input', () => {
            validateField('email', emailField.value, 'email-error');
        });
        senhaField.addEventListener('input', () => {
            validatePassword(senhaField.value);
        });
        confirmaSenhaField.addEventListener('input', () => {
            validateConfirmPassword(senhaField.value, confirmaSenhaField.value);
        });
        
async function validateField(field, value, errorFieldId) {
    const errorField = document.getElementById(errorFieldId);
    try {
        const response = await fetch(`validacoes/valida_${field}.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `${field}=${encodeURIComponent(value)}`
        });

        const result = await response.text();

        if (result) {
            errorField.textContent = result; // Exibe a mensagem de erro
        } else {
            errorField.textContent = ''; // Nenhum erro
        }
    } catch (error) {
        console.error('Erro na validação:', error);
    }
}

        // Função de validação de senha
        function validatePassword(password) {
            const errorField = document.getElementById('senha-error');
            const minLength = 12;
            const regexUpperCase = /[A-Z]/;
            const regexLowerCase = /[a-z]/;
            const regexNumber = /\d/;
            const regexSpecialChar = /[!@#$%^&*(),.?":{}|<>]/;

            if (password.length < minLength) {
                errorField.textContent = 'A senha deve ter no mínimo 12 caracteres.';
            } else if (!regexUpperCase.test(password)) {
                errorField.textContent = 'A senha deve conter pelo menos uma letra maiúscula.';
            } else if (!regexLowerCase.test(password)) {
                errorField.textContent = 'A senha deve conter pelo menos uma letra minúscula.';
            } else if (!regexNumber.test(password)) {
                errorField.textContent = 'A senha deve conter pelo menos um número.';
            } else if (!regexSpecialChar.test(password)) {
                errorField.textContent = 'A senha deve conter pelo menos um caractere especial.';
            } else {
                errorField.textContent = ''; // Senha válida
            }
        }

        // Função de validação de confirmação de senha
        function validateConfirmPassword(password, confirmPassword) {
            const errorField = document.getElementById('senha-error');
            if (confirmPassword !== password) {
                errorField.textContent = 'As senhas não coincidem.';
            } else {
                errorField.textContent = ''; // Senhas coincidem
            }
        }
    });

    
    </script>

</body>
</html>
