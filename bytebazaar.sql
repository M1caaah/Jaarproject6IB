-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 06:40 PM
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
-- Database: `bytebazaar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcarts`
--

CREATE TABLE `tblcarts` (
  `cart_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcarts`
--

INSERT INTO `tblcarts` (`cart_id`, `client_id`) VALUES
(5, 32),
(6, 33),
(4, 42);

-- --------------------------------------------------------

--
-- Table structure for table `tblcart_items`
--

CREATE TABLE `tblcart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblclients`
--

CREATE TABLE `tblclients` (
  `client_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `regDate` date NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclients`
--

INSERT INTO `tblclients` (`client_id`, `firstname`, `lastname`, `email`, `birthdate`, `password`, `role_id`, `regDate`, `active`) VALUES
(32, 'Micah', 'Botha', 'micah.botha@gmail.com', '2006-08-21', '$2y$10$83WqqlS.4VsXQcFw83cLiugll0unYApwlqGAXi14ljDd0DnPaEHu2', 1, '2024-02-19', 1),
(33, 'Obi', 'Verheyen', 'verheyenobi@lyceumgent.be', '2004-06-01', '$2y$10$6q1cEdYwKcSQakQCzk8HkewSylWNDDnM7AVscG9DTTIroEUAzKXiG', 0, '2024-02-19', 1),
(42, 'Rayan', 'Sayah', 'rs@gmail.com', '2004-06-30', '$2y$10$78UyEwaNfb8Fv0tvUeasFuOwbYHhbDwMsNpIeyM.t0QbJN/mKWVKO', 0, '2024-04-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorders`
--

INSERT INTO `tblorders` (`order_id`, `client_id`, `date`, `total`, `status`, `active`) VALUES
(11, 32, '2024-05-02', 71.96, 0, 1),
(12, 33, '2024-05-02', 50.92, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_items`
--

CREATE TABLE `tblorder_items` (
  `order_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorder_items`
--

INSERT INTO `tblorder_items` (`order_item_id`, `product_id`, `order_id`, `quantity`, `price`) VALUES
(14, 14, 11, 2, 3.49),
(15, 16, 11, 1, 49.99),
(16, 22, 11, 1, 14.99),
(17, 23, 12, 5, 6.00),
(18, 20, 12, 1, 20.92);

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `product_id` int(11) NOT NULL,
  `productName` text NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `bannerPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`product_id`, `productName`, `description`, `price`, `imagePath`, `active`, `bannerPath`) VALUES
(14, 'Celeste', 'Help Madeline survive her inner demons on her journey to the top of Celeste Mountain, in this super-tight platformer from the creators of TowerFall. Brave hundreds of hand-crafted challenges, uncover devious secrets, and piece together the mystery of the mountain.', 3.49, '/productImages/celeste.webp', 1, 'productImages/celeste-banner.webp'),
(15, 'Helldivers 2 ', 'The Galaxy’s Last Line of Offence. Enlist in the Helldivers and join the fight for freedom across a hostile galaxy in a fast, frantic, and ferocious third-person shooter.', 30.49, '/productImages/helldivers-2.webp', 1, NULL),
(16, 'Elden Ring', 'THE NEW FANTASY ACTION RPG. Rise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.', 49.99, '/productImages/elden-ring.webp', 1, NULL),
(17, 'Dragon&#39;s Dogma 2', 'Dragon’s Dogma 2 is a single player, narrative driven action-RPG that challenges the players to choose their own experience – from the appearance of their Arisen, their vocation, their party, how to approach different situations and more - in a truly immersive fantasy world.&#13;&#10;', 40.98, '/productImages/dragons-dogma-2.webp', 1, NULL),
(18, 'Horizon Forbidden West', 'Experience the epic Horizon Forbidden West™ in its entirety with bonus content and the Burning Shores expansion included. The Burning Shores add-on contains additional content for Aloy’s adventure, including new storylines, characters, and experiences in a stunning yet hazardous new area.&#13;&#10;', 45.99, '/productImages/horizon-forbidden-west.webp', 1, NULL),
(19, 'Content Warning', 'Film your friends doing scary things to become SpöökTube famous! (strongly advised to not go alone)&#13;&#10;', 2.98, '/productImages/content-warning.webp', 1, NULL),
(20, 'Baldur&#39;s Gate 3', 'Baldur’s Gate 3 is a story-rich, party-based RPG set in the universe of Dungeons &#38; Dragons, where your choices shape a tale of fellowship and betrayal, survival and sacrifice, and the lure of absolute power.&#13;&#10;', 20.92, '/productImages/baldurs-gate-3.webp', 1, NULL),
(21, 'ULTRAKILL', 'ULTRAKILL is a fast-paced ultraviolent retro FPS combining the skill-based style scoring from character action games with unadulterated carnage inspired by the best shooters of the &#39;90s. Rip apart your foes with varied destructive weapons and shower in their blood to regain your health.&#13;&#10;', 10.50, '/productImages/ultrakill.webp', 1, NULL),
(22, 'Guilty Gear Strive', 'The cutting-edge 2D/3D hybrid graphics pioneered in the Guilty Gear series have been raised to the next level in “GUILTY GEAR -STRIVE-“. The new artistic direction and improved character animations will go beyond anything you’ve seen before in a fighting game!&#13;&#10;', 14.99, '/productImages/guilty-gear-strive.webp', 1, NULL),
(23, 'Half Life 2', '1998. HALF-LIFE sends a shock through the game industry with its combination of pounding action and continuous, immersive storytelling. Valve&#39;s debut title wins more than 50 game-of-the-year awards on its way to being named &#34;Best PC Game Ever&#34; by PC Gamer, and launches a franchise with more than eight million retail units sold worldwide.&#13;&#10;', 6.00, '/productImages/half-life-2.webp', 1, NULL),
(24, 'Hollow Knight', 'Forge your own path in Hollow Knight! An epic action adventure through a vast ruined kingdom of insects and heroes. Explore twisting caverns, battle tainted creatures and befriend bizarre bugs, all in a classic, hand-drawn 2D style.&#13;&#10;', 9.95, '/productImages/hollow-knight.webp', 1, 'productImages/hollow-knight-banner.webp'),
(29, 'Dark Souls 3', 'Dark Souls continues to push the boundaries with the latest, ambitious chapter in the critically-acclaimed and genre-defining series. Prepare yourself and Embrace The Darkness!', 2.00, '/productImages/dark-souls-3.webp', 1, 'productImages/dark-souls-3-banner.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tblroles`
--

CREATE TABLE `tblroles` (
  `role_id` int(11) NOT NULL,
  `roleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblroles`
--

INSERT INTO `tblroles` (`role_id`, `roleName`) VALUES
(0, 'User'),
(1, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcarts`
--
ALTER TABLE `tblcarts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`client_id`);

--
-- Indexes for table `tblcart_items`
--
ALTER TABLE `tblcart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tblclients`
--
ALTER TABLE `tblclients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `role` (`role_id`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `tblorder_items`
--
ALTER TABLE `tblorder_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tblroles`
--
ALTER TABLE `tblroles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcarts`
--
ALTER TABLE `tblcarts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcart_items`
--
ALTER TABLE `tblcart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tblclients`
--
ALTER TABLE `tblclients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblorder_items`
--
ALTER TABLE `tblorder_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tblroles`
--
ALTER TABLE `tblroles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcarts`
--
ALTER TABLE `tblcarts`
  ADD CONSTRAINT `tblcarts_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tblclients` (`client_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tblclients`
--
ALTER TABLE `tblclients`
  ADD CONSTRAINT `tblclients_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tblroles` (`role_id`);

--
-- Constraints for table `tblorder_items`
--
ALTER TABLE `tblorder_items`
  ADD CONSTRAINT `tblorder_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tblorders` (`order_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tblorder_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tblproducts` (`product_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
