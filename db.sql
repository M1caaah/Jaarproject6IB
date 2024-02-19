-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 01:56 AM
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
  `artikelNaam` varchar(255) NOT NULL,
  `artikelVoorraad` int(11) NOT NULL,
  `artikelPrijs` decimal(10,2) NOT NULL,
  `artikelAfbeelding` varchar(255) NOT NULL,
  `artikelMinLeeftijd` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblartikel`
--

INSERT INTO `tblartikel` (`artikelID`, `artikelNaam`, `artikelVoorraad`, `artikelPrijs`, `artikelAfbeelding`, `artikelMinLeeftijd`, `active`) VALUES
(1, 'Baldur\'s Gate 3', 53, 20.00, 'baldursgate.jpg', 18, 1),
(11, 'Elden Ring', 16, 30.00, 'eldenring.png', 16, 1),
(12, 'Lethal Company', 8, 9.50, 'lethalcompany.webp', 12, 1),
(13, 'Cyberpunk 2077', 23, 29.99, 'cyberpunk.jpg', 18, 1),
(14, 'Windows 11 Pro', 56, 18.99, 'windowspro.jpg', 12, 1),
(15, 'Xbox Game Pass', 13, 7.99, 'gamepass.jpg', 12, 1),
(16, 'Star Wars Jedi: Survivor', 34, 24.99, 'jedisurvivor.jpg', 14, 1),
(17, 'Enshrouded', 45, 12.05, 'enshrouded.jpg', 16, 1),
(18, 'Palworld', 42, 59.99, 'palworld.jpg', 12, 1),
(19, 'Persona 3 Reload', 41, 26.99, 'persona3reload.jpg', 12, 1),
(21, '', 0, 0.00, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblklant`
--

CREATE TABLE `tblklant` (
  `klantID` int(11) NOT NULL,
  `klantnaam` varchar(65) NOT NULL,
  `klantachternaam` varchar(255) NOT NULL,
  `klantemail` varchar(65) NOT NULL,
  `geboortedatum` date NOT NULL,
  `passwoord` varchar(65) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `registratiedatum` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblklant`
--

INSERT INTO `tblklant` (`klantID`, `klantnaam`, `klantachternaam`, `klantemail`, `geboortedatum`, `passwoord`, `rol_id`, `registratiedatum`, `active`) VALUES
(0, 'Obi', 'Verheyen', 'verheyenobi@lyceumgent.be', '2000-06-01', '$2y$10$E1gHijriHctrfO3ZdXzvR.0h1BhdfLWrjVGrDyWoJUgFM21BoFHZe', 1, '2024-07-01', 1),
(1, 'Micah', 'Botha', 'bothamicah@lyceumgent.be', '2006-08-21', '$2y$10$77Wf6IAHAFBhE6ipqXCjce5Ae5R5Ese/kW3gl.oxqJpalBoPV4Vmi', 1, '2024-07-01', 1),
(2, 'Rayan', 'Sayah', 'sayahrayan@lyceumgent.be', '2012-02-03', '$2y$10$xN2Q/gWVTt4bVJhjU.lk2.7nKsFJ61iXo17rGKcuF8KrB.UGdiRqS', 0, '2024-07-01', 1),
(3, 'Tim', 'Meesen', 'meesentim@lyceumgent.be', '1978-05-12', '$2y$10$eVuZCNhQrpwPEuB0ERBtPu85WDXrg2Ld8rBJ8IXO/0Ta9HIUuJbiG', 0, '2024-07-01', 1),
(4, 'Stef', 'De Feyter', 'defeijtersteffy@lyceumgent.be', '2004-10-23', '$2y$10$eF9814meVnlGFrFBJxl4P.tNVUhzdeoiAkHxaP07CdLWz.WqufMsG', 0, '2024-07-01', 1),
(5, 'Brend', 'Van Den Eynde', 'vandeneyndebrendt@lyceumgent.be', '2006-03-14', '$2y$10$lEuLcUA6sCTpwst1fbD22u0LymJ1SBiA3OVg1ISAqf71z8w3atUj2', 0, '2024-07-01', 1),
(6, 'Raîf', 'Demirogullari', 'demirogullariraîf@lyceumgent.be', '2004-09-27', '$2y$10$TUWRP7HiSVgbubjQ.GKQeOHPrFlK.SocKirazlo.TJeyxh.NXBsZS', 0, '2024-07-01', 1),
(7, 'Emre', 'Güler', 'güleremre@lyceumgent.be', '2005-04-21', '$2y$10$PZ0U.SPjqwtAh3437cPfuuMLO8f.rkIkKtYIkVTy/nK14XHG9N0E.', 0, '2024-07-01', 1),
(8, 'Amin', 'Shabazov', 'shabazovamin@lyceumgent.be', '2006-06-10', '$2y$10$LrbdVkKHcC9HoIYm1VjtDen9Booc8q7R85QR7OuVsCJlA6strKCoW', 0, '2024-07-01', 1),
(9, 'Maggie', 'Van Damme', 'vandammemagie@lyceumgent.be', '1923-01-24', '$2y$10$1pK.jvkzgzmN4Vir/BzIdupDg33/vSG3fwP8UhahKE5Q39apuR7aq', 0, '2024-07-01', 1),
(11, 'Micah ', 'Botha', 'mb@mb.com', '2000-02-22', '$2y$10$urQyFGjdfNDSP.i1GV.RBuYUaBCa5BWTgJYN2uI.gpNw6FSQGPIjS', 0, '2024-02-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblrol`
--

CREATE TABLE `tblrol` (
  `rol_id` int(11) NOT NULL,
  `rolnaam` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblrol`
--

INSERT INTO `tblrol` (`rol_id`, `rolnaam`) VALUES
(0, 'User'),
(1, 'Admin');

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
  ADD UNIQUE KEY `klantemail` (`klantemail`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indexes for table `tblrol`
--
ALTER TABLE `tblrol`
  ADD PRIMARY KEY (`rol_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblartikel`
--
ALTER TABLE `tblartikel`
  MODIFY `artikelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblklant`
--
ALTER TABLE `tblklant`
  MODIFY `klantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblrol`
--
ALTER TABLE `tblrol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblklant`
--
ALTER TABLE `tblklant`
  ADD CONSTRAINT `tblklant_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tblrol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
