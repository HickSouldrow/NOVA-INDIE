<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados da Pesquisa - NOVA INDIE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
    <link rel="icon" type="image/x-icon" href="assets/img/favicon_io/favicon-32x32.png">
    <script src="js/carrossel.js" defer></script>
    <script src="js/game.js" defer></script>
    <script src="js/sidebar.js" defer></script>
    <script src="js/dropdown.js" defer></script>
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


<body class="bg-gray-800 text-white">
<?php
include 'conexoes/config.php';
include 'includes/header.php';
session_start();


// Define $query para evitar o erro de variável indefinida
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

$sql = "SELECT CodJogo, nome, Preco, Desconto FROM jogo WHERE nome LIKE ? LIMIT 30"; // Certifique-se de que a coluna Desconto existe
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->bind_param("s", $searchTerm);

$stmt->execute();
$result = $stmt->get_result();
?>
<main class="mx-auto max-w-screen-xl px-6 md:px-12 lg:px-16 py-4 mt-16 flex-grow"> <!-- Ajustado para max-w-screen-xl e padding lateral -->
    <div class="text-center mb-6">
        <h2 class="text-4xl font-bold">Resultados da Pesquisa</h2>
        <p class="text-gray-400 mt-2">Você pesquisou por: <span class="text-purple-400 font-semibold"><?php echo htmlspecialchars($query); ?></span></p>
    </div>

    <?php
    // Exibir quantidade de itens encontrados
    echo "<p class='text-white mb-4 text-purple-400'>Resultados encontrados: " . $result->num_rows . "</p>";
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
                $desconto = $row['Desconto'];
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

    <!-- Espaço para a seção "Talvez você goste" -->
    <section class="mt-10">
        <?php include 'includes/random.php'; ?> <!-- Inclui a seção de cards aleatórios -->
    </section>
    
</main>

<?php include 'includes/footer.php'; ?> <!-- Inclui o rodapé -->

</body>
</html>
