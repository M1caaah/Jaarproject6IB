-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 12:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jaarproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblartikel`
--

CREATE TABLE `tblartikel` (
                              `artikelID` int(11) NOT NULL,
                              `artikelNaam` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `artikelVoorraad` int(11) NOT NULL,
                              `artikelPrijs` decimal(10,2) NOT NULL,
                              `artikelAfbeelding` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `artikelMinLeeftijd` int(11) NOT NULL,
                              `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblartikel`
--

INSERT INTO `tblartikel` (`artikelID`, `artikelNaam`, `artikelVoorraad`, `artikelPrijs`, `artikelAfbeelding`, `artikelMinLeeftijd`, `active`) VALUES
                                                                                                                                                  (1, 'Baldur&#039;s Gate 3', 53, 20.00, 'baldursgate.jpg', 18, 1),
                                                                                                                                                  (11, 'Elden Ring', 16, 30.00, 'eldenring.png', 16, 1),
                                                                                                                                                  (12, 'Lethal Company', 8, 9.50, 'lethalcompany.webp', 12, 1),
                                                                                                                                                  (13, 'Cyberpunk 2077', 23, 29.99, 'cyberpunk.jpg', 18, 1),
                                                                                                                                                  (14, 'Windows 11 Pro', 56, 18.99, 'windowspro.jpg', 12, 1),
                                                                                                                                                  (15, 'Xbox Game Pass', 13, 7.99, 'gamepass.jpg', 12, 1),
                                                                                                                                                  (16, 'Star Wars Jedi: Survivor', 34, 24.99, 'jedisurvivor.jpg', 14, 1),
                                                                                                                                                  (17, 'Enshrouded', 45, 12.05, 'enshrouded.jpg', 16, 1),
                                                                                                                                                  (18, 'Palworld', 42, 59.99, 'palworld.jpg', 12, 1),
                                                                                                                                                  (19, 'Persona 3 Reload', 41, 26.99, 'persona3reload.jpg', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblklant`
--

CREATE TABLE `tblklant` (
                            `klantID` int(11) NOT NULL,
                            `klantnaam` varchar(65) NOT NULL,
                            `klantemail` varchar(65) NOT NULL,
                            `geboortedatum` date NOT NULL,
                            `passwoord` varchar(65) NOT NULL,
                            `rol` varchar(65) NOT NULL,
                            `registratiedatum` date NOT NULL,
                            `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblklant`
--

INSERT INTO `tblklant` (`klantID`, `klantnaam`, `klantemail`, `geboortedatum`, `passwoord`, `rol`, `registratiedatum`, `active`) VALUES
                                                                                                                                     (0, 'Obi Verheyen', 'verheyenobi@lyceumgent.be', '2004-06-01', 'pizza', 'admin', '2024-07-01', 1),
                                                                                                                                     (1, 'Micah Botha', 'bothamicah@lyceumgent.be', '2006-08-21', 'password', 'admin', '2024-07-01', 1),
                                                                                                                                     (2, 'Rayan Sayah', 'sayahrayan@lyceumgent.be', '2012-02-03', 'notpassword', 'user', '2024-07-01', 1),
                                                                                                                                     (3, 'Tim Meesen', 'meesentim@lyceumgent.be', '1978-05-12', 'hello :D', 'user', '2024-07-01', 1),
                                                                                                                                     (4, 'Stef De Feyter', 'deschijtersteffy@lyceumgent.be', '2004-10-23', 'E', 'user', '2024-07-01', 1),
                                                                                                                                     (5, 'Brendt Van Den Eynde', 'vandeneyndebrenda@lyceumgent.be', '2006-03-14', ':D', 'user', '2024-07-01', 1),
                                                                                                                                     (6, 'Raîf Demirogullari', 'demirogullariraîf@lyceumgent.be', '2004-09-27', 'D:', 'user', '2024-07-01', 1),
                                                                                                                                     (7, 'Emre Güler', 'güleremre@lyceumgent.be', '2005-04-21', ':(', 'user', '2024-07-01', 1),
                                                                                                                                     (8, 'Amin Shabazov', 'shabazovamin@lyceumgent.be', '2006-06-10', '>:(', 'user', '2024-07-01', 1),
                                                                                                                                     (9, 'Maggie Van Damme', 'vandammemagie@lyceumgent.be', '1923-01-24', '):<', 'user', '2024-07-01', 1),
                                                                                                                                     (10, 'Test', 'test@gmail.com', '2024-02-05', 'passwoord', 'admin', '2024-02-07', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblartikel`
--
ALTER TABLE `tblartikel`
    ADD PRIMARY KEY (`artikelID`);

--
-- Indexes for table `tblklant`
--
ALTER TABLE `tblklant`
    ADD PRIMARY KEY (`klantID`),
  ADD UNIQUE KEY `klantemail` (`klantemail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblartikel`
--
ALTER TABLE `tblartikel`
    MODIFY `artikelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblklant`
--
ALTER TABLE `tblklant`
    MODIFY `klantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
