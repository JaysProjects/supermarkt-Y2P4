-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 jun 2023 om 20:00
-- Serverversie: 8.0.28
-- PHP-versie: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supermarkt`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelen`
--

CREATE TABLE `artikelen` (
  `artId` int NOT NULL,
  `levId` int DEFAULT NULL,
  `artOmschrijving` varchar(12) NOT NULL,
  `artInkoop` decimal(2,0) DEFAULT NULL,
  `artVerkoop` decimal(2,0) DEFAULT NULL,
  `artVoorraad` int NOT NULL,
  `artMinVoorraad` int NOT NULL,
  `artMaxVoorraad` int NOT NULL,
  `artLocatie` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Gegevens worden geëxporteerd voor tabel `artikelen`
--

INSERT INTO `artikelen` (`artId`, `levId`, `artOmschrijving`, `artInkoop`, `artVerkoop`, `artVoorraad`, `artMinVoorraad`, `artMaxVoorraad`, `artLocatie`) VALUES
(1, 1, 'appel', NULL, NULL, 200, 100, 1000, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkooporders`
--

CREATE TABLE `inkooporders` (
  `inkOrdId` int NOT NULL,
  `Artikelen_artId` int NOT NULL,
  `Leveranciers_levId` int NOT NULL,
  `inkOrdDatum` date DEFAULT NULL,
  `inkOrdBestAantal` int DEFAULT NULL,
  `inkOrdStatus` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Gegevens worden geëxporteerd voor tabel `inkooporders`
--

INSERT INTO `inkooporders` (`inkOrdId`, `Artikelen_artId`, `Leveranciers_levId`, `inkOrdDatum`, `inkOrdBestAantal`, `inkOrdStatus`) VALUES
(1, 1, 1, '2023-06-07', 10, 1),
(2, 1, 1, '2023-06-07', 10, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `klantId` int NOT NULL,
  `klantNaam` varchar(20) DEFAULT NULL,
  `klantEmail` varchar(30) NOT NULL,
  `klantAdres` varchar(30) NOT NULL,
  `klantPostcode` varchar(6) DEFAULT NULL,
  `klantWoonplaats` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(1, 'Jahden', 'test@live.nl', 'test 24', '1234ZA', 'Rotterdam'),
(2, 'test', 'teste@live.nl', 'test', '2348dc', 'RTortder'),
(3, 'test', 'teste@live.nl', 'test', '2348dc', 'RTortder'),
(4, 'Hallo', 'Halleo@hotmail.com', 'Stuitenweg', '2043ZS', 'Hoofddorp'),
(5, 'Kayra', 'kayra@live.nl', 'kayrahuuis', '2334WE', 'Tilburg'),
(6, 'Hendrick', 'Hendrick@gmail.com', 'Waddenweg 1', '2134WA', 'Scheveningen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leveranciers`
--

CREATE TABLE `leveranciers` (
  `levId` int NOT NULL,
  `levNaam` varchar(15) NOT NULL,
  `levContact` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `levEmail` varchar(30) NOT NULL,
  `levAdres` varchar(30) DEFAULT NULL,
  `levPostcode` varchar(6) DEFAULT NULL,
  `levWoonplaats` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Gegevens worden geëxporteerd voor tabel `leveranciers`
--

INSERT INTO `leveranciers` (`levId`, `levNaam`, `levContact`, `levEmail`, `levAdres`, `levPostcode`, `levWoonplaats`) VALUES
(1, 'Pink Lady', 'Grégoire Van den Ostende', 'info@breaking-news.be', 'Louizalaan 367', '1050BE', 'Brussels');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verkooporders`
--

CREATE TABLE `verkooporders` (
  `verOrdId` int NOT NULL,
  `Klanten_klantId` int NOT NULL,
  `Artikelen_artId` int NOT NULL,
  `verOrdDatum` date DEFAULT NULL,
  `verOrdBestAantal` int DEFAULT NULL,
  `verOrdStatus` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Gegevens worden geëxporteerd voor tabel `verkooporders`
--

INSERT INTO `verkooporders` (`verOrdId`, `Klanten_klantId`, `Artikelen_artId`, `verOrdDatum`, `verOrdBestAantal`, `verOrdStatus`) VALUES
(3, 3, 1, '2023-05-31', 10, 1),
(5, 2, 1, '2023-06-07', 2, 3),
(7, 3, 1, '2023-06-07', 11, 1),
(8, 1, 1, '2023-06-07', 12, 1),
(9, 1, 1, '2023-06-07', 12, 1),
(10, 6, 1, '2023-06-07', 123, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikelen`
--
ALTER TABLE `artikelen`
  ADD PRIMARY KEY (`artId`),
  ADD UNIQUE KEY `artId_UNIQUE` (`artId`),
  ADD KEY `levId_idx` (`levId`);

--
-- Indexen voor tabel `inkooporders`
--
ALTER TABLE `inkooporders`
  ADD PRIMARY KEY (`inkOrdId`,`Artikelen_artId`,`Leveranciers_levId`),
  ADD UNIQUE KEY `inkOrdId_UNIQUE` (`inkOrdId`),
  ADD KEY `fk_Inkoop Orders_Leveranciers1_idx` (`Leveranciers_levId`),
  ADD KEY `fk_Inkoop Orders_Artikelen1_idx` (`Artikelen_artId`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexen voor tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  ADD PRIMARY KEY (`levId`),
  ADD UNIQUE KEY `levId_UNIQUE` (`levId`);

--
-- Indexen voor tabel `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD PRIMARY KEY (`verOrdId`,`Klanten_klantId`,`Artikelen_artId`),
  ADD UNIQUE KEY `verOrdId_UNIQUE` (`verOrdId`),
  ADD KEY `fk_Verkooporders_Artikelen_idx` (`Artikelen_artId`),
  ADD KEY `fk_Verkooporders_Klanten1_idx` (`Klanten_klantId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikelen`
--
ALTER TABLE `artikelen`
  MODIFY `artId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `inkooporders`
--
ALTER TABLE `inkooporders`
  MODIFY `inkOrdId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `klantId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  MODIFY `levId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `verkooporders`
--
ALTER TABLE `verkooporders`
  MODIFY `verOrdId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `artikelen`
--
ALTER TABLE `artikelen`
  ADD CONSTRAINT `levId` FOREIGN KEY (`levId`) REFERENCES `leveranciers` (`levId`);

--
-- Beperkingen voor tabel `inkooporders`
--
ALTER TABLE `inkooporders`
  ADD CONSTRAINT `fk_Inkoop Orders_Artikelen1` FOREIGN KEY (`Artikelen_artId`) REFERENCES `artikelen` (`artId`),
  ADD CONSTRAINT `fk_Inkoop Orders_Leveranciers1` FOREIGN KEY (`Leveranciers_levId`) REFERENCES `leveranciers` (`levId`);

--
-- Beperkingen voor tabel `verkooporders`
--
ALTER TABLE `verkooporders`
  ADD CONSTRAINT `fk_Verkooporders_Artikelen` FOREIGN KEY (`Artikelen_artId`) REFERENCES `artikelen` (`artId`),
  ADD CONSTRAINT `fk_Verkooporders_Klanten1` FOREIGN KEY (`Klanten_klantId`) REFERENCES `klanten` (`klantId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
