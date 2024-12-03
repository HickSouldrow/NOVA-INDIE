<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Jogos Comprados - NOVA INDIE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Incluindo SweetAlert -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon_io/favicon-32x32.png">
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
<body class="bg-gray-800 text-white" style="background-color: #101014;">

<?php
include 'conexoes/config.php';
include 'includes/header.php';
session_start();

// Verificar se o cliente está logado
if (!isset($_SESSION['CodCliente'])) {
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}

$codCliente = $_SESSION['CodCliente'];

// Buscar os jogos comprados pelo cliente
$sql = "SELECT j.CodJogo, j.nome, j.Preco, j.desconto, nf.DataCompra 
        FROM notafiscal nf
        INNER JOIN notafiscaljogo nj ON nf.CodNotaFiscal = nj.CodNotaFiscal
        INNER JOIN Jogo j ON nj.CodJogo = j.CodJogo
        WHERE nf.CodCliente = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $codCliente);
$stmt->execute();
$result = $stmt->get_result();
?>

<main class="mx-auto max-w-screen-xl px-6 md:px-12 lg:px-16 py-4 mt-16 flex-grow">
    <!-- Título -->
    <div class="text-center mb-6">
        <h2 class="text-4xl font-bold text-gray-300">Meus Jogos Comprados</h2>
        <p class="text-gray-400 mt-2 text-purple-500">Confira os jogos que você comprou na NOVA INDIE!</p>
    </div>

    <script>
    function removerDoCarrinho(codJogo) {
        fetch('remover_do_carrinho.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ CodJogo: codJogo })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    background: '#1A202C',
                    confirmButtonColor: '#6B46C1',
                    icon: 'success',
                    title: 'Item removido!',
                    text: 'O item foi removido com sucesso.',
                    showConfirmButton: false,
                    timer: 1500,
                }).then(() => {
                    location.reload(); // Atualiza a página para refletir a remoção
                });
            } else {
                Swal.fire({
                    background: '#1A202C',
                    confirmButtonColor: '#6B46C1',
                    icon: 'error',
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao remover o item. Tente novamente.',
                    showConfirmButton: true,
                });
            }
        })
        .catch(error => console.error('Erro:', error));
    }
    </script>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
    <?php
// Array para rastrear os códigos já exibidos
$jogosExibidos = [];

// Verificar se há resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Verificar se o jogo já foi exibido
        if (in_array($row['CodJogo'], $jogosExibidos)) {
            continue; // Pular para o próximo jogo se já foi exibido
        }

        // Adicionar o jogo ao array de rastreamento
        $jogosExibidos[] = $row['CodJogo'];

        // Lógica de cálculo de desconto (opcional)
        $precoFinal = $row['Preco'];
        $desconto = $row['desconto'];
        if (!empty($desconto) && $desconto > 0) {
            $precoFinal -= ($precoFinal * ($desconto / 100));
        }

        // Card do jogo
        echo "<div class='bg-gray-900 max-w-sm rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl relative'>";
        echo "<a href='jogo_comprado_template.php?CodJogo=" . $row['CodJogo'] . "'>";
        echo "<img src='assets/jogos/{$row['nome']}/thumbnail0.png' alt='" . htmlspecialchars($row['nome']) . "' class='w-full h-60 object-cover' onerror='this.onerror=null; this.src=\"assets/thumbnail0.png\";'>";
        echo "</a>";
        echo "<div class='p-4'>";
        echo "<p class='text-gray-300 text-sm'>Comprado em: " . date("d/m/Y", strtotime($row['DataCompra'])) . "</p>";
        echo "<span class='text-lg font-bold'>" . htmlspecialchars($row['nome']) . "</span>";
        echo "<div class='mt-2'>";
        echo "<span class='text-green-500 font-bold'>R$ " . number_format($precoFinal, 2, ',', '.') . "</span>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p class='text-white'>Você não comprou nenhum jogo ainda.</p>";
}
?>

    </div>
    <section class="mt-36 mb-16">
                <?php include 'includes/random.php'; ?>
                </section>
</main>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>

</body>
</html>
