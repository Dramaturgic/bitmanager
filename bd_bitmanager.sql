-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Maio-2024 às 18:43
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_bitmanager`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_carrinhos`
--

CREATE TABLE `tb_carrinhos` (
  `i_id_carrinho` int(11) NOT NULL,
  `s_cod_carrinho` varchar(32) DEFAULT NULL,
  `i_produto_id_carrinho` int(11) DEFAULT NULL,
  `i_qtde_carrinho` int(11) DEFAULT NULL,
  `i_usuario_id_carrinho` int(11) DEFAULT NULL,
  `i_stat_carrinho` int(11) DEFAULT NULL,
  `d_dt_carrinho` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_carrinhos`
--

INSERT INTO `tb_carrinhos` (`i_id_carrinho`, `s_cod_carrinho`, `i_produto_id_carrinho`, `i_qtde_carrinho`, `i_usuario_id_carrinho`, `i_stat_carrinho`, `d_dt_carrinho`) VALUES
(1, '6492652417', 102, 0, 17, 0, '2024-05-07 16:56:51'),
(2, '1206668317', 114, 0, 17, 0, '2024-05-08 14:17:05'),
(3, '1206668317', 112, 0, 17, 0, '2024-05-08 14:26:31'),
(4, '1206668317', 99, 0, 17, 0, '2024-05-08 14:39:12'),
(5, '128558310', 99, 0, 10, 0, '2024-05-08 14:53:33'),
(6, '128558310', 116, 0, 10, 0, '2024-05-08 16:32:25'),
(7, '3475323110', 99, 0, 10, 0, '2024-05-08 17:27:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `i_id_categoria` int(11) NOT NULL,
  `s_nm_categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_categorias`
--

INSERT INTO `tb_categorias` (`i_id_categoria`, `s_nm_categoria`) VALUES
(1, 'Jogo'),
(2, 'Filme'),
(3, 'Música');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `i_id_produto` int(11) NOT NULL,
  `s_nm_produto` varchar(50) DEFAULT NULL,
  `s_descri_produto` varchar(100) DEFAULT NULL,
  `s_gen_produto` varchar(20) DEFAULT NULL,
  `s_depart_produto` varchar(30) DEFAULT NULL,
  `s_claset_produto` varchar(20) DEFAULT NULL,
  `dt_dtlanc_produto` date DEFAULT NULL,
  `dc_prec_produto` decimal(10,0) DEFAULT NULL,
  `s_art_produto` varchar(50) DEFAULT NULL,
  `s_direc_produto` varchar(50) DEFAULT NULL,
  `s_dev_produto` varchar(50) DEFAULT NULL,
  `s_ativ_produto` varchar(30) DEFAULT NULL,
  `s_vid_produto` varchar(30) DEFAULT NULL,
  `s_foto_produto` varchar(30) DEFAULT NULL,
  `i_estoq_produto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`i_id_produto`, `s_nm_produto`, `s_descri_produto`, `s_gen_produto`, `s_depart_produto`, `s_claset_produto`, `dt_dtlanc_produto`, `dc_prec_produto`, `s_art_produto`, `s_direc_produto`, `s_dev_produto`, `s_ativ_produto`, `s_vid_produto`, `s_foto_produto`, `i_estoq_produto`) VALUES
(99, 'Ride The Lightning', 'Ride The Lightning from Ride The Lightning, Metallica', 'Rock', '3', '16 anos', '1983-07-09', '92', 'Metallica', NULL, NULL, NULL, 'none.jpg', 'ridethelightning.jpg', 12),
(100, 'Phamtom Lord', 'Phamtom Lord from Metallica', 'Rock', '3', '16 anos', '1983-07-26', '92', 'Metallica', NULL, NULL, NULL, 'none.jpg', 'none.jpg', 12),
(103, 'aaa', 'bbb', 'Outros', '1', 'Classificação penden', '2024-05-07', '66666', NULL, NULL, 'ccccc', 'dddddd', 'none.jpg', 'none.jpg', 100),
(105, 'The Sims 4', 'simulador de vida real', 'Simulation', '1', 'Adolescentes, 13+', '2004-12-09', '0', NULL, NULL, 'The Sims Studio', 'jhh1b2d1yuibuiy12ab3ui12v', 'none.jpg', 'none.jpg', 4),
(106, 'The Monster', 'Song produced by the artists Eminem and Rihanna', 'Pop', '3', '12 anos', '2013-10-29', '50', 'Eminem', NULL, NULL, NULL, 'none.jpg', 'none.jpg', 10),
(107, 'Cuphead', 'xirca', 'Platformer', '1', 'Todas as idades', '2017-05-01', '40', NULL, NULL, 'Studio MDHR', 'jhh1b231yuibuiy12vb3ui12v', 'none.jpg', 'none.jpg', 15),
(109, 'Bloodborne', 'jogobosta da silva', 'Action RPG', '1', 'Adolescentes, 13+', '2012-01-01', '150', NULL, NULL, 'FromSoftware', 'udnandiosdbouabdad', 'none.jpg', 'none.jpg', 5),
(111, 'Sheltered', 'a jog', 'Platformer', '1', 'Adolescentes, 13+', '2022-01-01', '20', NULL, NULL, 'Unicube', 'md8agbd87a8hdw8d7', 'none.jpg', 'none.jpg', 7),
(112, 'Bloons TD 6', 'macaco e balão', 'indie', '1', 'Todas as idades', '2018-02-01', '25', NULL, NULL, 'Shanttingant', 'adnuoybadw87dbq7d8', 'none.jpg', 'none.jpg', 3),
(113, '10 Coisas que eu odeio em você', 'apaixonante', 'Romance', '2', 'Livre', '1999-03-31', '122', NULL, 'Gil julger', NULL, NULL, 'none.jpg', 'none.jpg', 10),
(114, 'Panico', 'terror uhuhuhhuu', 'Terror', '2', '16 anos', '1997-01-31', '20', NULL, 'Wes Cravel', NULL, NULL, 'none.jpg', 'none.jpg', 2),
(115, 'Blade Runner - O Caçador de Androides', '\"Blade Runner\", dirigido por Ridley Scott e lançado em 1982, é um icônico filme de ficção científica', 'Ação', '2', 'Livre', '1982-12-25', '55', NULL, 'Ridley Scott', NULL, NULL, 'none.jpg', 'none.jpg', 4),
(116, 'Bee Movie', 'Alanzoka e suas aventuras.', 'Animação', '2', 'Livre', '2007-12-07', '13', NULL, 'Steve hickrel', NULL, NULL, 'none.jpg', 'none.jpg', 3),
(117, 'operação BIG HERO', '\"Pacific Rim\", também conhecido no Brasil como \"Círculo de Fogo\", é um filme de ficção científica e ', 'Animação', '2', 'Livre', '2014-12-25', '11', NULL, 'Don Hall', NULL, NULL, 'none.jpg', 'none.jpg', 6),
(118, 'Batman Cavaleiro das trevas', 'batman foda', 'Heroi', '2', 'Livre', '2008-06-18', '123', NULL, 'Cristopher Nolan', NULL, NULL, 'none.jpg', 'none.jpg', 9),
(119, 'Dark Souls Remastered', 'Jogo legal', 'Action RPG', '1', 'Adolescentes, 13+', '2010-07-01', '150', NULL, NULL, 'FromSoftware', 'fvbuye26yeg72eb1iu', 'Dark Souls Remastered.mp4', 'darksouls.jpg', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `i_id_usuario` int(11) NOT NULL,
  `s_nm_usuario` varchar(50) DEFAULT NULL,
  `s_unm_usuario` varchar(50) DEFAULT NULL,
  `s_pw_usuario` varchar(50) DEFAULT NULL,
  `s_tel_usuario` varchar(14) DEFAULT NULL,
  `dt_nasc_usuario` date DEFAULT NULL,
  `s_eml_usuario` varchar(40) DEFAULT NULL,
  `s_end_usuario` varchar(50) DEFAULT NULL,
  `s_cpf_usuario` varchar(14) DEFAULT NULL,
  `s_temp_usuario` varchar(50) DEFAULT NULL,
  `i_nvl_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`i_id_usuario`, `s_nm_usuario`, `s_unm_usuario`, `s_pw_usuario`, `s_tel_usuario`, `dt_nasc_usuario`, `s_eml_usuario`, `s_end_usuario`, `s_cpf_usuario`, `s_temp_usuario`, `i_nvl_usuario`) VALUES
(3, 'Victor', 'D4rk', '71173e2799493bb08735aa98ed33c905', '(16)98872-5438', '2004-04-26', 'vvictorgabrielreis@gmail.com', 'José Alves', '281.283.953/09', '2f69041ec8dda2c2dd5934c21b7e1fa1', 10),
(9, 'Gabriel', 'Gab', '8d3f318d87ee78d4bf5961a7ede6f1c6', '(16)98872-5438', '2008-04-27', 'victorgabriel@gmail.com', 'José Pereira', '382.735.281/95', 'c1b33a683b32f66f7614300da3941952', 1),
(10, 'admin', 'admin', 'c830187420ad56352c9ceffa907c429d', '00000000000000', '0001-01-01', 'admin@admin.com', '0000000000000000', '000.000.000/00', 'bed471cab0266c692ebe49f245ac8e86', 10),
(11, 'Usuario', 'User User', '5088790ea4a14b8f4ee1cebad326e914', '(98)15852-1571', '1960-02-08', 'user@userr.com', 'OAFUOIFHOAIFUOA', '123.412.412/12', 'ae8f3691a75231ffcd07b5ff74b8b649', 1),
(13, 'Patrícia ', 'patricia_queiroz', '04e8b6d2f4c76b267339c7932d132e39', '(16)98164-6909', '2007-03-24', 'patriciaqueiroz806@gmail.com', 'Rua Egydio Pedreschi, 931', '479.667.278/82', '69ceaa96def305b90debdff6ea3a6cdc', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_carrinhos`
--
ALTER TABLE `tb_carrinhos`
  ADD PRIMARY KEY (`i_id_carrinho`);

--
-- Índices para tabela `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`i_id_categoria`);

--
-- Índices para tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`i_id_produto`);

--
-- Índices para tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`i_id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_carrinhos`
--
ALTER TABLE `tb_carrinhos`
  MODIFY `i_id_carrinho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `i_id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `i_id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `i_id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
