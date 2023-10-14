-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Out-2023 às 01:26
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome_categoria`) VALUES
(1, 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `datanasc` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `datanasc`, `email`, `telefone`) VALUES
(1, 'teste', '234234234234', '2004-03-15', 'teste@tes', '23423423');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dinheiro`
--

DROP TABLE IF EXISTS `dinheiro`;
CREATE TABLE IF NOT EXISTS `dinheiro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dinheiro` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dinheiro`
--

INSERT INTO `dinheiro` (`id`, `dinheiro`) VALUES
(18, '40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeproduto` varchar(100) NOT NULL,
  `categoria` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valorvenda` float NOT NULL,
  `valorcompra` float NOT NULL,
  `empresaproduto` varchar(100) NOT NULL,
  `quantidade` int(100) NOT NULL,
  `datacompra` datetime NOT NULL,
  `quantidadecomprada` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nomeproduto`, `categoria`, `descricao`, `valorvenda`, `valorcompra`, `empresaproduto`, `quantidade`, `datacompra`, `quantidadecomprada`) VALUES
(2, 'teste2', 1, 'teste', 20, 50, 'teste', 0, '2023-09-11 02:04:00', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reporestoque`
--

DROP TABLE IF EXISTS `reporestoque`;
CREATE TABLE IF NOT EXISTS `reporestoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `quantidadenova` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `restringe_estoque` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `reporestoque`
--

INSERT INTO `reporestoque` (`id`, `data`, `quantidadenova`, `id_produto`) VALUES
(1, '2023-09-10 23:10:00', 2, 2),
(2, '2023-09-10 23:13:00', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `cpf`, `email`, `nivel`) VALUES
(1, 'admin', 'admin', '000.000.000-00', 'admin@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produtovenda_id` int(11) NOT NULL,
  `clientevenda_id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `quantidade` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `produtovenda_id`, `clientevenda_id`, `data`, `quantidade`) VALUES
(7, 1, 1, '2023-09-11 02:32:00', 2),
(8, 2, 1, '2023-09-24 22:52:00', 2);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `reporestoque`
--
ALTER TABLE `reporestoque`
  ADD CONSTRAINT `restringe_estoque` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
