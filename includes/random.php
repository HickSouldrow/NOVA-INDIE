<h3 class="text-3xl font-bold">Talvez Você Goste</h3>

<div class="borda-jogos mt-6">
    
    <div class="flex justify-between items-center mb-4">
        <button id="prev-random" class="grid-nav-button bg-purple-800 rounded-full p-2 shadow-lg hover:bg-purple-900 transition-all duration-300 transform hover:scale-110" onclick="changeRandomGames(-5)">
            <img src="assets/img/back.svg" alt="Anterior" class="w-5 h-5">
        </button>

        <button id="next-random" class="grid-nav-button bg-purple-800 rounded-full p-2 shadow-lg hover:bg-purple-900 transition-all duration-300 transform hover:scale-110" onclick="changeRandomGames(5)">
            <img src="assets/img/forward.svg" alt="Próximo" class="w-5 h-5">
        </button>
    </div>

    <div class="overflow-hidden">
        <div class="flex transition-transform duration-500 ease-in-out" id="random-games-container">
            <?php
            include 'conexoes/config.php';
            // Seleciona 10 jogos aleatórios
            $sql = "SELECT CodJogo, nome, Preco, desconto FROM jogo WHERE desconto < 99 ORDER BY RAND() LIMIT 10";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<a href='jogo_template.php?CodJogo=" . $row['CodJogo'] . "' class='block bg-gray-900 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl mx-2' style='flex: 0 0 calc(20% - 16px);'>"; 
                    echo "<img src='assets/jogos/{$row['nome']}/thumbnail0.png' alt='" . htmlspecialchars($row['nome']) . "' class='w-full h-60 object-cover' onerror='this.onerror=null; this.src=\"assets/thumbnail0.png\";'>"; 
                    echo "<div class='p-4'>"; 
                    echo "<p class='text-gray-300 text-sm'>Jogo Base</p>"; 
                    echo "<p class='text-lg font-bold'>" . htmlspecialchars($row['nome']) . "</p>";

                    // Cálculo do preço com desconto
                    $precoOriginal = $row['Preco'];
                    $desconto = $row['desconto'];
                    $precoFinal = $precoOriginal;

                    echo "<div class='mt-2'>";
                    if (!empty($desconto) && $desconto > 0) {
                        $precoFinal -= ($precoFinal * ($desconto / 100));
                        echo "<span class='text-purple-500 font-bold'>-{$desconto}%</span>";
                        echo "<div class='flex items-center mt-1'>";
                        echo "<span class='line-through text-gray-400 mr-2'>R$ " . number_format($precoOriginal, 2, ',', '.') . "</span>";
                        echo "<span class='text-green-400 font-bold'>R$ " . number_format($precoFinal, 2, ',', '.') . "</span>";
                        echo "</div>";
                    } else {
                        echo "<span class='text-green-400 font-bold'>R$ " . number_format($precoOriginal, 2, ',', '.') . "</span>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</a>"; 
                }
            } else {
                echo "<p>Nenhum jogo encontrado.</p>";
            }
            $conn->close();
            ?>
            <script>
                let currentRandomIndex = 0; // Índice inicial para os jogos aleatórios
const randomGames = document.querySelectorAll('#random-games-container > a');
const randomGamesPerPage = 5;
const totalRandomGames = randomGames.length;

function showRandomGames() {
    const offset = -currentRandomIndex * (100 / randomGamesPerPage);
    const container = document.getElementById('random-games-container');
    container.style.transform = `translateX(${offset}%)`;
    document.getElementById('prev-random').disabled = currentRandomIndex === 0;
    document.getElementById('next-random').disabled = currentRandomIndex + randomGamesPerPage >= totalRandomGames;
}

function changeRandomGames(direction) {
    const newIndex = currentRandomIndex + direction;
    if (newIndex >= 0 && newIndex <= totalRandomGames - randomGamesPerPage) {
        currentRandomIndex = newIndex;
        showRandomGames();
    }
}

// Inicializa a exibição dos jogos aleatórios
showRandomGames();

            </script>
        </div>
    </div>
</div>
