-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Out-2019 às 01:32
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mauricioluminarias`
--

CREATE DATABASE mauricioluminarias;
--
-- Estrutura da tabela `clientes`
--

use mauricioluminarias;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `data_criacao` datetime NOT NULL,
  `relevante` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `imagem` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `fotos`
  ADD KEY `usuario_id` (`usuario_id`);

-- --------------------------------------------------------

CREATE TABLE `encomenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `descricao` varchar(255) NOT NULL,
  `medida` varchar(100) NULL,
  `qtd` int(11) NULL,
  `fotoambiente` varchar(200) DEFAULT NULL,
  `cliente_id` int(11) NOT NULL,
  `chave_confirmacao` varchar(20) NOT NULL,
  `data_expiracao_confirmacao` datetime NOT NULL,
  `confirmado` tinyint(1) NOT NULL,
  `respondida` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `encomenda`
  ADD KEY `encomenda_ibfk_1` (`cliente_id`);

ALTER TABLE `encomenda`
  ADD CONSTRAINT `encomenda_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
COMMIT;
-- --------------------------------------------------------

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `perfil` enum('Administrador','Funcionário') NOT NULL,
  `chave_senha` varchar(20) NOT NULL,
  `data_expiracao_senha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `perfil`) VALUES
(1, 'admin', 'admin@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Administrador');

ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

-- insert into fotos values(null,'Foto1.png','png',null,1);
-- insert into fotos values(null,'Foto3.png','png',null,1);
-- insert into fotos values(null,'Foto4.png','png',null,1);
-- insert into fotos values(null,'Foto5.png','png',null,1);
-- insert into fotos values(null,'Foto6.png','png',null,1);
-- insert into fotos values(null,'Foto7.png','png',null,1);
-- insert into fotos values(null,'Foto8.png','png',null,1);
-- insert into fotos values(null,'Foto9.png','png',null,1);
-- insert into fotos values(null,'Foto10.png','png',null,1);
-- insert into fotos values(null,'Foto11.png','png',null,1);
-- insert into fotos values(null,'Foto12.png','png',null,1);
-- insert into fotos values(null,'Foto13.png','png',null,1);
-- insert into fotos values(null,'Foto14.png','png',null,1);
-- insert into fotos values(null,'Foto2.1.png','png',null,1);

