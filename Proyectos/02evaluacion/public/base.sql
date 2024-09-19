-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Clinicas
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Clinicas
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Clinicas` DEFAULT CHARACTER SET utf8 ;
USE `Clinicas` ;

-- -----------------------------------------------------
-- Table `Clinicas`.`Pacientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Clinicas`.`Pacientes` (
  `idPacientes` INT NOT NULL AUTO_INCREMENT,
  `Nombre` TEXT NOT NULL,
  `Apellido` TEXT NOT NULL,
  `Direccion` TEXT NOT NULL,
  `Telefono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPacientes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Clinicas`.`Medicos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Clinicas`.`Medicos` (
  `idMedicos` INT NOT NULL AUTO_INCREMENT,
  `Nombre` TEXT NOT NULL,
  `Especialidad` TEXT NOT NULL,
  `Telefono` VARCHAR(45) NOT NULL,
  `Email` TEXT NOT NULL,
  PRIMARY KEY (`idMedicos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Clinicas`.`Consultas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Clinicas`.`Consultas` (
  `idConsultas` INT NOT NULL AUTO_INCREMENT,
  `Fecha` DATETIME NOT NULL,
  `Descripcion` TEXT NOT NULL,
  `Medicos_idMedicos` INT NOT NULL,
  `Pacientes_idPacientes` INT NOT NULL,
  PRIMARY KEY (`idConsultas`),
  INDEX `fk_Consultas_Medicos_idx` (`Medicos_idMedicos` ASC),
  INDEX `fk_Consultas_Pacientes1_idx` (`Pacientes_idPacientes` ASC),
  CONSTRAINT `fk_Consultas_Medicos`
    FOREIGN KEY (`Medicos_idMedicos`)
    REFERENCES `Clinicas`.`Medicos` (`idMedicos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Consultas_Pacientes1`
    FOREIGN KEY (`Pacientes_idPacientes`)
    REFERENCES `Clinicas`.`Pacientes` (`idPacientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
