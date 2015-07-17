-- MySQL Script generated by MySQL Workbench
-- 07/17/15 11:02:44
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydbase
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydbase
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydbase` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydbase` ;

-- -----------------------------------------------------
-- Table `mydbase`.`adm`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydbase`.`adm` (
  `idAdm` 			INT 			NOT NULL AUTO_INCREMENT COMMENT 'Identificador databela adm',
  `login` 			VARCHAR(14) 	NOT NULL 				COMMENT 'Login (cpf) do usuario adminiatrador no sistema',
  `senha` 			VARCHAR(65) 	NOT NULL 				COMMENT 'Senha do usuario administrador no sistema',
  `ultimo_acesso` 	DATE 			NULL 					COMMENT 'Data do ultimo acesso do administrador no sistema',
  `status` 			CHAR 			NULL 					COMMENT 'Status do administrador. A = ATIVO, I = INATIVO',
  `nome` 			VARCHAR(60) 	NULL 					COMMENT 'Nome do administrador',
  PRIMARY KEY (`idAdm`)  									COMMENT '')
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydbase`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydbase`.`categoria` (
  `idCategoria` INT 		NOT NULL AUTO_INCREMENT COMMENT 'Identificador da categoria no sistema',
  `nome` 		VARCHAR(60) NULL 					COMMENT 'Nome da categoria',
  PRIMARY KEY (`idCategoria`)  						COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydbase`.`subCategoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydbase`.`subCategoria` (
  `idSubCategoria` 	INT 		NOT NULL AUTO_INCREMENT 		COMMENT 'Identificador da sub categoria no sistema',
  `nome` 			VARCHAR(60) NULL 							COMMENT 'Nome da sub categoria',
  `id_categoria` 	INT 		NOT NULL 						COMMENT 'Chave estrangeira da cateogira pai',
  PRIMARY KEY (`idSubCategoria`)  								COMMENT '',
  INDEX `fk_subCategoria_categoria1_idx` (`id_categoria` ASC)  	COMMENT '',
  CONSTRAINT `fk_subCategoria_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `mydbase`.`categoria` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydbase`.`arquivos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydbase`.`arquivos` (
  `idArquivos`		INT 			NOT NULL AUTO_INCREMENT 	COMMENT 'Identificador dos arquivos no sistema',
  `edicao` 			FLOAT 			NULL 						COMMENT 'Numero da edicao do arquivo',
  `titulo` 			VARCHAR(60) 	NULL 						COMMENT 'Titulo do arquivo',
  `descricao` 		TEXT 			NULL 						COMMENT 'Conteudo do arquivo',
  `anexo` 			VARCHAR(128) 	NULL 						COMMENT 'Link de acesso ao anexo do arquivo',
  `certificado` 	VARCHAR(128) 	NULL 						COMMENT 'Certificado digital',
  `dataHora` 		DATETIME 		NULL 						COMMENT 'Data e hora definidos pelo administrador',
  `dataHoraCriacao` DATETIME 		NULL 						COMMENT 'Data e hora da criacao do arquivo no sistema',
  `id_adm` 			INT 			NOT NULL 					COMMENT 'Chave estrangeira do administrador no sistema ',
  `id_categoria` 	INT 			NOT NULL 					COMMENT 'Chave estrangeira da categoria',
  `id_subCategoria` INT 			NOT NULL 					COMMENT 'Chave estrangeira da sub categoria',
  `status` 			CHAR 			NULL 						COMMENT 'Status do arquivo no sistema. A = ATIVO, I = INATIVO ',
  PRIMARY KEY (`idArquivos`)  									COMMENT '',
  INDEX `fk_arquivos_adm1_idx` (`id_adm` ASC)  					COMMENT '',
  INDEX `fk_arquivos_categoria1_idx` (`id_categoria` ASC)  		COMMENT '',
  INDEX `fk_arquivos_subCategoria1_idx` (`id_subCategoria` ASC) COMMENT '',
  CONSTRAINT `fk_arquivos_adm1`
    FOREIGN KEY (`id_adm`)
    REFERENCES `mydbase`.`adm` (`idAdm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_arquivos_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `mydbase`.`categoria` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_arquivos_subCategoria1`
    FOREIGN KEY (`id_subCategoria`)
    REFERENCES `mydbase`.`subCategoria` (`idSubCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydbase`.`configuracoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydbase`.`configuracoes` (
  `idConfig` 	INT 			NOT NULL AUTO_INCREMENT COMMENT 'Identificador da configuracao',
  `nome` 		VARCHAR(128) 	NULL 					COMMENT '',
  `endereco` 	VARCHAR(128) 	NULL 					COMMENT '',
  `bairro` 		VARCHAR(45) 	NULL 					COMMENT '',
  `numero` 		VARCHAR(10) 	NULL 					COMMENT '',
  `cep` 		VARCHAR(10) 	NULL 					COMMENT '',
  `email` 		VARCHAR(100) 	NULL 					COMMENT '',
  `cnpj` 		VARCHAR(45) 	NULL 					COMMENT '',
  `logo` 		VARCHAR(128) 	NULL 					COMMENT '',
  PRIMARY KEY (`idConfig`)  							COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydbase`.`log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydbase`.`log` (
  `idLog` 		INT 			NOT NULL 			COMMENT 'Identificador do Log no sistema',
  `data` 		DATETIME 		NULL 				COMMENT 'Data e hora da criacao do log',
  `alteracao` 	VARCHAR(100) 	NULL 				COMMENT 'Texto informando a alteracao feita',
  `id_adm` 		INT 			NOT NULL 			COMMENT 'Chave estrangeira do administrador',
  `id_arquivos` INT 			NOT NULL 			COMMENT 'Chave estrangeire do arquivo',
  PRIMARY KEY (`idLog`)  							COMMENT '',
  INDEX `fk_log_adm1_idx` (`id_adm` ASC)  			COMMENT '',
  INDEX `fk_log_arquivos1_idx` (`id_arquivos` ASC)  COMMENT '',
  CONSTRAINT `fk_log_adm1`
    FOREIGN KEY (`id_adm`)
    REFERENCES `mydbase`.`adm` (`idAdm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_arquivos1`
    FOREIGN KEY (`id_arquivos`)
    REFERENCES `mydbase`.`arquivos` (`idArquivos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydbase`.`logConfig`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydbase`.`logConfig` (
  `idLogConfig` 	INT 			NOT NULL 				COMMENT 'Identificador do loCOnfig no sistema',
  `data` 			DATETIME 		NULL 					COMMENT 'Data e hora da criacao do log',
  `alteracao` 		VARCHAR(100) 	NULL 					COMMENT 'Texto informando a alteracao feita',
  `id_config` 		INT 			NOT NULL 				COMMENT 'Chave estrangeira do Config',
  `id_adm` 			INT 			NOT NULL 				COMMENT 'Chave estrangeira do administrador',
  PRIMARY KEY (`idLogConfig`)  								COMMENT '',
  INDEX `fk_logConfig_configuracoes1_idx` (`id_config` ASC) COMMENT '',
  INDEX `fk_logConfig_adm1_idx` (`id_adm` ASC)  			COMMENT '',
  CONSTRAINT `fk_logConfig_configuracoes1`
    FOREIGN KEY (`id_config`)
    REFERENCES `mydbase`.`configuracoes` (`idConfig`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_logConfig_adm1`
    FOREIGN KEY (`id_adm`)
    REFERENCES `mydbase`.`adm` (`idAdm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- Create user for all tables
grant all ON mydbase.* TO 'user_mydbase' identified by 'dataBP@ss';