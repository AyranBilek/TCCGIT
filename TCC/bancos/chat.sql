-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09-Jun-2020 às 18:28
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `chat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `interacoes`
--

CREATE TABLE `interacoes` (
  `nm_usuario` varchar(20) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `dt_interacao` datetime NOT NULL,
  `ds_interacao` varchar(500) NOT NULL,
  `nm_destinatario` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `interacoes`
--

INSERT INTO `interacoes` (`nm_usuario`, `id_sala`, `dt_interacao`, `ds_interacao`, `nm_destinatario`) VALUES
('ll', 4, '2020-04-22 05:19:10', 'Entrou na sala.', ''),
('gg', 1, '2020-04-22 05:19:10', 'Saiu da sala.', ''),
('ll', 4, '2020-04-22 05:19:23', 'ççççççççç', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `salas`
--

CREATE TABLE `salas` (
  `id_sala` int(11) NOT NULL,
  `nm_sala` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `salas`
--

INSERT INTO `salas` (`id_sala`, `nm_sala`) VALUES
(1, 'Filmes'),
(2, 'Esportes'),
(3, 'Jogos'),
(4, 'Música'),
(5, 'Séries'),
(6, 'Desenhos'),
(7, 'Animes'),
(8, 'Front-End'),
(9, 'Back-end'),
(10, 'Reclamar da Vida');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nm_usuario` varchar(20) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `dt_refresh` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nm_usuario`, `id_sala`, `dt_refresh`) VALUES
(14, 'll', 4, '2020-04-22 05:19:29');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id_sala`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `salas`
--
ALTER TABLE `salas`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
