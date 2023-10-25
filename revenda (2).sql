-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: 28/03/2023 às 20h18min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `revenda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `automoveis`
--

CREATE TABLE IF NOT EXISTS `automoveis` (
  `codigo` int(5) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `codmodelo` int(5) NOT NULL,
  `codcategoria` int(5) NOT NULL,
  `ano` int(4) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `localizacao` varchar(50) NOT NULL,
  `combustivel` varchar(30) NOT NULL,
  `opcionais` varchar(50) NOT NULL,
  `valor` float(10,2) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codmodelo` (`codmodelo`),
  KEY `codcategoria` (`codcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `automoveis`
--

INSERT INTO `automoveis` (`codigo`, `descricao`, `codmodelo`, `codcategoria`, `ano`, `cor`, `placa`, `localizacao`, `combustivel`, `opcionais`, `valor`) VALUES
(1, 'Carro muito bom', 1, 1, 2022, 'Preto', 'F1T4', 'Criciúma', 'Gasolina', 'Banco personalizado, teto solar', 615000.00),
(2, 'Carro muito bom, confortável e espaçoso', 2, 2, 2023, 'Branco', 'R1T5', 'Criciúma', 'Diesel', 'Teto solar, banco personalizado', 250000.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`codigo`, `nome`) VALUES
(1, 'Sedan'),
(2, 'SUV');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`codigo`, `nome`) VALUES
(1, 'BMW'),
(2, 'Jeep');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelos`
--

CREATE TABLE IF NOT EXISTS `modelos` (
  `codigo` int(5) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codmarca` int(5) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codmarca` (`codmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modelos`
--

INSERT INTO `modelos` (`codigo`, `nome`, `codmarca`) VALUES
(1, 'X5', 1),
(2, 'Commander', 2);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `automoveis`
--
ALTER TABLE `automoveis`
  ADD CONSTRAINT `automoveis_ibfk_1` FOREIGN KEY (`codmodelo`) REFERENCES `modelos` (`codigo`),
  ADD CONSTRAINT `automoveis_ibfk_2` FOREIGN KEY (`codcategoria`) REFERENCES `categorias` (`codigo`);

--
-- Restrições para a tabela `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`codmarca`) REFERENCES `marcas` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
