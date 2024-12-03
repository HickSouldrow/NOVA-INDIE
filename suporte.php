<?php include 'conexoes/config.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte - NOVA INDIE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
<body class="bg-neutral-900 text-white">

    <?php include 'includes/header.php'; ?>

    <main class="mx-auto max-w-6xl px-14 py-20 mt-16">
        <h1 class="text-purple-600 text-4xl font-bold mb-10">Suporte</h1>

        <section class="mb-16">
            <div class="bg-gray-900 p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4 text-purple-500">1. Como podemos ajudá-lo?</h2>
                <p class="text-gray-300">
                    Se você tiver algum problema ou dúvida relacionada ao uso do nosso site, estamos aqui para ajudar! Nossa equipe de suporte está pronta para fornecer a assistência que você precisa.
                </p>
                <p class="text-gray-300 mt-4">
                    Abaixo, você encontrará algumas das perguntas mais frequentes e informações sobre como entrar em contato conosco para resolver sua questão.
                </p>
            </div>
        </section>

        <section class="mb-16">
            <div class="bg-gray-900 p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4 text-purple-500">2. Perguntas Frequentes</h2>
                <div class="text-gray-300">
                    <h3 class="font-semibold mb-2">Como posso recuperar minha senha?</h3>
                    <p class="mb-4">
                        Se você esqueceu sua senha, basta clicar no link "Esqueci minha senha" na página de login e seguir as instruções para redefinir sua senha. Se você não receber o e-mail de recuperação, verifique sua pasta de spam.
                    </p>

                    <h3 class="font-semibold mb-2">Como posso fazer uma compra no site?</h3>
                    <p class="mb-4">
                        Para comprar um jogo, basta navegar pelo nosso catálogo, adicionar o jogo ao seu carrinho e seguir para o checkout. Você será solicitado a fornecer suas informações de pagamento e escolher a forma de pagamento preferida.
                    </p>

                    <h3 class="font-semibold mb-2">Estou tendo problemas ao realizar uma compra, o que fazer?</h3>
                    <p class="mb-4">
                        Se você encontrou algum problema ao tentar concluir sua compra, certifique-se de que seus dados de pagamento estão corretos e que há saldo suficiente na sua conta. Se o problema persistir, entre em contato com nossa equipe de suporte para assistência imediata.
                    </p>

                    <h3 class="font-semibold mb-2">Como posso alterar minhas informações de pagamento?</h3>
                    <p class="mb-4">
                        Para alterar suas informações de pagamento, acesse sua conta no site, vá até a seção de "Configurações" e atualize os dados conforme necessário. Se precisar de ajuda, entre em contato com nosso suporte.
                    </p>

                    <h3 class="font-semibold mb-2">Como posso solicitar um reembolso?</h3>
                    <p class="mb-4">
                        Se você deseja solicitar um reembolso por um jogo adquirido, entre em contato com nossa equipe de suporte dentro de 7 dias após a compra. Avaliaremos o caso e, se aplicável, providenciaremos o reembolso.
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-16">
            <div class="bg-gray-900 p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4 text-purple-500">3. Fale Conosco</h2>
                <p class="text-gray-300">
                    Se as perguntas frequentes não resolveram sua dúvida ou se você precisa de ajuda personalizada, nossa equipe de suporte está disponível para ajudá-lo.
                </p>
                <p class="text-gray-300 mt-4">
                    Você pode entrar em contato conosco de diversas formas:
                </p>
                <ul class="list-disc pl-5 text-gray-300 mt-4">
                    <li>Envie um e-mail para: <a href="mailto:suporte@novasite.com" class="text-purple-500 underline">suporte@novasite.com</a></li>
                    <li>Preencha o formulário de contato em nosso site</li>
                    <li>Chame nosso atendimento via chat ao vivo disponível na parte inferior direita do site</li>
                </ul>
                <p class="text-gray-300 mt-4">
                    Nossa equipe de suporte está disponível de segunda a sexta-feira, das 9h às 18h. Responderemos a sua solicitação o mais rápido possível.
                </p>
            </div>
        </section>

        <section>
            <div class="bg-gray-900 p-6 rounded-lg">
                <h2 class="text-xl font-bold mb-4 text-purple-500">4. Nosso Compromisso</h2>
                <p class="text-gray-300">
                    Nosso objetivo é garantir que você tenha a melhor experiência possível em nosso site. Estamos comprometidos em oferecer soluções rápidas e eficientes para qualquer problema que possa surgir. Agradecemos por sua confiança no NOVA INDIE!
                </p>
            </div>
        </section>

    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>
