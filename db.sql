-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2024 at 08:12 PM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `productid` int(11) NOT NULL,
  `productnaam` text NOT NULL,
  `omschrijving` text NOT NULL,
  `prijs` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblartikel`
--

INSERT INTO `tblartikel` (`productid`, `productnaam`, `omschrijving`, `prijs`) VALUES
(1, 'TestProduct', 'TEST', 1337),
(12, 'TestProduct2', 'aaaa', 5),
(13, 'AAAA', 'dqdq', 5);

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
  `registratiedatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblklant`
--

INSERT INTO `tblklant` (`klantID`, `klantnaam`, `klantemail`, `geboortedatum`, `passwoord`, `rol`, `registratiedatum`) VALUES
(0, 'Obi Verheyen', 'verheyenobi@lyceumgent.be', '2004-06-01', 'pizza', 'admin', '2024-07-01'),
(1, 'Micah Botha', 'bothamicah@lyceumgent.be', '2006-08-21', 'password', 'admin', '2024-07-01'),
(2, 'Rayan Sayah', 'sayahrayan@lyceumgent.be', '2012-02-03', 'notpassword', 'user', '2024-07-01'),
(3, 'Tim Meesen', 'meesentim@lyceumgent.be', '1978-05-12', 'hello :D', 'user', '2024-07-01'),
(4, 'Steffy De Schijter', 'deschijtersteffy@lyceumgent.be', '0000-00-00', 'E', 'user', '2024-07-01'),
(5, 'Brendt Van Den Eynde', 'vandeneyndebrenda@lyceumgent.be', '0000-00-00', ':D', 'user', '2024-07-01'),
(6, 'Raîf Demirogullari', 'demirogullariraîf@lyceumgent.be', '0000-00-00', 'D:', 'user', '2024-07-01'),
(7, 'Emre Güler', 'güleremre@lyceumgent.be', '0000-00-00', ':(', 'user', '2024-07-01'),
(8, 'Amin Shabazov', 'shabazovamin@lyceumgent.be', '0000-00-00', '>:(', 'user', '2024-07-01'),
(9, 'Maggie Van Damme', 'vandammemagie@lyceumgent.be', '0000-00-00', '):<', 'user', '2024-07-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblartikel`
--
ALTER TABLE `tblartikel`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `tblklant`
--
ALTER TABLE `tblklant`
  ADD PRIMARY KEY (`klantID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblartikel`
--
ALTER TABLE `tblartikel`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tblklant`
--
ALTER TABLE `tblklant`
  MODIFY `klantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
