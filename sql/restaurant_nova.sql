-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mariadb
-- Generation Time: Mar 28, 2024 at 09:17 AM
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
(12, '2051 JA', 29, 'Overveen', 'Prinshendriklaan'),
(18, '2222 RE', 32, 'Leiden', 'weet ik niet'),
(19, '1234QW', 12, 'qwert', 'qwerty'),
(20, '2201 DU', 11, 'Daghove', 'Dagostraat');

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
(7, 12, 'Mickey', 'Mouse', '$2y$10$ymnPH3Rx8.3nv4atwQp/W.JKZ90naOQsWdEMpqzFfi/GX4BzmtDRO', '192443@novacollege.nl', 'Directeur'),
(13, 18, 'piet', 'paaltjens', '$2y$10$6UxCs7Gmgbw.q5ojozsPGeKo6qlq.U/8ColgYdaoZsKyoYc2OiYv.', 'gebruiker@spaghettificatie.nl', 'Klant'),
(14, 19, 'qwerty', 'uiop', '$2y$10$PvY07an1elv08cnu.C.WJeJQe4YwF8f89rMg.5r5IqJg0TTybs4ke', 'admin@work4me.nl', 'Klant'),
(15, 20, 'Donald', 'Duck', '$2y$10$GXXP8OA1F9FGlFL5Yq9ThurAm0Tfbb4WLM6Y14i7T15k5CAqNFLMS', 'donald@duck.be', 'Klant');

-- --------------------------------------------------------

--
-- Table structure for table `menugang`
--

CREATE TABLE `menugang` (
  `menugangid` int(11) NOT NULL,
  `naam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `menugang`
--

INSERT INTO `menugang` (`menugangid`, `naam`) VALUES
(1, 'Wiener Schnitzel'),
(2, 'Geschnetzeltes'),
(3, 'Wijn'),
(4, 'Drinken');

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

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `categorieid`, `menugangid`, `naam`, `beschrijving`, `inkoopprijs`, `verkoopprijs`, `afbeelding`, `is_vega`, `aantal_voorraad`) VALUES
(1, 1, 1, 'Tomatensoep', 'Een geroosterde-tomatensoep met basilicum en kaascroutons', '1025', '2000', '', 1, 21),
(2, 2, 1, 'Wiener Schnitzel', 'Geserveerd met aardappelsalade en een frisse groene salade met vinaigrette dressing', '1500', '2500', '', 0, 11),
(3, 3, 1, 'Apfelstrudel', 'Deze apfelstrudel wordt geserveerd met vanillesaus. Apfelstrudel bestaat uit deeg, plakjes appel en rozijnen.', '800', '1000', '', 1, 15),
(4, 1, 2, 'Käsespätzle', 'Zachte, huisgemaakte noedels vermengd met gesmolten kaas, gebakken ui en geserveerd met een frisse salade.', '900', '1000', '', 1, 11),
(5, 2, 2, 'Geschnetzeltes', 'malse reepjes varkensvlees of kalfsvlees, gebakken met champignons en ui in een romige saus, geserveerd met knapperige Rösti-aardappelen en gestoomde groenten.', '1100', '1500', '', 0, 12),
(6, 3, 2, 'Sachertorte', 'een weelderige chocoladetaart gevuld met abrikozenjam en bedekt met een glanzende laag pure chocolade, geserveerd met een toefje slagroom en een kopje sterke Oostenrijkse koffie.', '800', '1200', '', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `product_categorie`
--

CREATE TABLE `product_categorie` (
  `categorieid` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_categorie`
--

INSERT INTO `product_categorie` (`categorieid`, `categorie`) VALUES
(1, 'Voorgerecht'),
(2, 'Hoofdgerecht'),
(3, 'Desert');

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
  ADD KEY `gebruikerid` (`gebruikerid`),
  ADD KEY `tafelnummer` (`tafelnummer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adres`
--
ALTER TABLE `adres`
  MODIFY `adresid` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `gebruikerid` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menugang`
--
ALTER TABLE `menugang`
  MODIFY `menugangid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_categorie`
--
ALTER TABLE `product_categorie`
  MODIFY `categorieid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
