<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOVA INDIE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="js/carrossel.js" defer></script>
    <script src="js/game.js" defer></script>
    <script src="js/sidebar.js" defer></script>
    <script src="js/dropdown.js" defer></script>
    <script src="js/games.js" defer></script> 
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
<body class="bg-neutral-900 text-white" style="background-color: #101014;">

    <?php include 'includes/header.php'; ?>

    <main class="mx-auto max-w-7xl px-14 py-4 mt-16">
        <?php include 'includes/carousel.php'; ?>
    </main>

    <section id="descobrir" class="mx-auto max-w-6xl px-8 py-10">

        <div class="borda-jogos mt-6">


        

                <section class="mt-10">
                <?php include 'includes/games.php'; ?>
                </section>

                <section class="mt-20">
                <?php include 'includes/destaques.php'; ?>
                </section>

                <section class="mt-10">
                <?php include 'includes/descontos.php'; ?>
                </section>

                <section class="mt-10">
                <?php include 'includes/random.php'; ?>
                </section>

                <section class="mt-28">
                <?php include 'includes/f2p.php'; ?> 
                </section>

                <section class="mt-28">
                <?php include 'includes/lastrota.php'; ?> 
                </section>

                <section class="mt-28">
                <?php include 'includes/lancamentos.php'; ?> 
                </section>

                <section class="mt-28">
                <?php include 'includes/jogados.php'; ?> 
                </section>

                <section class="mt-28">
                <?php include 'includes/end.php'; ?> 
                </section>

            
                

        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

</body>
</html>
