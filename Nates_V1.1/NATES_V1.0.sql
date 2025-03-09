-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 09, 2025 at 12:43 AM
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
-- Database: `NATES_V1.0`
--
CREATE DATABASE IF NOT EXISTS `NATES_V1.0` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `NATES_V1.0`;

-- --------------------------------------------------------

--
-- Table structure for table `eventTable`
--

DROP TABLE IF EXISTS `eventTable`;
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
(10, 17, '2026-02-28 12:00:00', '2025-02-28 15:00:00', 2, 150.00, 'Oscars Petroleum Talk', 'At NATES, Oscar will share his expertise on the future of petroleum engineering, the role of technology in optimizing resource extraction, and strategies for balancing economic viability with environmental stewardship.', '2025-03-02 21:11:14'),
(12, 18, '2025-11-03 09:00:00', '2025-11-03 15:45:00', 3, 475.00, 'Hybrid and Electric Vehicle Repair Best Practices', 'At NATES: Nathan\'s Automotive Technical Education Summit, Franklyn will be sharing his insights on the future of automotive repair, the impact of electric and hybrid vehicles on the industry, and best practices for staying ahead in an ever-changing field. Whether you\'re an experienced technician or just beginning your journey in automotive repair, Franklyn\'s engaging and informative sessions will equip you with the knowledge and skills needed to thrive in today’s automotive industry.', '2025-03-03 01:49:46'),
(13, 19, '2025-05-29 08:00:00', '2025-05-29 15:30:00', 1, 695.00, 'Diesel Tech Talk With D Merc', 'As a featured speaker at NATES: Nathan\'s Automotive Technical Education Summit, Daniel will deliver insights on advanced diesel diagnostics, emission regulations, and the latest innovations in diesel engine performance. His engaging and hands-on approach ensures that attendees walk away with practical skills and industry knowledge that they can apply immediately.', '2025-03-03 02:03:17'),
(14, 20, '2025-11-03 07:30:00', '2025-11-03 16:30:00', 2, 499.00, 'High-Voltage Safety Protocols', 'At NATES: Nathan’s Automotive Technical Education Summit, Samantha will lead a hands-on workshop covering advanced vehicle electronics, sensor diagnostics, and high-voltage safety protocols. Whether you\'re new to electrical diagnostics or looking to refine your expertise, her session will provide practical knowledge and real-world applications to help you excel in today’s technology-driven automotive industry.', '2025-03-03 03:31:20'),
(15, 17, '2025-03-05 00:30:00', '2025-03-05 00:30:00', 4, 695.00, 'gfhj', 'fhgh', '2025-03-05 08:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `locationTable`
--

DROP TABLE IF EXISTS `locationTable`;
CREATE TABLE `locationTable` (
  `locationId` int NOT NULL,
  `state` char(2) NOT NULL,
  `city` varchar(50) NOT NULL,
  `streetNumber` varchar(25) NOT NULL,
  `streetName` varchar(100) NOT NULL,
  `suite` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `zipcode` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `venueName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `locationTable`
--

INSERT INTO `locationTable` (`locationId`, `state`, `city`, `streetNumber`, `streetName`, `suite`, `zipcode`, `phone`, `venueName`) VALUES
(1, 'ca', 'Sacramento', '500', 'David J Stern Walk', 'n/a', '95814', '855-555-5555', 'Golden One Center'),
(2, 'CA', 'San Francisco', '50', '3rd St', NULL, '94103', '4159746400', 'Hyatt Regency SF'),
(3, 'WA', 'Tacoma', '2727 ', 'E D St', NULL, '98421', '(253) 272-3663', 'Tacoma Dome'),
(4, 'NY', 'Long Island', '3608', '33rd st', NULL, '11106', '934-555-7841', 'Melrose Ballroom'),
(5, 'OR', 'Portland', '2357', '3rd st', '37', '52478', '5035551423', 'Portland Event Center'),
(6, 'ph', 'php', '404', 'testing', '404', '404404', '404-404-4444', 'php error');

-- --------------------------------------------------------

--
-- Table structure for table `speakerTable`
--

DROP TABLE IF EXISTS `speakerTable`;
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
(17, 'Oscar', 'Allen', 'Oscara@nates.com', '18885554565', 'https://ctrlaltdel.dev/NATES/', 'speakerPhotos/OscarAllen_1740945958.jpg', 'Photograph of event speaker Oscar Allen', 'Oscar Allen is a highly skilled petroleum engineer with over a decade of experience in the oil and gas industry. Specializing in reservoir engineering, drilling operations, and energy resource management, Oscar has played a pivotal role in optimizing extraction techniques and improving efficiency in hydrocarbon production.\r\n\r\nHolding a degree in Petroleum Engineering, Oscar has worked with major energy corporations and independent operators, leading projects that focus on sustainable resource development and innovative drilling technologies. His expertise includes well stimulation, enhanced oil recovery (EOR), and the integration of advanced data analytics to maximize output while minimizing environmental impact.', 'Beyond his technical contributions, Oscar is a passionate advocate for responsible energy production and has been involved in industry panels, technical conferences, and mentorship programs aimed at developing the next generation of petroleum engineers. His insights into energy market trends and cutting-edge drilling methodologies make him a sought-after speaker in the field.\r\n\r\nAt NATES, Oscar will share his expertise on the future of petroleum engineering, the role of technology in optimizing resource extraction, and strategies for balancing economic viability with environmental stewardship.', '2025-03-02 12:05:58'),
(18, 'Franklyn', 'Hayward', 'haywardf@hayfrank.com', '253-555-7788', 'hayfrank.com', 'speakerPhotos/FranklynHayward_1740966290.jpg', 'Franklyn Hayward, an automotive expert with short salt-and-pepper hair and a beard.', 'Franklyn Hayward is a leading voice in the world of automotive technology, specializing in vehicle diagnostics, hybrid systems, and technical education. With a passion for innovation and hands-on training, Franklyn has spent over a decade bridging the gap between traditional automotive repair and the rapidly evolving landscape of modern vehicle technology.\r\n\r\n', 'A seasoned educator and industry professional, Franklyn has worked extensively with automotive training programs, helping technicians and students master the complexities of vehicle performance, emerging electric and hybrid technologies, and advanced diagnostics. His expertise in technical instruction makes him a sought-after speaker at conferences, workshops, and industry summits.', '2025-03-02 17:44:50'),
(19, 'Daniel', 'Mercer', 'dmercer@dmerc.com', '916-555-6782', 'dmerc.com', 'speakerPhotos/dmerc_1740967240.jpg', 'Daniel Mercer, a diesel engine specialist with induction hair cut and a neatly trimmed beard.', 'With a career spanning over a decade in diesel engine technology, Daniel Mercer is a highly respected expert in the field of heavy-duty vehicle maintenance, diagnostics, and performance optimization. His deep understanding of fuel injection systems, turbochargers, and emissions control technologies has made him a sought-after instructor and consultant for technicians and industry professionals alike.', 'Daniel\'s expertise extends beyond just repairs—he is passionate about teaching the next generation of mechanics the evolving science behind diesel engines. He has worked with top automotive training programs, helping students and professionals stay ahead in a world shifting toward cleaner, more efficient diesel technology.', '2025-03-02 18:00:40'),
(20, 'Samantha', 'Greeneee', 'Sam@greensam.com', '212-555-7391', 'greensam.com', 'speakerPhotos/greensam_1740972368.jpg', 'Samantha Greene, an automotive electrical systems expert with shoulder-length blond hair.', 'Samantha Greene is a highly respected automotive electrical systems specialist with over a decade of experience in vehicle diagnostics, electrical troubleshooting, and hybrid technology. Her expertise spans advanced wiring systems, onboard diagnostics (OBD), and high-voltage vehicle components, making her a key resource for technicians looking to master modern automotive electronics.\r\n\r\nAs a certified instructor and industry consultant, Samantha has trained countless automotive professionals on diagnosing complex electrical issues, integrating new vehicle technologies, and enhancing workshop efficiency. She is passionate about breaking down intricate electrical systems into easy-to-understand concepts, ensuring technicians at all levels can confidently tackle electrical repairs.', 'Automotive Electrical Systems Expert & Educator', '2025-03-02 19:26:08'),
(21, 'New ', 'test', 'user@errortesting.com', '9168358401', 'testingphperrors.com', 'speakerPhotos/php-error-handling_1741277407.jpg', 'testing for errors', 'testing for php errors', 'do I work', '2025-03-06 08:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `userTable`
--

DROP TABLE IF EXISTS `userTable`;
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
(1, 'Nathan', 'Sparks', 'sparksnathan84@gmail.com', 'TESTING', 'Admin', '9168388401', '2025-02-23 06:52:29'),
(2, 'Joel', 'Jobs', 'jj@jobs.com', 'Testing', 'User', '2065552354', '2025-03-04 22:56:10'),
(3, 'Kris', 'Who', 'Kris@Who.com', '123456789', 'Admin', '7815557832', '2025-03-05 08:34:16'),
(4, 'Error', 'Man', 'error.phptesting.com', 'error', 'Admin', '404-404-4444', '2025-03-06 16:13:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventTable`
--
ALTER TABLE `eventTable`
  ADD PRIMARY KEY (`eventId`),
  ADD KEY `speaker` (`speakerId`),
  ADD KEY `location` (`locationID`);

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
  MODIFY `eventId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `locationTable`
--
ALTER TABLE `locationTable`
  MODIFY `locationId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `speakerTable`
--
ALTER TABLE `speakerTable`
  MODIFY `speakerId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `userTable`
--
ALTER TABLE `userTable`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventTable`
--
ALTER TABLE `eventTable`
  ADD CONSTRAINT `location` FOREIGN KEY (`locationID`) REFERENCES `locationTable` (`locationId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `speaker` FOREIGN KEY (`speakerId`) REFERENCES `speakerTable` (`speakerId`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
