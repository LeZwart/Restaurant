-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Mar 22, 2024 at 08:13 AM
-- Server version: 10.4.32-MariaDB-1:10.4.32+maria~ubu2004
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_nova`
--

-- --------------------------------------------------------

--
-- Table structure for table `adres`
--

CREATE TABLE `adres` (
  `adresid` int(16) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `huisnummer` int(8) NOT NULL,
  `woonplaats` varchar(255) NOT NULL,
  `straatnaam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `adres`
--

INSERT INTO `adres` (`adresid`, `postcode`, `huisnummer`, `woonplaats`, `straatnaam`) VALUES
(12, '2051 JA', 29, 'Overveen', 'Prinshendriklaan');

-- --------------------------------------------------------

--
-- Table structure for table `gebruiker`
--

CREATE TABLE `gebruiker` (
  `gebruikerid` int(16) NOT NULL,
  `adresid` int(16) NOT NULL,
  `voornaam` varchar(255) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rol` enum('Directeur','Manager','Medewerker','Klant') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `gebruiker`
--

INSERT INTO `gebruiker` (`gebruikerid`, `adresid`, `voornaam`, `achternaam`, `wachtwoord`, `email`, `rol`) VALUES
(7, 12, 'Mickey', 'Mouse', '$2y$10$ymnPH3Rx8.3nv4atwQp/W.JKZ90naOQsWdEMpqzFfi/GX4BzmtDRO', '192443@novacollege.nl', 'Directeur');

-- --------------------------------------------------------

--
-- Table structure for table `menugang`
--

CREATE TABLE `menugang` (
  `menugangid` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `categorieid` int(11) NOT NULL,
  `menugangid` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `beschrijving` varchar(255) NOT NULL,
  `inkoopprijs` varchar(255) NOT NULL,
  `verkoopprijs` varchar(255) NOT NULL,
  `afbeelding` varchar(255) NOT NULL,
  `is_vega` tinyint(1) NOT NULL,
  `aantal_voorraad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categorie`
--

CREATE TABLE `product_categorie` (
  `categorieid` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservering`
--

CREATE TABLE `reservering` (
  `reserveringid` int(11) NOT NULL,
  `gebruikerid` int(11) NOT NULL,
  `datum` int(11) NOT NULL,
  `tijd` time NOT NULL,
  `aantal_personen` int(8) NOT NULL,
  `tafelnummer` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`adresid`);

--
-- Indexes for table `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`gebruikerid`),
  ADD KEY `adresid` (`adresid`);

--
-- Indexes for table `menugang`
--
ALTER TABLE `menugang`
  ADD PRIMARY KEY (`menugangid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `menugangid` (`menugangid`),
  ADD KEY `categorieid` (`categorieid`);

--
-- Indexes for table `product_categorie`
--
ALTER TABLE `product_categorie`
  ADD PRIMARY KEY (`categorieid`);

--
-- Indexes for table `reservering`
--
ALTER TABLE `reservering`
  ADD PRIMARY KEY (`reserveringid`),
  ADD KEY `gebruikerid` (`gebruikerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adres`
--
ALTER TABLE `adres`
  MODIFY `adresid` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `gebruikerid` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menugang`
--
ALTER TABLE `menugang`
  MODIFY `menugangid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categorie`
--
ALTER TABLE `product_categorie`
  MODIFY `categorieid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservering`
--
ALTER TABLE `reservering`
  MODIFY `reserveringid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD CONSTRAINT `gebruiker_ibfk_1` FOREIGN KEY (`adresid`) REFERENCES `adres` (`adresid`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`menugangid`) REFERENCES `menugang` (`menugangid`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`categorieid`) REFERENCES `product_categorie` (`categorieid`);

--
-- Constraints for table `reservering`
--
ALTER TABLE `reservering`
  ADD CONSTRAINT `reservering_ibfk_1` FOREIGN KEY (`gebruikerid`) REFERENCES `gebruiker` (`gebruikerid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
