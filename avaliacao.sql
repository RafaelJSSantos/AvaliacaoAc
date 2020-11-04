-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 04-Nov-2020 às 00:27
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `avaliacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `IdProduto` int(11) NOT NULL AUTO_INCREMENT,
  `Descricao` varchar(800) NOT NULL,
  `Valor` decimal(10,2) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Excluido` varchar(2) NOT NULL DEFAULT 'N',
  `CodBarra` bigint(20) NOT NULL,
  PRIMARY KEY (`IdProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`IdProduto`, `Descricao`, `Valor`, `Quantidade`, `Excluido`, `CodBarra`) VALUES
(1, 'Batata', '15.00', 999, 'N', 1231312312312),
(2, 'Arroz', '25.00', 4200, 'N', 78978978978978),
(3, 'Coca 2l', '10.00', 300, 'N', 321312123231123);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

DROP TABLE IF EXISTS `venda`;
CREATE TABLE IF NOT EXISTS `venda` (
  `IdVenda` int(11) NOT NULL AUTO_INCREMENT,
  `IdProduto` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Valor` decimal(10,2) NOT NULL,
  `Data` date NOT NULL,
  PRIMARY KEY (`IdVenda`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`IdVenda`, `IdProduto`, `Quantidade`, `Valor`, `Data`) VALUES
(1, 1, 1, '1.00', '2020-11-03');

ALTER TABLE `venda`
  ADD CONSTRAINT `produto_venda_fk` FOREIGN KEY (`IdProduto`) REFERENCES `produto` (`IdProduto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
