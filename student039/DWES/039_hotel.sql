-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 09:17 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `039_hotel`
--
DROP TABLE IF EXISTS `039_reservations`;
DROP TABLE IF EXISTS `039_rooms`;
DROP TABLE IF EXISTS `039_categories`;
DROP TABLE IF EXISTS `039_clients`;
DROP TABLE IF EXISTS `039_status`;
DROP TABLE IF EXISTS `039_users`;
DROP TABLE IF EXISTS `039_amenities`;
-- --------------------------------------------------------

--
-- Table structure for table `039_amenities`
--

CREATE TABLE IF NOT EXISTS `039_amenities` (
  `ID_amenity` int(11) NOT NULL AUTO_INCREMENT,
  `amenity_name` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_amenity`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `039_amenities`
--

TRUNCATE TABLE `039_amenities`;
--
-- Dumping data for table `039_amenities`
--

INSERT INTO `039_amenities` (`ID_amenity`, `amenity_name`) VALUES
(1, 'Internet inalámbrico'),
(2, 'Teléfono con línea nacional e internacional'),
(3, 'Minibar'),
(4, 'Plancha y tabla de planchar'),
(5, 'Room Service'),
(6, 'Control climático'),
(7, 'Mesa de trabajo con Plug DC'),
(8, 'Secadora de cabello'),
(9, 'Calentador de toallas'),
(10, 'TV LCD con cable'),
(11, 'Caja de seguridad electrónica'),
(12, 'Finas batas y pantuflas'),
(13, 'Jacuzzi');

-- --------------------------------------------------------

--
-- Table structure for table `039_categories`
--

CREATE TABLE IF NOT EXISTS `039_categories` (
  `ID_category` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(60) NOT NULL,
  `category_price` int(11) NOT NULL,
  PRIMARY KEY (`ID_category`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `039_categories`
--

TRUNCATE TABLE `039_categories`;
--
-- Dumping data for table `039_categories`
--

INSERT INTO `039_categories` (`ID_category`, `category_name`, `category_price`) VALUES
(1, 'Habitacion Deluxe', 230),
(2, 'Serenity Suite', 240),
(3, 'Suite Familiar del Lago', 560),
(4, 'Bungalow', 500),
(5, 'Villa', 530),
(6, 'Suite Presidencial', 420),
(7, 'Suite Colonial', 375),
(8, 'Junior Suite Colonial', 350),
(9, 'Habitacion Colonial', 260);

-- --------------------------------------------------------

--
-- Table structure for table `039_clients`
--

CREATE TABLE IF NOT EXISTS `039_clients` (
  `ID_client` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(9) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `pwd` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_client`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `039_clients`
--

TRUNCATE TABLE `039_clients`;
--
-- Dumping data for table `039_clients`
--

INSERT INTO `039_clients` (`ID_client`, `dni`, `firstname`, `surname`, `email`, `phone_number`, `birthday`, `pwd`) VALUES
(1, '95265142G', 'juan', 'qwer', 'email.1@gmail.com', 653689524, '1990-08-08', '123'),
(2, '22453142K', 'jaime', 'asd', 'email.2@gmail.com', 645812257, '1980-08-08', '123'),
(3, '18265142W', 'tomas', 'smiz', 'email.3@gmail.com', 957558631, '1999-08-08', '123'),
(4, '91165142T', 'pol', 'lopez', 'email.4@gmail.com', 654987321, '1985-08-08', '123'),
(5, '95265872H', 'paul', 'lopes', 'email.5@gmail.com', 369852147, '1996-08-08', '123'),
(6, '97832337P', 'Hiroko', 'Boyd', 'in@google.edu', 320585866, '1975-08-08', '123'),
(7, '06893777O', 'Ethan', 'Wade', 'non.feugiat.nec@outlook.com', 216373121, '1986-08-08', '123'),
(8, '979359103', 'Alma', 'Dodson', 'ac.mattis@yahoo.org', 236724556, '1988-08-08', '123'),
(9, '07671327J', 'Hamilton', 'Riddle', 'pellentesque.ultricies@protonmail.com', 256971068, '1984-08-08', '123'),
(10, '47715381M', 'Wylie', 'Hess', 'nulla.eget@icloud.couk', 713312882, '1995-08-08', '123'),
(11, '81512703N', 'Ashely', 'Mclean', 'morbi.sit.amet@aol.couk', 426088885, '1995-08-08', '123'),
(12, '61315716M', 'Myra', 'Carr', 'vitae.nibh@outlook.couk', 427187745, '1998-08-08', '123'),
(13, '53117614H', 'Anjolie', 'Cash', 'cras.interdum.nunc@yahoo.org', 865222605, '1997-08-08', '123'),
(14, '33447936Q', 'Jana', 'Hicks', 'in.cursus@protonmail.net', 475351125, '1991-08-08', '123'),
(15, '77526272F', 'Herrod', 'Prince', 'molestie.sodales@outlook.org', 686155111, '1992-08-08', '123');

-- --------------------------------------------------------

--
-- Table structure for table `039_reservations`
--

CREATE TABLE IF NOT EXISTS `039_reservations` (
  `ID_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `ID_client` int(11) NOT NULL,
  `ID_room` int(11) NOT NULL,
  `initial_date` date NOT NULL,
  `final_date` date NOT NULL,
  `number_guests` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `ID_status` int(11) NOT NULL,
  PRIMARY KEY (`ID_reservation`),
  KEY `ID_client` (`ID_client`),
  KEY `ID_room` (`ID_room`),
  KEY `ID_status` (`ID_status`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `039_reservations`
--

TRUNCATE TABLE `039_reservations`;
--
-- Dumping data for table `039_reservations`
--

INSERT INTO `039_reservations` (`ID_reservation`, `ID_client`, `ID_room`, `initial_date`, `final_date`, `number_guests`, `total_price`, `ID_status`) VALUES
(1, 6, 3, '2022-06-17', '2022-06-19', 2, 300, 1),
(2, 10, 9, '2022-07-10', '2022-07-17', 2, 2100, 2),
(3, 13, 10, '2022-06-21', '2022-06-25', 2, 1200, 1),
(4, 10, 1, '2022-06-21', '2022-06-22', 2, 220, 2),
(5, 1, 10, '2022-06-30', '2022-07-08', 2, 2400, 2),
(6, 12, 2, '2022-06-28', '2022-06-29', 2, 220, 2),
(7, 10, 9, '2022-06-29', '2022-07-08', 2, 2700, 2),
(8, 12, 14, '2022-06-18', '2022-06-19', 2, 220, 2),
(9, 4, 11, '2022-07-03', '2022-07-06', 2, 900, 2),
(10, 1, 1, '2022-07-05', '2022-07-10', 2, 1100, 2),
(11, 1, 15, '2022-06-20', '2022-06-25', 2, 1100, 2),
(12, 4, 5, '2022-06-20', '2022-06-25', 2, 1100, 2);

-- --------------------------------------------------------

--
-- Table structure for table `039_rooms`
--

CREATE TABLE IF NOT EXISTS `039_rooms` (
  `ID_room` int(11) NOT NULL AUTO_INCREMENT,
  `ID_category` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`ID_room`),
  KEY `ID_category` (`ID_category`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `039_rooms`
--

TRUNCATE TABLE `039_rooms`;
--
-- Dumping data for table `039_rooms`
--

INSERT INTO `039_rooms` (`ID_room`, `ID_category`, `capacity`) VALUES
(1, 8, 4),
(2, 8, 4),
(3, 8, 4),
(4, 7, 2),
(5, 7, 2),
(6, 7, 2),
(7, 7, 2),
(8, 7, 2),
(9, 7, 2),
(10, 6, 2),
(11, 6, 2),
(12, 4, 4),
(13, 4, 4),
(14, 4, 4),
(15, 5, 5),
(16, 5, 5),
(17, 5, 5),
(18, 3, 5),
(19, 3, 5),
(20, 1, 3),
(21, 1, 3),
(22, 1, 3),
(23, 1, 3),
(24, 1, 3),
(25, 2, 3),
(26, 2, 3),
(27, 2, 3),
(28, 2, 3),
(29, 2, 3),
(30, 2, 3),
(31, 9, 3),
(32, 9, 3),
(33, 9, 3),
(34, 9, 3),
(35, 9, 3),
(36, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `039_status`
--

CREATE TABLE IF NOT EXISTS `039_status` (
  `ID_status` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `039_status`
--

TRUNCATE TABLE `039_status`;
--
-- Dumping data for table `039_status`
--

INSERT INTO `039_status` (`ID_status`, `name`) VALUES
(1, 'booked'),
(2, 'checkin'),
(3, 'checkout');

-- --------------------------------------------------------

--
-- Table structure for table `039_users`
--

CREATE TABLE IF NOT EXISTS `039_users` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pwd` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `039_users`
--

TRUNCATE TABLE `039_users`;
--
-- Dumping data for table `039_users`
--

INSERT INTO `039_users` (`ID_user`, `username`, `email`, `pwd`) VALUES
(1, 'dwesteacher', 'dwesteacher@correo.com', 'enrique'),
(2, 'hugo', 'correo@correo.com', '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `039_reservations`
--
ALTER TABLE `039_reservations`
  ADD CONSTRAINT `039_reservations_ibfk_1` FOREIGN KEY (`ID_client`) REFERENCES `039_clients` (`ID_client`),
  ADD CONSTRAINT `039_reservations_ibfk_2` FOREIGN KEY (`ID_room`) REFERENCES `039_rooms` (`ID_room`),
  ADD CONSTRAINT `039_reservations_ibfk_3` FOREIGN KEY (`ID_status`) REFERENCES `039_status` (`ID_status`);

--
-- Constraints for table `039_rooms`
--
ALTER TABLE `039_rooms`
  ADD CONSTRAINT `039_rooms_ibfk_1` FOREIGN KEY (`ID_category`) REFERENCES `039_categories` (`ID_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
