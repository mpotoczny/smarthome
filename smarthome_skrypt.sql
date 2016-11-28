-- Pierwszy skrypt tworzacy baze danych potrzebna w aplikacji wykonany z wykorzystaniem MySQL Workbench


-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema smarthome
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema smarthome
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `smarthome` DEFAULT CHARACTER SET utf8 ;
USE `smarthome` ;

-- -----------------------------------------------------
-- Table `smarthome`.`dostep_uzytk`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`dostep_uzytk` (
  `id_dostepu` INT NOT NULL AUTO_INCREMENT,
  `typ_dostepu` VARCHAR(45) NULL,
  `szczegoly` VARCHAR(45) NULL,
  PRIMARY KEY (`id_dostepu`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`uzytkownik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`uzytkownik` (
  `id_uzytkownika` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `haslo` VARCHAR(45) NOT NULL,
  `imie` VARCHAR(45) NOT NULL,
  `nazwisko` VARCHAR(45) NULL,
  `czas_rejestracji` TIMESTAMP NULL,
  `dostep_uzytk_id_dostepu` INT NOT NULL,
  PRIMARY KEY (`id_uzytkownika`, `dostep_uzytk_id_dostepu`),
  INDEX `fk_uzytkownik_dostep_uzytk_idx` (`dostep_uzytk_id_dostepu` ASC),
  CONSTRAINT `fk_uzytkownik_dostep_uzytk`
    FOREIGN KEY (`dostep_uzytk_id_dostepu`)
    REFERENCES `smarthome`.`dostep_uzytk` (`id_dostepu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`urzadzenia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`urzadzenia` (
  `id_urzadzenia` INT(11) NOT NULL,
  `nazwa` VARCHAR(80) NOT NULL,
  `kategoria` VARCHAR(45) NULL,
  `szczegoly` VARCHAR(200) NULL,
  PRIMARY KEY (`id_urzadzenia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`grupa_wpisow`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`grupa_wpisow` (
  `id_grupy` INT NOT NULL,
  `nazwa_grupy` VARCHAR(80) NULL,
  `szczegoly` VARCHAR(90) NULL,
  PRIMARY KEY (`id_grupy`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`typ_wpisu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`typ_wpisu` (
  `id_typu` INT(11) NOT NULL,
  `nazwa_typu` VARCHAR(45) NULL,
  `szczegoly` VARCHAR(90) NULL,
  PRIMARY KEY (`id_typu`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`wpis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`wpis` (
  `id_wpisu` INT(11) NOT NULL,
  `nazwa_wpisu` VARCHAR(50) NULL,
  `szczegoly` VARCHAR(50) NULL,
  `czas` TIMESTAMP NOT NULL,
  `urzadzenia_id_urzadzenia` INT(11) NOT NULL,
  `grupa_wpisow_id_grupy` INT NOT NULL,
  `typ_wpisu_id_typu` INT(11) NOT NULL,
  PRIMARY KEY (`id_wpisu`, `urzadzenia_id_urzadzenia`, `grupa_wpisow_id_grupy`, `typ_wpisu_id_typu`),
  INDEX `fk_wpis_urzadzenia1_idx` (`urzadzenia_id_urzadzenia` ASC),
  INDEX `fk_wpis_grupa_wpisow1_idx` (`grupa_wpisow_id_grupy` ASC),
  INDEX `fk_wpis_typ_wpisu1_idx` (`typ_wpisu_id_typu` ASC),
  CONSTRAINT `fk_wpis_urzadzenia1`
    FOREIGN KEY (`urzadzenia_id_urzadzenia`)
    REFERENCES `smarthome`.`urzadzenia` (`id_urzadzenia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wpis_grupa_wpisow1`
    FOREIGN KEY (`grupa_wpisow_id_grupy`)
    REFERENCES `smarthome`.`grupa_wpisow` (`id_grupy`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wpis_typ_wpisu1`
    FOREIGN KEY (`typ_wpisu_id_typu`)
    REFERENCES `smarthome`.`typ_wpisu` (`id_typu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`dane_wpisu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`dane_wpisu` (
  `id_danych` INT NOT NULL AUTO_INCREMENT,
  `wartosc` INT(11) NULL,
  `czas` TIMESTAMP NULL,
  `jednostka` VARCHAR(8) NULL,
  `szczegoly` VARCHAR(90) NULL,
  `wpis_id_wpisu` INT(11) NOT NULL,
  `wpis_urzadzenia_id_urzadzenia` INT(11) NOT NULL,
  `wpis_grupa_wpisow_id_grupy` INT NOT NULL,
  `wpis_typ_wpisu_id_typu` INT(11) NOT NULL,
  PRIMARY KEY (`id_danych`, `wpis_id_wpisu`, `wpis_urzadzenia_id_urzadzenia`, `wpis_grupa_wpisow_id_grupy`, `wpis_typ_wpisu_id_typu`),
  INDEX `fk_dane_wpisu_wpis1_idx` (`wpis_id_wpisu` ASC, `wpis_urzadzenia_id_urzadzenia` ASC, `wpis_grupa_wpisow_id_grupy` ASC, `wpis_typ_wpisu_id_typu` ASC),
  CONSTRAINT `fk_dane_wpisu_wpis1`
    FOREIGN KEY (`wpis_id_wpisu` , `wpis_urzadzenia_id_urzadzenia` , `wpis_grupa_wpisow_id_grupy` , `wpis_typ_wpisu_id_typu`)
    REFERENCES `smarthome`.`wpis` (`id_wpisu` , `urzadzenia_id_urzadzenia` , `grupa_wpisow_id_grupy` , `typ_wpisu_id_typu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
