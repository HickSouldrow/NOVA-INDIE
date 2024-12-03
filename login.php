<?php
session_start();
$erro = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnLogin'])) {
    include_once 'conexoes/cliente.php';
    include_once 'conexoes/config.php';
    $usuario = new Cliente();
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    
    
    // Realiza o login
    $pro_bd = $usuario->logar();

    // Se o login for bem-sucedido, define a variável de sessão
    if ($pro_bd) {
        $_SESSION['usuario'] = $pro_bd;
        
        // Verifica se é administrador e define na sessão
        if ($usuario->isAdmin()) {
            $_SESSION['is_admin'] = true;
            
            // Verifica se o CodCliente é 1 ou 5 para exibir o menu de gerenciar tabelas
            if ($usuario->getCodCliente() == 1 || $usuario->getCodCliente() == 5) {
                $_SESSION['can_manage_tables'] = true;  // Permite acessar as tabelas
            } else {
                $_SESSION['can_manage_tables'] = false;
            }
        } else {
            $_SESSION['is_admin'] = false;
            $_SESSION['can_manage_tables'] = false;
        }
        
        header("Location: index.php");
        exit;
    } else {
        $erro = true;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NOVA Indie</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon_io/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('senha');
            const icon = document.getElementById('togglePasswordIcon');

            // Verifica o tipo atual do campo de senha e alterna
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.src = 'assets/img/eye-open.svg'; // Ícone para o olho aberto
            } else {
                passwordInput.type = 'password';
                icon.src = 'assets/img/eye-closed.svg'; // Ícone para o olho fechado
            }
        }

        function validateField(field) {
            if (!field.value) {
                field.classList.add('border-red-500');
            } else {
                field.classList.remove('border-red-500');
            }
        }
    </script>
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
        .bg-dark-gray {
            background-color: #1f1f1f;
        }    
    </style>
</head>
<body class="flex flex-col min-h-screen text-white">
    <?php include 'includes/header.php'; ?>
    
    <div class="flex flex-grow justify-center items-center mb-40 mt-40">
        <div class="flex w-11/12 bg-dark-gray max-w-2xl bg-gray-900 rounded-lg shadow-lg overflow-hidden transform transition-transform">
            <div class="w-1/2 p-8 border-r border-gray-700">
                <h2 class="text-2xl font-semibold text-p-500 mb-6">Acessar sua conta</h2>
                <form action="" method="post">
                    <div class="mb-4 relative">
                        <input type="email" name="email" id="email" class="input-field w-full p-3 rounded text-white border <?php if ($erro) echo 'border-red-500'; ?> border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent text-sm focus:bg-[#282626]" placeholder="Endereço de E-mail" required onblur="validateField(this)">
                    </div>
                    <div class="mb-4 relative">
                        <input type="password" name="senha" id="senha" class="input-field w-full p-3 rounded text-white border <?php if ($erro) echo 'border-red-500'; ?> border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent text-sm focus:bg-[#282626]" placeholder="Senha" required onblur="validateField(this)">
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-3 flex items-center justify-center hover:bg-gray-700 px-2 py-0.5 hover:rounded-full rounded-full p-2 transition duration-200">
                            <img id="togglePasswordIcon" src="assets/img/eye-closed.svg" alt="Mostrar/Ocultar Senha" class="w-5 h-5 hover:opacity-75 transition-opacity duration-200">
                        </button>
                    </div>

                    <?php if ($erro): ?>
                        <p class="text-red-500 text-xs mb-4">Login ou senha incorretos.</p>
                    <?php endif; ?>

                    <div class="mt-6">
                        <button name="btnLogin" id="btnLogin" type="submit" class="w-full py-3 bg-purple-700 hover:bg-purple-600 text-white text-lg font-semibold rounded transition-transform duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-600">
                            Entrar
                        </button>
                    </div>
                </form>

                <p class="mt-6 text-xs text-center text-blue-400 hover:underline">
                    <a href="cadastro.php">Não tem uma conta? Cadastre-se</a>
                </p>
            </div>

            <div class="w-1/2 bg-purple-800 flex flex-col items-center justify-center p-6 text-center">
                <img src="assets/img/logo.png" alt="NOVA Indie Logo" class="w-24 h-24 mb-4">
                <h2 class="text-3xl font-bold text-white">NOVA Indie</h2>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const savedEmail = localStorage.getItem('newsletterEmail');
        if (savedEmail) {
            const emailField = document.getElementById('email');
            if (emailField) {
                emailField.value = savedEmail;
            }
            localStorage.removeItem('newsletterEmail'); // Remove o e-mail após utilizá-lo
        }
    });
</script>
    <footer class="text-white w-full mt-auto">
        <?php include 'includes/footer.php'; ?>
    </footer>
</body>
</html>
