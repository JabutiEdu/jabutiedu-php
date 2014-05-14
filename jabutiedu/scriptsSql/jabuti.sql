-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2014 at 02:34 PM
-- Server version: 5.5.37
-- PHP Version: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jabuti`
--

-- --------------------------------------------------------

--
-- Table structure for table `configuracao`
--

CREATE TABLE IF NOT EXISTS `configuracao` (
  `id_configuracao` int(11) NOT NULL,
  `timeout_atividade` int(11) NOT NULL,
  `timeout_acesso` int(11) NOT NULL,
  `velocidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipe`
--

CREATE TABLE IF NOT EXISTS `equipe` (
  `id_equipe` int(11) NOT NULL AUTO_INCREMENT,
  `id_instituicao` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  PRIMARY KEY (`id_equipe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `equipe`
--

INSERT INTO `equipe` (`id_equipe`, `id_instituicao`, `nome`) VALUES
(1, 1, 'Sala de aula B3'),
(2, 1, 'Equipe 2'),
(3, 2, 'Turma do barulho');

-- --------------------------------------------------------

--
-- Table structure for table `instituicao`
--

CREATE TABLE IF NOT EXISTS `instituicao` (
  `id_instituicao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  PRIMARY KEY (`id_instituicao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `instituicao`
--

INSERT INTO `instituicao` (`id_instituicao`, `nome`) VALUES
(1, 'Marista PIO XII'),
(2, 'Instituição 2'),
(3, 'Cesmar');

-- --------------------------------------------------------

--
-- Table structure for table `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(128) NOT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `descricao`) VALUES
(1, 'Módulo 1'),
(2, 'Módulo 2'),
(3, 'Módulo 3'),
(4, 'Módulo 4'),
(5, 'Módulo 5'),
(6, 'Módulo 6'),
(7, 'Módulo 7');

-- --------------------------------------------------------

--
-- Table structure for table `pessoa`
--

CREATE TABLE IF NOT EXISTS `pessoa` (
  `id_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa_tipo` int(11) NOT NULL,
  `nome` varchar(128) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  `ultimo_acesso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(128) NOT NULL,
  `login` varchar(32) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `data_nascimento` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `interativo` int(11) NOT NULL,
  PRIMARY KEY (`id_pessoa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pessoa`
--

INSERT INTO `pessoa` (`id_pessoa`, `id_pessoa_tipo`, `nome`, `id_equipe`, `ultimo_acesso`, `email`, `login`, `senha`, `id_modulo`, `data_nascimento`, `interativo`) VALUES
(1, 1, 'Administrador', 0, '2014-05-13 15:41:51', 'daniel@opcode.com.br', 'admin', '1qaz@wsx', 0, '0000-00-00 00:00:00', 0),
(2, 3, 'Usuário Livre', 0, '2014-05-14 01:28:22', '', 'livre', 'livre', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pessoa_tipo`
--

CREATE TABLE IF NOT EXISTS `pessoa_tipo` (
  `id_pessoa_tipo` int(11) NOT NULL,
  `descricao` varchar(128) NOT NULL,
  PRIMARY KEY (`id_pessoa_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pessoa_tipo`
--

INSERT INTO `pessoa_tipo` (`id_pessoa_tipo`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Moderador'),
(3, 'Usuário');

-- --------------------------------------------------------

--
-- Table structure for table `sessao`
--

CREATE TABLE IF NOT EXISTS `sessao` (
  `id_sessao` varchar(64) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data_ultimo_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `data_ultimo_acesso` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `data_expira` timestamp NULL DEFAULT NULL,
  `user_agent` varchar(256) NOT NULL,
  `remote_ip` varchar(64) DEFAULT NULL,
  `request_method` varchar(8) DEFAULT NULL,
  `query_string` tinytext,
  `script_name` varchar(64) DEFAULT NULL,
  `dados_sessao` text,
  `estado` int(11) NOT NULL,
  UNIQUE KEY `idx_session_id` (`id_sessao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessao`
--

INSERT INTO `sessao` (`id_sessao`, `data_criacao`, `data_ultimo_login`, `data_ultimo_acesso`, `data_expira`, `user_agent`, `remote_ip`, `request_method`, `query_string`, `script_name`, `dados_sessao`, `estado`) VALUES
('0a570097e25ceaa6e65792d482cf167d', '2014-05-14 06:50:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 06:50:05', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"1"}', 1),
('0ceb5a1b448b63dba63f8d13ee9989c8', '2014-05-14 04:45:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 04:44:50', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"1"}', 9),
('49b7d5ff5b8adb5a13e005a2cb93fa72', '2014-05-14 06:49:03', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 06:45:55', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"1"}', 9),
('4ec3d996be46ef3c4ae86f4ee9956112', '2014-05-14 01:36:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-12 22:53:35', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"dado_qualquer":"teste de dados","id_pessoa":"2","nome_pessoa":null,"id_pessoa_tipo":"3","id_modulo":"0"}', 9),
('628226cfc0e00a6685e9048aa11fe5e9', '2014-05-14 06:49:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 06:49:08', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"1"}', 9),
('67c87deb56d12a20c1c30f6a1e237d36', '2014-05-14 01:45:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 01:36:50', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"0"}', 9),
('6943f6d492b398b588670a363e6e1951', '2014-05-14 03:35:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 03:35:49', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, NULL, 9),
('6f448447695211210da0f9820770465b', '2014-05-14 04:44:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 03:35:50', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"1"}', 9),
('ba7b37f0bc23a1ea251e4057f5073c0d', '2014-05-14 04:45:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 04:45:31', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"1"}', 9),
('d99e5659ecf4ad7558c2e207d66921c7', '2014-05-14 01:51:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 01:51:12', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, NULL, 9),
('eddab4b2be84fad7bac7bf1aef8ec687', '2014-05-14 06:49:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 06:49:56', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"1","nome_pessoa":"Administrador","id_pessoa_tipo":"1","id_modulo":"1"}', 9),
('ee812c1e045701144cb62957e27d8268', '2014-05-14 01:50:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 01:45:34', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"0"}', 9),
('f8b6575dd4f9969963c3968e8c40cd07', '2014-05-14 06:45:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 04:45:48', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"1"}', 9),
('fb6e292d5f19b69272a4a255ecfe52df', '2014-05-14 01:55:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 01:55:21', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, NULL, 9),
('ff17e8ef0ab257890f85aeb1b66ea85e', '2014-05-14 01:50:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-06-13 01:50:25', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:29.0) Gecko/20100101 Firefox/29.0', '127.0.0.1', NULL, NULL, NULL, '{"id_pessoa":"2","nome_pessoa":"Usu\\u00e1rio Livre","id_pessoa_tipo":"3","id_modulo":"0"}', 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
