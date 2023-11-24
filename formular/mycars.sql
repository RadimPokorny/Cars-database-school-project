-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 24. lis 2023, 14:11
-- Verze serveru: 10.4.28-MariaDB
-- Verze PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `mycars`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `carmakes`
--

CREATE TABLE `carmakes` (
  `id` tinyint(3) NOT NULL,
  `makename` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_czech_ci;

--
-- Vypisuji data pro tabulku `carmakes`
--

INSERT INTO `carmakes` (`id`, `makename`) VALUES
(1, 'Toyota'),
(2, 'Ford'),
(3, 'Opel');

-- --------------------------------------------------------

--
-- Struktura tabulky `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `prd_year` smallint(4) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  `models_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_czech_ci;

--
-- Vypisuji data pro tabulku `cars`
--

INSERT INTO `cars` (`id`, `prd_year`, `price`, `photo`, `models_id`) VALUES
(1, 2004, 19999, NULL, 4),
(2, 1996, 8999, NULL, 5),
(3, 1998, 6999, NULL, 7),
(4, 2010, 18999, NULL, 2),
(5, 2190, 1910, NULL, 10),
(6, 1974, 19999, NULL, 9);

-- --------------------------------------------------------

--
-- Struktura tabulky `carsinfo`
--

CREATE TABLE `carsinfo` (
  `vykon` smallint(10) NOT NULL,
  `palivo` varchar(20) NOT NULL,
  `pocet_dvere` smallint(10) NOT NULL,
  `barva` varchar(30) NOT NULL,
  `tachometr_stav` int(50) NOT NULL,
  `prevodovka` smallint(10) NOT NULL,
  `obrazek` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_czech_ci COMMENT='id carsinfo = id cars';

-- --------------------------------------------------------

--
-- Struktura tabulky `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `model_name` varchar(45) DEFAULT NULL,
  `carmakes_id` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_czech_ci;

--
-- Vypisuji data pro tabulku `models`
--

INSERT INTO `models` (`id`, `model_name`, `carmakes_id`) VALUES
(1, 'Yaris', 1),
(2, 'Corolla', 1),
(3, 'Rava', 1),
(4, 'Fiesta', 2),
(5, 'Puma', 2),
(6, 'Focus', 2),
(7, 'Mustang', 2),
(8, 'Corsa', 3),
(9, 'Moka', 3),
(10, 'Astra', 3),
(11, 'Grandland', 3),
(12, 'Crossland', 3);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `carmakes`
--
ALTER TABLE `carmakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`,`models_id`),
  ADD KEY `fk_cars_models1_idx` (`models_id`);

--
-- Indexy pro tabulku `carsinfo`
--
ALTER TABLE `carsinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`,`carmakes_id`),
  ADD KEY `fk_models_carmakes_idx` (`carmakes_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `carmakes`
--
ALTER TABLE `carmakes`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pro tabulku `carsinfo`
--
ALTER TABLE `carsinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `fk_cars_models1` FOREIGN KEY (`models_id`) REFERENCES `models` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `fk_models_carmakes` FOREIGN KEY (`carmakes_id`) REFERENCES `carmakes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
