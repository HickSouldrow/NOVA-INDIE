<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre Nós | NOVA INDIE</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="assets/img/favicon_io/favicon-32x32.png" />
  <style>


    @keyframes fadeIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Linha animada */
    .line-transition {
      position: relative;
      transition: transform 0.5s ease-in-out;
    }

    .line-transition.up {
      transform: translateY(-30px);
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
<body class="bg-neutral-900 text-white fade-in" onscroll="handleScroll()">

  <?php include 'includes/header.php'; ?>

  <main class="mx-auto max-w-7xl px-14 py-20 mt-32">
    <section class="text-center mb-10">
      <h1 class="text-4xl font-bold">Sobre Nós</h1>
      <p class="mt-4 text-lg text-gray-300">
        Bem-vindo à NOVA INDIE, uma plataforma dedicada à venda e valorização de jogos independentes. Nosso objetivo é dar visibilidade a desenvolvedores indie e oferecer aos gamers uma experiência única com jogos inovadores e criativos.
      </p>
      <div id="animated-line" class="mt-6 w-full h-0.5 bg-purple-700 line-transition"></div>
    </section>

    <section class="bg-neutral-800 rounded-lg shadow-lg p-10 items-center fade-in">
      <h2 class="text-3xl font-bold mb-6">Nossa Missão</h2>
      <p class="text-gray-400 leading-relaxed">
        Na NOVA INDIE, acreditamos no potencial dos jogos independentes para transformar a indústria de games. Nossa missão é fornecer um espaço onde esses jogos possam brilhar e alcançar o público que valoriza a originalidade e o esforço dos desenvolvedores indie.
      </p>
    </section>

   <section class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-12 fade-in">
  <!-- Card 1: HickSouldrow -->
  <div class="bg-neutral-800 p-6 rounded-lg shadow-lg text-center">
    <img src="https://github.com/HickSouldrow.png" alt="HickSouldrow" class="w-32 h-32 rounded-full mx-auto mb-4" />
    <h3 class="text-2xl font-semibold">HickSouldrow</h3>
    <p class="text-gray-400 mt-2">
      Desenvolvedor e membro da NOVA INDIE. Atua na área de programação com foco em criatividade e inovação.
    </p>
    <a href="https://github.com/HickSouldrow" target="_blank" class="mt-4 inline-block text-purple-400 hover:underline">
      Ver perfil no GitHub
    </a>
  </div>

  <!-- Card 2: Gus -->
  <div class="bg-neutral-800 p-6 rounded-lg shadow-lg text-center">
    <img src="https://github.com/Ioogo.png" alt="Ioogo" class="w-32 h-32 rounded-full mx-auto mb-4" />
    <h3 class="text-2xl font-semibold">Ioogo</h3>
    <p class="text-gray-400 mt-2">
      Contribuidor da NOVA INDIE, interessado em desenvolvimento web e tecnologias modernas.
    </p>
    <a href="https://github.com/Ioogo" target="_blank" class="mt-4 inline-block text-purple-400 hover:underline">
      Ver perfil no GitHub
    </a>
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
