<!-- footer.php -->
<footer class="bg-gray-900 text-white py-12 mt-10 border-t border-purple-800">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        
        <!-- Logo e Direitos Autorais -->
        <div class="flex flex-col items-center md:items-start">
            <a href="index.php" class="flex items-center space-x-3">
                <img src="assets/img/logo.png" alt="NOVA INDIE Logo" class="w-10 h-10">
                <h2 class="text-2xl font-bold">NOVA INDIE</h2>
            </a>
            <p class="mt-4 text-gray-400 text-sm text-center md:text-left">
                &copy; <?php echo date("Y"); ?> NOVA INDIE. Todos os direitos reservados. Nomes e marcas mencionados no site são propriedade de seus respectivos donos.
            </p>
        </div>

        <!-- Links Rápidos: Suporte -->
        <div class="flex flex-col items-center md:items-start space-y-6 md:col-span-1">
        <h3 class="text-lg font-semibold text-purple-400">Jogos</h3>
            <ul class="space-y-2">
                <li><a href="ofertas.php" class="hover:text-purple-600 transition-colors duration-200">Ofertas</a></li>
                <li><a href="novidades.php" class="hover:text-purple-600 transition-colors duration-200">Novidades</a></li>
                <li><a href="classificacaoindicativa.php" class="hover:text-purple-600 transition-colors duration-200">Classificações Indicativas</a></li>
                <li><a href="reqminimos.php" class="hover:text-purple-600 transition-colors duration-200">Requisitos Mínimos</a></li>
            </ul>
        </div>

        <!-- Links Rápidos: Jogos -->
        <div class="flex flex-col items-center md:items-start space-y-6 ">
        <h3 class="text-lg font-semibold text-purple-400">Suporte</h3>
            <ul class="space-y-2">
                <li><a href="suporte.php" class="hover:text-purple-600 transition-colors duration-200">Suporte</a></li>
                <li><a href="sobrenos.php" class="hover:text-purple-600 transition-colors duration-200">Sobre</a></li>
                <li><a href="termos.php" class="hover:text-purple-600 transition-colors duration-200">Termos de Uso</a></li>
                <li><a href="privacidade.php" class="hover:text-purple-600 transition-colors duration-200">Políticas de Privacidade</a></li>

            </ul>
        </div>

        <!-- Redes Sociais -->
        <div class="flex flex-col items-center md:items-start space-y-6">
            <h3 class="text-lg font-semibold text-purple-400">Redes</h3>
            <div class="flex space-x-3">
                <a href="https://www.facebook.com" class="bg-purple-800 p-1 rounded-full hover:bg-purple-600 transition-all duration-300">
                    <img src="assets/img/facebook-icon.svg" alt="Facebook" class="w-6 h-6">
                </a>
                <a href="https://www.instagram.com/novaindiegames/" class="bg-purple-800 p-1 rounded-full hover:bg-purple-600 transition-all duration-300">
                    <img src="assets/img/instagram-icon.svg" alt="Instagram" class="w-6 h-6">
                </a>
                <a href="https://www.x.com" class="bg-purple-800 p-1 rounded-full hover:bg-purple-600 transition-all duration-300">
                    <img src="assets/img/twitter-icon.svg" alt="Twitter" class="w-6 h-6">
                </a>
            </div>

            <?php
// Verifique se o usuário está logado
$loggedIn = isset($_SESSION['CodCliente']);
?>

<form id="newsletterForm" action="login.php" method="post" class="mt-4 flex items-center w-full max-w-sm">
    <input type="email" id="emailField" name="email" placeholder="Assine nossa newsletter" class="bg-gray-800 text-white p-2 w-full rounded-l-md focus:outline-none focus:bg-gray-700 text-sm" required 
           <?php echo $loggedIn ? 'disabled' : ''; ?>>
    <button type="button" onclick="retainEmail()" class="bg-purple-800 p-2 rounded-r-md hover:bg-purple-600 transition-all duration-300 text-sm" 
            <?php echo $loggedIn ? 'disabled' : ''; ?>>Entre!</button>
</form>

<script>
    function retainEmail() {
        // Só permite funcionar se o usuário não estiver logado
        if (!<?php echo $loggedIn ? 'true' : 'false'; ?>) {
            const email = document.getElementById('emailField').value;
            if (email) {
                localStorage.setItem('newsletterEmail', email);
                window.location.href = 'login.php'; // Redireciona para a página de login
            } else {
                alert('Por favor, preencha o campo de e-mail!');
            }
        }
    }
</script>


        </div>
    </div>
</footer>

