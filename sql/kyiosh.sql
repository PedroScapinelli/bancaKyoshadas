-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Jun-2024 às 20:31
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `kyiosh`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbclientes`
--

CREATE TABLE `tbclientes` (
  `idCliente` int(11) NOT NULL,
  `nomeCli` varchar(255) NOT NULL,
  `emailCli` varchar(255) NOT NULL,
  `senhaCli` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `foneCli` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbclientes`
--

INSERT INTO `tbclientes` (`idCliente`, `nomeCli`, `emailCli`, `senhaCli`, `endereco`, `foneCli`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', 'admin', '69696969'),
(2, 'bernardo', 'bernardoc.freitas@gmail.com', '123', 'rua legal', '69696969');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbfuncinarios`
--

CREATE TABLE `tbfuncinarios` (
  `idFunc` int(11) NOT NULL,
  `nomeFunc` varchar(255) NOT NULL,
  `emailFunc` varchar(255) NOT NULL,
  `senhaFunc` varchar(255) NOT NULL,
  `funcao` varchar(255) NOT NULL,
  `ativo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbfuncinarios`
--

INSERT INTO `tbfuncinarios` (`idFunc`, `nomeFunc`, `emailFunc`, `senhaFunc`, `funcao`, `ativo`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', 'gerente', 's');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `idProduto` int(11) NOT NULL,
  `nomeProd` varchar(255) NOT NULL,
  `descProd` varchar(255) NOT NULL,
  `fotoProd` varchar(255) NOT NULL,
  `precoVenda` decimal(10,2) NOT NULL,
  `precoProm` decimal(10,2) NOT NULL,
  `ativo` varchar(1) NOT NULL,
  `promocao` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbproduto`
--

INSERT INTO `tbproduto` (`idProduto`, `nomeProd`, `descProd`, `fotoProd`, `precoVenda`, `precoProm`, `ativo`, `promocao`) VALUES
(1, 'playboy #1', 'playboy talento - Lucas Kyiosh', 'revista01.png', '29.00', '0.00', 's', 'n'),
(4, 'playboy#2', 'playboy edição especial - Lucas Kyiosh - Amor, Tesão e Razão ', 'revista02.png', '69.90', '59.99', 's', 's');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvendas`
--

CREATE TABLE `tbvendas` (
  `idPedido` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `precoVenda` decimal(10,2) NOT NULL,
  `qnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbvendas`
--

INSERT INTO `tbvendas` (`idPedido`, `idProduto`, `idCliente`, `data`, `precoVenda`, `qnt`) VALUES
(11, 4, 2, '2024-06-05', '239.96', 4),
(12, 4, 2, '2024-06-05', '59.99', 1),
(13, 1, 2, '2024-06-05', '29.00', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbclientes`
--
ALTER TABLE `tbclientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Índices para tabela `tbfuncinarios`
--
ALTER TABLE `tbfuncinarios`
  ADD PRIMARY KEY (`idFunc`);

--
-- Índices para tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices para tabela `tbvendas`
--
ALTER TABLE `tbvendas`
  ADD PRIMARY KEY (`idPedido`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbclientes`
--
ALTER TABLE `tbclientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbfuncinarios`
--
ALTER TABLE `tbfuncinarios`
  MODIFY `idFunc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tbvendas`
--
ALTER TABLE `tbvendas`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
