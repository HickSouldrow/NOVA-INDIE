
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas - NOVA INDIE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body class="bg-gray-800 text-white" style="background-color: #101014;">
<?php

include 'conexoes/config.php';
include 'includes/header.php';
session_start();

$sql = "SELECT CodJogo, nome, Preco, desconto FROM jogo WHERE desconto > 0 ORDER BY desconto DESC"; // Seleciona jogos com desconto, do maior para o menor
$result = $conn->query($sql);
?>

<main class="mx-auto max-w-screen-xl px-6 md:px-12 lg:px-16 py-4 mt-16 flex-grow"> <!-- Ajustado para max-w-screen-xl e padding lateral -->
    <!-- Imagem de destaque no topo -->
    <div class="relative w-full h-96 overflow-hidden mb-6">
        <img src="assets/img/Ofertas.png" alt="Ofertas" class="absolute inset-0 object-cover w-full h-full" style="filter: brightness(0.7);">
        <div class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-5xl font-bold text-green-600">Grandes Ofertas</h1>
        </div>
    </div>

    <div class="text-center mb-6">
        <h2 class="text-4xl font-bold text-gray-300">Jogos em Oferta</h2>
        <p class="text-gray-400 mt-2 text-purple-500">Aproveite descontos imperdíveis!</p>
    </div>

    <?php
    // Exibir quantidade de ofertas encontradas
    echo "<p class='text-purple-400 mb-4'>Ofertas do momento: " . $result->num_rows . "</p>";
    ?>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        <?php
        // Código para exibir os cards dos jogos em oferta
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Card de cada jogo encontrado
                echo "<a href='jogo_template.php?CodJogo=" . $row['CodJogo'] . "' class='bg-gray-900 max-w-sm rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl block'>"; // Alterado para um link
                echo "<img src='assets/jogos/{$row['nome']}/thumbnail0.png' alt='" . htmlspecialchars($row['nome']) . "' class='w-full h-60 object-cover' onerror='this.onerror=null; this.src=\"assets/thumbnail0.png\";'>";
                echo "<div class='p-4'>";
                echo "<p class='text-gray-300 text-sm'>Jogo Base</p>";
                echo "<span class='text-lg font-bold transition-colors duration-300 hover:text-purple-600'>" . htmlspecialchars($row['nome']) . "</span>";
                
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
                echo "</a>"; // Fechando o link aqui
            }
        } else {
            echo "<p class='text-white'>Nenhum jogo encontrado.</p>";
        }
        ?>
    </div>
    <section class="mt-10">
                     <?php include 'includes/random.php'; ?> 
                </section>
</main>

<?php include 'includes/footer.php'; ?> <!-- Inclui o rodapé -->

</body>
</html>