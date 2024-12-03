<?php
include 'conexoes/config.php';

$codJogo = $_GET['CodJogo'];
$sql = "SELECT Nome, DtLancamento, Avaliacao, CodFaixaEtaria, ReqMinId, Preco, Descricao, Sinopse, Desconto FROM jogo WHERE CodJogo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $codJogo);
$stmt->execute();
$result = $stmt->get_result();
$game = $result->fetch_assoc();

if (!$game) {
    echo "<p>Jogo não encontrado.</p>";
    exit;
}

// Caminho para as imagens do jogo
$gameFolder = "assets/jogos/" . $game['Nome'];

// Checa se a pasta do jogo existe
if (is_dir($gameFolder)) {
    $imagePaths = [
        "$gameFolder/thumbnail1.png",
        "$gameFolder/thumbnail2.png",
        "$gameFolder/thumbnail3.png",
        "$gameFolder/thumbnail4.png"
    ];
} 

$sqlCategorias = "SELECT c.CategoriaTipo FROM categoriajogo cj JOIN categoria c ON cj.CodCategoria = c.CodCategoria WHERE cj.CodJogo = ?";
$stmtCategorias = $conn->prepare($sqlCategorias);
$stmtCategorias->bind_param("i", $codJogo);
$stmtCategorias->execute();
$resultCategorias = $stmtCategorias->get_result();

$categorias = [];
while ($categoria = $resultCategorias->fetch_assoc()) {
    $categorias[] = $categoria['CategoriaTipo'];
}
// Consulta para obter o CodDesenvolvedora
$sqlDesenvolvedora = "SELECT CodDesenvolvedora FROM JogoDesenvolvedora WHERE CodJogo = ?";
$stmtDesenvolvedora = $conn->prepare($sqlDesenvolvedora);
$stmtDesenvolvedora->bind_param("i", $codJogo);
$stmtDesenvolvedora->execute();
$resultDesenvolvedora = $stmtDesenvolvedora->get_result();
$desenvolvedoraId = $resultDesenvolvedora->fetch_assoc()['CodDesenvolvedora'];

// Consulta para obter as informações da desenvolvedora
$sqlInfoDesenvolvedora = "SELECT NomeDesenvolvedora, CNPJ, Email_Contato, SiteOficial FROM Desenvolvedora WHERE CodDesenvolvedora = ?";
$stmtInfoDesenvolvedora = $conn->prepare($sqlInfoDesenvolvedora);
$stmtInfoDesenvolvedora->bind_param("i", $desenvolvedoraId);
$stmtInfoDesenvolvedora->execute();
$resultInfoDesenvolvedora = $stmtInfoDesenvolvedora->get_result();
$desenvolvedora = $resultInfoDesenvolvedora->fetch_assoc();

// Consulta para obter os requisitos mínimos
$reqMinId = $game['ReqMinId'];
$sqlReqMin = "SELECT SOMin, GPUMin, CPUMin, DirectXMin, Armazenamento, RAMmin, OBS FROM ReqMinimos WHERE ReqMinId = ?";
$stmtReqMin = $conn->prepare($sqlReqMin);
$stmtReqMin->bind_param("i", $reqMinId);
$stmtReqMin->execute();
$resultReqMin = $stmtReqMin->get_result();
$reqMin = $resultReqMin->fetch_assoc();

// Consulta para obter a Classificaça~o Indicativa
$codFaixaEtaria = $game['CodFaixaEtaria'];
$sqlClassificacao = "SELECT classificacaoindicativa FROM ClassificacaoIndicativa WHERE CodFaixaEtaria = ?";
$stmtClassificacao = $conn->prepare($sqlClassificacao);
$stmtClassificacao->bind_param("i", $codFaixaEtaria);
$stmtClassificacao->execute();
$resultClassificacao = $stmtClassificacao->get_result();
$classificacao = $resultClassificacao->fetch_assoc()['classificacaoindicativa'];

// Obtendo os gêneros do jogo
$sqlGeneros = "SELECT g.GeneroDescr FROM Genero g 
               JOIN generojogo gj ON g.CodGenero = gj.CodGenero WHERE gj.CodJogo = ?";
$stmtGeneros = $conn->prepare($sqlGeneros);
$stmtGeneros->bind_param("i", $codJogo);
$stmtGeneros->execute();
$resultGeneros = $stmtGeneros->get_result();

// Array para armazenar os gêneros
$generos = [];
while ($row = $resultGeneros->fetch_assoc()) {
    $generos[] = $row['GeneroDescr'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $game['Nome']; ?> - Detalhes do Jogo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon_io/favicon-32x32.png">
    <style>
        /* Estilos personalizados para as imagens */

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

        .image-carousel img {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 8px;
        }

        .image-carousel img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }

        .thumbnail img {
            width: 100px;
            height: 70px;
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
        }

        .thumbnail img:hover {
            transform: scale(1.1);
            opacity: 0.8;
        }
        .fade-out {
    animation: fadeOut 0.3s forwards;
}

.fade-in {
    animation: fadeIn 0.3s forwards;
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
        
    </style>
</head>
<body class="bg-neutral-900 text-white">

    <?php include 'includes/header.php'; ?>

    <main class="mx-auto max-w-6xl px-14 py-20 mt-16"> <!-- Ajuste do container principal para espaçamento lateral -->
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Coluna Esquerda (Imagens do jogo) -->
            <div class="lg:w-2/3">
                <!-- Nome do jogo -->
                <h2 class="text-purple-600 text-3xl font-bold mt-8 mb-4"><?php echo $game['Nome']; ?></h2>



<!-- Carousel de imagens -->
<div class="mb-6 image-carousel">
    <img id="main-image" src="<?php echo $imagePaths[0]; ?>" alt="Imagem do Jogo" class="w-full h-80 object-cover rounded-lg mb-4">
    <div class="flex items-center justify-between">
        <!-- Botão de seta esquerda (back) -->
        <button id="prev" class="grid-nav-button bg-purple-800 rounded-full p-2 shadow-lg hover:bg-purple-900 transition-all duration-300 transform hover:scale-110" onclick="changeGames(-1)">
            <img src="assets/img/back.svg" alt="Anterior" style="width: 12px; height: 16px;"> <!-- Imagem trocada -->
        </button>

        <div class="flex space-x-2 thumbnail">
            <?php for ($i = 0; $i < count($imagePaths); $i++): // Mudei para começar de 0 ?>
                <img src="<?php echo $imagePaths[$i]; ?>" alt="Thumbnail <?php echo $i + 1; ?>" class="rounded-lg" onclick="changeMainImage(<?php echo $i; ?>)"> <!-- Adicionei onclick para cada thumbnail -->
            <?php endfor; ?>
        </div>

        <!-- Botão de seta direita (forward) -->
        <button id="next" class="grid-nav-button bg-purple-800 rounded-full p-2 shadow-lg hover:bg-purple-900 transition-all duration-300 transform hover:scale-110" onclick="changeGames(1)">
            <img src="assets/img/forward.svg" alt="Próximo" style="width: 12px; height: 16px;"> <!-- Imagem trocada -->
        </button>
    </div>
</div>


                <!-- Descrição do jogo -->
                <div class="p-4 rounded-lg mb-4">
                    <p class="text-gray-300 break-words"><?php echo $game['Descricao']; ?></p> <!-- Adicionada a classe break-words para quebra de linha -->
                </div>

                <!-- Sinopse do jogo -->
                <div class="bg-gray-900 p-4 rounded-lg mb-4">
                    <h3 class="text-xl font-semibold mb-2 text-purple-500">Sinopse</h3>
                    <p class="text-gray-300 break-words"><?php echo $game['Sinopse']; ?></p> <!-- Adicionada a classe break-words para quebra de linha -->
                </div>

                <!-- Requisitos mínimos -->
                <?php if ($reqMin): ?>
                    <a  href="reqminimos.php">
                <div class="mt-10 bg-gray-900 p-6 rounded-lg hover:bg-gray-800 transition duration-300">
                    <h3 class="text-xl font-bold mb-4 text-purple-500">Requisitos Mínimos</h3>
                    <ul class="text-gray-300 space-y-4"> <!-- Aumentado o espaçamento entre os itens -->
                        <li><strong>Sistema Operacional:</strong> <?php echo $reqMin['SOMin']; ?></li>
                        <li><strong>GPU:</strong> <?php echo $reqMin['GPUMin']; ?></li>
                        <li><strong>CPU:</strong> <?php echo $reqMin['CPUMin']; ?></li>
                        <li><strong>DirectX:</strong> <?php echo $reqMin['DirectXMin']; ?></li>
                        <li><strong>Armazenamento:</strong> <?php echo $reqMin['Armazenamento']; ?></li>
                        <li><strong>RAM:</strong> <?php echo $reqMin['RAMmin']; ?></li>
                        <li><strong class="text-purple-700">Observações:</strong> <?php echo $reqMin['OBS']; ?></li> 

                    </ul>
                </div>
                </a>
                <?php endif; ?>
            </div>

            <!-- Coluna Direita (Preço e Botões de Ação) -->
<div class="lg:w-1/3 mt-16"> 
<div class="bg-gradient-to-r from-gray-900 to-indigo-800 p-8 rounded-lg shadow-xl text-center transform hover:scale-105 transition-all">
<p class="text-gray-300 text-lg font-semibold mb-4">Jogo Base</p>
<div id="buttonContainer">
    <a id="downloadLink" href="assets/jogo.apk" download="jogo.apk" class="w-full bg-gradient-to-r from-purple-600 to-indigo-800 py-2 rounded-full text-white font-bold hover:bg-purple-800 transition-all shadow-lg hover:shadow-xl text-center inline-block" onclick="mudarParaJogar()">
        Instalar Agora!
    </a>
</div>

<script>
function mudarParaJogar() {
    const buttonContainer = document.getElementById('buttonContainer');

    // Remover o botão de instalação
    buttonContainer.innerHTML = `
        <a id="playLink" href="assets/pong/pong.html" class="w-full bg-gradient-to-r from-purple-600 to-indigo-800 py-2 rounded-full text-white font-bold hover:bg-Purple-700 transition-all shadow-lg hover:shadow-xl text-center inline-block">
            Jogar Agora!
        </a>
    `;
}
</script>
</div>

    <!-- Informações do jogo -->
    <div class="mt-6 p-4 bg-gray-900 rounded-lg shadow-lg text-center">
    <p class="text-gray-400 mb-2">
        <span class="font-semibold text-white">Avaliação:</span> 
        <?php 
            // Renderiza estrelas com base na avaliação
            $avaliacao = $game['Avaliacao'];
            $stars = str_repeat('<span class="text-purple-600">★</span>', floor($avaliacao)) . str_repeat('<span class="text-gray-400">☆</span>', 5 - floor($avaliacao));
            echo $stars; 
        ?>
    </p>

    <p class="text-gray-400 mb-2">
        <span class="font-semibold text-white">Gênero:</span> <?php echo implode(", ", $generos); ?>
    </p>

    <p class="text-gray-400 mb-2">
        <span class="font-semibold text-white">Categoria:</span> <?php echo implode(", ", $categorias); ?>
    </p>
<a href= "classificacaoIndicativa.php">
    <p class="text-gray-400 mb-2 hover:text-gray-300 mt-3 inline-block font-semibold">
        <span class="font-semibold text-white">Classificação Indicativa:</span> <?php echo $classificacao; ?>
    </p> 
</a>

    <p class="text-gray-400 mb-2">
        <span class="font-semibold text-white">Data de Lançamento:</span> <?php echo $game['DtLancamento']; ?>
    </p>

    <p class="text-gray-400 mb-2">
        <span class="font-semibold text-white">Auto-reembolsável</span>
    </p>

    <a href="#" class="text-blue-500 hover:text-blue-400 mt-3 inline-block font-semibold">Ver todas as edições e complementos</a>
</div>

<!-- Informações da Desenvolvedora -->
<a href="desenvolvedora.php?CodDesenvolvedora=<?php echo $desenvolvedoraId; ?>">
    <div class="mt-6 p-4 bg-gray-900 rounded-lg hover:bg-gray-800 transition duration-300">
        <h3 class="text-xl font-semibold mb-2 text-purple-500">Desenvolvedora</h3>
        <?php if ($desenvolvedora): ?>
            <p class="text-purple-300 text-lg"><?php echo $desenvolvedora['NomeDesenvolvedora']; ?></p>
            <p class="text-purple-300 text-lg"><strong>CNPJ:</strong> <?php echo $desenvolvedora['CNPJ']; ?></p>
            <p class="text-purple-300 text-lg"><strong>Email de Contato:</strong> <a href="mailto:<?php echo $desenvolvedora['Email_Contato']; ?>" class="text-blue-500"><?php echo $desenvolvedora['Email_Contato']; ?></a></p>
            <p class="text-purple-300 text-lg"><strong>Site Oficial:</strong> <a href="<?php echo $desenvolvedora['SiteOficial']; ?>" target="_blank" class="text-blue-500"><?php echo $desenvolvedora['SiteOficial']; ?></a></p>
        <?php else: ?>
            <p class="text-purple-300 text-lg">Nenhuma informação disponível sobre a desenvolvedora.</p>
        <?php endif; ?>
    </div>
</a>

            </div>
            
        </div>
        <section class="mt-32">
                <?php include 'includes/random.php'; ?>
                </section>
    </main>

    <?php include 'includes/footer.php'; ?>
    
<script>

let currentImageIndex = 0; 

function changeGames(direction) {
    const images = <?php echo json_encode($imagePaths); ?>; 
    const totalImages = images.length;

    currentImageIndex += direction;

    if (currentImageIndex < 0) {
        currentImageIndex = totalImages - 1; 
    } else if (currentImageIndex >= totalImages) {
        currentImageIndex = 0; 
    }

    const mainImage = document.getElementById('main-image');
    mainImage.classList.add('fade-out');

    // Troca de imagem após a animação de fade-out
    setTimeout(() => {
        mainImage.src = images[currentImageIndex];
        mainImage.classList.remove('fade-out');
        mainImage.classList.add('fade-in');

        // Remove a classe fade-in após a animação
        setTimeout(() => {
            mainImage.classList.remove('fade-in');
        }, 300); // Tempo da animação fade-in
    }, 300); // Tempo da animação fade-out
}

function changeMainImage(index) {
    currentImageIndex = index; 

    const mainImage = document.getElementById('main-image');
    mainImage.classList.add('fade-out');

    // Troca de imagem após a animação de fade-out
    setTimeout(() => {
        mainImage.src = <?php echo json_encode($imagePaths); ?>[currentImageIndex]; // Atualiza a imagem principal
        mainImage.classList.remove('fade-out');
        mainImage.classList.add('fade-in');

        // Remove a classe fade-in após a animação
        setTimeout(() => {
            mainImage.classList.remove('fade-in');
        }, 300); // Tempo da animação fade-in
    }, 300); // Tempo da animação fade-out
}

</script>

</body>

</html>
