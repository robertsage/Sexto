-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Cursos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Cursos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Cursos` DEFAULT CHARACTER SET utf8 ;
USE `Cursos` ;

-- -----------------------------------------------------
-- Table `Cursos`.`Categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cursos`.`Categorias` (
  `idCategorias` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Categoria` VARCHAR(45) NOT NULL,
  `Descripcion` TEXT NULL,
  PRIMARY KEY (`idCategorias`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Cursos`.`Cursos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cursos`.`Cursos` (
  `idCursos` INT NOT NULL AUTO_INCREMENT,
  `Nombre_Curso` VARCHAR(45) NOT NULL,
  `Descripcion` TEXT NULL,
  `Fecha_Inicio` DATETIME NOT NULL,
  `Fecha_Fin` DATETIME NOT NULL,
  `Categorias_idCategorias` INT NOT NULL,
  PRIMARY KEY (`idCursos`),
  INDEX `fk_Cursos_Categorias1_idx` (`Categorias_idCategorias` ASC),
  CONSTRAINT `fk_Cursos_Categorias1`
    FOREIGN KEY (`Categorias_idCategorias`)
    REFERENCES `Cursos`.`Categorias` (`idCategorias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Cursos`.`Estudiantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cursos`.`Estudiantes` (
  `idEstudiantes` INT NOT NULL AUTO_INCREMENT,
  `Nombres` TEXT NOT NULL,
  `Apellidos` TEXT NOT NULL,
  `Cedula` VARCHAR(13) NOT NULL,
  `Direccion` TEXT NULL,
  `Telefono` VARCHAR(17) NOT NULL,
  `Email` TEXT NOT NULL,
  PRIMARY KEY (`idEstudiantes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Cursos`.`Inscripciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Cursos`.`Inscripciones` (
  `idInscripciones` INT NOT NULL AUTO_INCREMENT,
  `Fecha_Inscripcion` DATETIME NOT NULL,
  `Estudiantes_idEstudiantes` INT NOT NULL,
  `Cursos_idCursos` INT NOT NULL,
  PRIMARY KEY (`idInscripciones`),
  INDEX `fk_Inscripciones_Estudiantes1_idx` (`Estudiantes_idEstudiantes` ASC),
  INDEX `fk_Inscripciones_Cursos1_idx` (`Cursos_idCursos` ASC),
  CONSTRAINT `fk_Inscripciones_Estudiantes1`
    FOREIGN KEY (`Estudiantes_idEstudiantes`)
    REFERENCES `Cursos`.`Estudiantes` (`idEstudiantes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscripciones_Cursos1`
    FOREIGN KEY (`Cursos_idCursos`)
    REFERENCES `Cursos`.`Cursos` (`idCursos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;