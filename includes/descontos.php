<section id="descontos" class="mx-auto max-w-6xl px-8 py-10">
    <h3 class="text-3xl font-bold text-center mb-8">Ofertas Especiais</h3>
    <div class="flex justify-center items-center space-x-6 overflow-hidden">
        <div class="flex flex-wrap justify-center gap-6">
            <?php
            include 'conexoes/config.php';

            // Consulta para selecionar os dois jogos com maior desconto
            $sql = "SELECT CodJogo, nome, Preco, desconto FROM jogo WHERE desconto > 0 ORDER BY desconto DESC LIMIT 2"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Cálculo do preço com desconto
                    $precoOriginal = $row['Preco'];
                    $desconto = $row['desconto'];
                    $precoFinal = $precoOriginal - ($precoOriginal * ($desconto / 100));

                    // Card do jogo com desconto
                    echo "<a href='jogo_template.php?CodJogo=" . $row['CodJogo'] . "' class='block bg-gray-900 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl' style='width: 240px; flex-shrink: 0;'>";
                    echo "<img src='assets/jogos/{$row['nome']}/thumbnail0.png' alt='" . htmlspecialchars($row['nome']) . "' class='w-full h-48 object-cover' onerror='this.onerror=null; this.src=\"assets/thumbnail0.png\";'>";
                    echo "<div class='p-4 text-center'>";
                    echo "<p class='text-gray-300 text-sm'>Ofertão de Fim de Ano</p>"; 
                    echo "<p class='text-lg font-bold text-purple-600'>" . htmlspecialchars($row['nome']) . "</p>";
                    echo "<div class='flex justify-center items-center mt-2'>";
                    echo "<span class='line-through text-gray-400 mr-2'>R$ " . number_format($precoOriginal, 2, ',', '.') . "</span>";
                    echo "<span class='text-green-400 font-bold'>R$ " . number_format($precoFinal, 2, ',', '.') . "</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>";
                }
            } else {
                echo "<p class='text-center'>Nenhum jogo com desconto encontrado.</p>";
            }

            $conn->close();
            ?>

            <!-- Card final levando a ofertas.php -->
            <a href="ofertas.php" class="flex flex-col justify-center items-center bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl" style="width: 250px; height: 305px;">
                <div class="p-4 text-center">
                    <p class="text-xl font-bold text-purple-400">Ver Todas as Ofertas</p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mt-2 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9V5a1 1 0 112 0v4a1 1 0 01-1 1H7a1 1 0 010-2h2zm3.707 4.707a1 1 0 010-1.414l2.586-2.586a1 1 0 010 1.414l-2.586 2.586a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            </a>
        </div>
    </div>
</section>
