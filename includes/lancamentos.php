<h3 class="text-3xl font-bold text-center mb-12">Lançados recentemente</h3>


<div class="borda-jogos mt-6">
    <div class="overflow-hidden">
        <div class="flex transition-transform duration-500 ease-in-out" id="recent-games-container">
            <?php
            include 'conexoes/config.php';
            
            // Seleciona os jogos mais recentes
            $sqlRecent = "SELECT CodJogo, nome, Preco, desconto, DtLancamento FROM jogo ORDER BY DtLancamento DESC LIMIT 3";
            $resultRecent = $conn->query($sqlRecent);

            if ($resultRecent->num_rows > 0) {
                while ($row = $resultRecent->fetch_assoc()) {
                    echo "<a href='jogo_template.php?CodJogo=" . $row['CodJogo'] . "' class='block bg-gray-900 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl mx-2' style='flex: 0 0 calc(33.33% - 16px);'>"; 
                    echo "<img src='assets/jogos/{$row['nome']}/thumbnail0.png' alt='" . htmlspecialchars($row['nome']) . "' class='w-full h-80 object-cover' onerror='this.onerror=null; this.src=\"assets/thumbnail0.png\";'>"; 
                    echo "<div class='p-6'>"; 
                    echo "<p class='text-gray-300 text-sm'>Lançamento Recente</p>"; 
                    echo "<p class='text-xl font-bold text-white'>" . htmlspecialchars($row['nome']) . "</p>";

                    // Cálculo do preço com desconto
                    $precoOriginal = $row['Preco'];
                    $desconto = $row['desconto'];
                    $precoFinal = $precoOriginal - ($precoOriginal * ($desconto / 100));
                    
                    echo "<div class='mt-2'>";
                    if ($desconto > 0) {
                        echo "<span class='text-purple-500 font-bold'>-{$desconto}%</span>";
                        echo "<div class='flex items-center mt-1'>";
                        echo "<span class='line-through text-gray-400 mr-2'>R$ " . number_format($precoOriginal, 2, ',', '.') . "</span>";
                        echo "<span class='text-green-400 font-bold'>R$ " . number_format($precoFinal, 2, ',', '.') . "</span>";
                        echo "</div>";
                    } else {
                        echo "<span class='text-green-400 font-bold'>R$ " . number_format($precoOriginal, 2, ',', '.') . "</span>";
                    }
                    echo "</div>";

                    // Botão "Jogue Agora"
                    echo "<button class='mt-4 bg-purple-700 text-white font-bold py-2 px-4 rounded hover:bg-purple-900 transition duration-300 w-full'>Jogue Agora</button>";
                    
                    echo "</div>";
                    echo "</a>";
                }
            } else {
                echo "<p>Nenhum jogo recente encontrado.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</div>
