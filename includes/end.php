<?php
include 'conexoes/config.php';

// Seleciona os jogos mais vendidos
$sql_maisVendidos = "SELECT CodJogo, nome, Preco, desconto FROM jogo ORDER BY nome DESC LIMIT 3";
$result_maisVendidos = $conn->query($sql_maisVendidos);
$maisVendidos = [];
if ($result_maisVendidos->num_rows > 0) {
    while ($row = $result_maisVendidos->fetch_assoc()) {
        $maisVendidos[] = $row;
    }
}

// Seleciona os jogos mais jogados
$sql_maisJogados = "SELECT CodJogo, nome, Preco, desconto FROM jogo ORDER BY desconto LIMIT 3";
$result_maisJogados = $conn->query($sql_maisJogados);
$maisJogados = [];
if ($result_maisJogados->num_rows > 0) {
    while ($row = $result_maisJogados->fetch_assoc()) {
        $maisJogados[] = $row;
    }
}

// Seleciona os próximos títulos mais aguardados
$sql_maisAguardados = "SELECT CodJogo, nome, Preco, desconto, Dtlancamento FROM Jogo ORDER BY CodJogo ASC LIMIT 3";
$result_maisAguardados = $conn->query($sql_maisAguardados);
$maisAguardados = [];
if ($result_maisAguardados->num_rows > 0) {
    while ($row = $result_maisAguardados->fetch_assoc()) {
        $maisAguardados[] = $row;
    }
}

$conn->close();
?>

<div class="grid grid-cols-3 gap-6 mt-6">
    <div>
        <div class="space-y-4">
            <?php foreach ($maisVendidos as $jogo): 
                $precoOriginal = $jogo['Preco'];
                $desconto = $jogo['desconto'];
                $precoComDesconto = $precoOriginal - ($precoOriginal * ($desconto / 100));
            ?>
            <a href="jogo_template.php?CodJogo=<?= $jogo['CodJogo'] ?>" class="flex flex-col bg-gray-900 rounded-lg hover:bg-gray-800 transition-all shadow-md">
                <div class="w-full h-36 bg-cover bg-center rounded-t-lg" style="background-image: url('assets/jogos/<?= $jogo['nome'] ?>/thumbnail1.png'); hover:url('assets/jogos/<?= $jogo['nome'] ?>/thumbnail2.png');"></div>
                <div class="p-4">
                    <p class="text-white text-lg font-bold"><?= htmlspecialchars($jogo['nome']) ?></p>
                    <div class="flex items-center space-x-2">
                        <?php if ($desconto > 0): ?>
                            <span class="line-through text-gray-400"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
                            <span class="text-purple-500">-<?= $desconto ?>%</span>
                            <span class="text-green-400 font-bold"><?= "R$ " . number_format($precoComDesconto, 2, ',', '.') ?></span>
                        <?php else: ?>
                            <span class="text-gray-300"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div>
        <div class="space-y-4">
            <?php foreach ($maisJogados as $jogo): 
                $precoOriginal = $jogo['Preco'];
                $desconto = $jogo['desconto'];
                $precoComDesconto = $precoOriginal - ($precoOriginal * ($desconto / 100));
            ?>
            <a href="jogo_template.php?CodJogo=<?= $jogo['CodJogo'] ?>" class="flex flex-col bg-gray-900 rounded-lg hover:bg-gray-800 transition-all shadow-md">
                <div class="w-full h-36 bg-cover bg-center rounded-t-lg" style="background-image: url('assets/jogos/<?= $jogo['nome'] ?>/thumbnail1.png');"></div>
                <div class="p-4">
                    <p class="text-white text-lg font-bold"><?= htmlspecialchars($jogo['nome']) ?></p>
                    <div class="flex items-center space-x-2">
                        <?php if ($desconto > 0): ?>
                            <span class="line-through text-gray-400"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
                            <span class="text-purple-500">-<?= $desconto ?>%</span>
                            <span class="text-green-400 font-bold"><?= "R$ " . number_format($precoComDesconto, 2, ',', '.') ?></span>
                        <?php else: ?>
                            <span class="text-gray-300"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    

    <div>
        <div class="space-y-4">
            <?php foreach ($maisAguardados as $jogo): 
                $precoOriginal = $jogo['Preco'];
                $desconto = $jogo['desconto'];
                $precoComDesconto = $precoOriginal - ($precoOriginal * ($desconto / 100));
            ?>
            <a href="jogo_template.php?CodJogo=<?= $jogo['CodJogo'] ?>" class="flex flex-col bg-gray-900 rounded-lg hover:bg-gray-800 transition-all shadow-md">
                <div class="w-full h-36 bg-cover bg-center rounded-t-lg" style="background-image: url('assets/jogos/<?= $jogo['nome'] ?>/thumbnail1.png'); hover:url('assets/jogos/<?= $jogo['nome'] ?>/thumbnail2.png');"></div>
                <div class="p-4">
                    <p class="text-white text-lg font-bold"><?= htmlspecialchars($jogo['nome']) ?></p>
                    <div class="flex items-center space-x-2">
                        <?php if ($desconto > 0): ?>
                            <span class="line-through text-gray-400"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
                            <span class="text-purple-500">-<?= $desconto ?>%</span>
                            <span class="text-green-400 font-bold"><?= "R$ " . number_format($precoComDesconto, 2, ',', '.') ?></span>
                        <?php else: ?>
                            <span class="text-gray-300"><?= "R$ " . number_format($precoOriginal, 2, ',', '.') ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
