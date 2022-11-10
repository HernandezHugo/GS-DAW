-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2022 at 05:24 PM
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
  PRIMARY KEY (`ID_client`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `039_clients`
--

INSERT INTO `039_clients` (`ID_client`, `dni`, `firstname`, `surname`, `email`, `phone_number`) VALUES
(1, '95265142G', 'juan', 'qwer', 'email.1@gmail.com', 653689524),
(2, '22453142K', 'jaime', 'asd', 'email.2@gmail.com', 645812257),
(3, '18265142W', 'tomas', 'smiz', 'email.3@gmail.com', 957558631),
(4, '91165142T', 'pol', 'lopez', 'email.4@gmail.com', 654987321),
(5, '95265872H', 'paul', 'lopes', 'email.5@gmail.com', 369852147),
(6, '97832337P', 'Hiroko', 'Boyd', 'in@google.edu', 320585866),
(7, '06893777O', 'Ethan', 'Wade', 'non.feugiat.nec@outlook.com', 216373121),
(8, '979359103', 'Alma', 'Dodson', 'ac.mattis@yahoo.org', 236724556),
(9, '07671327J', 'Hamilton', 'Riddle', 'pellentesque.ultricies@protonmail.com', 256971068),
(10, '47715381M', 'Wylie', 'Hess', 'nulla.eget@icloud.couk', 713312882),
(11, '81512703N', 'Ashely', 'Mclean', 'morbi.sit.amet@aol.couk', 426088885),
(12, '61315716M', 'Myra', 'Carr', 'vitae.nibh@outlook.couk', 427187745),
(13, '53117614H', 'Anjolie', 'Cash', 'cras.interdum.nunc@yahoo.org', 865222605),
(14, '33447936Q', 'Jana', 'Hicks', 'in.cursus@protonmail.net', 475351125),
(15, '77526272F', 'Herrod', 'Prince', 'molestie.sodales@outlook.org', 686155111);

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
  `total_price` int(11) NOT NULL,
  `status` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_reservation`),
  KEY `ID_client` (`ID_client`),
  KEY `ID_room` (`ID_room`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `039_reservations`
--

INSERT INTO `039_reservations` (`ID_reservation`, `ID_client`, `ID_room`, `initial_date`, `final_date`, `total_price`, `status`) VALUES
(1, 6, 3, '2022-06-17', '2022-06-19', 300, 'check-in/out'),
(2, 10, 9, '2022-07-10', '2022-07-17', 2100, 'check-in/out'),
(3, 13, 10, '2022-06-21', '2022-06-25', 1200, 'check-in/out'),
(4, 10, 1, '2022-06-21', '2022-06-22', 220, 'check-in/out'),
(5, 1, 10, '2022-06-30', '2022-07-08', 2400, 'check-in/out'),
(6, 12, 2, '2022-06-28', '2022-06-29', 220, 'check-in/out'),
(7, 10, 9, '2022-06-29', '2022-07-08', 2700, 'check-in/out'),
(8, 12, 14, '2022-06-18', '2022-06-19', 220, 'check-in/out'),
(9, 4, 11, '2022-07-03', '2022-07-06', 900, 'check-in/out'),
(10, 1, 1, '2022-07-05', '2022-07-10', 1100, 'check-in/out'),
(11, 1, 15, '2022-06-20', '2022-06-25', 1100, 'check-in/out'),
(12, 4, 5, '2022-06-20', '2022-06-25', 1100, 'check-in/out');

-- --------------------------------------------------------

--
-- Table structure for table `039_rooms`
--

CREATE TABLE IF NOT EXISTS `039_rooms` (
  `ID_room` int(11) NOT NULL AUTO_INCREMENT,
  `name_room` varchar(60) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`ID_room`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `039_rooms`
--

INSERT INTO `039_rooms` (`ID_room`, `name_room`, `capacity`) VALUES
(1, 'Fabulous', 2),
(2, 'Fabulous Sky', 2),
(3, 'Cozy', 2),
(4, 'Cozy', 2),
(5, 'Wonderful Sky', 4),
(6, 'Wonderful Sky', 4),
(7, 'Wonderful', 2),
(8, 'Wonderful', 2),
(9, 'Wonderful', 2),
(10, 'Wonderful', 2),
(11, 'Wonderful Sky', 4),
(12, 'Fabulous Sky', 2),
(13, 'Fabulous', 2),
(14, 'Fabulous', 2),
(15, 'Fabulous Sky', 2),
(16, 'Cozy', 2),
(17, 'Cozy', 2),
(18, 'Cozy', 2),
(19, 'Cozy', 2);

-- --------------------------------------------------------

--
-- Table structure for table `039_users`
--

CREATE TABLE IF NOT EXISTS `039_users` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `pwd` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `039_users`
--

INSERT INTO `039_users` (`ID_user`, `email`, `pwd`) VALUES
(1, 'correo@correo.com', '123456'),
(2, 'idk.asd@gmail.com', '123'),
(4, 'asdf@correo.com', '123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `039_reservations`
--
ALTER TABLE `039_reservations`
  ADD CONSTRAINT `039_reservations_ibfk_1` FOREIGN KEY (`ID_client`) REFERENCES `039_clients` (`ID_client`) ON UPDATE CASCADE,
  ADD CONSTRAINT `039_reservations_ibfk_2` FOREIGN KEY (`ID_room`) REFERENCES `039_rooms` (`ID_room`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
