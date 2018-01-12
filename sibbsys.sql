-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 26/01/2015 às 23:33
-- Versão do servidor: 5.5.41-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.5

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Estrutura para tabela `Curso`
--

CREATE TABLE IF NOT EXISTS `Curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` text NOT NULL,
  `Duracao` varchar(45) NOT NULL,
  `Descricao` text,
  `Status` varchar(45) NOT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `Curso`
--

INSERT INTO `Curso` (`idCurso`, `Nome`, `Duracao`, `Descricao`, `Status`) VALUES
(1, 'Bíblico Geral', '2', 'nada', 'ativo');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Disciplina`
--

CREATE TABLE IF NOT EXISTS `Disciplina` (
  `idDisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `Disciplina` varchar(100) NOT NULL,
  `QntdCred` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL,
  PRIMARY KEY (`idDisciplina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Faturas`
--

CREATE TABLE IF NOT EXISTS `Faturas` (
  `idFatura` int(11) NOT NULL AUTO_INCREMENT,
  `valorFatura` float DEFAULT NULL,
  `desconto` int(11) DEFAULT '0',
  `mes` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idFatura`,`Usuario_idUsuario`),
  KEY `fk_Faturas_Usuario1_idx` (`Usuario_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Faturas_has_Debitos`
--

CREATE TABLE IF NOT EXISTS `Faturas_has_Debitos` (
  `idFatura_has_Debitos` int(11) NOT NULL AUTO_INCREMENT,
  `Faturas_idFatura` int(11) NOT NULL,
  `Debitos_idDebitos` int(11) NOT NULL,
  PRIMARY KEY (`idFatura_has_Debitos`,`Faturas_idFatura`,`Debitos_idDebitos`),
  KEY `fk_Faturas_has_Debitos_Debitos1_idx` (`Debitos_idDebitos`),
  KEY `fk_Faturas_has_Debitos_Faturas1_idx` (`Faturas_idFatura`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `Igreja`
--

INSERT INTO `Igreja` (`idIgreja`, `Igreja`, `Endereco`, `Bairro`, `CEP`, `Telefone`, `Pastor`, `Status`) VALUES
(1, 'Nenhuma', 'Nenhuma', 'Nenhum', '00.000-000', '00 0000-0000', 'NENHUM', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Nota`
--

CREATE TABLE IF NOT EXISTS `Nota` (
  `idNota` int(11) NOT NULL AUTO_INCREMENT,
  `Unit1` varchar(10) DEFAULT NULL,
  `Unit2` varchar(10) DEFAULT NULL,
  `Unit3` varchar(10) DEFAULT NULL,
  `idUsuario_has_Turma` int(11) NOT NULL,
  `Turma_idTurma` int(11) NOT NULL,
  PRIMARY KEY (`idNota`,`idUsuario_has_Turma`,`Turma_idTurma`),
  KEY `fk_Nota_Usuario_has_Turma1_idx` (`idUsuario_has_Turma`),
  KEY `fk_Nota_Turma1_idx` (`Turma_idTurma`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `Nome`, `Endereco`, `Bairro`, `CEP`, `Telefone`, `Celular`, `CPF`, `DataNascimento`, `NomeMae`, `NomePai`, `Email`, `Senha`, `ConfirmaSenha`, `Foto`, `Tipo`, `Status`, `Igreja_idIgreja`, `Curso_idCurso`) VALUES
(1, 'Admin', 'Nenhum', 'nenhum', '00.000-000', '00 0000-0000', NULL, '000.000.000-00', '00/00/0000', 'Nenhum', NULL, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'profile.jpg', '1', 'ativo', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Usuario_has_Servicos`
--

CREATE TABLE IF NOT EXISTS `Usuario_has_Servicos` (
  `idUsuario_has_Servicos` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Servicos_idServicos` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  `ano` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario_has_Servicos`,`Usuario_idUsuario`,`Servicos_idServicos`),
  KEY `fk_Usuario_has_Servicos_Servicos1_idx` (`Servicos_idServicos`),
  KEY `fk_Usuario_has_Servicos_Usuario1_idx` (`Usuario_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `Arquivos`
--
ALTER TABLE `Arquivos`
  ADD CONSTRAINT `fk_Arquivos_Disciplina1` FOREIGN KEY (`Disciplina_idDisciplina`) REFERENCES `Disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Faturas`
--
ALTER TABLE `Faturas`
  ADD CONSTRAINT `fk_Faturas_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Faturas_has_Debitos`
--
ALTER TABLE `Faturas_has_Debitos`
  ADD CONSTRAINT `fk_Faturas_has_Debitos_Debitos1` FOREIGN KEY (`Debitos_idDebitos`) REFERENCES `Debitos` (`idDebitos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Faturas_has_Debitos_Faturas1` FOREIGN KEY (`Faturas_idFatura`) REFERENCES `Faturas` (`idFatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
