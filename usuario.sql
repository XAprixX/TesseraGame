-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 13-Dez-2023 às 11:56
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `Nickname` varchar(25) NOT NULL,
  `Senha` varchar(12) NOT NULL,
  `ID` int(4) NOT NULL,
  `Player_Number` varchar(19) NOT NULL,
  `Criacao` varchar(7) DEFAULT NULL,
  `Descricao` varchar(500) DEFAULT NULL,
  `money` decimal(10,0) NOT NULL,
  `happiness` int(3) NOT NULL,
  `hunger` int(3) NOT NULL,
  `Job` varchar(13) NOT NULL,
  `wisdom` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`Nickname`, `Senha`, `ID`, `Player_Number`, `Criacao`, `Descricao`, `money`, `happiness`, `hunger`, `Job`, `wisdom`) VALUES
('Admin', 'admin', 1, '1234 1234 1234 1234', '09/2023', 'Sou o desenvolvedor desse site', '1000000', 100, 19, '', 2147483647);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
