-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/12/2024 às 23:46
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja_de_jogos`
--
create database `loja_de_jogos`;
use `loja_de_jogos`;
-- --------------------------------------------------------

--
-- Estrutura para tabela `adm`
--

CREATE TABLE `adm` (
  `CodFuncionario` int(11) NOT NULL,
  `Senha` varchar(15) NOT NULL,
  `EmailFunc` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `adm`
--

INSERT INTO `adm` (`CodFuncionario`, `Senha`, `EmailFunc`) VALUES
(1, 'Zeromeia', 'henrique.macedo@gmail'),
(2, 'Tiquinho', 'gustavo.abreu16@etec.sp.gov.br');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `CodJogo` int(11) NOT NULL,
  `CodCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`CodJogo`, `CodCliente`) VALUES
(1, 5),
(5, 5),
(7, 2),
(5, 2),
(19, 2),
(1, 2),
(11, 2),
(4, 2),
(23, 2),
(24, 2),
(27, 2),
(9, 2),
(15, 2),
(2, 2),
(12, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `CodCategoria` int(11) NOT NULL,
  `CategoriaTipo` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`CodCategoria`, `CategoriaTipo`) VALUES
(1, 'Competitivo Online'),
(2, 'Cooperativo'),
(3, 'MMO'),
(4, 'Multijogador'),
(5, 'Multijogador local'),
(6, 'Rede Local(LAN)'),
(7, 'Um jogador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoriajogo`
--

CREATE TABLE `categoriajogo` (
  `CodJogo` int(11) NOT NULL,
  `CodCategoria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `categoriajogo`
--

INSERT INTO `categoriajogo` (`CodJogo`, `CodCategoria`) VALUES
(1, 7),
(2, 2),
(2, 4),
(2, 5),
(3, 7),
(4, 2),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(5, 7),
(6, 1),
(6, 2),
(6, 4),
(6, 5),
(6, 7),
(7, 1),
(8, 7),
(9, 7),
(10, 7),
(11, 7),
(12, 7),
(13, 7),
(14, 7),
(16, 7),
(15, 7),
(17, 7),
(18, 7),
(18, 2),
(18, 5),
(19, 1),
(19, 2),
(19, 4),
(20, 7),
(21, 7),
(22, 7),
(22, 2),
(23, 7),
(24, 7),
(25, 7),
(26, 7),
(27, 7),
(28, 7),
(29, 7),
(30, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `classificacaoindicativa`
--

CREATE TABLE `classificacaoindicativa` (
  `CodFaixaEtaria` int(11) NOT NULL,
  `ClassificacaoIndicativa` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `classificacaoindicativa`
--

INSERT INTO `classificacaoindicativa` (`CodFaixaEtaria`, `ClassificacaoIndicativa`) VALUES
(1, 'Livre'),
(2, '10 anos'),
(3, '12 anos'),
(4, '14 anos'),
(5, '16 anos'),
(6, '18 anos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `CodCliente` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Nickname` varchar(50) NOT NULL,
  `DataNasc` date NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `Senha` varchar(30) NOT NULL,
  `Email` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`CodCliente`, `Nome`, `Nickname`, `DataNasc`, `CPF`, `Senha`, `Email`) VALUES
(1, 'Gustavo de Souza\r\n', 'Iovatsug', '2004-10-03', '553.885.121-00', 'Ramonas12..', 'gustavo.adsa12@gmail.com'),
(2, 'Pedro Eduardo', 'PedroLoLo23', '2004-10-21', '026.279.840-98', 'Hgsywe/27436', 'Pedrinhokawai@gmail.com'),
(3, 'Matheus Jorge Santana', 'Math002', '2007-12-03', '619.706.610-62', 'hcuG12498.12', 'MatheusBonitinhoMB@gmail.com'),
(4, 'Enzo Souto Cavalcante', 'EnzinhoLegal1', '2007-11-14', '010.547.580-77', 'BSYHWGff!4', 'EnzinhoDaMassa@outlook.com'),
(5, 'Henrique da Silva Macedo', 'Henrique1lugar', '2007-12-15', '767.545.980-69', 'G.YeHUIWJ1ee', 'henrique1lugar@gmail.com'),
(6, 'Raul Souza Sá', 'NinjaLobo00', '2005-01-25', '331.569.000-60', 'aJBN21632376..', 'NINJALOBO0000@gmail.com'),
(7, 'Martha de Souza', 'Mattyyy06', '2011-10-10', '713.154.070-60', 'sjdgfg!!HAHAHA', 'zeromeiaseubisonho@etec.sp.gov.br'),
(8, 'Luan Gosling de Vasconcelo', 'LuanzinhoManeiro171', '2006-05-17', '911.739.650-68', 'shgAsy##3311', 'LuanZinhoManeiringo@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura para tabela `desejos`
--

CREATE TABLE `desejos` (
  `CodJogo` int(11) NOT NULL,
  `CodCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `desejos`
--

INSERT INTO `desejos` (`CodJogo`, `CodCliente`) VALUES
(4, 2),
(5, 2),
(23, 2),
(11, 2),
(24, 2),
(3, 4),
(9, 2),
(1, 2),
(2, 2),
(12, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `desenvolvedora`
--

CREATE TABLE `desenvolvedora` (
  `CodDesenvolvedora` int(11) NOT NULL,
  `NomeDesenvolvedora` varchar(50) NOT NULL,
  `CNPJ` varchar(14) NOT NULL,
  `Email_Contato` varchar(80) NOT NULL,
  `SiteOficial` varchar(2085) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `desenvolvedora`
--

INSERT INTO `desenvolvedora` (`CodDesenvolvedora`, `NomeDesenvolvedora`, `CNPJ`, `Email_Contato`, `SiteOficial`) VALUES
(1, 'Team Cherry', '69907994000120', 'teamCherry@gmail.com', 'https://www.teamcherry.com.au/'),
(2, ' Studio MDHR Entertainment Inc', '04013024000136', 'press@studiomdhr.com\r\n', 'http://studiomdhr.com/'),
(3, ' Sabotage Studio', '08242237000190', 'philip@sabotagestudio.com', 'https://sabotagestudio.com/'),
(4, ' ConcernedApe', '98025037000179', 'support@stardewvalley.net', 'https://www.stardewvalley.net/author/concernedape/'),
(5, ' Bedtime Digital Games', '06142151000160', 'contact@bedtime.io', '\r\nBedtime Digital Games'),
(6, ' Unfinished Pixel', '64188722000102', 'contact@unfinishedpixel.com', 'https://www.unfinishedpixel.com/'),
(7, 'Extremely OK Games, Ltd', '08186210000128', 'contact@exok.com.', 'https://www.exok.com/index.html'),
(8, 'tobyfox', '23176724000196', 'undertalegame@gmail.com\r\n', 'fangamer.com'),
(9, ' Playdead', '49831152000125', 'support@playdead.com', 'https://playdead.com/'),
(10, ' LocalThunk', '73088204000108', 'balatro@playstack.com', 'https://x.com/LocalThunk'),
(11, ' MINTROCKET', '61193266000192', 'press@mintrocketgames.com', 'https://mintrock.et/en/about'),
(12, ' niceplay games', '90804050000114', 'contact@niceplay-games.com', 'https://niceplay-games.com/'),
(13, ' MassHive Media', '74215697000154', 'contact@masshive-media.com', 'https://www.masshive-media.com/'),
(14, ' Billy Basso', '80416656000129', 'billybasso1@gmail.com', 'https://www.animalwell.net/'),
(15, ' Polychroma Games', '68602793000152', 'first@polychromagames.com', 'https://polychromagames.com/'),
(16, ' Orube Game Studio', '90848836000133', 'contato@orubegamestudio.com', 'https://www.orubegamestudio.com/'),
(17, 'Tour De Pizza', '23984062000180', 'pizzatowergame@gmail.com', 'https://x.com/pizzatowergame'),
(18, 'Dani', '12213303000171', 'danidevbusiness@gmail.com', 'https://www.youtube.com/@Danidev'),
(19, 'Askiisoft ', '16566473000190', 'contact@askiisoft.com', 'https://x.com/askiisoft'),
(20, ' Magic Design Studios', '53263392000148', 'hello@magicdesignstudios.com', 'https://www.magicdesignstudios.com/contact'),
(21, 'Sewer Cat', '60491630000138', 'buggychickenjumper@gmail.com', 'https://www.industriadejogos.com.br/estudio/sewer-cat/'),
(22, ' HAMMER95', '14998154000129', 'hammer95studios@gmail.com', 'https://www.hammer95.com/'),
(23, ' Mobius Digital', '83645936000105', 'fanmail@mobiusdigitalgames.com', 'https://www.mobiusdigitalgames.com/'),
(24, 'vanripperart', '48429558000113', '@vanripperart', 'https://x.com/vanripperart'),
(25, 'HopFrog', '08899521000134', 'mariano@hopfrogsa.com', 'https://hopfrogsa.net/'),
(26, 'Polytron Corporation', '', 'https://x.com/polytron', 'https://x.com/polytron'),
(27, 'Team Meat', '54884955000188', 'support@supermeatboy.com', 'http://www.supermeatboy.com/'),
(28, ' Freebird Games', '87383779000150', 'orders@Freebirdstores.com', 'https://freebirdgames.com/about/');

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

CREATE TABLE `genero` (
  `CodGenero` int(11) NOT NULL,
  `GeneroDescr` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `genero`
--

INSERT INTO `genero` (`CodGenero`, `GeneroDescr`) VALUES
(1, 'Ação'),
(2, 'Aventura'),
(3, 'RPG'),
(4, 'Simulação'),
(5, 'Estratégia'),
(6, 'Esporte e Corrida');

-- --------------------------------------------------------

--
-- Estrutura para tabela `generojogo`
--

CREATE TABLE `generojogo` (
  `CodJogo` int(11) NOT NULL,
  `CodGenero` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `generojogo`
--

INSERT INTO `generojogo` (`CodJogo`, `CodGenero`) VALUES
(1, 2),
(2, 1),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(3, 2),
(1, 1),
(4, 3),
(4, 4),
(5, 2),
(5, 5),
(7, 1),
(7, 2),
(8, 3),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 5),
(12, 2),
(12, 3),
(12, 4),
(13, 4),
(14, 1),
(14, 2),
(14, 3),
(17, 1),
(16, 1),
(16, 2),
(15, 2),
(17, 2),
(18, 2),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(22, 2),
(22, 6),
(23, 1),
(24, 1),
(24, 2),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(27, 4),
(28, 2),
(29, 1),
(29, 2),
(30, 2),
(30, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogo`
--

CREATE TABLE `jogo` (
  `CodJogo` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `DtLancamento` date NOT NULL,
  `Avaliacao` float NOT NULL,
  `CodFaixaEtaria` int(11) NOT NULL,
  `ReqMinId` int(11) NOT NULL,
  `Preco` float NOT NULL,
  `Descricao` varchar(2000) NOT NULL,
  `Sinopse` varchar(2000) NOT NULL,
  `Desconto` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `jogo`
--

INSERT INTO `jogo` (`CodJogo`, `Nome`, `DtLancamento`, `Avaliacao`, `CodFaixaEtaria`, `ReqMinId`, `Preco`, `Descricao`, `Sinopse`, `Desconto`) VALUES
(1, 'Hollow Knight', '2018-02-24', 5, 1, 2, 45, 'Hollow Knight é um jogo de ação e aventura em estilo metroidvania 2D que se passa em Hallownest, antigo reino fictício.', 'Forje seu caminho em Hollow Knight! Uma aventura de ação épica em um vasto reino arruinado de insetos e heróis. Explore cavernas serpenteantes, lute contra criaturas malignas e alie-se a insetos bizarros num estilo clássico 2D desenhado à mão.', 5),
(2, 'Cuphead', '2017-09-29', 5, 2, 2, 35, 'Cuphead apresenta dois jogadores que controlam o personagem-título e seu irmão Mugman, em uma aventura através da fictícia Inkwell Isle para derrotar uma série de chefes para pagar uma dívida adquirida com o diabo.', 'Cuphead é um jogo de ação e tiros clássico, com enorme ênfase nas batalhas de chefes. Inspirado nas animações infantis da década de 1930, os visuais e efeitos sonoros foram minuciosamente recriados com as mesmíssimas técnicas dessa era, com destaque para desenhos feitos à mão', 10),
(3, 'Sea of Stars', '2023-09-29', 4.5, 2, 2, 90, 'Sea of Stars é um RPG com batalhas por turnos inspirado pelos clássicos.', 'Sea of Stars é um RPG por turnos inspirado nos clássicos. Conta a história de dois Filhos do Solstício que combinarão os poderes do sol e da lua para realizar a Magia do Eclipse, a única força capaz de deter as criações monstruosas do malvado alquimista conhecido como The Fleshmancer', 20),
(4, 'Stardew Valley', '2016-02-26', 5, 3, 1, 25, 'Stardew Valley é um jogo de simulação agrícola inspirado principalmente em Story of Seasons, uma série da Marvelous e anteriormente conhecida como Harvest Moon.', 'Você herdou a antiga fazenda do seu avô, em Stardew Valley. Com ferramentas de segunda-mão e algumas moedas, você parte para dar início a sua nova vida. Será que você vai aprender a viver da terra, a transformar esse matagal em um próspero lar?', 20),
(5, 'Back to Bed', '2014-08-06', 3.5, 1, 1, 10, 'De Volta pra Cama é um jogo 3D ambientado um mundo de fantasia único e artístico onde você guiará o sonâmbulo Bob até sua cama com segurança. Para conseguir isso, você deve ter o controle do guardião do subconsciente de Bob chamado Subob.', 'Back to Bed é um jogo artístico de quebra-cabeça em 3D com um toque surreal. Bob é um narcoléptico azarado que tem tendência a adormecer em seu escritório chato e depois se aventurar como um sonâmbulo diante dos perigos da cidade grande. Felizmente, Bob tem um guardião subconsciente chamado Subob, que protege o sonâmbulo e o guia de volta para a segurança de sua cama.\r\n', 80),
(6, 'Super Sports Blast', '2021-01-29', 4, 1, 2, 45, 'Vôlei, Tênis ou Futebol - escolha seu esporte favorito, vá para o campo e prepare-se para se divertir !!', 'Entre em campo e prepare-se para se divertir muito! Crie o seu próprio personagem e jogue para ser o campeão em três dos esportes mais populares do mundo.\r\n\r\nPrepare-se para o pontapé inicial e jogue futebol, domine a quadra de tênis e acerte o seu oponente na quadra de vôlei. Cada esporte apresenta os seus próprios modos repletos de vários torneios para conquistar!', 10),
(7, 'Celeste', '2018-01-25', 5, 1, 2, 57, 'Ajude Madeline a enfrentar seus demônios internos em sua jornada até o topo da Montanha Celeste, nesse jogo de plataforma super afiado dos criadores de TowerFall. Desbrave centenas de desafios meticulosos, descubra segredos complicados e desvende o mistério da montanha.', 'Os controles são simples e acessíveis - salte, faça dash aéreo e escale -, mas com camadas de profundidade para dominar, onde cada morte é uma lição. Renascimentos incrivelmente rápidos permitem que você continue escalando enquanto descobre os mistérios da montanha e desbrava seus perigos.', 20),
(8, 'Undertale', '2015-09-15', 4.5, 1, 1, 18, 'UNDERTALE! O jogo RPG onde você não tem que matar ninguém', 'Bem-vindo à UNDERTALE. Neste RPG, você controla um humano que cai no subsolo em um mundo de monstros. Agora você deve encontrar a saída... ou ficará preso para sempre.', 5),
(9, 'Limbo', '2011-08-02', 4.5, 4, 1, 35, 'Sem certezas acerca do destino da irmã, um rapaz entra no LIMBO', 'Limbo é um sidescroller 2D, incorporando um sistema de física que administra os objetos ambientais e o personagem do jogador. O jogador guia um menino anônimo através de ambientes e armadilhas perigosas enquanto procura por sua irmã mais velha.', 0),
(10, 'Inside', '0000-00-00', 4, 4, 2, 70, 'Perseguido e sozinho, um rapaz é atraído para o centro de um projeto sombrio.', 'Inside conta a história de um menino enquanto ele luta para sobreviver contra as forças do mal que estão tentando dominar o mundo através de experimentos em corpos humanos de uma forma totalmente questionável. O menino começa a sua jornada em uma floresta onde estranhas sombras o perseguem.', 10),
(11, 'Balatro', '2024-02-20', 4.5, 1, 2, 42, 'O roguelike de póquer.', 'Balatro é um jogo de construção de baralhos de cartas hipnoticamente satisfatório onde vais jogar mãos de póquer ilegais, descobrir jóqueres que vão mudar o rumo do jogo e fazer combinações empolgantes.', 5),
(12, 'Dave the diver', '2023-06-28', 5, 1, 2, 55, 'Junte-se a Dave e seus amigos peculiares enquanto eles tentam desvendar os segredos do misterioso Blue Hole.', 'DAVE THE DIVER is a casual, singleplayer adventure RPG featuring deep-sea exploration and fishing during the day and sushi restaurant management at night.', 5),
(13, 'Potion craft', '2022-12-13', 4, 1, 2, 55, 'Lembre-se: a cidade inteira conta com você.', 'Potion Craft é um simulador de alquimista onde você interage fisicamente com suas ferramentas e ingredientes para preparar poções. Você tem controle total de toda a loja: invente novas receitas, atraia clientes e experimente o quanto quiser.', 10),
(14, 'Potion permit', '2022-09-22', 3.5, 2, 3, 55, 'Os habitantes de Moonbury precisam de curativos e tu és o melhor químico disponível!', 'Com as tuas ferramentas de confiança, um caldeirão e um companheiro canino, terás de diagnosticar sintomas, recolher ingredientes, preparar poções e curar doenças nesta simulação RPG cheia de desafios', 15),
(15, 'Until them', '2024-06-25', 4.5, 3, 3, 55, 'Um encontro fatídico dá origem a uma reação em cadeia que vira a vida de Mark do avesso.', 'Algumas pessoas desaparecem e recordações ficam difusas. Desvenda a verdade na companhia de Mark e dos seus amigos nesta aventura e descobre o grande mistério antes que seja demasiado tarde.', 5),
(16, 'Animal well', '2024-05-09', 4.5, 1, 1, 70, 'Explore um labirinto denso e interconectado e desvende seus muitos segredos.\r\n', 'Colete itens para manipular seu ambiente de maneiras surpreendentes e significativas. Encontre criaturas lindas e perturbadoras enquanto tenta sobreviver ao que se esconde no escuro. Há mais do que você vê.', 10),
(17, 'Super Mombo Quest', '2021-11-04', 5, 1, 2, 48, 'Super Mombo Quest é um jogo de plataformas de precisão cheio de ação!', 'Salte e pise em um enorme mundo interconectado, fazendo acrobacias intensas e conseguindo combos enormes! Um jogo de plataformas de precisão super-rápido que mistura o mundo Metroidvania com a mecânica clássica do Arcade.', 5),
(18, 'Pizza Tower', '2023-01-26', 4.5, 4, 1, 35, 'Peppino Spaghetti, um italiano surpreendentemente ágil e poderoso, gordo e careca, tem a missão de destruir a Pizza Tower titular para salvar seu restaurante da aniquilação.', 'Pizza Tower é um jogo de plataforma 2D rápido, com ênfase em movimento, exploração e ataque de pontuação. Apresentando pixel art altamente estilizado inspirado nos desenhos animados dos anos 90 e uma trilha sonora altamente energética.', 5),
(19, 'Crab Game', '2021-10-29', 3.5, 4, 2, 0, 'Crab Game um jogo feito para se jogar com os amigos onde você tem que ser o último sobrevivente dos testes', 'Crab Game é um jogo multijogador em primeira pessoa onde você joga vários minijogos diferentes baseados em jogos infantis, até que apenas um jogador saia vitorioso.', 0),
(20, 'Katana ZERO', '2019-04-18', 5, 4, 2, 45, 'Katana ZERO é um elegante jogo de plataforma de ação neo-noir com ação alucinante e combate de morte instantânea.', 'Corte, corra e manipule o tempo para desvendar seu passado em uma exibição acrobática lindamente brutal.\r\n\r\nCombate Excepcional: Supere sua oposição da maneira que a situação exigir. Desvie os tiros contra os inimigos, evite ataques e manipule inimigos e ambientes com armadilhas e explosivos. Não deixe sobreviventes.\r\n\r\nSequências feitas à mão: cada nível é projetado exclusivamente para inúmeros métodos de conclusão. Derrote inimigos de forma criativa, usando abordagens espontâneas para eliminá-los como achar melhor.\r\n\r\nNarrativa não convencional: uma história enigmática contada por meio de sequências cinematográficas integradas à jogabilidade, distorcendo-se e dobrando-se até uma conclusão inesperada.', 10),
(21, 'Have a Nice Death', '2023-03-22', 4.5, 3, 2, 63, 'Para restaurar a ordem, você terá que pegar sua fiel foice e mostrar aos seus funcionários quem manda.', 'Have a Nice Death é um roguelike de ação 2D onde você joga como um Death sobrecarregado, cujos funcionários correram desenfreados, desequilibrando completamente as almas - e seus planos de férias. Para restaurar a ordem, você terá que pegar sua fiel foice e mostrar aos seus funcionários quem manda.', 5),
(22, 'Super Chicken Jumper', '2021-09-24', 5, 1, 2, 10, 'Corra por 6 mundos diferentes, atire em seus inimigos e torne-se uma galinha lendária.', 'O mundo está em perigo. Forças malignas do passado voltaram para destruir o nosso planeta e o único indivíduo que a senhora Presidente confia para salvar as nossas vidas é você, Chicken.\r\n\r\nEsse jogo é um runner com um pouquinho de shooter, então...\r\nCorra, pule, se esquive, destrua e mate todas as coisas em seu caminho, essas sãos as necessidades básicas para você lutar contra o mal que está surgindo do inferno. Ouça os conselhos das meninas de anime mais fofas que você já viu e estará seguro. Oh, e tome cuidado com cogumelos, alguns são beeeem perigosos.\r\n', 0),
(23, 'MULLET MADJACK', '2024-05-15', 5, 5, 3, 48, 'MULLET MAD JACK é um FPS super rápido para um jogador onde você está dentro de um ANIME CLÁSSICO.', 'MULLET MAD JACK é um jogo de ação e tiro em primeira pessoa com a estética dos ANIMES CLÁSSICOS! “ Em um futuro distante, HUMANIDADE e INTERNET se fundem em um novo ser. Um humano precisa de DOPAMINA a cada 10 SEGUNDOS ou ele MORRE!', 5),
(24, 'Outer Wilds', '2020-06-18', 5, 2, 3, 65, 'Um jogo onde você descobre o que é o jogo', 'Nomeado Jogo do Ano de 2019 pela Giant Bomb, Polygon, Eurogamer e The Guardian, Outer Wilds é um mistério de mundo aberto aclamado pela crítica e premiado sobre um sistema solar preso em um loop temporal sem fim.', 10),
(25, 'Helltaker', '2020-03-11', 4.5, 4, 1, 0, 'Helltaker é um jogo curto sobre garotas demoníacas bem vestidas.', 'Você acordou um dia com um sonho. Harém cheio de garotas demoníacas. Você abriu o portal na esperança de realizar seus desejos mais loucos. O fogo do inferno queima seus pulmões, a morte espera em cada esquina e tudo parece ter saído de um jogo para celular fofo. Você está no inferno.', 0),
(26, 'The Messenger', '2018-08-30', 4.5, 4, 3, 55, 'Enquanto um exército de demônios sitia sua vila, um jovem ninja se aventura por um mundo amaldiçoado.', 'O que começa como um clássico jogo de plataforma de ação logo se transforma em uma extensa aventura de viagem no tempo cheia de emoções, surpresas e humor.', 0),
(27, 'Forager', '2019-04-18', 4, 1, 1, 35, 'O altamente popular e peculiar \"jogo ocioso que você deseja continuar jogando ativamente\".', 'Explore, craft, gather & manage resources, find secrets and build your base out of nothing! Buy land to explore and expand!', 5),
(28, 'FEZ', '2013-05-01', 4, 1, 1, 15, 'Gomez é uma criatura 2D que vive em um mundo 2D. Ou ele é?', 'Quando a existência de uma misteriosa 3ª dimensão lhe é revelada, Gomez é enviado numa viagem que o levará até ao fim do tempo e do espaço. Use sua capacidade de navegar em estruturas 3D a partir de 4 perspectivas 2D clássicas distintas.', 5),
(29, 'Super Meat Boy Forever', '2022-01-10', 4, 4, 2, 35, 'Super Meat Boy está de volta! Desta vez, Meat Boy está sempre correndo, literalmente é um corredor automático.', 'Você vai pular, mergulhar, deslizar e abrir caminho através de níveis brutais e lutas contra chefes. Projetamos mais de 5.000 níveis para que você possa jogar repetidamente sem ver o mesmo nível duas vezes.', 20),
(30, 'To the Moon', '2011-11-01', 5, 1, 1, 27, 'Uma história sobre a viagem de dois doutores através das memórias de um homem moribundo, de modo a realizar artificialmente o seu último desejo.', 'Os doutores Rosalene e Watts têm trabalhos peculiares, eles oferecem a chance de viver outra vez, tudo dentro da mente dos seus pacientes.\r\n\r\nDevido a seriedade da operação, a nova vida torna-se na última coisa de que os pacientes se lembram antes de respirarem uma última vez. Assim, a operação só é aplicada a pessoas em estado terminal, pare que possam experienciar o que sempre quiseram, mas não conseguiram.\r\n\r\nEsta história particular segue a tentativa de completar o sonho de Johnny, um homem idoso. Ao recuarem na sua memória, novos fragmentos do seu passado se vão relevados. Ao unir os acontecimentos da sua vida, os dois doutores procuram descobrir a razão por detrás do seu último pedido.\r\n\r\nE o último desejo de Johnny é, claro… ir para a lua.', 80);

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogodesenvolvedora`
--

CREATE TABLE `jogodesenvolvedora` (
  `CodDesenvolvedora` int(11) NOT NULL,
  `CodJogo` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `jogodesenvolvedora`
--

INSERT INTO `jogodesenvolvedora` (`CodDesenvolvedora`, `CodJogo`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(9, 10),
(10, 11),
(11, 12),
(12, 13),
(14, 16),
(13, 14),
(15, 15),
(16, 17),
(17, 18),
(18, 19),
(19, 20),
(20, 21),
(21, 22),
(22, 23),
(23, 24),
(24, 25),
(24, 26),
(25, 27),
(26, 28),
(27, 29),
(28, 30);

-- --------------------------------------------------------

--
-- Estrutura para tabela `meiopagamento`
--

CREATE TABLE `meiopagamento` (
  `CodMeioPagamento` int(11) NOT NULL,
  `OpcoesPagamento` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `meiopagamento`
--

INSERT INTO `meiopagamento` (`CodMeioPagamento`, `OpcoesPagamento`) VALUES
(1, 'Débito'),
(2, 'Crédito'),
(3, 'PicPay'),
(4, 'Pix'),
(5, 'Boleto'),
(6, 'PayPal');

-- --------------------------------------------------------

--
-- Estrutura para tabela `notafiscal`
--

CREATE TABLE `notafiscal` (
  `CodNotaFiscal` int(11) NOT NULL,
  `CodCliente` int(11) DEFAULT NULL,
  `MeioPagamento` int(11) NOT NULL,
  `DataCompra` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `notafiscal`
--

INSERT INTO `notafiscal` (`CodNotaFiscal`, `CodCliente`, `MeioPagamento`, `DataCompra`) VALUES
(1, 1, 1, '2024-10-02 11:22:27'),
(2, 2, 2, '2024-10-10 15:52:27'),
(3, 3, 3, '2024-09-07 01:42:37');
-- --------------------------------------------------------

--
-- Estrutura para tabela `notafiscaljogo`
--

CREATE TABLE `notafiscaljogo` (
  `CodNotaFiscal` int(11) DEFAULT NULL,
  `CodJogo` int(11) NOT NULL,
  `QtdVend` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `notafiscaljogo`
--

INSERT INTO `notafiscaljogo` (`CodNotaFiscal`, `CodJogo`, `QtdVend`) VALUES
(5, 1, 1),
(6, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reqminimos`
--

CREATE TABLE `reqminimos` (
  `ReqMinId` int(11) NOT NULL,
  `SOMin` varchar(50) NOT NULL,
  `GPUMin` varchar(50) NOT NULL,
  `CPUMin` varchar(50) NOT NULL,
  `DirectXMin` varchar(50) NOT NULL,
  `Armazenamento` varchar(30) NOT NULL,
  `RAMmin` varchar(20) NOT NULL,
  `OBS` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `reqminimos`
--

INSERT INTO `reqminimos` (`ReqMinId`, `SOMin`, `GPUMin`, `CPUMin`, `DirectXMin`, `Armazenamento`, `RAMmin`, `OBS`) VALUES
(1, 'Windows 7', 'Integrada (ex: Intel HD Graphics 3000)', 'Dual-Core (ex: Intel Core 2 Duo, AMD Athlon 64 X2)', ' DirectX 9', '2 GB', '2 GB', 'PC de nível baixo'),
(2, 'Windows 8.1', ' Integrada (ex: Intel HD Graphics 4000, AMD Radeon', 'Dual-Core (ex: Intel Core i3 4ª geração, AMD Ryzen', ' DirectX 10', '5 GB', ' 4 GB', 'PC de potência moderadamente baixa'),
(3, 'Windows 10', 'Dedicada de entrada (ex: NVIDIA GTX 750 Ti, AMD R7', 'Quad-Core (ex: Intel Core i5 4ª geração, AMD Ryzen', ' DirectX 11', '10 GB', '6 GB', 'PC de potência média'),
(4, 'Windows 10', 'Dedicada intermediária (ex: NVIDIA GTX 1050 Ti, AM', 'Quad-Core (ex: Intel Core i5 8ª geração, AMD Ryzen', 'DirectX 11', '20 GB', '8 GB', 'PC de potência moderadamente alta'),
(5, 'Windows 10', 'Dedicada de nível médio (ex: NVIDIA GTX 1660, AMD ', 'Hexa-Core (ex: Intel Core i5 10ª geração, AMD Ryze', 'DirectX 12', '30 GB', '12 GB', 'PC de potência alta');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `adm`
--
ALTER TABLE `adm`
  ADD PRIMARY KEY (`CodFuncionario`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`CodCategoria`);

--
-- Índices de tabela `classificacaoindicativa`
--
ALTER TABLE `classificacaoindicativa`
  ADD PRIMARY KEY (`CodFaixaEtaria`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CodCliente`),
  ADD UNIQUE KEY `CodCliente` (`CodCliente`,`Email`,`Nickname`),
  ADD UNIQUE KEY `CodCliente_2` (`CodCliente`,`Email`,`Nickname`),
  ADD UNIQUE KEY `CodCliente_3` (`CodCliente`,`Email`,`Nickname`),
  ADD UNIQUE KEY `CodCliente_4` (`CodCliente`,`Email`,`Nickname`),
  ADD UNIQUE KEY `CodCliente_5` (`CodCliente`,`Email`,`Nickname`),
  ADD UNIQUE KEY `CodCliente_6` (`CodCliente`,`Email`,`Nickname`),
  ADD UNIQUE KEY `Email` (`CodCliente`,`Email`,`Nickname`) USING BTREE;

--
-- Índices de tabela `desenvolvedora`
--
ALTER TABLE `desenvolvedora`
  ADD PRIMARY KEY (`CodDesenvolvedora`),
  ADD UNIQUE KEY `Email_Contato` (`Email_Contato`),
  ADD UNIQUE KEY `CNPJ` (`CNPJ`),
  ADD UNIQUE KEY `SiteOficial` (`SiteOficial`) USING HASH;

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`CodGenero`);

--
-- Índices de tabela `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`CodJogo`);

--
-- Índices de tabela `meiopagamento`
--
ALTER TABLE `meiopagamento`
  ADD PRIMARY KEY (`CodMeioPagamento`);

--
-- Índices de tabela `notafiscal`
--
ALTER TABLE `notafiscal`
  ADD PRIMARY KEY (`CodNotaFiscal`);

--
-- Índices de tabela `reqminimos`
--
ALTER TABLE `reqminimos`
  ADD PRIMARY KEY (`ReqMinId`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adm`
--
ALTER TABLE `adm`
  MODIFY `CodFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `CodCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `classificacaoindicativa`
--
ALTER TABLE `classificacaoindicativa`
  MODIFY `CodFaixaEtaria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `CodCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `desenvolvedora`
--
ALTER TABLE `desenvolvedora`
  MODIFY `CodDesenvolvedora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `CodGenero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `CodJogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `meiopagamento`
--
ALTER TABLE `meiopagamento`
  MODIFY `CodMeioPagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `notafiscal`
--
ALTER TABLE `notafiscal`
  MODIFY `CodNotaFiscal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `reqminimos`
--
ALTER TABLE `reqminimos`
  MODIFY `ReqMinId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
