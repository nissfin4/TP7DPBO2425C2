-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2025 at 04:05 AM
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
-- Database: `db_konser`
--

-- --------------------------------------------------------

--
-- Table structure for table `concert`
--

CREATE TABLE `concert` (
  `id_concert` int(11) NOT NULL,
  `concert_name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `venue` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `concert`
--

INSERT INTO `concert` (`id_concert`, `concert_name`, `date`, `venue`) VALUES
(1, 'Coldplay Music of the Spheres', '2025-03-17', 'Gelora Bung Karno, Jakarta'),
(2, 'Taylor Swift The Eras Tour', '2025-06-20', 'Singapore National Stadium'),
(3, 'NCT Dream Road to Dream Show', '2025-04-05', 'ICE BSD Hall 5-6');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_ticket_category` int(11) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `id_ticket_category`, `customer_name`, `qty`) VALUES
(1, 1, 'Nisrina Safinatunnajah', 2),
(2, 3, 'Repa Pitriani', 1),
(3, 5, 'Fauzia Rahma', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_category`
--

CREATE TABLE `ticket_category` (
  `id_ticket_category` int(11) NOT NULL,
  `id_concert` int(11) DEFAULT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_category`
--

INSERT INTO `ticket_category` (`id_ticket_category`, `id_concert`, `category_name`, `price`, `quota`) VALUES
(1, 1, 'VIP', 5500000, 100),
(2, 1, 'Festival A', 3800000, 250),
(3, 2, 'CAT 1', 7200000, 150),
(4, 2, 'CAT 2', 5200000, 300),
(5, 3, 'Festival', 2700000, 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `concert`
--
ALTER TABLE `concert`
  ADD PRIMARY KEY (`id_concert`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_ticket_category` (`id_ticket_category`);

--
-- Indexes for table `ticket_category`
--
ALTER TABLE `ticket_category`
  ADD PRIMARY KEY (`id_ticket_category`),
  ADD KEY `id_concert` (`id_concert`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `concert`
--
ALTER TABLE `concert`
  MODIFY `id_concert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_category`
--
ALTER TABLE `ticket_category`
  MODIFY `id_ticket_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_ticket_category`) REFERENCES `ticket_category` (`id_ticket_category`);

--
-- Constraints for table `ticket_category`
--
ALTER TABLE `ticket_category`
  ADD CONSTRAINT `ticket_category_ibfk_1` FOREIGN KEY (`id_concert`) REFERENCES `concert` (`id_concert`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
