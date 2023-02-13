-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2023 at 03:29 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsletter`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkbox`
--

CREATE TABLE `checkbox` (
  `id` int NOT NULL,
  `label_checkbox` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkbox`
--

INSERT INTO `checkbox` (`id`, `label_checkbox`) VALUES
(1, 'Peinture'),
(2, 'Sculpture'),
(3, 'Photographie'),
(4, 'Art contemporain'),
(5, 'Films'),
(6, 'Art numérique'),
(7, 'Installations');

-- --------------------------------------------------------

--
-- Table structure for table `origines`
--

CREATE TABLE `origines` (
  `id` int NOT NULL,
  `origine_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `origines`
--

INSERT INTO `origines` (`id`, `origine_label`) VALUES
(3, 'Un ami m’en a parlé'),
(4, 'Recherche sur internet'),
(5, 'Publicité dans un magazine');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `origine_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `created_on`, `email`, `first_name`, `name`, `origine_id`) VALUES
(113, '2023-02-13 15:27:55', 'alfred.dupont@gmail.com', 'Alfred', 'Dupont', NULL),
(114, '2023-02-13 15:27:55', 'b.lav@hotmail.fr', 'Bertrand', 'Lavoisier', NULL),
(115, '2023-02-13 15:27:55', 'SarahLAMINE@gmail.com', 'Sarah', 'LAMINE', NULL),
(116, '2023-02-13 15:27:55', 'mo78@laposte.net', 'Mohamed', 'Ben Salam', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkbox`
--
ALTER TABLE `checkbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `origines`
--
ALTER TABLE `origines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_origine` (`origine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkbox`
--
ALTER TABLE `checkbox`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `origines`
--
ALTER TABLE `origines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD CONSTRAINT `id_origine` FOREIGN KEY (`origine_id`) REFERENCES `origines` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
