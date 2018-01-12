-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 27-Jan-2015 às 02:27
-- Versão do servidor: 5.5.34-0ubuntu0.13.10.1
-- versão do PHP: 5.5.3-1ubuntu2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `sibb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Arquivos`
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
-- Estrutura da tabela `Configs`
--

CREATE TABLE IF NOT EXISTS `Configs` (
  `idConfigs` int(11) NOT NULL,
  `Meta_Key` text NOT NULL,
  `Meta_Value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `Configs`
--

INSERT INTO `Configs` (`idConfigs`, `Meta_Key`, `Meta_Value`) VALUES
(0, 'valor_credito', '16.50'),
(0, 'dia_debito', '25'),
(0, 'dia_fatura', '2'),
(0, 'ano_atual', '2015'),
(0, 'semestre_atual', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Curso`
--

CREATE TABLE IF NOT EXISTS `Curso` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` text NOT NULL,
  `Duracao` varchar(45) NOT NULL,
  `Descricao` text,
  `Status` varchar(45) NOT NULL,
  PRIMARY KEY (`idCurso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `Curso`
--

INSERT INTO `Curso` (`idCurso`, `Nome`, `Duracao`, `Descricao`, `Status`) VALUES
(1, 'Bíblico Geral', '2 anos', 'Estimular o aluno a descobrir e/ou desenvolver seus dons e talentos preparando-o para o ministério prático na igreja local.', 'ativo'),
(2, 'Bacharel em Teologia', '4 anos', 'Estimular o aluno a desenvolver o seu dom de Pastor-Mestre, preparando-o e equipando-o para o ministério prático na igreja; com ênfase nos estudos bíblicos e teológicos e na exegese.', 'ativo'),
(3, 'Bacharel em Educação Cristã', '4 anos', 'Estimular o aluno a desenvolver o seu dom de ensino e/ou administração cristã, preparando-o e equipando-o para o ministério prático na igreja, nas escolas bíblicas, teológicas e seculares e/ou campo missionário.', 'ativo'),
(4, 'Bacharel em Missões', '4 anos', 'Estimular e capacitar acadêmica e metodologicamente o aluno, de ambos os sexos, para o exercício do ministério de missões nacionais e transculturais.', 'ativo'),
(5, 'Pastoral (Teológico)', '4 anos', 'Estimular o aluno a desenvolver o seu dom de ensino e/ou administração, preparando-o e equipando-o para o ministério prático na igreja e/ou campo missionário.', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Debitos`
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
-- Estrutura da tabela `Disciplina`
--

CREATE TABLE IF NOT EXISTS `Disciplina` (
  `idDisciplina` int(11) NOT NULL AUTO_INCREMENT,
  `Disciplina` varchar(100) NOT NULL,
  `QntdCred` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL,
  PRIMARY KEY (`idDisciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Extraindo dados da tabela `Disciplina`
--

INSERT INTO `Disciplina` (`idDisciplina`, `Disciplina`, `QntdCred`, `Status`) VALUES
(1, 'Panorama do Antigo Testamento I', '4', 'ativo'),
(2, 'Panorama do Antigo Testamento II', '4', 'ativo'),
(3, 'Análise de I Coríntios', '2', 'ativo'),
(4, 'Oratória', '2', 'ativo'),
(5, 'Métodos de Estudo Bíblico', '3', 'ativo'),
(6, 'Vida de Cristo', '2', 'ativo'),
(7, 'Metodólogia e Técnica de Pesquisa', '2', 'ativo'),
(8, 'Evangelismo Pessoal', '2', 'ativo'),
(9, 'Discipulado Bíblico', '2', 'ativo'),
(10, 'Tecnologia e Comunicação', '2', 'ativo'),
(11, 'Aconselhamento', '2', 'ativo'),
(12, 'Análise de Romanos', '2', 'ativo'),
(13, 'Introdução à Missões', '3', 'ativo'),
(14, 'Culturas e Costumes Bíblicos', '2', 'ativo'),
(15, 'Introdução à Música', '2', 'ativo'),
(16, 'Análise das Epístolas Pastorais', '2', 'ativo'),
(17, 'Análise de Gálatas', '2', 'ativo'),
(18, 'Hermenêutica', '2', 'ativo'),
(19, 'Panorama do Novo Testamento I', '4', 'ativo'),
(20, 'Panorama do Novo Testamento II', '4', 'ativo'),
(21, 'Teologia Elementar', '2', 'ativo'),
(22, 'Religiões Mundiais', '2', 'ativo'),
(23, 'Técnica de Ensino Bíblico', '2', 'ativo'),
(24, 'Homilética I', '2', 'ativo'),
(25, 'História e Distintivo dos Batistas', '2', 'ativo'),
(26, 'Ética Cristã', '2', 'ativo'),
(27, 'Análise de Atos', '2', 'ativo'),
(28, 'Geografia Bíblica', '2', 'ativo'),
(29, 'Lar Cristão', '2', 'ativo'),
(30, 'Análise de Gênesis 1-11', '2', 'ativo'),
(31, 'Admin. de Departamento Eclesiástico I', '2', 'ativo'),
(32, 'Análise de Levítico e Hebreus', '2', 'ativo'),
(33, 'Teologia Sistemática I', '4', 'ativo'),
(34, 'Teologia Sistemática II', '4', 'ativo'),
(35, 'Teologia Sistemática III', '4', 'ativo'),
(36, 'Teologia Sistemática IV', '4', 'ativo'),
(37, 'Português I', '2', 'ativo'),
(38, 'Português II', '2', 'ativo'),
(39, 'Dispensacionalismo', '2', 'ativo'),
(40, 'Arqueologia Bíblica', '2', 'ativo'),
(41, 'Grego I', '3', 'ativo'),
(42, 'Grego II', '3', 'ativo'),
(43, 'Grego III', '3', 'ativo'),
(44, 'Grego IV', '3', 'ativo'),
(45, 'Hebraico I', '2', 'ativo'),
(46, 'Hebraico II', '2', 'ativo'),
(47, 'Análise do Antigo Testamento', '2', 'ativo'),
(48, 'Monografia I', '1', 'ativo'),
(49, 'Monografia II', '1', 'ativo'),
(50, 'Análise de Daniel e Apocalipse', '2', 'ativo'),
(51, 'Música na Igreja', '2', 'ativo'),
(52, 'Introdução a Educação Cristã', '2', 'ativo'),
(53, 'Homilética II', '2', 'ativo'),
(54, 'Teologia Contemporânea', '2', 'ativo'),
(55, 'História Eclesiástica I', '3', 'ativo'),
(56, 'Teologia Bíblica do AT', '2', 'ativo'),
(57, 'Análise do Novo Testamento', '2', 'ativo'),
(58, 'História Eclesiástica II', '3', 'ativo'),
(59, 'Filosofia e Fé Cristã', '2', 'ativo'),
(60, 'Teologia Pastoral', '2', 'ativo'),
(61, 'Teologia Bíblica do NT', '2', 'ativo'),
(62, 'Arquivo e Biblioteca', '2', 'ativo'),
(63, 'Didática', '2', 'ativo'),
(64, 'Técnica de Áudio Visuais', '2', 'ativo'),
(65, 'Mulher Cristã', '2', 'ativo'),
(66, 'Ed. C. Crianças e Pré-Adultos', '4', 'ativo'),
(67, 'Filosofia Cristã da Educação', '2', 'ativo'),
(68, 'Departamento de Educação Cristã', '3', 'ativo'),
(69, 'Obreira Cristã', '2', 'ativo'),
(70, 'Educação Cristã de Adultos', '3', 'ativo'),
(71, 'Admin. de Departamento Eclesiástico II', '2', 'ativo'),
(72, 'Teologia de Missões', '2', 'ativo'),
(73, 'Vida Missionária', '2', 'ativo'),
(74, 'Cultura e Costumes', '2', 'ativo'),
(75, 'Missões Urbanas e Rurais', '2', 'ativo'),
(76, 'Implantação e Crescimento de Igrejas', '2', 'ativo'),
(77, 'Comunicação Transcultural', '2', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Faturas`
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
-- Estrutura da tabela `Faturas_has_Debitos`
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
-- Estrutura da tabela `Igreja`
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
-- Extraindo dados da tabela `Igreja`
--

INSERT INTO `Igreja` (`idIgreja`, `Igreja`, `Endereco`, `Bairro`, `CEP`, `Telefone`, `Pastor`, `Status`) VALUES
(1, 'Batista Regular Central de Mossoró', 'Av. Mota Neto, 349', 'Nova Betânia', '59.600-000', '84 9668-7406', 'Charles Bronson Aquino do Nascimento', 'ativo'),
(2, 'Batista do Alto', 'Seny Fialho', 'Pajuçara', '59.600-000', '84 8810-3129', 'Almir Cocentino Júnior', 'ativo'),
(3, 'Batista Regular de Igapó', 'Rua Izabel de Bento Lima', 'Igapó', '59.600-000', '84 3614-7415', 'José Erinaldo da Costa', 'ativo'),
(4, 'Batista Fundamentalista de Nova Cruz', 'Rua Industrial José de Brito', 'Alto de São Sebastião', '59.215-000', '84 9128-6709', 'Júlio Tavares de Sousa', 'ativo'),
(5, 'Batista Regular Ebenezer', 'Rua Iná Brito, 288', 'Parque Santa Rosa - Fortaleza/CE', '60.763-005', '85 3296-7754', 'Lidenir Vaz Bragança', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Nota`
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
-- Estrutura da tabela `Pagamento`
--

CREATE TABLE IF NOT EXISTS `Pagamento` (
  `idPagamento` int(11) NOT NULL AUTO_INCREMENT,
  `valorPagamento` float NOT NULL,
  `dataPagamento` datetime DEFAULT NULL,
  `Faturas_idFatura` int(11) NOT NULL,
  `Descricao` text NOT NULL,
  PRIMARY KEY (`idPagamento`,`Faturas_idFatura`),
  KEY `fk_Pagamento_Faturas1_idx` (`Faturas_idFatura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Presenca`
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
-- Estrutura da tabela `Servicos`
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
-- Estrutura da tabela `Turma`
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
-- Estrutura da tabela `Usuario`
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
-- Extraindo dados da tabela `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `Nome`, `Endereco`, `Bairro`, `CEP`, `Telefone`, `Celular`, `CPF`, `DataNascimento`, `NomeMae`, `NomePai`, `Email`, `Senha`, `ConfirmaSenha`, `Foto`, `Tipo`, `Status`, `Igreja_idIgreja`, `Curso_idCurso`) VALUES
(1, 'Admin', 'Wilson Rosado', 'Aeroporto', '59600-000', '84 3316-9958', NULL, '056.492.024-00', '02/04/1985', 'Eliene Maria Silva de Aquino', NULL, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'profile.jpg', '1', 'ativo', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Usuario_has_Servicos`
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
-- Estrutura da tabela `Usuario_has_Turma`
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
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `Arquivos`
--
ALTER TABLE `Arquivos`
  ADD CONSTRAINT `fk_Arquivos_Disciplina1` FOREIGN KEY (`Disciplina_idDisciplina`) REFERENCES `Disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Faturas`
--
ALTER TABLE `Faturas`
  ADD CONSTRAINT `fk_Faturas_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Faturas_has_Debitos`
--
ALTER TABLE `Faturas_has_Debitos`
  ADD CONSTRAINT `fk_Faturas_has_Debitos_Debitos1` FOREIGN KEY (`Debitos_idDebitos`) REFERENCES `Debitos` (`idDebitos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Faturas_has_Debitos_Faturas1` FOREIGN KEY (`Faturas_idFatura`) REFERENCES `Faturas` (`idFatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Nota`
--
ALTER TABLE `Nota`
  ADD CONSTRAINT `fk_Nota_Turma1` FOREIGN KEY (`Turma_idTurma`) REFERENCES `Turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Nota_Usuario_has_Turma1` FOREIGN KEY (`idUsuario_has_Turma`) REFERENCES `Usuario_has_Turma` (`idUsuario_has_Turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Pagamento`
--
ALTER TABLE `Pagamento`
  ADD CONSTRAINT `fk_Pagamento_Faturas1` FOREIGN KEY (`Faturas_idFatura`) REFERENCES `Faturas` (`idFatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Presenca`
--
ALTER TABLE `Presenca`
  ADD CONSTRAINT `fk_Presenca_Turma1` FOREIGN KEY (`Turma_idTurma`) REFERENCES `Turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Presenca_Usuario_has_Turma1` FOREIGN KEY (`idUsuario_has_Turma`) REFERENCES `Usuario_has_Turma` (`idUsuario_has_Turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Turma`
--
ALTER TABLE `Turma`
  ADD CONSTRAINT `fk_Turma_Disciplina1` FOREIGN KEY (`Disciplina_idDisciplina`) REFERENCES `Disciplina` (`idDisciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Turma_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_Usuario_Curso1` FOREIGN KEY (`Curso_idCurso`) REFERENCES `Curso` (`idCurso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_Igreja` FOREIGN KEY (`Igreja_idIgreja`) REFERENCES `Igreja` (`idIgreja`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Usuario_has_Servicos`
--
ALTER TABLE `Usuario_has_Servicos`
  ADD CONSTRAINT `fk_Usuario_has_Servicos_Servicos1` FOREIGN KEY (`Servicos_idServicos`) REFERENCES `Servicos` (`idServicos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_has_Servicos_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `Usuario_has_Turma`
--
ALTER TABLE `Usuario_has_Turma`
  ADD CONSTRAINT `fk_Usuario_has_Turma_Turma1` FOREIGN KEY (`Turma_idTurma`) REFERENCES `Turma` (`idTurma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_has_Turma_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
