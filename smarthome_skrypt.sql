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
-- Table `smarthome`.`uzytkownik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`uzytkownik` (
  `id_uzytkownika` INT(11) NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `imie` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `haslo` VARCHAR(45) NOT NULL,
  `czas_rejestracji` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_uzytkownika`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`typy_urzadzen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`typy_urzadzen` (
  `id_typu` INT(11) NOT NULL AUTO_INCREMENT,
  `nazwa_typu` VARCHAR(90) NOT NULL,
  `szczegoly_typu` VARCHAR(90) NULL,
  PRIMARY KEY (`id_typu`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`urzadzenia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`urzadzenia` (
  `id_urzadzenia` INT(11) NOT NULL AUTO_INCREMENT,
  `nazwa_urzadzenia` VARCHAR(90) NOT NULL,
  `szczegoly_urzadzenia` VARCHAR(90) NULL,
  `typy_urzadzen_id_typu` INT(11) NOT NULL,
  PRIMARY KEY (`id_urzadzenia`, `typy_urzadzen_id_typu`),
  UNIQUE INDEX `nazwa_urz_UNIQUE` (`nazwa_urzadzenia` ASC),
  INDEX `fk_urzadzenia_typy_urzadzen1_idx` (`typy_urzadzen_id_typu` ASC),
  CONSTRAINT `fk_urzadzenia_typy_urzadzen1`
    FOREIGN KEY (`typy_urzadzen_id_typu`)
    REFERENCES `smarthome`.`typy_urzadzen` (`id_typu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`pomieszczenia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`pomieszczenia` (
  `id_pomieszczenia` INT(11) NOT NULL AUTO_INCREMENT,
  `nazwa_pomieszczenia` VARCHAR(90) NOT NULL,
  `szczegoly_pomieszczenia` VARCHAR(90) NULL,
  PRIMARY KEY (`id_pomieszczenia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`pomiary`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`pomiary` (
  `id_pomiaru` INT(11) NOT NULL AUTO_INCREMENT,
  `szczegoly_pomiaru` VARCHAR(90) NULL,
  `wartosc` INT(11) NOT NULL,
  `czas_pomiaru` TIMESTAMP NOT NULL,
  `pomieszczenia_id_pomieszczenia` INT(11) NOT NULL,
  `urzadzenia_id_urzadzenia` INT(11) NOT NULL,
  PRIMARY KEY (`id_pomiaru`, `pomieszczenia_id_pomieszczenia`, `urzadzenia_id_urzadzenia`),
  INDEX `fk_pomiar_urzadzenia1_idx` (`urzadzenia_id_urzadzenia` ASC),
  INDEX `fk_pomiar_pomieszczenia1_idx` (`pomieszczenia_id_pomieszczenia` ASC),
  CONSTRAINT `fk_pomiar_urzadzenia1`
    FOREIGN KEY (`urzadzenia_id_urzadzenia`)
    REFERENCES `smarthome`.`urzadzenia` (`id_urzadzenia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pomiar_pomieszczenia1`
    FOREIGN KEY (`pomieszczenia_id_pomieszczenia`)
    REFERENCES `smarthome`.`pomieszczenia` (`id_pomieszczenia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`dane_pomiaru`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`dane_pomiaru` (
  `id_danych` INT(11) NOT NULL AUTO_INCREMENT,
  `wartosc` INT(11) NOT NULL,
  `czas` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `szczegoly_danych` VARCHAR(90) NULL,
  `pomiar_id_pomiaru` INT(11) NOT NULL,
  PRIMARY KEY (`id_danych`, `pomiar_id_pomiaru`),
  INDEX `fk_dane_pomiaru_pomiar1_idx` (`pomiar_id_pomiaru` ASC),
  CONSTRAINT `fk_dane_pomiaru_pomiar1`
    FOREIGN KEY (`pomiar_id_pomiaru`)
    REFERENCES `smarthome`.`pomiary` (`id_pomiaru`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`roles` (
  `id_roli` INT(11) NOT NULL,
  `szczegoly_roli` VARCHAR(45) NULL,
  PRIMARY KEY (`id_roli`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `smarthome`.`users_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `smarthome`.`users_roles` (
  `id_roli` INT(11) NOT NULL,
  `id_uzytkownika` INT(11) NOT NULL,
  PRIMARY KEY (`id_roli`, `id_uzytkownika`),
  INDEX `fk_users_roles_roles1_idx` (`id_roli` ASC),
  INDEX `fk_users_roles_uzytkownik1_idx` (`id_uzytkownika` ASC),
  CONSTRAINT `fk_users_roles_roles1`
    FOREIGN KEY (`id_roli`)
    REFERENCES `smarthome`.`roles` (`id_roli`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_roles_uzytkownik1`
    FOREIGN KEY (`id_uzytkownika`)
    REFERENCES `smarthome`.`uzytkownik` (`id_uzytkownika`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
