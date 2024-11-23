<?php
include 'conexoes/config.php';

// Seleciona os jogos mais vendidos
$sql_maisVendidos = "SELECT CodJogo, nome, Preco, desconto FROM jogo ORDER BY CodJogo DESC LIMIT 5";
$result_maisVendidos = $conn->query($sql_maisVendidos);
$maisVendidos = [];
if ($result_maisVendidos->num_rows > 0) {
    while ($row = $result_maisVendidos->fetch_assoc()) {
        $maisVendidos[] = $row;
    }
}

// Seleciona os jogos mais jogados
$sql_maisJogados = "SELECT CodJogo, nome, Preco, desconto FROM jogo ORDER BY Preco DESC LIMIT 5";
$result_maisJogados = $conn->query($sql_maisJogados);
$maisJogados = [];
if ($result_maisJogados->num_rows > 0) {
    while ($row = $result_maisJogados->fetch_assoc()) {
        $maisJogados[] = $row;
    }
}

// Seleciona os próximos títulos mais aguardados
$sql_maisAguardados = "SELECT CodJogo, nome, Preco, desconto, Dtlancamento FROM jogo ORDER BY DtLancamento ASC LIMIT 5";
$result_maisAguardados = $conn->query($sql_maisAguardados);
$maisAguardados = [];
if ($result_maisAguardados->num_rows > 0) {
    while ($row = $result_maisAguardados->fetch_assoc()) {
        $maisAguardados[] = $row;
    }
}

// Seleciona os jogos com desconto
$sql_descontos = "SELECT CodJogo, nome, Preco, desconto FROM jogo WHERE desconto > 0 ORDER BY desconto DESC LIMIT 5";
$result_descontos = $conn->query($sql_descontos);
$descontos = [];
if ($result_descontos->num_rows > 0) {
    while ($row = $result_descontos->fetch_assoc()) {
        $descontos[] = $row;
    }
}

$conn->close();
?>

<h3 class="text-3xl font-bold text-center mb-16">Populares do momento</h3>

<div class="grid grid-cols-3 gap-6 mt-6">
    <!-- Coluna 1 -->
    <div class="relative">
        <h4 class="text-lg font-bold mb-4 text-purple-600">Mais vendidos</h4>
        <div>
            <?php foreach ($maisVendidos as $jogo): 
                $precoOriginal = $jogo['Preco'];
                $desconto = $jogo['desconto'];
                $precoFinal = $precoOriginal - ($precoOriginal * ($desconto / 100));
            ?>
<a href="jogo_template.php?CodJogo=<?= $jogo['CodJogo'] ?>" class="flex p-4 bg-gray-900 rounded-lg hover:bg-gray-800 transition-all">
    <!-- Imagem menor e cobrindo a lateral do card -->
    <div class="w-20 h-full">
        <img src="assets/jogos/<?= htmlspecialchars($jogo['nome']) ?>/thumbnail0.png" 
             alt="Imagem do jogo <?= htmlspecialchars($jogo['nome']) ?>" 
             class="w-full h-full object-cover rounded-l-lg">
    </div>
    <div class="flex flex-col justify-between ml-4 w-full">
        <p class="text-white font-bold truncate"><?= htmlspecialchars($jogo['nome']) ?></p>
        <div class="flex items-center mt-2">
            <?php if ($desconto > 0): ?>
                <span class="line-through text-gray-400 text-sm"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
                <span class="text-green-400 font-bold text-lg ml-2"><?= "R$ " . number_format($precoFinal, 2, ',', '.') ?></span>
            <?php else: ?>
                <span class="text-gray-300 text-lg"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
            <?php endif; ?>
        </div>
    </div>
</a>

            <?php endforeach; ?>
        </div>
    </div>
    
    <!-- Coluna 2 -->
    <div class="relative">
        <h4 class="text-lg font-bold mb-4 text-purple-600">Mais jogados</h4>
        <div>
            <?php foreach ($maisJogados as $jogo): 
                $precoOriginal = $jogo['Preco'];
                $desconto = $jogo['desconto'];
                $precoFinal = $precoOriginal - ($precoOriginal * ($desconto / 100));
            ?>
<a href="jogo_template.php?CodJogo=<?= $jogo['CodJogo'] ?>" class="flex p-4 bg-gray-900 rounded-lg hover:bg-gray-800 transition-all">
    <!-- Imagem menor e cobrindo a lateral do card -->
    <div class="w-20 h-full">
        <img src="assets/jogos/<?= htmlspecialchars($jogo['nome']) ?>/thumbnail0.png" 
             alt="Imagem do jogo <?= htmlspecialchars($jogo['nome']) ?>" 
             class="w-full h-full object-cover rounded-l-lg">
    </div>
    <div class="flex flex-col justify-between ml-4 w-full">
        <p class="text-white font-bold truncate"><?= htmlspecialchars($jogo['nome']) ?></p>
        <div class="flex items-center mt-2">
            <?php if ($desconto > 0): ?>
                <span class="line-through text-gray-400 text-sm"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
                <span class="text-green-400 font-bold text-lg ml-2"><?= "R$ " . number_format($precoFinal, 2, ',', '.') ?></span>
            <?php else: ?>
                <span class="text-gray-300 text-lg"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
            <?php endif; ?>
        </div>
    </div>
</a>

            <?php endforeach; ?>
        </div>
    </div>
    
    <!-- Coluna 3 -->
    <div class="relative">
        <h4 class="text-lg font-bold mb-4 text-purple-600">Títulos Mais Aguardados</h4>
        <div">
            <?php foreach ($maisAguardados as $jogo): 
                $precoOriginal = $jogo['Preco'];
                $desconto = $jogo['desconto'];
                $precoFinal = $precoOriginal - ($precoOriginal * ($desconto / 100));
            ?>
     <a href="jogo_template.php?CodJogo=<?= $jogo['CodJogo'] ?>" class="flex p-4 bg-gray-900 rounded-lg hover:bg-gray-800 transition-all">
    <!-- Imagem menor e cobrindo a lateral do card -->
    <div class="w-20 h-full">
        <img src="assets/jogos/<?= htmlspecialchars($jogo['nome']) ?>/thumbnail0.png" 
             alt="Imagem do jogo <?= htmlspecialchars($jogo['nome']) ?>" 
             class="w-full h-full object-cover rounded-l-lg">
    </div>
    <div class="flex flex-col justify-between ml-4 w-full">
        <p class="text-white font-bold truncate"><?= htmlspecialchars($jogo['nome']) ?></p>
        <div class="flex items-center mt-2">
            <?php if ($desconto > 0): ?>
                <span class="line-through text-gray-400 text-sm"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
                <span class="text-green-400 font-bold text-lg ml-2"><?= "R$ " . number_format($precoFinal, 2, ',', '.') ?></span>
            <?php else: ?>
                <span class="text-gray-300 text-lg"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
            <?php endif; ?>
        </div>
    </div>
</a>

            <?php endforeach; ?>
        </div>
    </div>


<div class="border-t-2 border-b-2 border-purple-700 mt-6"></div>
