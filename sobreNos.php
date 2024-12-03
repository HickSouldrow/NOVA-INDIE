<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós | NOVA INDIE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon_io/favicon-32x32.png">
    <style>
        /* Animação para a linha */
        .line-transition {
            position: relative;
            transition: transform 0.5s ease-in-out;
        }
        .line-transition.up {
            transform: translateY(-30px); /* Ajuste a altura para subir mais ou menos */
        }
    
    
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

    </style>
</head>
<body class="bg-neutral-900 text-white" onscroll="handleScroll()">

    <?php include 'includes/header.php'; ?>

    <main class="mx-auto max-w-7xl px-14 py-20 mt-32">
        <section class="text-center mb-10">
            <h1 class="text-4xl font-bold">Sobre Nós</h1>
            <p class="mt-4 text-lg text-gray-300">
                Bem-vindo à NOVA INDIE, uma plataforma dedicada à venda e valorização de jogos independentes. Nosso objetivo é dar visibilidade a desenvolvedores indie e oferecer aos gamers uma experiência única com jogos inovadores e criativos.
            </p>
            <div id="animated-line" class="mt-6 w-full h-0.5 bg-purple-700 line-transition"></div>
        </section>

        <section class="bg-neutral-800 rounded-lg shadow-lg p-10 items-center">
            <h2 class="text-3xl font-bold mb-6 ">Nossa Missão</h2>
            <p class="text-gray-400 leading-relaxed">
                Na NOVA INDIE, acreditamos no potencial dos jogos independentes para transformar a indústria de games. Nossa missão é fornecer um espaço onde esses jogos possam brilhar e alcançar o público que valoriza a originalidade e o esforço dos desenvolvedores indie.
            </p>
        </section>

        <section class="mt-16 flex justify-around items-center">
            <!-- Perfil Henrique -->
            <div class="text-center">
                <img src="assets/team/Henri.jpeg" alt="Henrique da Silva" class="w-40 h-40 object-cover rounded-full mx-auto mb-4">
                <h3 class="text-2xl font-semibold">Henrique da Silva Macedo</h3>
                <p class="text-gray-400 mt-2">
                    Olá, sou Henrique e meu sonho é me tornar um grande programador. Estudo programação e sou apaixonado por games. Estou comprometido com o crescimento da NOVA INDIE e em ajudar a comunidade indie a prosperar.
                </p>
                <p class="text-purple-400 mt-2">Email: <a href="mailto:henriquedasilvamacedo6@gmail.com" class="hover:underline">henriquedasilvamacedo6@gmail.com</a></p>
            </div>
            
            <!-- Perfil Gustavo -->
            <div class="text-center">
                <img src="assets/team/Gustavo.jpeg" alt="Gustavo" class="w-40 h-40 object-cover rounded-full mx-auto mb-4">
                <h3 class="text-2xl font-semibold">Gustavo de Souza Abreu</h3>
                <p class="text-gray-400 mt-2">
                    Eu sou o Gustavo, estudante de programação na ETEC Zona Leste. Embora ainda esteja explorando minhas opções de carreira, sou fascinado por robótica e tecnologia, e contribuo com minha perspectiva para a NOVA INDIE.
                </p>
                <p class="text-purple-400 mt-2">Email: <a href="mailto:gustavo.abreu16@etec.sp.gov.br" class="hover:underline">gustavo.abreu16@etec.sp.gov.br</a></p>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script>
        function handleScroll() {
            const animatedLine = document.getElementById('animated-line');
            const scrollPosition = window.scrollY + window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;

            if (scrollPosition >= documentHeight) {
                animatedLine.classList.add('up');
            } else {
                animatedLine.classList.remove('up');
            }
        }
    </script>
</body>
</html>
