-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 03, 2025 at 03:48 AM
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
DROP DATABASE IF EXISTS NATES;
CREATE DATABASE NATES;
USE NATES;

-- --------------------------------------------------------

--
-- Table structure for table `event_table`
--

CREATE TABLE `event_table` (
                               `event_id` int NOT NULL,
                               `speaker_id` int NOT NULL,
                               `event_start` datetime NOT NULL,
                               `event_end` datetime NOT NULL,
                               `location_id` int NOT NULL,
                               `event_price` decimal(7,2) NOT NULL,
                               `event_name` varchar(100) NOT NULL,
                               `event_description` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                               `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_table`
--

INSERT INTO `event_table` (`event_id`, `speaker_id`, `event_start`, `event_end`, `location_id`, `event_price`, `event_name`, `event_description`, `creation_date`) VALUES
(1, 1, '2026-02-28 12:00:00', '2025-02-28 15:00:00', 2, 150.00, 'Oscars Petroleum Talk', 'At NATES, Oscar will share his expertise on the future of petroleum engineering, the role of technology in optimizing resource extraction, and strategies for balancing economic viability with environmental stewardship.', '2025-03-02 21:11:14'),
(2, 2, '2025-11-03 09:00:00', '2025-11-03 15:45:00', 3, 475.00, 'Hybrid and Electric Vehicle Repair Best Practices', 'At NATES: Nathan\'s Automotive Technical Education Summit, Franklyn will be sharing his insights on the future of automotive repair, the impact of electric and hybrid vehicles on the industry, and best practices for staying ahead in an ever-changing field. Whether you\'re an experienced technician or just beginning your journey in automotive repair, Franklyn\'s engaging and informative sessions will equip you with the knowledge and skills needed to thrive in today’s automotive industry.', '2025-03-03 01:49:46'),
(3, 3, '2025-05-29 08:00:00', '2025-05-29 15:30:00', 1, 695.00, 'Diesel Tech Talk With D Merc', 'As a featured speaker at NATES: Nathan\'s Automotive Technical Education Summit, Daniel will deliver insights on advanced diesel diagnostics, emission regulations, and the latest innovations in diesel engine performance. His engaging and hands-on approach ensures that attendees walk away with practical skills and industry knowledge that they can apply immediately.', '2025-03-03 02:03:17'),
(4, 4, '2025-11-03 07:30:00', '2025-11-03 16:30:00', 2, 499.00, 'High-Voltage Safety Protocols', 'At NATES: Nathan’s Automotive Technical Education Summit, Samantha will lead a hands-on workshop covering advanced vehicle electronics, sensor diagnostics, and high-voltage safety protocols. Whether you\'re new to electrical diagnostics or looking to refine your expertise, her session will provide practical knowledge and real-world applications to help you excel in today’s technology-driven automotive industry.', '2025-03-03 03:31:20'),
(5, 5, '2025-03-05 00:30:00', '2025-03-05 00:30:00', 4, 695.00, 'gfhj', 'fhgh', '2025-03-05 08:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `location_table`
--

CREATE TABLE `location_table` (
                                  `location_id` int NOT NULL,
                                  `state` char(2) NOT NULL,
                                  `city` varchar(50) NOT NULL,
                                  `street_number` varchar(25) NOT NULL,
                                  `street_name` varchar(100) NOT NULL,
                                  `suite` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                                  `zipcode` varchar(10) NOT NULL,
                                  `phone` varchar(20) NOT NULL,
                                  `venue_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `location_table`
--

INSERT INTO `location_table` (`location_id`, `state`, `city`, `street_number`, `street_name`, `suite`, `zipcode`, `phone`, `venue_name`) VALUES
 (1, 'ca', 'Sacramento', '500', 'David J Stern Walk', 'n/a', '95814', '855-555-5555', 'Golden One Center'),
 (2, 'CA', 'San Francisco', '50', '3rd St', NULL, '94103', '4159746400', 'Hyatt Regency SF'),
 (3, 'WA', 'Tacoma', '2727 ', 'E D St', NULL, '98421', '(253) 272-3663', 'Tacoma Dome'),
 (4, 'NY', 'Long Island', '3608', '33rd st', NULL, '11106', '934-555-7841', 'Melrose Ballroom'),
 (5, 'OR', 'Portland', '2357', '3rd st', '37', '52478', '5035551423', 'Portland Event Center'),
 (6, 'ph', 'php', '404', 'testing', '404', '404404', '404-404-4444', 'php error');

-- --------------------------------------------------------

--
-- Table structure for table `speaker_table`
--

CREATE TABLE `speaker_table` (
                                 `speaker_id` int NOT NULL,
                                 `first_name` varchar(100) NOT NULL,
                                 `last_name` varchar(100) NOT NULL,
                                 `email` varchar(100) NOT NULL,
                                 `phone` varchar(20) NOT NULL,
                                 `speaker_links` varchar(100) NOT NULL,
                                 `speaker_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                                 `photo_alt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                                 `speaker_bio` varchar(5000) NOT NULL,
                                 `speaker_details` varchar(5000) NOT NULL,
                                 `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `speaker_table`
--

INSERT INTO `speaker_table` (`speaker_id`, `first_name`, `last_name`, `email`, `phone`, `speaker_links`, `speaker_photo`, `photo_alt`, `speaker_bio`, `speaker_details`, `create_date`) VALUES
(1, 'Oscar', 'Allen', 'Oscara@nates.com', '18885554565', 'https://ctrlaltdel.dev/NATES/', 'speakerPhotos/OscarAllen_1740945958.jpg', 'Photograph of event speaker Oscar Allen', 'Oscar Allen is a highly skilled petroleum engineer with over a decade of experience in the oil and gas industry. Specializing in reservoir engineering, drilling operations, and energy resource management, Oscar has played a pivotal role in optimizing extraction techniques and improving efficiency in hydrocarbon production.\r\n\r\nHolding a degree in Petroleum Engineering, Oscar has worked with major energy corporations and independent operators, leading projects that focus on sustainable resource development and innovative drilling technologies. His expertise includes well stimulation, enhanced oil recovery (EOR), and the integration of advanced data analytics to maximize output while minimizing environmental impact.', 'Beyond his technical contributions, Oscar is a passionate advocate for responsible energy production and has been involved in industry panels, technical conferences, and mentorship programs aimed at developing the next generation of petroleum engineers. His insights into energy market trends and cutting-edge drilling methodologies make him a sought-after speaker in the field.\r\n\r\nAt NATES, Oscar will share his expertise on the future of petroleum engineering, the role of technology in optimizing resource extraction, and strategies for balancing economic viability with environmental stewardship.', '2025-03-02 12:05:58'),
(2, 'Franklyn', 'Hayward', 'haywardf@hayfrank.com', '253-555-7788', 'hayfrank.com', 'speakerPhotos/FranklynHayward_1740966290.jpg', 'Franklyn Hayward, an automotive expert with short salt-and-pepper hair and a beard.', 'Franklyn Hayward is a leading voice in the world of automotive technology, specializing in vehicle diagnostics, hybrid systems, and technical education. With a passion for innovation and hands-on training, Franklyn has spent over a decade bridging the gap between traditional automotive repair and the rapidly evolving landscape of modern vehicle technology.\r\n\r\n', 'A seasoned educator and industry professional, Franklyn has worked extensively with automotive training programs, helping technicians and students master the complexities of vehicle performance, emerging electric and hybrid technologies, and advanced diagnostics. His expertise in technical instruction makes him a sought-after speaker at conferences, workshops, and industry summits.', '2025-03-02 17:44:50'),
(3, 'Daniel', 'Mercer', 'dmercer@dmerc.com', '916-555-6782', 'dmerc.com', 'speakerPhotos/dmerc_1740967240.jpg', 'Daniel Mercer, a diesel engine specialist with induction hair cut and a neatly trimmed beard.', 'With a career spanning over a decade in diesel engine technology, Daniel Mercer is a highly respected expert in the field of heavy-duty vehicle maintenance, diagnostics, and performance optimization. His deep understanding of fuel injection systems, turbochargers, and emissions control technologies has made him a sought-after instructor and consultant for technicians and industry professionals alike.', 'Daniel\'s expertise extends beyond just repairs—he is passionate about teaching the next generation of mechanics the evolving science behind diesel engines. He has worked with top automotive training programs, helping students and professionals stay ahead in a world shifting toward cleaner, more efficient diesel technology.', '2025-03-02 18:00:40'),
(4, 'Samantha', 'Greeneee', 'Sam@greensam.com', '212-555-7391', 'greensam.com', 'speakerPhotos/greensam_1740972368.jpg', 'Samantha Greene, an automotive electrical systems expert with shoulder-length blond hair.', 'Samantha Greene is a highly respected automotive electrical systems specialist with over a decade of experience in vehicle diagnostics, electrical troubleshooting, and hybrid technology. Her expertise spans advanced wiring systems, onboard diagnostics (OBD), and high-voltage vehicle components, making her a key resource for technicians looking to master modern automotive electronics.\r\n\r\nAs a certified instructor and industry consultant, Samantha has trained countless automotive professionals on diagnosing complex electrical issues, integrating new vehicle technologies, and enhancing workshop efficiency. She is passionate about breaking down intricate electrical systems into easy-to-understand concepts, ensuring technicians at all levels can confidently tackle electrical repairs.', 'Automotive Electrical Systems Expert & Educator', '2025-03-02 19:26:08'),
(5, 'New ', 'test', 'user@errortesting.com', '9168358401', 'testingphperrors.com', 'speakerPhotos/php-error-handling_1741277407.jpg', 'testing for errors', 'testing for php errors', 'do I work', '2025-03-06 08:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
                              `user_id` int NOT NULL,
                              `first_name` varchar(100) NOT NULL,
                              `last_name` varchar(100) NOT NULL,
                              `email` varchar(100) NOT NULL,
                              `password` varchar(100) NOT NULL,
                              `role` varchar(20) NOT NULL,
                              `phone` varchar(20) NOT NULL,
                              `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `first_name`, `last_name`, `email`, `password`, `role`, `phone`, `create_date`) VALUES
(1, 'Nathan', 'Sparks', 'sparksnathan84@gmail.com', 'TESTING', 'Admin', '9168388401', '2025-02-23 06:52:29'),
(2, 'Joel', 'Jobs', 'jj@jobs.com', 'Testing', 'User', '2065552354', '2025-03-04 22:56:10'),
(3, 'Kris', 'Who', 'Kris@Who.com', '123456789', 'Admin', '7815557832', '2025-03-05 08:34:16'),
(4, 'Error', 'Man', 'error.phptesting.com', 'error', 'Admin', '404-404-4444', '2025-03-06 16:13:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event_table`
--
ALTER TABLE `event_table`
    ADD PRIMARY KEY (`event_id`),
    ADD KEY `speaker` (`speaker_id`),
    ADD KEY `location` (`location_id`);

--
-- Indexes for table `location_table`
--
ALTER TABLE `location_table`
    ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `speaker_table`
--
ALTER TABLE `speaker_table`
    ADD PRIMARY KEY (`speaker_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
    ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event_table`
--
ALTER TABLE `event_table`
    MODIFY `event_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `location_table`
--
ALTER TABLE `location_table`
    MODIFY `location_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `speaker_table`
--
ALTER TABLE `speaker_table`
    MODIFY `speaker_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
    MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_table`
--
ALTER TABLE `event_table`
    ADD CONSTRAINT `location` FOREIGN KEY (`location_id`) REFERENCES `location_table` (`location_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
    ADD CONSTRAINT `speaker` FOREIGN KEY (`speaker_id`) REFERENCES `speaker_table` (`speaker_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
