-- MySQL Script generated by MySQL Workbench
-- 07/17/15 11:02:44
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

-- -----------------------------------------------------
-- Table `adms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adms` (
  `idAdm` 			INT 			NOT NULL AUTO_INCREMENT COMMENT 'Identificador databela adm',
  `login` 			VARCHAR(14) 	NOT NULL 				COMMENT 'Login (cpf) do usuario adminiatrador no sistema',
  `senha` 			VARCHAR(65) 	NOT NULL 				COMMENT 'Senha do usuario administrador no sistema',
  `ultimo_acesso` 	DATE 			NULL 					COMMENT 'Data do ultimo acesso do administrador no sistema',
  `status` 			CHAR 			NULL 					COMMENT 'Status do administrador. A = ATIVO, I = INATIVO',
  `nome` 			VARCHAR(60) 	NULL 					COMMENT 'Nome do administrador',
  PRIMARY KEY (`idAdm`)  									COMMENT '')
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `categorias` (
  `idCategoria` INT 		NOT NULL AUTO_INCREMENT COMMENT 'Identificador da categoria no sistema',
  `nome` 		VARCHAR(60) NULL 					COMMENT 'Nome da categoria',
  PRIMARY KEY (`idCategoria`)  						COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sub_categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sub_categorias` (
  `idSubCategoria` 	INT 		NOT NULL AUTO_INCREMENT 		COMMENT 'Identificador da sub categoria no sistema',
  `nome` 			VARCHAR(60) NULL 							COMMENT 'Nome da sub categoria',
  `id_categoria` 	INT 		NOT NULL 						COMMENT 'Chave estrangeira da cateogira pai',
  PRIMARY KEY (`idSubCategoria`)  								COMMENT '',
  INDEX `fk_subCategoria_categoria1_idx` (`id_categoria` ASC)  	COMMENT '',
  CONSTRAINT `fk_subCategoria_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `categorias` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `arquivos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `arquivos` (
  `idArquivo`		INT 			NOT NULL AUTO_INCREMENT 	COMMENT 'Identificador dos arquivos no sistema',
  `edicao` 			FLOAT 			NULL 						COMMENT 'Numero da edicao do arquivo',
  `titulo` 			VARCHAR(60) 	NULL 						COMMENT 'Titulo do arquivo',
  `descricao` 		TEXT 			NULL 						COMMENT 'Conteudo do arquivo',
  `anexo` 			VARCHAR(128) 	NULL 						COMMENT 'Link de acesso ao anexo do arquivo',
  `certificado` 	VARCHAR(128) 	NULL 						COMMENT 'Certificado digital',
  `dataHora` 		DATETIME 		NULL 						COMMENT 'Data e hora definidos pelo administrador',
  `dataHoraCriacao` DATETIME 		NULL 						COMMENT 'Data e hora da criacao do arquivo no sistema',
  `id_adm` 			INT 			NULL 						COMMENT 'Chave estrangeira do administrador no sistema ',
  `id_categoria` 	INT 			NULL 						COMMENT 'Chave estrangeira da categoria',
  `id_subCategoria` INT 			NULL 						COMMENT 'Chave estrangeira da sub categoria',
  `status` 			CHAR 			NULL 						COMMENT 'Status do arquivo no sistema. A = ATIVO, I = INATIVO ',
  PRIMARY KEY (`idArquivo`)  									COMMENT '',
  INDEX `fk_arquivos_adms1_idx` (`id_adm` ASC)  				COMMENT '',
  INDEX `fk_arquivos_categoria1_idx` (`id_categoria` ASC)  		COMMENT '',
  INDEX `fk_arquivos_subCategoria1_idx` (`id_subCategoria` ASC) COMMENT '',
  CONSTRAINT `fk_arquivos_adms1`
    FOREIGN KEY (`id_adm`)
    REFERENCES `adms` (`idAdm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_arquivos_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `categorias` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_arquivos_subCategorias1`
    FOREIGN KEY (`id_subCategoria`)
    REFERENCES `sub_categorias` (`idSubCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sys_configs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_configs` (
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
-- Table `sys_logs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_logs` (
  `idLog` 		INT 			NOT NULL 			COMMENT 'Identificador do Log no sistema',
  `data` 		DATETIME 		NULL 				COMMENT 'Data e hora da criacao do log',
  `alteracao` 	VARCHAR(100) 	NULL 				COMMENT 'Texto informando a alteracao feita',
  `id_adm` 		INT 			NOT NULL 			COMMENT 'Chave estrangeira do administrador',
  `id_arquivo` 	INT 			NOT NULL 			COMMENT 'Chave estrangeire do arquivo',
  PRIMARY KEY (`idLog`)  							COMMENT '',
  INDEX `fk_log_adms1_idx` (`id_adm` ASC)  			COMMENT '',
  INDEX `fk_log_arquivos1_idx` (`id_arquivo` ASC)  COMMENT '',
  CONSTRAINT `fk_log_adms1`
    FOREIGN KEY (`id_adm`)
    REFERENCES `adms` (`idAdm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_arquivos1`
    FOREIGN KEY (`id_arquivo`)
    REFERENCES `arquivos` (`idArquivo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `logConfig`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_log_configs` (
  `idLogConfig` 	INT 			NOT NULL 				COMMENT 'Identificador do loCOnfig no sistema',
  `data` 			DATETIME 		NULL 					COMMENT 'Data e hora da criacao do log',
  `alteracao` 		VARCHAR(100) 	NULL 					COMMENT 'Texto informando a alteracao feita',
  `id_config` 		INT 			NOT NULL 				COMMENT 'Chave estrangeira do Config',
  `id_adm` 			INT 			NOT NULL 				COMMENT 'Chave estrangeira do administrador',
  PRIMARY KEY (`idLogConfig`)  								COMMENT '',
  INDEX `fk_logConfig_config1_idx` (`id_config` ASC) COMMENT '',
  INDEX `fk_logConfig_adms1_idx` (`id_adm` ASC)  			COMMENT '',
  CONSTRAINT `fk_logConfig_config1`
    FOREIGN KEY (`id_config`)
    REFERENCES `sys_configs` (`idConfig`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_logConfig_adms1`
    FOREIGN KEY (`id_adm`)
    REFERENCES `adms` (`idAdm`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- Create a user defalut
INSERT INTO adms (nome, login, senha, status, ultimo_acesso) VALUES("Adm Root", "123.456.789-10", md5("AdmRootPass"), "A", now());

-- Create a blank register in config table
INSERT INTO sys_configs VALUES(1, "", "", "", "", "", "", "", "");

/*
SET FOREIGN_KEY_CHECKS=0; 
DROP TABLE adms; 
DROP TABLE arquivos; 
DROP TABLE categorias; 
DROP TABLE sys_configs; 
DROP TABLE sub_categorias; 
DROP TABLE sys_logs; 
DROP TABLE sys_log_configs; 
SET FOREIGN_KEY_CHECKS=1; 

*/