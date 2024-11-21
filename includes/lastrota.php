<div class="borda-jogos mt-6">
    
    <div class="flex justify-between items-center mb-4">
        <button id="prev-l" class="grid-nav-button bg-purple-800 rounded-full p-2 shadow-lg hover:bg-purple-900 transition-all duration-300 transform hover:scale-110" onclick="changeLGames(-5)">
            <img src="assets/img/back.svg" alt="Anterior" class="w-5 h-5">
        </button>

        <button id="next-l" class="grid-nav-button bg-purple-800 rounded-full p-2 shadow-lg hover:bg-purple-900 transition-all duration-300 transform hover:scale-110" onclick="changeLGames(5)">
            <img src="assets/img/forward.svg" alt="Próximo" class="w-5 h-5">
        </button>
    </div>

    <div class="overflow-hidden">
        <div class="flex transition-transform duration-500 ease-in-out" id="l-games-container">
            <?php
            include 'conexoes/config.php';
            
            // Seleciona os jogos com desconto
            $sql = "SELECT CodJogo, nome, Preco, desconto FROM jogo ORDER BY CodJogo DESC LIMIT 20"; 
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
                    $precoFinal = $precoOriginal - ($precoOriginal * ($desconto / 100));

                    echo "<div class='mt-2'>";
                    echo "<span class='text-purple-500 font-bold'>-{$desconto}%</span>";
                    echo "<div class='flex items-center mt-1'>";
                    echo "<span class='line-through text-gray-400 mr-2'>R$ " . number_format($precoOriginal, 2, ',', '.') . "</span>";
                    echo "<span class='text-green-400 font-bold'>R$ " . number_format($precoFinal, 2, ',', '.') . "</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>"; 
                }
            } else {
                echo "<p>Nenhum jogo com desconto encontrado.</p>";
            }
            $conn->close();
            ?>
<script>
    let currentLIndex = 0; // Índice inicial para os jogos com desconto
    const LGames = document.querySelectorAll('#l-games-container > a');
    const LGamesPerPage = 5; // Número de jogos por página
    const totalLGames = LGames.length; // Total de jogos carregados

    function showLGames() {
        const offset = -currentLIndex * (100 / LGamesPerPage);
        const container = document.getElementById('l-games-container');
        container.style.transform = `translateX(${offset}%)`;

        document.getElementById('prev-l').disabled = currentLIndex === 0;

        document.getElementById('next-l').disabled = currentLIndex + LGamesPerPage >= totalLGames;
    }

    function changeLGames(direction) {
        const newIndex = currentLIndex + direction;

        if (newIndex >= 0 && newIndex <= totalLGames - LGamesPerPage) {
            currentLIndex = newIndex;
            showLGames(); // Atualiza a exibição
        }
    }

    showLGames();
</script>

        </div>
    </div>
</div>
