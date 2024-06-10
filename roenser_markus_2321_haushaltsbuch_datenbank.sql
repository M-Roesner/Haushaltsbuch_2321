-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Sep 2022 um 16:54
-- Server-Version: 10.4.22-MariaDB
-- PHP-Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `haushaltsbuch_do_it`
--
CREATE DATABASE IF NOT EXISTS `haushaltsbuch_do_it` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `haushaltsbuch_do_it`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookkeeping`
--

CREATE TABLE `bookkeeping` (
  `id_bk` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `extraInfo` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `in_out` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `bookkeeping`
--

INSERT INTO `bookkeeping` (`id_bk`, `id_cat`, `extraInfo`, `date`, `price`, `in_out`) VALUES
(1, 11, 'mein Vermieter', '2022-09-01', '450.50', 1),
(3, 22, 'Firma', '2022-08-01', '1987.64', 0),
(4, 16, '', '2022-06-01', '185.00', 1),
(11, 22, 'meine Firma', '2022-09-01', '1400.50', 0),
(21, 31, 'Shell', '2022-09-07', '21.03', 1),
(24, 5, 'Allianz', '2021-11-01', '50.00', 1),
(30, 8, 'StudioFit', '2022-09-15', '42.50', 1),
(33, 18, 'meine Bank', '2022-09-16', '50.00', 1),
(35, 1, 'meine Auto Versicherung', '2022-09-15', '174.95', 1),
(37, 27, 'Edeka', '2022-09-24', '130.00', 1),
(38, 27, 'Penny', '2022-07-15', '120.00', 1),
(57, 36, 'tanken', '2022-09-28', '15.00', 0),
(58, 35, 'Reparatur Auto', '2022-09-27', '2450.00', 1);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `bookkeepingview`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `bookkeepingview` (
`id_bk` int(11)
,`id_cat` int(11)
,`cat` varchar(50)
,`subCat` varchar(50)
,`extraInfo` varchar(100)
,`date` date
,`price` decimal(10,2)
,`in_out` tinyint(1)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `id_cat` int(11) NOT NULL,
  `cat` varchar(50) NOT NULL,
  `subCat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`id_cat`, `cat`, `subCat`) VALUES
(1, 'Versicherung', 'Auto'),
(2, 'Versicherung', 'Berufsunfähigkeit'),
(3, 'Versicherung', 'Haftplicht'),
(4, 'Versicherung', 'Hausrat'),
(5, 'Versicherung', 'Leben'),
(6, 'Versicherung', 'Rechtschutz'),
(7, 'Versicherung', 'Unfall'),
(8, 'Verträge', 'Fitnessstudio'),
(9, 'Verträge', 'Handy'),
(10, 'Verträge', 'Internet/TV'),
(11, 'Verträge', 'Miete'),
(12, 'Verträge', 'Schulden/Kredit'),
(13, 'Verträge', 'Strom'),
(14, 'Steuern', 'Grundsteuer'),
(15, 'Steuern', 'Hunde'),
(16, 'Steuern', 'KFZ'),
(17, 'Steuern', 'Rückerstattung'),
(18, 'Bank', 'Aktien'),
(19, 'Bank', 'ETF'),
(20, 'Bank', 'Rente'),
(21, 'Bank', 'Sparbuch'),
(22, 'Bank', 'Lohn/Gehalt'),
(23, 'Gesundheit', 'Medikamente'),
(24, 'Gesundheit', 'Physiotherapie'),
(25, 'Gesundheit', 'Psychologe'),
(26, 'Gesundheit', 'Sport'),
(27, 'Sonstiges', 'einkaufen'),
(28, 'Sonstiges', 'Elektro'),
(29, 'Sonstiges', 'Kino'),
(30, 'sonstiges', 'Kleidung'),
(31, 'Sonstiges', 'tanken'),
(32, 'Sonstiges', 'Theater'),
(33, 'Sonstiges', 'Tierfutter'),
(34, 'Sonstiges', 'Lebensmittel'),
(35, 'Bank', 'Rechnung'),
(36, 'Bank', 'Gutschrift');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur des Views `bookkeepingview`
--
DROP TABLE IF EXISTS `bookkeepingview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bookkeepingview`  AS SELECT `bookkeeping`.`id_bk` AS `id_bk`, `category`.`id_cat` AS `id_cat`, `category`.`cat` AS `cat`, `category`.`subCat` AS `subCat`, `bookkeeping`.`extraInfo` AS `extraInfo`, `bookkeeping`.`date` AS `date`, `bookkeeping`.`price` AS `price`, `bookkeeping`.`in_out` AS `in_out` FROM (`bookkeeping` join `category`) WHERE `bookkeeping`.`id_cat` = `category`.`id_cat` ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bookkeeping`
--
ALTER TABLE `bookkeeping`
  ADD PRIMARY KEY (`id_bk`),
  ADD KEY `id_cat_FK` (`id_cat`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bookkeeping`
--
ALTER TABLE `bookkeeping`
  MODIFY `id_bk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bookkeeping`
--
ALTER TABLE `bookkeeping`
  ADD CONSTRAINT `id_cat_FK` FOREIGN KEY (`id_cat`) REFERENCES `category` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
