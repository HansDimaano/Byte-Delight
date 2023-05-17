-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 05:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bytedelight_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_products`
--

CREATE TABLE `menu_products` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_products`
--

INSERT INTO `menu_products` (`ID`, `name`, `image`, `price`) VALUES
(1, 'Caramelt Deluxe', 'assets/caramelt_icon.png', 15),
(2, 'Cocoa Bronze', 'assets/cocoa_bronze_icon.png', 10),
(3, 'Americano Rocks', 'assets/americano_rocks_icon.png', 15),
(4, 'Cpu-ccino', 'assets/cpu-ccino_icon.png', 15),
(5, 'Machine-ato', 'assets/machine-ato_icon.png', 15),
(6, 'Cloud-9 Coffee', 'assets/cloud-9_coffee_icon.png', 15),
(7, 'Quaso', 'assets/quaso_icon.png', 10),
(8, 'Chocopixel Cookie', 'assets/chocopixel_cookie_icon.png', 5),
(9, 'Puffin\' Muffin', 'assets/puffin\'_muffin_icon.png', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `orderDetails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`orderDetails`)),
  `totalItems` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `apartment` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `orderTimestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ID`, `orderDetails`, `totalItems`, `totalPrice`, `firstName`, `lastName`, `email`, `apartment`, `street`, `area`, `city`, `payment`, `orderTimestamp`) VALUES
(1, '[\"2 orders of Americano Rocks.\",\"1 order of Cocoa Bronze.\"]', 3, 40, 'Hans', 'Dimaano', 'hans@gmail.com', '1106', 'Najda', 'Markaziyah', 'Abu Dhabi', 'Card', '2023-05-03 10:06:01'),
(2, '[\"1 order of Machine-ato.\",\"1 order of Americano Rocks.\"]', 2, 30, 'Hans', 'Dimaano', 'hans@gmail.com', '1106', 'Najda', 'Maghds', 'Abu Dhabi', 'Card', '2023-05-14 19:38:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_products`
--
ALTER TABLE `menu_products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_products`
--
ALTER TABLE `menu_products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
