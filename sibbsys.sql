-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 21/07/2014 às 16:14
-- Versão do servidor: 5.5.38-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `sibbsys`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Arquivos`
--

CREATE TABLE IF NOT EXISTS `Arquivos` (
  `idArquivos` int(11) NOT NULL AUTO_INCREMENT,
  `Arquivo` text NOT NULL,
  `Nome` text NOT NULL,
  `Ano` varchar(45) NOT NULL,
  `Semestre` int(11) NOT NULL,
  `Data` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Disciplina_idDisciplina` int(11) NOT NULL,
  PRIMARY KEY (`idArquivos`,`Disciplina_idDisciplina`),
  KEY `fk_Arquivos_Disciplina1_idx` (`Disciplina_idDisciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `Arquivos`
--

INSERT INTO `Arquivos` (`idArquivos`, `Arquivo`, `Nome`, `Ano`, `Semestre`, `Data`, `Status`, `Disciplina_idDisciplina`) VALUES
(1, 'Colossenses.jpg', 'Mapa Colossenses', '2013', 2, '29/07/2013', 'ativo', 3),
(2, 'sibb-logo.png', 'SIBB', '2013', 2, '11/12/2013', 'ativo', 3),
(3, '4397763639_40e68f8661.jpg', 'Império Romano', '2014', 2, '20/12/2013', 'ativo', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Configs`
--

CREATE TABLE IF NOT EXISTS `Configs` (
  `idConfigs` int(11) NOT NULL,
  `Meta_Key` text NOT NULL,
  `Meta_Value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Credito`
--

CREATE TABLE IF NOT EXISTS `Credito` (
  `idCredito` int(11) NOT NULL,
  `ValorCred` float NOT NULL,
  PRIMARY KEY (`idCredito`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `Credito`
--

INSERT INTO `Credito` (`idCredito`, `ValorCred`) VALUES
(1, 16.5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Curso`
--

CREATE TABLE IF NOT EXISTS `Curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` text NOT NULL,
  `Duracao` varchar(45) NOT NULL,
  `Descricao` text,
  `Status` varchar(45) NOT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `Curso`
--

INSERT INTO `Curso` (`idCurso`, `Nome`, `Duracao`, `Descricao`, `Status`) VALUES
(1, 'Bíblico Geral', '2 anos', 'Qualquer coisa', 'ativo'),
(2, 'Professor', '4 anos', '', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Debitos`
--

CREATE TABLE IF NOT EXISTS `Debitos` (
  `idDebitos` int(11) NOT NULL AUTO_INCREMENT,
  `mesPagamento` int(11) NOT NULL,
  `descontoMes` int(11) NOT NULL,
  `anoPagamento` int(11) DEFAULT NULL,
  `idUsuario_has_Servicos` int(11) DEFAULT NULL,
  `idUsuario_has_Turma` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDebitos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Fazendo dump de dados para tabela `Debitos`
--

INSERT INTO `Debitos` (`idDebitos`, `mesPagamento`, `descontoMes`, `anoPagamento`, `idUsuario_has_Servicos`, `idUsuario_has_Turma`) VALUES
(6, 7, 0, 2014, NULL, 11),
(7, 7, 0, 2014, 15, NULL),
(8, 7, 0, 2014, 16, NULL),
(9, 7, 0, 2014, 18, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Disciplina`
--

CREATE TABLE IF NOT EXISTS `Disciplina` (
  `idDisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `Disciplina` varchar(100) NOT NULL,
  `QntdCred` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Credito_idCredito` int(11) NOT NULL,
  PRIMARY KEY (`idDisciplina`,`Credito_idCredito`),
  KEY `fk_Disciplina_Credito1` (`Credito_idCredito`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Fazendo dump de dados para tabela `Disciplina`
--

INSERT INTO `Disciplina` (`idDisciplina`, `Disciplina`, `QntdCred`, `Status`, `Credito_idCredito`) VALUES
(1, 'I Coríntios', '2', 'ativo', 1),
(2, 'Romanos', '2', 'ativo', 1),
(3, 'Atos', '2', 'ativo', 1),
(4, 'Levítico e Hebreus', '2', 'ativo', 1),
(5, 'Vida de Cristo', '2', 'ativo', 1),
(6, 'Gênesis 1-11', '2', 'ativo', 1),
(7, 'Panorama do Novo Testamento', '4', 'ativo', 1),
(8, 'Panorama do Antigo Testamento', '4', 'ativo', 1),
(9, 'Introdução a Música', '2', 'ativo', 1),
(10, 'Introdução a Missões', '2', 'ativo', 1),
(11, 'Teologia Básica', '2', 'ativo', 1),
(12, 'Teologia Sistemática', '4', 'ativo', 1),
(13, 'Grego I', '3', 'ativo', 1),
(14, 'Hebraico I', '2', 'ativo', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Faturas`
--

CREATE TABLE IF NOT EXISTS `Faturas` (
  `idFatura` int(11) NOT NULL AUTO_INCREMENT,
  `valorFatura` float DEFAULT NULL,
  `desconto` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idFatura`,`Usuario_idUsuario`),
  KEY `fk_Faturas_Usuario1_idx` (`Usuario_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Igreja`
--

CREATE TABLE IF NOT EXISTS `Igreja` (
  `idIgreja` int(11) NOT NULL AUTO_INCREMENT,
  `Igreja` text NOT NULL,
  `Endereco` text NOT NULL,
  `Bairro` varchar(100) NOT NULL,
  `CEP` varchar(45) DEFAULT NULL,
  `Telefone` varchar(45) DEFAULT NULL,
  `Pastor` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL,
  PRIMARY KEY (`idIgreja`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `Igreja`
--

INSERT INTO `Igreja` (`idIgreja`, `Igreja`, `Endereco`, `Bairro`, `CEP`, `Telefone`, `Pastor`, `Status`) VALUES
(1, 'Batista Central', 'Mota Neto', 'Nova Betânia', '59600-000', '3316-9958', 'Pr. Charles', 'ativo'),
(2, 'Batista do Alto', 'Mar do Leste', 'Pajuçara', '59.600-000', '84 0000-0000', 'Pr. Ricardo Mateus', 'ativo'),
(3, 'Igreja Batista Regular Cidade Satélite', 'Cidade Satélite', 'Não sei', '59.600-000', '84 0000-0000', 'Pr. Timóteo Franklin', 'ativo'),
(4, 'Batista de Nova Cruz', 'José de Brito', 'São Sebastião', '59.600-000', '84 0000-0000', 'Francisco Neto', 'ativo'),
(5, 'Batista Fundamentalista de Santo Antonio', 'Santo Antonio do Salto da Onça', 'Santo Antonio', '59.600-000', '84 0000-0000', 'Pr. Almir', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Nota`
--

CREATE TABLE IF NOT EXISTS `Nota` (
  `idNota` int(11) NOT NULL AUTO_INCREMENT,
  `Unit1` varchar(10) NOT NULL,
  `Unit2` varchar(10) DEFAULT NULL,
  `Unit3` varchar(10) DEFAULT NULL,
  `idUsuario_has_Turma` int(11) NOT NULL,
  `Turma_idTurma` int(11) NOT NULL,
  PRIMARY KEY (`idNota`,`idUsuario_has_Turma`,`Turma_idTurma`),
  KEY `fk_Nota_Usuario_has_Turma1_idx` (`idUsuario_has_Turma`),
  KEY `fk_Nota_Turma1_idx` (`Turma_idTurma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `Nota`
--

INSERT INTO `Nota` (`idNota`, `Unit1`, `Unit2`, `Unit3`, `idUsuario_has_Turma`, `Turma_idTurma`) VALUES
(1, '7.5', '8.4', '7.3', 2, 2),
(2, '9.5', '6,3', '7.6', 3, 2),
(3, '7.8', '7.3', '', 9, 2),
(4, '6.7', '', '', 8, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Pagamento`
--

CREATE TABLE IF NOT EXISTS `Pagamento` (
  `idPagamento` int(11) NOT NULL AUTO_INCREMENT,
  `valorPagamento` float NOT NULL,
  `dataPagamento` datetime DEFAULT NULL,
  `Faturas_idFatura` int(11) NOT NULL,
  PRIMARY KEY (`idPagamento`,`Faturas_idFatura`),
  KEY `fk_Pagamento_Faturas1_idx` (`Faturas_idFatura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Presenca`
--

CREATE TABLE IF NOT EXISTS `Presenca` (
  `idPresenca` int(11) NOT NULL AUTO_INCREMENT,
  `Data` varchar(45) NOT NULL,
  `Faltas` varchar(45) NOT NULL,
  `idUsuario_has_Turma` int(11) NOT NULL,
  `Turma_idTurma` int(11) NOT NULL,
  PRIMARY KEY (`idPresenca`,`idUsuario_has_Turma`,`Turma_idTurma`),
  KEY `fk_Presenca_Usuario_has_Turma1_idx` (`idUsuario_has_Turma`),
  KEY `fk_Presenca_Turma1_idx` (`Turma_idTurma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `Presenca`
--

INSERT INTO `Presenca` (`idPresenca`, `Data`, `Faltas`, `idUsuario_has_Turma`, `Turma_idTurma`) VALUES
(2, '19/07/2013', '2', 1, 1),
(3, '19/07/2013', '4', 2, 2),
(5, '08/02/2014', '3', 2, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Servicos`
--

CREATE TABLE IF NOT EXISTS `Servicos` (
  `idServicos` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` text,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`idServicos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `Servicos`
--

INSERT INTO `Servicos` (`idServicos`, `nome`, `descricao`, `valor`) VALUES
(1, 'Matricula', 'Matricula', 40),
(2, 'Xerox', 'Xerox (Valor precisa ser atualizado na hora de atribuir ao usuário)', 0.1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Turma`
--

CREATE TABLE IF NOT EXISTS `Turma` (
  `idTurma` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Descricao` varchar(45) DEFAULT NULL,
  `Ano` varchar(45) NOT NULL,
  `Semestre` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Disciplina_idDisciplina` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idTurma`,`Disciplina_idDisciplina`,`idUsuario`),
  KEY `fk_Turma_Disciplina1_idx` (`Disciplina_idDisciplina`),
  KEY `fk_Turma_Usuario1_idx` (`idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Fazendo dump de dados para tabela `Turma`
--

INSERT INTO `Turma` (`idTurma`, `Nome`, `Descricao`, `Ano`, `Semestre`, `Status`, `Disciplina_idDisciplina`, `idUsuario`) VALUES
(1, 'Analíse de Romanos', 'alguma coisa aqui', '2013', '2', 'ativo', 2, 2),
(2, 'Analíse de Atos', 'Alguma coisa', '2013', '2', 'ativo', 3, 3),
(3, 'I Coríntios', 'qlqr coisa', '2014', '1', 'ativo', 1, 3),
(4, 'Levítico e Hebreus', 'qlqr coisa', '2014', '2', 'ativo', 4, 2),
(5, 'Vida de Cristo', 'qlqr coisa', '2013', '1', 'ativo', 5, 3),
(6, 'Analise de Gênesis 1-11', '', '2014', '1', 'ativo', 6, 3),
(7, 'Introdução a Missões', '', '2014', '1', 'ativo', 10, 3),
(8, 'Introdução a Música', '', '2014', '1', 'ativo', 9, 3),
(9, 'Panorama do Antigo Testameno', '', '2014', '1', 'ativo', 8, 3),
(10, 'Panorama do Novo Testamento', '', '2014', '1', 'ativo', 7, 3),
(11, 'Teologia Elementar', '', '2014', '1', 'ativo', 11, 2),
(12, 'Grego I', '', '2014', '1', 'ativo', 13, 8),
(13, 'Hebraico I', '', '2014', '1', 'ativo', 14, 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(45) NOT NULL,
  `Endereco` text NOT NULL,
  `Bairro` varchar(100) NOT NULL,
  `CEP` varchar(45) DEFAULT NULL,
  `Telefone` varchar(45) NOT NULL,
  `Celular` varchar(45) DEFAULT NULL,
  `CPF` varchar(45) NOT NULL,
  `DataNascimento` varchar(20) NOT NULL,
  `NomeMae` varchar(100) NOT NULL,
  `NomePai` varchar(100) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(45) NOT NULL,
  `ConfirmaSenha` varchar(45) DEFAULT NULL,
  `Foto` text NOT NULL,
  `Tipo` char(1) NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Igreja_idIgreja` int(11) NOT NULL DEFAULT '0',
  `Curso_idCurso` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`,`Igreja_idIgreja`,`Curso_idCurso`),
  KEY `fk_Usuario_Igreja_idx` (`Igreja_idIgreja`),
  KEY `fk_Usuario_Curso1_idx` (`Curso_idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Fazendo dump de dados para tabela `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `Nome`, `Endereco`, `Bairro`, `CEP`, `Telefone`, `Celular`, `CPF`, `DataNascimento`, `NomeMae`, `NomePai`, `Email`, `Senha`, `ConfirmaSenha`, `Foto`, `Tipo`, `Status`, `Igreja_idIgreja`, `Curso_idCurso`) VALUES
(1, 'Admin', 'Wilson Rosado', 'Aeroporto', '59600-000', '84 3316-9958', NULL, '056.492.024-00', '02/04/1985', 'Eliene Maria Silva de Aquino', NULL, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'eliakim.jpg', '1', 'ativo', 1, 1),
(2, 'Ricardo Mateus', 'Mar do Leste', 'Pajuçara', '59.600-000', '84 0000-0000', '', '000.000.000-00', '10/10/1940', 'Adelaide', '', 'ricardo.mateus@gmail.com', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', '188445_455863147782584_2039102562_n.jpg', '2', 'ativo', 2, 1),
(3, 'Timoteo Franklin', 'Mar do Leste', 'Pajuçara', '59.600-000', '84 0000-0000', '', '000.000.000-00', '10/10/1940', 'Linda Franklin', 'Roberto Franklin', 'tim@gmail.com', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'prTimoteo.jpg', '2', 'ativo', 3, 1),
(4, 'Eliakim Aquino', 'Januario Pereira Pimenta', 'Aeroporto', '59.600-000', '84 3316-9958', '', '000.000.000-00', '02/04/1985', 'Eliene Aquino', 'Francisco Aquino', 'eliakim.aquino@gmail.com', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'PQAAAM4brXNt_7Gc2XgQyRMCPxqISAi_jTroof4VaWI5LK5NNNp6eBxQ0gyzXAki3NRrh_ReeHBtTugdGvBgXE4YEbgAm1T1UKCJlAIraWtuYH94_Y2SBLe6SoEG.jpg', '3', 'ativo', 1, 1),
(5, 'Kobe Bryant', 'Av. Mota Neto, 349', 'Nova Betânia', '59.600-000', '84 0000-0000', '', '000.000.000-00', '02/04/1985', 'Eliene Aquino', 'Francisco Aquino', 'kobe@gmail.com', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'kobe-jersey.jpg', '3', 'ativo', 2, 1),
(6, 'Magno Cabral', 'Igapó', 'Igapó', '59.600-000', '84 0000-0000', '', '000.000.000-00', '01/01/2014', 'Francisca', '', 'magno@gmail.com', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'magno.jpg', '3', 'ativo', 5, 1),
(8, 'Rubens Eduardo', 'Cidade Satelite', 'Cidade Satelite', '59.600-000', '84 0000-0000', '', '000.000.000-00', '16/03/1984', 'Francisca', '', 'rubens@gmail.com', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'rubens.jpg', '2', 'ativo', 3, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Usuario_has_Servicos`
--

CREATE TABLE IF NOT EXISTS `Usuario_has_Servicos` (
  `idUsuario_has_Servicos` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Servicos_idServicos` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  `mes` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario_has_Servicos`,`Usuario_idUsuario`,`Servicos_idServicos`),
  KEY `fk_Usuario_has_Servicos_Servicos1_idx` (`Servicos_idServicos`),
  KEY `fk_Usuario_has_Servicos_Usuario1_idx` (`Usuario_idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Fazendo dump de dados para tabela `Usuario_has_Servicos`
--

INSERT INTO `Usuario_has_Servicos` (`idUsuario_has_Servicos`, `Usuario_idUsuario`, `Servicos_idServicos`, `valor`, `mes`) VALUES
(15, 4, 1, 40, 7),
(16, 4, 2, 15, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Usuario_has_Turma`
--

CREATE TABLE IF NOT EXISTS `Usuario_has_Turma` (
  `idUsuario_has_Turma` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Turma_idTurma` int(11) NOT NULL,
  `Status` varchar(45) NOT NULL,
  PRIMARY KEY (`idUsuario_has_Turma`,`Usuario_idUsuario`,`Turma_idTurma`),
  KEY `fk_Usuario_has_Turma_Turma1_idx` (`Turma_idTurma`),
  KEY `fk_Usuario_has_Turma_Usuario1_idx` (`Usuario_idUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Fazendo dump de dados para tabela `Usuario_has_Turma`
--

INSERT INTO `Usuario_has_Turma` (`idUsuario_has_Turma`, `Usuario_idUsuario`, `Turma_idTurma`, `Status`) VALUES
(1, 4, 1, 'Cursando'),
(2, 4, 2, 'Aprovado'),
(3, 5, 2, 'Aprovado'),
(4, 5, 1, 'Cursando'),
(7, 3, 1, 'Cursando'),
(8, 1, 1, 'Cursando'),
(9, 1, 2, 'Cursando'),
(10, 1, 3, 'Cursando'),
(11, 1, 4, 'Cursando'),
(12, 1, 5, 'Cursando'),
(13, 1, 6, 'Cursando'),
(14, 1, 8, 'Cursando'),
(15, 1, 9, 'Cursando'),
(16, 1, 10, 'Cursando'),
(17, 1, 7, 'Cursando'),
(18, 1, 11, 'Cursando'),
(19, 6, 12, 'Cursando'),
(20, 6, 13, 'Cursando'),
(21, 5, 12, 'Cursando'),
(22, 5, 13, 'Cursando'),
(23, 4, 12, 'Cursando');

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `Arquivos`
--
ALTER TABLE `Arquivos`
  ADD CONSTRAINT `fk_Arquivos_Disciplina1` FOREIGN KEY (`Disciplina_idDisciplina`) REFERENCES `Disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Disciplina`
--
ALTER TABLE `Disciplina`
  ADD CONSTRAINT `fk_Disciplina_Credito1` FOREIGN KEY (`Credito_idCredito`) REFERENCES `Credito` (`idCredito`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Faturas`
--
ALTER TABLE `Faturas`
  ADD CONSTRAINT `fk_Faturas_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Nota`
--
ALTER TABLE `Nota`
  ADD CONSTRAINT `fk_Nota_Turma1` FOREIGN KEY (`Turma_idTurma`) REFERENCES `Turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Nota_Usuario_has_Turma1` FOREIGN KEY (`idUsuario_has_Turma`) REFERENCES `Usuario_has_Turma` (`idUsuario_has_Turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Pagamento`
--
ALTER TABLE `Pagamento`
  ADD CONSTRAINT `fk_Pagamento_Faturas1` FOREIGN KEY (`Faturas_idFatura`) REFERENCES `Faturas` (`idFatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Presenca`
--
ALTER TABLE `Presenca`
  ADD CONSTRAINT `fk_Presenca_Turma1` FOREIGN KEY (`Turma_idTurma`) REFERENCES `Turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Presenca_Usuario_has_Turma1` FOREIGN KEY (`idUsuario_has_Turma`) REFERENCES `Usuario_has_Turma` (`idUsuario_has_Turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Turma`
--
ALTER TABLE `Turma`
  ADD CONSTRAINT `fk_Turma_Disciplina1` FOREIGN KEY (`Disciplina_idDisciplina`) REFERENCES `Disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Turma_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_Usuario_Curso1` FOREIGN KEY (`Curso_idCurso`) REFERENCES `Curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_Igreja` FOREIGN KEY (`Igreja_idIgreja`) REFERENCES `Igreja` (`idIgreja`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Usuario_has_Servicos`
--
ALTER TABLE `Usuario_has_Servicos`
  ADD CONSTRAINT `fk_Usuario_has_Servicos_Servicos1` FOREIGN KEY (`Servicos_idServicos`) REFERENCES `Servicos` (`idServicos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_has_Servicos_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Usuario_has_Turma`
--
ALTER TABLE `Usuario_has_Turma`
  ADD CONSTRAINT `fk_Usuario_has_Turma_Turma1` FOREIGN KEY (`Turma_idTurma`) REFERENCES `Turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_has_Turma_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;