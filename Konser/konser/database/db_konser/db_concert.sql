-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 10:36 AM
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
-- Database: `db_concert`
--

-- --------------------------------------------------------

--
-- Table structure for table `concerts`
--

CREATE TABLE `concerts` (
  `id_concert` int(11) NOT NULL,
  `concert_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `venue` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `concerts`
--

INSERT INTO `concerts` (`id_concert`, `concert_name`, `date`, `venue`) VALUES
(1, 'LANY', '2025-12-01', 'Jakarta International Stadium'),
(2, 'Coldplay: Music of the Spheres', '2025-11-20', 'Gelora Bung Karno'),
(3, 'NCT DREAM THE DREAM SHOW', '2025-09-10', 'Jakarta International Stadium');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id_reservation` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `id_concert` int(11) NOT NULL,
  `id_ticket_category` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id_reservation`, `customer_name`, `id_concert`, `id_ticket_category`, `quantity`) VALUES
(1, 'Nisrina Safinatunnajah', 1, 1, 2),
(2, 'Ervina Kusnanda', 2, 3, 1),
(3, 'Fauzia Rahma', 3, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id_ticket_category` int(11) NOT NULL,
  `id_concert` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_categories`
--

INSERT INTO `ticket_categories` (`id_ticket_category`, `id_concert`, `category_name`, `price`, `quota`) VALUES
(1, 1, 'VIP', 1500000.00, 200),
(2, 1, 'Regular', 750000.00, 500),
(3, 2, 'Gold', 2500000.00, 300),
(4, 2, 'Silver', 1200000.00, 600),
(5, 3, 'VIP', 1800000.00, 250),
(6, 3, 'Regular', 950000.00, 400);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `concerts`
--
ALTER TABLE `concerts`
  ADD PRIMARY KEY (`id_concert`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_concert` (`id_concert`),
  ADD KEY `id_ticket_category` (`id_ticket_category`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id_ticket_category`),
  ADD KEY `id_concert` (`id_concert`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `concerts`
--
ALTER TABLE `concerts`
  MODIFY `id_concert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id_ticket_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_concert`) REFERENCES `concerts` (`id_concert`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`id_ticket_category`) REFERENCES `ticket_categories` (`id_ticket_category`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD CONSTRAINT `ticket_categories_ibfk_1` FOREIGN KEY (`id_concert`) REFERENCES `concerts` (`id_concert`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
