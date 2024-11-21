<div class="borda-jogos mt-6">
    <div class="overflow-hidden">
        <div class="flex transition-transform duration-500 ease-in-out" id="discount-games-container">
            <?php
            include 'conexoes/config.php';
            
            // Seleciona os dois jogos gratuitos
            $sqlFree = "SELECT CodJogo, nome, Preco, desconto FROM jogo WHERE Preco = 0 OR desconto = 100 LIMIT 2";
            $resultFree = $conn->query($sqlFree);

            if ($resultFree->num_rows > 0) {
                while ($row = $resultFree->fetch_assoc()) {
                    echo "<a href='jogo_template.php?CodJogo=" . $row['CodJogo'] . "' class='block rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl mx-2 ' style='flex: 0 0 calc(33.33% - 16px);'>"; 
                    echo "<img src='assets/jogos/{$row['nome']}/thumbnail0.png' alt='" . htmlspecialchars($row['nome']) . "' class='w-full h-60 object-cover' onerror='this.onerror=null; this.src=\"assets/thumbnail0.png\";'>"; 
                    echo "<div class='p-4'>"; 
                    echo "<p class='text-gray-300 text-sm'>Jogo Gratuito</p>"; 
                    echo "<p class='text-lg font-bold'>" . htmlspecialchars($row['nome']) . "</p>";
                    echo "<span class='text-green-400 font-bold'>Gratuito</span>";
                    echo "</div></a>";
                }
            }

            // Seleciona um jogo pago de baixo custo
            $sqlPaid = "SELECT CodJogo, nome, Preco, desconto FROM jogo WHERE Preco > 30 ORDER BY Preco LIMIT 1";
            $resultPaid = $conn->query($sqlPaid);


            if ($resultPaid->num_rows > 0) {
                $row = $resultPaid->fetch_assoc();
                echo "<a href='jogo_template.php?CodJogo=" . $row['CodJogo'] . "' class='block shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl mx-2' style='flex: 0 0 calc(33.33% - 16px);'>"; 
                echo "<img src='assets/{$row['nome']}/thumbnail0.png' alt='" . htmlspecialchars($row['nome']) . "' class='w-full h-60 object-cover' onerror='this.onerror=null; this.src=\"assets/thumbnail0.png\";'>"; 
                echo "<div class='p-4'>"; 
                echo "<p class='text-gray-300 text-sm'>Jogo Pago</p>"; 
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
            } else {
                echo "<p>Nenhum jogo pago encontrado.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</div>
