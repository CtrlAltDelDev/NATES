-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 24, 2025 at 05:30 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `NATES`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventTable`
--
CREATE DATABASE NATES;
USE NATES;
CREATE TABLE `eventTable` (
  `eventId` int NOT NULL,
  `speakerId` int NOT NULL,
  `eventStart` datetime NOT NULL,
  `eventEnd` datetime NOT NULL,
  `locationID` int NOT NULL,
  `eventPrice` decimal(7,2) NOT NULL,
  `eventName` varchar(100) NOT NULL,
  `eventDescription` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventTable`
--

INSERT INTO `eventTable` (`eventId`, `speakerId`, `eventStart`, `eventEnd`, `locationID`, `eventPrice`, `eventName`, `eventDescription`, `creationDate`) VALUES
(2, 1, '2025-02-22 21:16:00', '2025-02-22 21:16:00', 1, 1.00, 'First Event!', 'This is a test event. I populated the database successfully!', '2025-02-23 05:22:47'),
(3, 1, '2025-02-22 21:16:00', '2025-02-22 21:16:00', 1, 2.00, 'second Event!', 'This is a test event. I populated the database successfully!', '2025-02-23 05:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `locationTable`
--

CREATE TABLE `locationTable` (
  `locationId` int NOT NULL,
  `state` char(2) NOT NULL,
  `city` varchar(50) NOT NULL,
  `streetNumber` varchar(25) NOT NULL,
  `streetName` varchar(100) NOT NULL,
  `suite` varchar(10) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `venueName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `locationTable`
--

INSERT INTO `locationTable` (`locationId`, `state`, `city`, `streetNumber`, `streetName`, `suite`, `zipcode`, `phone`, `venueName`) VALUES
(1, 'ca', 'Sacramento', '500', 'David J Stern Walk', 'n/a', '95814', '855-555-5555', 'Golden One Center');

-- --------------------------------------------------------

--
-- Table structure for table `speakerTable`
--

CREATE TABLE `speakerTable` (
  `speakerId` int NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `speakerLinks` varchar(100) NOT NULL,
  `speakerPhoto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photoAlt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `speakerBio` varchar(5000) NOT NULL,
  `speakerDetails` varchar(5000) NOT NULL,
  `createDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `speakerTable`
--

INSERT INTO `speakerTable` (`speakerId`, `firstName`, `lastName`, `email`, `phone`, `speakerLinks`, `speakerPhoto`, `photoAlt`, `speakerBio`, `speakerDetails`, `createDate`) VALUES
(16, 'Nathan', 'Sparks', 'sparksnathan84@gmail.com', '9168388401', 'ctrlaltdel.dev', 'speakerPhotos/Speaker1_1740375008.jpg', 'upload', 'Test speaker bio', 'additional information about the talk', '2025-02-23 21:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `userTable`
--

CREATE TABLE `userTable` (
  `userID` int NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `createDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userTable`
--

INSERT INTO `userTable` (`userID`, `firstName`, `lastName`, `email`, `password`, `Role`, `phone`, `createDate`) VALUES
(1, 'Nathan', 'Sparks', 'sparksnathan84@gmail.com', 'TESTING', 'Admin', '9168388401', '2025-02-23 06:52:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventTable`
--
ALTER TABLE `eventTable`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `locationTable`
--
ALTER TABLE `locationTable`
  ADD PRIMARY KEY (`locationId`);

--
-- Indexes for table `speakerTable`
--
ALTER TABLE `speakerTable`
  ADD PRIMARY KEY (`speakerId`);

--
-- Indexes for table `userTable`
--
ALTER TABLE `userTable`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventTable`
--
ALTER TABLE `eventTable`
  MODIFY `eventId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `locationTable`
--
ALTER TABLE `locationTable`
  MODIFY `locationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `speakerTable`
--
ALTER TABLE `speakerTable`
  MODIFY `speakerId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `userTable`
--
ALTER TABLE `userTable`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
