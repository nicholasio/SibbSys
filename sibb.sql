SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `sibb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `sibb` ;

-- -----------------------------------------------------
-- Table `sibb`.`Disciplina`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibb`.`Disciplina` (
  `idDisciplina` INT NOT NULL AUTO_INCREMENT ,
  `Disciplina` VARCHAR(100) NOT NULL ,
  `ValorCred` FLOAT NOT NULL ,
  `QntdCred` VARCHAR(45) NOT NULL ,
  `Status` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idDisciplina`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibb`.`Igreja`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibb`.`Igreja` (
  `idIgreja` INT NOT NULL AUTO_INCREMENT ,
  `Igreja` TEXT NOT NULL ,
  `Endereco` TEXT NOT NULL ,
  `Bairro` VARCHAR(100) NOT NULL ,
  `CEP` VARCHAR(45) NULL ,
  `Telefone` VARCHAR(45) NULL ,
  `Pastor` VARCHAR(45) NOT NULL ,
  `Status` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idIgreja`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibb`.`Curso`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibb`.`Curso` (
  `idCurso` INT NOT NULL AUTO_INCREMENT ,
  `Nome` TEXT NOT NULL ,
  `Duracao` VARCHAR(45) NOT NULL ,
  `Descricao` TEXT NOT NULL ,
  `Status` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idCurso`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibb`.`Usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibb`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(45) NOT NULL ,
  `Endereco` TEXT NOT NULL ,
  `Bairro` VARCHAR(100) NOT NULL ,
  `CEP` VARCHAR(45) NULL ,
  `Telefone` VARCHAR(45) NOT NULL ,
  `Celular` VARCHAR(45) NULL ,
  `CPF` VARCHAR(45) NOT NULL ,
  `RG` VARCHAR(45) NOT NULL ,
  `DataNascimento` VARCHAR(20) NOT NULL ,
  `NomeMae` VARCHAR(100) NOT NULL ,
  `NomePai` VARCHAR(100) NULL ,
  `Email` VARCHAR(100) NOT NULL ,
  `Senha` VARCHAR(45) NOT NULL ,
  `ConfirmaSenha` VARCHAR(45) NOT NULL ,
  `Foto` TEXT NOT NULL ,
  `Tipo` CHAR NOT NULL ,
  `Status` VARCHAR(45) NOT NULL ,
  `Igreja_idIgreja` INT NOT NULL ,
  `Curso_idCurso` INT NOT NULL ,
  PRIMARY KEY (`idUsuario`, `Igreja_idIgreja`, `Curso_idCurso`) ,
  INDEX `fk_Usuario_Igreja` (`Igreja_idIgreja` ASC) ,
  INDEX `fk_Usuario_Curso1` (`Curso_idCurso` ASC) ,
  CONSTRAINT `fk_Usuario_Igreja`
    FOREIGN KEY (`Igreja_idIgreja` )
    REFERENCES `sibb`.`Igreja` (`idIgreja` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Curso1`
    FOREIGN KEY (`Curso_idCurso` )
    REFERENCES `sibb`.`Curso` (`idCurso` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibb`.`Turma`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibb`.`Turma` (
  `idTurma` INT NOT NULL ,
  `Nome` VARCHAR(45) NOT NULL ,
  `Descricao` VARCHAR(45) NOT NULL ,
  `Ano` VARCHAR(45) NOT NULL ,
  `Semestre` VARCHAR(45) NOT NULL ,
  `Status` VARCHAR(45) NOT NULL ,
  `Disciplina_idDisciplina` INT NOT NULL ,
  `Usuario_idUsuario` INT NOT NULL ,
  PRIMARY KEY (`idTurma`, `Disciplina_idDisciplina`, `Usuario_idUsuario`) ,
  INDEX `fk_Turma_Disciplina1` (`Disciplina_idDisciplina` ASC) ,
  INDEX `fk_Turma_Usuario1` (`Usuario_idUsuario` ASC) ,
  CONSTRAINT `fk_Turma_Disciplina1`
    FOREIGN KEY (`Disciplina_idDisciplina` )
    REFERENCES `sibb`.`Disciplina` (`idDisciplina` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Turma_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario` )
    REFERENCES `sibb`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibb`.`Usuario_has_Turma`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibb`.`Usuario_has_Turma` (
  `idUsuario_has_Turma` INT NOT NULL AUTO_INCREMENT ,
  `Usuario_idUsuario` INT NOT NULL ,
  `Turma_idTurma` INT NOT NULL ,
  `Status` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idUsuario_has_Turma`, `Usuario_idUsuario`, `Turma_idTurma`) ,
  INDEX `fk_Usuario_has_Turma_Turma1` (`Turma_idTurma` ASC) ,
  INDEX `fk_Usuario_has_Turma_Usuario1` (`Usuario_idUsuario` ASC) ,
  CONSTRAINT `fk_Usuario_has_Turma_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario` )
    REFERENCES `sibb`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Turma_Turma1`
    FOREIGN KEY (`Turma_idTurma` )
    REFERENCES `sibb`.`Turma` (`idTurma` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibb`.`Nota`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibb`.`Nota` (
  `idNota` INT NOT NULL AUTO_INCREMENT ,
  `Unidade` INT NOT NULL ,
  `Nota` FLOAT NOT NULL ,
  `Status` VARCHAR(45) NOT NULL ,
  `idUsuario_has_Turma` INT NOT NULL ,
  PRIMARY KEY (`idNota`, `idUsuario_has_Turma`) ,
  INDEX `fk_Nota_Usuario_has_Turma1` (`idUsuario_has_Turma` ASC) ,
  CONSTRAINT `fk_Nota_Usuario_has_Turma1`
    FOREIGN KEY (`idUsuario_has_Turma` )
    REFERENCES `sibb`.`Usuario_has_Turma` (`idUsuario_has_Turma` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sibb`.`Presenca`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sibb`.`Presenca` (
  `idPresenca` INT NOT NULL AUTO_INCREMENT ,
  `Data` DATE NOT NULL ,
  `Faltas` VARCHAR(45) NOT NULL ,
  `idUsuario_has_Turma` INT NOT NULL ,
  PRIMARY KEY (`idPresenca`, `idUsuario_has_Turma`) ,
  INDEX `fk_Presenca_Usuario_has_Turma1` (`idUsuario_has_Turma` ASC) ,
  CONSTRAINT `fk_Presenca_Usuario_has_Turma1`
    FOREIGN KEY (`idUsuario_has_Turma` )
    REFERENCES `sibb`.`Usuario_has_Turma` (`idUsuario_has_Turma` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
