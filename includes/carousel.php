<!-- Carrossel -->
<div class="relative bg-[#63E663] text-white p-10 rounded-lg  overflow-hidden mt-20 flex z-40"> <!-- z-40 para garantir que esteja abaixo da sidebar -->
    <!-- Conteúdo Principal do Carrossel -->
    <div class="w-3/4 relative overflow-hidden">
        <div id="carousel-images" class="flex transition-transform duration-700 ease-in-out">
            <div class="carousel-item w-full flex-shrink-0">
                <a href="jogo_template.php?CodJogo=1">
                    <img src="assets/img/Carrossel1.png" alt="Hollow Knight" class="w-full h-100 object-cover rounded-lg"> <!-- Altura aumentada para 96 e bordas arredondadas -->
                </a>
            </div>
            <div class="carousel-item w-full flex-shrink-0">
                <a href="ofertas.php">
                    <img src="assets/img/Carrossel2.png" alt="Ofertas de Outono" class="w-full h-100 object-cover rounded-lg">
                </a>
            </div>
            <div class="carousel-item w-full flex-shrink-0">
                <a href="novidades.php">
                    <img src="assets/img/Carrossel3.png" alt="Novidades da Temporada" class="w-full h-100 object-cover rounded-lg">
                </a>
            </div>
            <div class="carousel-item w-full flex-shrink-0">
                <a href="reqMinimos.php">
                    <img src="assets/img/Carrossel4.png" alt="Requisitos Mínimos" class="w-full h-100 object-cover rounded-lg">
                </a>
            </div>
            <div class="carousel-item w-full flex-shrink-0">
                <a href="jogo_template.php?CodJogo=25">
                    <img src="assets/img/Carrossel5.png" alt="Helltaker" class="w-full h-100 object-cover rounded-lg">
                </a>
            </div>
        </div>



        <!-- Barra de Progresso -->
        <div class="absolute bottom-0 left-0 w-full h-1 bg-gray-500">
            <div id="progress-bar" class="h-1 bg-purple-600 transition-all"></div>
        </div>
    </div>

    <!-- Botões Laterais -->
    <div class="w-1/4 flex flex-col space-y-2 ml-4">

            <button onclick="showSlide(0)" class="flex items-center bg-[#101014] text-white p-3 rounded-md text-left hover:bg-gray-800 transition">
                <img src="assets/img/Carrossel1.png" alt="Hollow Knight em Desconto!" class="w-10 h-10 mr-3 rounded-md object-cover"> <!-- Aumente a largura e altura da miniatura -->
                <span class="hover:text-purple-500 flex-1 text-lg"> Adquira Hollow Knight Agora!</span>
                <span class="ml-auto text-gray-400 group-hover:text-purple-500">→</span>
            </button>
        </a>

            <button onclick="showSlide(1)" class="flex items-center bg-[#101014] text-white p-3 rounded-md text-left hover:bg-gray-800 transition">
                <img src="assets/img/Carrossel2.png" alt="Miniatura Ofertas de Outono" class="w-10 h-10 mr-3 rounded-md object-cover">
                <span class="hover:text-purple-500 flex-1 text-lg">Ofertas de Outono</span>
                <span class="ml-auto text-gray-400 group-hover:text-purple-500">→</span>
            </button>
        </a>

            <button onclick="showSlide(2)" class="flex items-center bg-[#101014] text-white p-3 rounded-md text-left hover:bg-gray-800 transition">
                <img src="assets/img/Carrossel3.png" alt="Miniatura Novidades da Temporada" class="w-10 h-10 mr-3 rounded-md object-cover">
                <span class="hover:text-purple-500 flex-1 text-lg">Novidades da Temporada</span>
                <span class="ml-auto text-gray-400 group-hover:text-purple-500">→</span>
            </button>
        </a>

        <button onclick="showSlide(3)" class="flex items-center bg-[#101014] text-white p-3 rounded-md text-left hover:bg-gray-800 transition">
                <img src="assets/img/Carrossel4.png" alt="Miniatura Novidades da Temporada" class="w-10 h-10 mr-3 rounded-md object-cover">
                <span class="hover:text-purple-500 flex-1 text-lg">Veja agora os indies que rodam em seu PC</span>
                <span class="ml-auto text-gray-400 group-hover:text-purple-500">→</span>
            </button>
        </a>
        <button onclick="showSlide(4)" class="flex items-center bg-[#101014] text-white p-3 rounded-md text-left hover:bg-gray-800 transition">
                <img src="assets/img/Carrossel5.png" alt="Miniatura Novidades da Temporada" class="w-10 h-10 mr-3 rounded-md object-cover">
                <span class="hover:text-purple-500 flex-1 text-lg">Jogue HellTaker de Graça!</span>
                <span class="ml-auto text-gray-400 group-hover:text-purple-500">→</span>
            </button>
        </a>

    </div>
</div>
