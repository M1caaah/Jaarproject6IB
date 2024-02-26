-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 feb 2024 om 14:48
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bytebazaar`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblclients`
--

CREATE TABLE `tblclients` (
  `client_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tblclients`
--

INSERT INTO `tblclients` (`client_id`, `firstname`, `lastname`, `email`, `password`, `birthdate`, `role_id`) VALUES
(1, 'Micah', 'Botha', 'micah.botha@gmail.com', '$2y$10$BZI5n0Cq77AJHIj24MK6pO1qejbbVXdzl34rJ5JkrriGSqKWhVgnG', '2006-08-21', 1),
(2, 'Obi', 'Verheyen', 'verheyenobi@lyceumgent.be', '$2y$10$rFtlJ3BNwTDk4BSh8TbYiexN.Y0FyZh/P8thhSKPibNj0rNImcFe2', '2004-06-01', 0),
(4, 'Maggie', 'Van Damme', 'vandammemaggie@lyceumgent.be', '$2y$10$9PiU1YXkNM8cQPF2FUvI3u/BNI7eccOe6lBmDuBA2EGdLczBQg6zO', '1970-05-05', 0),
(6, 'Steffy', 'De Scheijter', 'descheijterstef@lyceumgent.be', '$2y$10$Bo4QAA5d7G9LLZBSoeQ2Duu8zleWEA1cPUSUvE46GH8sQI8HgNe92', '2004-10-10', 0),
(7, 'Tim', 'Meesen', 'meesentim@lyceumgent.be', '$2y$10$ssRsA/cjPLjIwAsjp0u3VekiysLwup3sbEgX.9fiuon0Pwe4C17lO', '2006-03-03', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblproducts`
--

CREATE TABLE `tblproducts` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `imagepath` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `age_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tblroles`
--

CREATE TABLE `tblroles` (
  `role_id` int(11) NOT NULL,
  `rolename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `tblroles`
--

INSERT INTO `tblroles` (`role_id`, `rolename`) VALUES
(0, 'User'),
(1, 'Admin');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tblclients`
--
ALTER TABLE `tblclients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexen voor tabel `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `tblroles`
--
ALTER TABLE `tblroles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tblclients`
--
ALTER TABLE `tblclients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `tblroles`
--
ALTER TABLE `tblroles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `tblclients`
--
ALTER TABLE `tblclients`
  ADD CONSTRAINT `tblclients_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tblroles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
