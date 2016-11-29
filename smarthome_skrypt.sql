-- Poprawiony skrypt tworzacy baze danych potrzebna w aplikacji wykonany z wykorzystaniem MySQL Workbench

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema smarthome3
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema smarthome3
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `smarthome3` DEFAULT CHARACTER SET utf8 ;
USE `smarthome3` ;

-- -----------------------------------------------------
-- Table `smarthome3`.`dostep_uzytk`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome3`.`dostep_uzytk` (
  `typ_dostepu` VARCHAR(40) NOT NULL,
  `id_dostepu` INT NOT NULL AUTO_INCREMENT,
  `szczegoly` VARCHAR(45) NULL,
  PRIMARY KEY (`typ_dostepu`),
  UNIQUE INDEX `id_dostepu_UNIQUE` (`id_dostepu` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome3`.`uzytkownik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome3`.`uzytkownik` (
  `login` VARCHAR(45) NOT NULL,
  `haslo` VARCHAR(45) NOT NULL,
  `id_uzytkownika` INT(11) UNSIGNED NOT NULL,
  `imie` VARCHAR(45) NOT NULL,
  `nazwisko` VARCHAR(45) NULL,
  `czas_rejestracji` TIMESTAMP NOT NULL,
  `uwagi` VARCHAR(200) NULL,
  `dostep_uzytk_typ_dostepu` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`login`, `dostep_uzytk_typ_dostepu`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  INDEX `fk_uzytkownik_dostep_uzytk1_idx` (`dostep_uzytk_typ_dostepu` ASC),
  CONSTRAINT `fk_uzytkownik_dostep_uzytk1`
    FOREIGN KEY (`dostep_uzytk_typ_dostepu`)
    REFERENCES `smarthome3`.`dostep_uzytk` (`typ_dostepu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome3`.`urzadzenie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome3`.`urzadzenie` (
  `id_urzadzenia` INT(11) NOT NULL,
  `nazwa` VARCHAR(80) NOT NULL,
  `kategoria` VARCHAR(45) NULL,
  `szczegoly` VARCHAR(200) NULL,
  PRIMARY KEY (`id_urzadzenia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome3`.`pomieszczenie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome3`.`pomieszczenie` (
  `nazwa_pomieszczenia` VARCHAR(60) NOT NULL,
  `id_pomieszczenia` INT(11) NOT NULL AUTO_INCREMENT,
  `szczegoly` VARCHAR(200) NULL,
  PRIMARY KEY (`nazwa_pomieszczenia`),
  UNIQUE INDEX `nazwa_pomieszczenia_UNIQUE` (`nazwa_pomieszczenia` ASC),
  UNIQUE INDEX `id_pomieszczenia_UNIQUE` (`id_pomieszczenia` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome3`.`kategoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome3`.`kategoria` (
  `nazwa_kategorii` VARCHAR(80) NOT NULL,
  `id_grupy` INT(11) NOT NULL,
  `szczegoly` VARCHAR(200) NULL,
  PRIMARY KEY (`nazwa_kategorii`),
  UNIQUE INDEX `id_grupy_UNIQUE` (`id_grupy` ASC),
  UNIQUE INDEX `nazwa_grupy_UNIQUE` (`nazwa_kategorii` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome3`.`wpis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome3`.`wpis` (
  `id_wpisu` INT(11) NOT NULL,
  `nazwa_wpisu` VARCHAR(50) NULL,
  `szczegoly` VARCHAR(50) NULL,
  `czas` TIMESTAMP NOT NULL,
  `pomieszczenie_nazwa_pomieszczenia` VARCHAR(60) NOT NULL,
  `kategoria_nazwa_kategorii` VARCHAR(80) NOT NULL,
  `urzadzenie_id_urzadzenia` INT(11) NOT NULL,
  PRIMARY KEY (`id_wpisu`, `pomieszczenie_nazwa_pomieszczenia`, `kategoria_nazwa_kategorii`, `urzadzenie_id_urzadzenia`),
  INDEX `fk_wpis_pomieszczenie1_idx` (`pomieszczenie_nazwa_pomieszczenia` ASC),
  INDEX `fk_wpis_kategoria1_idx` (`kategoria_nazwa_kategorii` ASC),
  INDEX `fk_wpis_urzadzenie1_idx` (`urzadzenie_id_urzadzenia` ASC),
  CONSTRAINT `fk_wpis_pomieszczenie1`
    FOREIGN KEY (`pomieszczenie_nazwa_pomieszczenia`)
    REFERENCES `smarthome3`.`pomieszczenie` (`nazwa_pomieszczenia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wpis_kategoria1`
    FOREIGN KEY (`kategoria_nazwa_kategorii`)
    REFERENCES `smarthome3`.`kategoria` (`nazwa_kategorii`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wpis_urzadzenie1`
    FOREIGN KEY (`urzadzenie_id_urzadzenia`)
    REFERENCES `smarthome3`.`urzadzenie` (`id_urzadzenia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome3`.`dane_wpisu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome3`.`dane_wpisu` (
  `id_danych` INT NOT NULL AUTO_INCREMENT,
  `wartosc` INT(11) NULL,
  `czas` TIMESTAMP NULL,
  `jednostka` VARCHAR(8) NULL,
  `szczegoly` VARCHAR(200) NULL,
  `dane_wpisucol` VARCHAR(45) NULL,
  `wpis_id_wpisu` INT(11) NOT NULL,
  `wpis_pomieszczenie_nazwa_pomieszczenia` VARCHAR(60) NOT NULL,
  `wpis_kategoria_nazwa_kategorii` VARCHAR(80) NOT NULL,
  `wpis_urzadzenie_id_urzadzenia` INT(11) NOT NULL,
  PRIMARY KEY (`id_danych`, `wpis_id_wpisu`, `wpis_pomieszczenie_nazwa_pomieszczenia`, `wpis_kategoria_nazwa_kategorii`, `wpis_urzadzenie_id_urzadzenia`),
  INDEX `fk_dane_wpisu_wpis1_idx` (`wpis_id_wpisu` ASC, `wpis_pomieszczenie_nazwa_pomieszczenia` ASC, `wpis_kategoria_nazwa_kategorii` ASC, `wpis_urzadzenie_id_urzadzenia` ASC),
  CONSTRAINT `fk_dane_wpisu_wpis1`
    FOREIGN KEY (`wpis_id_wpisu` , `wpis_pomieszczenie_nazwa_pomieszczenia` , `wpis_kategoria_nazwa_kategorii` , `wpis_urzadzenie_id_urzadzenia`)
    REFERENCES `smarthome3`.`wpis` (`id_wpisu` , `pomieszczenie_nazwa_pomieszczenia` , `kategoria_nazwa_kategorii` , `urzadzenie_id_urzadzenia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
