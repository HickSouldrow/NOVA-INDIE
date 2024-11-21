<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desenvolvedora - <?= htmlspecialchars($desenvolvedora['NomeDesenvolvedora']); ?> - NOVA INDIE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
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
session_start();
include 'conexoes/config.php';
include 'includes/header.php';

// Obter o ID da desenvolvedora da URL
$CodDesenvolvedora = $_GET['CodDesenvolvedora'];

// Consulta para obter os dados da desenvolvedora
$sqlDesenvolvedora = "SELECT NomeDesenvolvedora, CNPJ, Email_Contato, SiteOficial FROM desenvolvedora WHERE CodDesenvolvedora = ?";
$stmt = $conn->prepare($sqlDesenvolvedora);
$stmt->bind_param("i", $CodDesenvolvedora);
$stmt->execute();
$resultDesenvolvedora = $stmt->get_result();
$desenvolvedora = $resultDesenvolvedora->fetch_assoc();

// Consulta para obter os jogos associados à desenvolvedora
$sqlJogos = "SELECT jogo.CodJogo, jogo.nome, jogo.Preco, jogo.desconto 
             FROM jogo
             JOIN JogoDesenvolvedora ON jogo.CodJogo = JogoDesenvolvedora.CodJogo
             WHERE JogoDesenvolvedora.CodDesenvolvedora = ?";
$stmtJogos = $conn->prepare($sqlJogos);
$stmtJogos->bind_param("i", $CodDesenvolvedora);
$stmtJogos->execute();
$resultJogos = $stmtJogos->get_result();
?>
<main class="mx-auto max-w-screen-xl px-6 md:px-12 lg:px-16 py-4 mt-16 flex-grow">
    <!-- Imagem da desenvolvedora no topo -->
    <div class="relative w-full h-80 overflow-hidden rounded-lg mb-6">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-900 flex flex-col items-start justify-end p-6">
            <h1 class="text-5xl font-bold text-green-400"><?= htmlspecialchars($desenvolvedora['NomeDesenvolvedora']); ?></h1>
        </div>
    </div>

    <!-- Jogos desenvolvidos -->
    <div class="text-center mb-6">
        <h2 class="text-4xl font-bold text-gray-300">Jogos Desenvolvidos</h2>
        <p class="text-gray-400 mt-2 text-purple-500">Confira os jogos criados por esta desenvolvedora</p>
    </div>

    <?php
    // Exibir quantidade de jogos encontrados
    echo "<p class='text-purple-400 mb-4'>Jogos desenvolvidos: " . $resultJogos->num_rows . "</p>";
    ?>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
        <?php
        if ($resultJogos->num_rows > 0) {
            while ($row = $resultJogos->fetch_assoc()) {
                echo "<a href='jogo_template.php?CodJogo=" . $row['CodJogo'] . "' class='bg-gray-900 max-w-sm rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl block'>";
                echo "<img src='assets/jogos/{$row['nome']}/thumbnail0.png' alt='" . htmlspecialchars($row['nome']) . "' class='w-full h-60 object-cover' onerror='this.onerror=null; this.src=\"assets/thumbnail0.png\";'>";
                echo "<div class='p-4'>";
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
                echo "</a>";
            }
        } else {
            echo "<p class='text-white'>Nenhum jogo encontrado para esta desenvolvedora.</p>";
        }
        ?>
    </div>

    <!-- Detalhes da Desenvolvedora -->
    <div class="bg-gray-900 p-6 rounded-lg shadow-lg mt-28">
        <h3 class="text-xl font-semibold mb-4 text-purple-500">Sobre a Desenvolvedora</h3>
        <?php if ($desenvolvedora): ?>
            <p class="text-purple-300 text-lg mb-2"><strong>CNPJ:</strong> <?= htmlspecialchars($desenvolvedora['CNPJ']); ?></p>
            <p class="text-purple-300 text-lg mb-2"><strong>Email de Contato:</strong> <a href="mailto:<?= htmlspecialchars($desenvolvedora['Email_Contato']); ?>" class="text-blue-500"><?= htmlspecialchars($desenvolvedora['Email_Contato']); ?></a></p>
            <p class="text-purple-300 text-lg mb-2"><strong>Site Oficial:</strong> <a href="<?= htmlspecialchars($desenvolvedora['SiteOficial']); ?>" target="_blank" class="text-blue-500"><?= htmlspecialchars($desenvolvedora['SiteOficial']); ?></a></p>
        <?php else: ?>
            <p class="text-purple-300 text-lg">Nenhuma informação disponível sobre a desenvolvedora.</p>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>
