<?php
include 'conexoes/config.php';

// Consulta para obter todos os registros de classificações indicativas
$sqlClassIndicativa = "SELECT * FROM ClassificacaoIndicativa";
$resultClassIndicativa = $conn->query($sqlClassIndicativa);

if (!$resultClassIndicativa || $resultClassIndicativa->num_rows == 0) {
    echo "<p>Nenhuma classificação indicativa encontrada no banco de dados.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classificação Indicativa</title>
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
            font-family: Arial; 
        }
    </style>
</head>
<body class="bg-neutral-900 text-white">

    <?php include 'includes/header.php'; ?>

    <main class="mx-auto max-w-6xl px-14 py-20 mt-16">
        <h1 class="text-purple-600 text-4xl font-bold mb-10">Classificação Indicativa</h1>

        <?php while ($classIndicativa = $resultClassIndicativa->fetch_assoc()): ?>
        <section class="mb-16">
            <!-- Informações da Classificação Indicativa -->
            <div class="bg-gray-900 p-6 rounded-lg">
            <h3 class="text-2xl font-bold text-gray-300">Classificação: </h3>
                <h2 class="text-xl  font-bold mb-4 text-purple-500"><?php echo htmlspecialchars($classIndicativa['ClassificacaoIndicativa']); ?></h2>
                <ul class="text-gray-300 space-y-4">
                    <?php
                    $codFaixaEtaria = $classIndicativa['CodFaixaEtaria'];
                    $sqlGames = "SELECT CodJogo, Nome, Preco, desconto 
                                 FROM jogo 
                                 WHERE CodFaixaEtaria = ? 
                                 ORDER BY Nome LIMIT 20";
                    $stmtGames = $conn->prepare($sqlGames);
                    $stmtGames->bind_param("i", $codFaixaEtaria);
                    $stmtGames->execute();
                    $resultGames = $stmtGames->get_result();
                    $numGames = $resultGames->num_rows;
                    ?>
               </div>
                    <!-- Carrossel de Jogos com esta Classificação -->
                    <div class="mt-10">
                        <h3 class="text-3xl font-bold">Jogos com esta Classificação</h3>
                        <div class="borda-jogos mt-6">
                            <?php if ($numGames > 0): ?>
                            <div class="flex justify-between items-center mb-4">
                                <button id="prev-<?php echo $classIndicativa['CodFaixaEtaria']; ?>" class="grid-nav-button bg-purple-800 rounded-full p-2 shadow-lg hover:bg-purple-900 transition-all duration-300 transform hover:scale-110" onclick="changeGameSlide('<?php echo $classIndicativa['CodFaixaEtaria']; ?>', 4)">
                                    <img src="assets/img/back.svg" alt="Anterior" class="w-5 h-5">
                                </button>
                                <button id="next-<?php echo $classIndicativa['CodFaixaEtaria']; ?>" class="grid-nav-button bg-purple-800 rounded-full p-2 shadow-lg hover:bg-purple-900 transition-all duration-300 transform hover:scale-110" onclick="changeGameSlide('<?php echo $classIndicativa['CodFaixaEtaria']; ?>', -4)">
                                    <img src="assets/img/forward.svg" alt="Próximo" class="w-5 h-5">
                                </button>
                            </div>
                            <?php endif; ?>

                            <div class="overflow-hidden">
                                <div class="flex transition-transform duration-500 ease-in-out" id="game-slider-<?php echo $classIndicativa['CodFaixaEtaria']; ?>">
                                    <?php
                                    if ($numGames > 0):
                                        while ($game = $resultGames->fetch_assoc()):
                                            $precoOriginal = $game['Preco'];
                                            $desconto = $game['desconto'];
                                            $precoFinal = $precoOriginal - ($precoOriginal * ($desconto / 100));
                                    ?>
                                    <a href="jogo_template.php?CodJogo=<?php echo $game['CodJogo']; ?>" class="block bg-gray-900 mb-16 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl mx-2" style="flex: 0 0 calc(20% - 16px);">
                                        <img src="assets/jogos/<?php echo $game['Nome']; ?>/thumbnail0.png" alt="<?php echo htmlspecialchars($game['Nome']); ?>" class="w-full h-60 object-cover" onerror="this.onerror=null; this.src='assets/thumbnail0.png';">
                                        <div class="p-4">
                                            <p class="text-gray-300 text-sm">Jogo Base</p>
                                            <p class="text-lg font-bold"><?php echo htmlspecialchars($game['Nome']); ?></p>
                                            <div class="mt-2">
                                                <span class="text-purple-500 font-bold">-<?php echo $desconto; ?>%</span>
                                                <div class="flex items-center mt-1">
                                                    <span class="line-through text-gray-400 mr-2">R$ <?php echo number_format($precoOriginal, 2, ',', '.'); ?></span>
                                                    <span class="text-green-400 font-bold">R$ <?php echo number_format($precoFinal, 2, ',', '.'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php endwhile; else: ?>
                                    <p class="text-gray-500">Nenhum jogo encontrado para esta classificação.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php endwhile; ?>

        </section>

        <script>
        function changeGameSlide(codFaixaEtaria, direction) {
            const slider = document.getElementById(`game-slider-${codFaixaEtaria}`);
            const items = slider.children;
            const totalItems = items.length;
            const visibleItems = 5; // Número de itens visíveis no carrossel

            let currentOffset = parseInt(slider.style.transform.replace('translateX(', '').replace('%)', '')) || 0;
            const newOffset = currentOffset + (direction * (100 / visibleItems));

            if (newOffset <= 0 && Math.abs(newOffset) / (100 / visibleItems) < totalItems) {
                slider.style.transform = `translateX(${newOffset}%)`;
            }
        }
        </script>

    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>
