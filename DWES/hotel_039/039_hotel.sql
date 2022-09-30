-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-09-2022 a las 13:43:28
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `07_hotel`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addReservations` (IN `var_tier` INT, IN `var_initial_date` DATE, IN `var_number_of_days` INT)  BEGIN
DECLARE var_qty_on_tier, var_qty_of_reservations, var_counter, aux_counter, i, var_ID_persons INT;
DECLARE var_price DECIMAL(10,2);
DECLARE var_final_date, aux_initial_day, aux_final_day DATE;

SET var_final_date = ADDDATE(var_initial_date, var_number_of_days);
SET var_ID_persons = CEILING(RAND()*15);
SET aux_initial_day = var_initial_date;
SET var_price = 0.0;
SET var_counter = 0;
SET i = 1;
SET var_qty_on_tier = 0;

SELECT COUNT(*) INTO var_qty_on_tier
FROM rooms
WHERE ID_tiers = var_tier;

WHILE i <= var_number_of_days DO

SET aux_final_day = ADDDATE(aux_initial_day, i);

SELECT COUNT(*) INTO aux_counter
FROM reservations
WHERE ID_tiers = var_tier AND (initial_date < aux_final_day AND  final_date > aux_initial_day);

SET aux_initial_day = ADDDATE(aux_initial_day, i);

IF var_counter < aux_counter THEN
SET var_counter = aux_counter;
END IF;

SET i = i + 1;

END WHILE;

IF (var_qty_on_tier > var_counter)  THEN

SELECT price_per_night INTO var_price
FROM tiers
WHERE ID_tiers = var_tier;

SET var_price = var_price * var_number_of_days;

INSERT INTO reservations(ID_persons, ID_tiers, ID_rooms, initial_date, final_date, number_guests, total_price, ID_status)
VALUES(var_ID_persons, var_tier, NULL, var_initial_date, var_final_date, NULL, var_price, 1);

END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addReservationsRandom` (IN `var_numberItem` INT)  BEGIN
DECLARE i, var_ID_rooms, present, var_total_days, var_capacity, var_ID_tiers INT;
DECLARE var_price DECIMAL(10,2);
DECLARE var_date_start, var_initial_date, var_final_date DATE;
SET var_capacity = 0;
SET var_price = 0.0;
SET var_total_days = 0;
SET var_ID_rooms = 0;
SET var_ID_tiers = 0;
SET present = 0;
SET var_date_start = CURRENT_DATE;
SET i = 0;

WHILE i != var_numberItem DO
SET var_ID_rooms = CEILING(RAND()*15);

SET var_initial_date = DATE_ADD(var_date_start, INTERVAL CEILING(RAND()*30) DAY);
SET var_final_date = DATE_ADD(var_initial_date, INTERVAL CEILING(RAND()*10) DAY);

SELECT COUNT(*) INTO present
FROM reservations
WHERE ID_rooms = var_ID_rooms AND (initial_date < var_final_date AND  final_date > var_initial_date);

IF present = 0 THEN

SELECT ID_tiers INTO var_ID_tiers
FROM rooms
WHERE ID_rooms = var_ID_rooms;

SELECT price_per_night INTO var_price
FROM tiers
WHERE ID_tiers = var_ID_tiers;

SET var_total_days = DATEDIFF(var_final_date, var_initial_date);
SET var_price = var_price * var_total_days;

SELECT capacity INTO var_capacity
FROM rooms
WHERE ID_rooms = var_ID_rooms;

INSERT INTO reservations(ID_reservations, ID_persons, ID_tiers, ID_rooms, initial_date, final_date, number_guests, total_price, ID_status)
VALUES (DEFAULT, CEILING(RAND()*15), var_ID_tiers, var_ID_rooms, var_initial_date, var_final_date, CEILING(RAND()*var_capacity), var_price, 1);

SET i = i + 1;
END IF;

END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addReview` (IN `var_order_number` INT)  BEGIN
DECLARE var_comment_text VARCHAR(60);
DECLARE var_stars, var_ID_persons INT;

SELECT comment_text, stars INTO var_comment_text, var_stars
FROM reviews
ORDER BY RAND()
LIMIT 1;

SELECT ID_persons INTO var_ID_persons
FROM reservations
WHERE ID_rooms IN (SELECT ID_rooms
                  FROM orders
                  WHERE order_number = var_order_number);

INSERT INTO orders_reviews(order_number, ID_persons, comment_text, stars)
SELECT var_order_number, var_ID_persons, var_comment_text, var_stars
FROM orders
WHERE order_number = var_order_number
LIMIT 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addToHotelCart` (IN `var_numberItems` INT)  BEGIN
DECLARE var_ID_rooms, i INT;
SET i = 0;

SELECT ID_rooms INTO var_ID_rooms
FROM reservations
WHERE ID_status = 2
ORDER BY RAND()
LIMIT 1;

WHILE i < var_numberItems DO

INSERT INTO hotel_cart(ID_rooms, ID_services, quantity, unit_price)
SELECT var_ID_rooms, ID_services, CEILING(RAND()*3), price
FROM services
WHERE ID_services != 1
ORDER BY RAND()
LIMIT 1;

SET i = i + 1;
END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `assignRoom` (IN `var_ID_reservations` INT)  BEGIN

DECLARE var_ID_rooms, var_ID_tiers, var_capacity, var_days INT;
DECLARE var_initial_date, var_final_date DATE;
DECLARE var_price_per_night DECIMAL(10,2);

SELECT ID_tiers INTO var_ID_tiers
FROM reservations
WHERE ID_reservations = var_ID_reservations;

SELECT ID_rooms INTO var_ID_rooms
FROM rooms
WHERE ID_tiers = var_ID_tiers AND room_status = 'Free'
ORDER BY RAND()
LIMIT 1;

SELECT capacity INTO var_capacity
FROM rooms
WHERE ID_rooms = var_ID_rooms;

UPDATE reservations
SET ID_rooms = var_ID_rooms, number_guests = CEILING(RAND()*var_capacity), ID_status = 2
WHERE ID_reservations = var_ID_reservations;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkIn` (IN `var_ID_reservation` INT)  BEGIN

UPDATE reservations
SET ID_status = 2
WHERE ID_reservations = var_ID_reservation AND ID_status = 1;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkOut` (IN `var_ID_rooms` INT)  BEGIN
DECLARE var_last_order, var_qty_services, i INT;

SET var_last_order = 1;
SET i = 0;

SELECT order_number + 1 INTO var_last_order
FROM orders
ORDER BY order_number DESC
LIMIT 1;

SELECT COUNT(*) INTO var_qty_services
FROM hotel_cart
WHERE ID_rooms = var_ID_rooms AND ID_rooms IN(SELECT ID_rooms
                                             FROM reservations
                                             WHERE ID_status = 2);

INSERT INTO orders(order_number, ID_rooms, ID_services, quantity, subtotal)
SELECT var_last_order, var_ID_rooms, 1, 1, total_price
FROM reservations
WHERE ID_rooms = var_ID_rooms AND ID_status = 2;

WHILE i < var_qty_services DO

INSERT INTO orders(order_number, ID_rooms, ID_services, quantity, subtotal)
SELECT var_last_order, var_ID_rooms, ID_services, quantity, quantity*unit_price 
FROM hotel_cart
WHERE ID_rooms = var_ID_rooms AND ID_services != 1 AND ID_services NOT IN(SELECT ID_services
                                                FROM orders
                                                WHERE order_number = var_last_order)
LIMIT 1;

SET i = i + 1;

END WHILE;

UPDATE reservations
SET ID_status = 3
WHERE ID_rooms = var_ID_rooms AND ID_status = 2;

SELECT order_number, SUM(subtotal)
FROM orders
WHERE order_number = var_last_order;

DELETE FROM hotel_cart
WHERE ID_rooms = var_ID_rooms;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `perksRoom` (IN `var_ID_rooms` INT)  BEGIN

SELECT *
FROM perks
WHERE ID_perks IN(SELECT ID_perks
                 FROM tiers_perks
                 WHERE ID_tiers IN (SELECT ID_tiers
                                   FROM rooms
                                   WHERE ID_rooms = var_ID_rooms));
                                   
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `roomsAvailability` (IN `var_tier` INT, IN `var_initial_date` DATE, IN `var_final_date` DATE, IN `var_guests` INT)  BEGIN

SELECT *
FROM rooms
WHERE ID_tiers = var_tier AND capacity >= var_guests AND ID_rooms NOT IN(
SELECT ID_rooms
FROM reservations
WHERE ID_rooms IS NOT NULL AND (initial_date < var_final_date AND  final_date > var_initial_date));

END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `age` (`birthday` DATE) RETURNS INT(11) RETURN DATEDIFF(CURRENT_DATE, birthday) DIV 365$$

CREATE DEFINER=`root`@`localhost` FUNCTION `fullname` (`surname` VARCHAR(60), `firstname` VARCHAR(60)) RETURNS VARCHAR(60) CHARSET utf8mb4 RETURN CONCAT(UPPER(surname), ', ', firstname)$$

CREATE DEFINER=`root`@`localhost` FUNCTION `room_name` (`var_ID_rooms` INT, `name` VARCHAR(60)) RETURNS VARCHAR(60) CHARSET utf8mb4 RETURN CONCAT(var_ID_rooms, ', ', name)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `customers`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `customers` (
`ID_persons` int(11)
,`DNI` varchar(9)
,`Full_name` varchar(60)
,`email` varchar(60)
,`Age` int(11)
,`phone_number` varchar(10)
,`Position` varchar(60)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `employees`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `employees` (
`ID_persons` int(11)
,`DNI` varchar(9)
,`Full_name` varchar(60)
,`email` varchar(60)
,`Age` int(11)
,`phone_number` varchar(10)
,`Position` varchar(60)
,`Sector` varchar(60)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotel_cart`
--

CREATE TABLE `hotel_cart` (
  `ID_rooms` int(11) NOT NULL,
  `ID_services` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `hotel_cart_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `hotel_cart_view` (
`room` varchar(60)
,`services` varchar(60)
,`quantity` int(11)
,`unit_price` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `order_number` int(11) NOT NULL,
  `ID_rooms` int(11) NOT NULL,
  `ID_services` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders_reviews`
--

CREATE TABLE `orders_reviews` (
  `order_number` int(11) NOT NULL,
  `ID_persons` int(11) NOT NULL,
  `comment_text` varchar(60) NOT NULL,
  `stars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orders_reviews`
--

INSERT INTO `orders_reviews` (`order_number`, `ID_persons`, `comment_text`, `stars`) VALUES
(1, 7, 'Podría ser peor', 3);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `orders_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `orders_view` (
`order_number` int(11)
,`room` varchar(60)
,`services` varchar(60)
,`quantity` int(11)
,`subtotal` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perks`
--

CREATE TABLE `perks` (
  `ID_perks` int(11) NOT NULL,
  `name_perk` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perks`
--

INSERT INTO `perks` (`ID_perks`, `name_perk`) VALUES
(1, 'Swimming pool'),
(2, 'Spa'),
(3, 'Gym'),
(4, 'Buffet'),
(5, 'Restaurant'),
(6, 'Bar Terrace'),
(7, 'Conferences'),
(8, 'Parking'),
(9, 'WiFi'),
(10, 'Hairdresser'),
(11, 'Room service'),
(12, 'Single bed'),
(13, 'Double bed'),
(14, 'Amenities'),
(15, 'Water'),
(16, 'Safe'),
(17, 'Phone'),
(18, 'Air-conditioning'),
(19, 'Refrigerator'),
(20, 'Coffe machine'),
(21, 'Hairdryer'),
(22, 'TV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persons`
--

CREATE TABLE `persons` (
  `ID_persons` int(11) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `birthday` date NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `ID_position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persons`
--

INSERT INTO `persons` (`ID_persons`, `DNI`, `firstname`, `surname`, `email`, `birthday`, `phone_number`, `ID_position`) VALUES
(1, '95265142G', 'juan', 'qwer', 'email.1@gmail.com', '1990-08-08', '653689524', 7),
(2, '22453142K', 'jaime', 'asd', 'email.2@gmail.com', '1999-04-14', '645812257', NULL),
(3, '18265142W', 'tomas', 'smiz', 'email.3@gmail.com', '1980-10-15', '957558631', NULL),
(4, '91165142T', 'pol', 'lopez', 'email.4@gmail.com', '1997-08-30', '654987321', 4),
(5, '95265872H', 'paul', 'lopes', 'email.5@gmail.com', '1986-08-01', '369852147', 5),
(6, '97832337P', 'Hiroko', 'Boyd', 'in@google.edu', '2001-11-02', '320585866', NULL),
(7, '06893777O', 'Ethan', 'Wade', 'non.feugiat.nec@outlook.com', '2001-08-22', '216373121', NULL),
(8, '979359103', 'Alma', 'Dodson', 'ac.mattis@yahoo.org', '2003-09-21', '236724556', 8),
(9, '07671327J', 'Hamilton', 'Riddle', 'pellentesque.ultricies@protonmail.com', '1992-09-03', '256971068', NULL),
(10, '47715381M', 'Wylie', 'Hess', 'nulla.eget@icloud.couk', '1995-11-22', '713312882', 9),
(11, '81512703N', 'Ashely', 'Mclean', 'morbi.sit.amet@aol.couk', '1986-12-19', '426088885', 9),
(12, '61315716M', 'Myra', 'Carr', 'vitae.nibh@outlook.couk', '1978-09-24', '427187745', NULL),
(13, '53117614H', 'Anjolie', 'Cash', 'cras.interdum.nunc@yahoo.org', '2001-10-04', '865222605', NULL),
(14, '33447936Q', 'Jana', 'Hicks', 'in.cursus@protonmail.net', '2000-03-26', '475351125', NULL),
(15, '77526272F', 'Herrod', 'Prince', 'molestie.sodales@outlook.org', '1994-12-16', '686155111', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
--

CREATE TABLE `positions` (
  `ID_positions` int(11) NOT NULL,
  `name_position` varchar(60) NOT NULL,
  `ID_sectors` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `positions`
--

INSERT INTO `positions` (`ID_positions`, `name_position`, `ID_sectors`) VALUES
(1, 'Recepcionista', 1),
(2, 'Botones', 1),
(3, 'Barman', 3),
(4, 'Camarero', 3),
(5, 'Cocinero', 4),
(6, 'Auxiliar de Cocina', 4),
(7, 'Personal de Seguridad', 5),
(8, 'Socorrista', 5),
(9, 'Camarera de pisos', 2),
(10, 'Gobernanta', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

CREATE TABLE `reservations` (
  `ID_reservations` int(11) NOT NULL,
  `ID_persons` int(11) NOT NULL,
  `ID_tiers` int(11) NOT NULL,
  `ID_rooms` int(11) DEFAULT NULL,
  `initial_date` date NOT NULL,
  `final_date` date NOT NULL,
  `number_guests` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `ID_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`ID_reservations`, `ID_persons`, `ID_tiers`, `ID_rooms`, `initial_date`, `final_date`, `number_guests`, `total_price`, `ID_status`) VALUES
(1, 6, 1, 3, '2022-06-17', '2022-06-19', 1, '300.00', 1),
(2, 10, 3, 9, '2022-07-10', '2022-07-17', 1, '2100.00', 1),
(3, 13, 3, 10, '2022-06-21', '2022-06-25', 1, '1200.00', 1),
(4, 10, 2, 1, '2022-06-21', '2022-06-22', 2, '220.00', 1),
(5, 1, 3, 10, '2022-06-30', '2022-07-08', 1, '2400.00', 1),
(6, 12, 2, 2, '2022-06-28', '2022-06-29', 2, '220.00', 1),
(7, 10, 3, 9, '2022-06-29', '2022-07-08', 2, '2700.00', 1),
(8, 12, 2, 14, '2022-06-18', '2022-06-19', 2, '220.00', 1),
(9, 4, 3, 11, '2022-07-03', '2022-07-06', 2, '900.00', 1),
(10, 1, 2, 1, '2022-07-05', '2022-07-10', 2, '1100.00', 1),
(11, 1, 2, 15, '2022-06-20', '2022-06-25', 2, '1100.00', 2),
(12, 4, 2, NULL, '2022-06-20', '2022-06-25', NULL, '1100.00', 1);

--
-- Disparadores `reservations`
--
DELIMITER $$
CREATE TRIGGER `tr_up_status_reservations` AFTER UPDATE ON `reservations` FOR EACH ROW BEGIN

CASE NEW.ID_status
	WHEN 1 THEN
    	UPDATE rooms
		SET room_status = "Free"
		WHERE ID_rooms = NEW.ID_rooms;
    WHEN  2 THEN
    	UPDATE rooms
		SET room_status = "Occupied"
		WHERE ID_rooms = NEW.ID_rooms;
    WHEN 3 THEN
    	UPDATE rooms
		SET room_status = "Free"
		WHERE ID_rooms = NEW.ID_rooms;
END CASE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `reservations_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `reservations_view` (
`ID_reservations` int(11)
,`customer_name` varchar(60)
,`room_tier` varchar(9)
,`room` varchar(60)
,`initial_date` date
,`final_date` date
,`number_guests` int(11)
,`total_price` decimal(10,2)
,`status` varchar(10)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `ID_review` int(11) NOT NULL,
  `comment_text` varchar(60) NOT NULL,
  `stars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`ID_review`, `comment_text`, `stars`) VALUES
(1, 'Perfecto', 5),
(2, 'Muy bueno', 5),
(3, 'Buen producto', 4),
(4, 'Muy útil', 4),
(5, 'No está mal', 3),
(6, 'Podría ser peor', 3),
(7, 'Mal producto', 2),
(8, 'No me gusta', 2),
(9, 'Horrible', 1),
(10, 'Terrible', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rooms`
--

CREATE TABLE `rooms` (
  `ID_rooms` int(11) NOT NULL,
  `name_room` varchar(60) NOT NULL,
  `capacity` int(11) NOT NULL,
  `ID_tiers` int(11) NOT NULL,
  `room_status` varchar(10) NOT NULL DEFAULT 'Free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rooms`
--

INSERT INTO `rooms` (`ID_rooms`, `name_room`, `capacity`, `ID_tiers`, `room_status`) VALUES
(1, 'Fabulous', 2, 2, 'Free'),
(2, 'Fabulous Sky', 2, 2, 'Free'),
(3, 'Cozy', 2, 1, 'Free'),
(4, 'Cozy', 2, 1, 'Free'),
(5, 'Wonderful Sky', 4, 3, 'Free'),
(6, 'Wonderful Sky', 4, 3, 'Free'),
(7, 'Wonderful', 2, 3, 'Free'),
(8, 'Wonderful', 2, 3, 'Free'),
(9, 'Wonderful', 2, 3, 'Free'),
(10, 'Wonderful', 2, 3, 'Free'),
(11, 'Wonderful Sky', 4, 3, 'Free'),
(12, 'Fabulous Sky', 2, 2, 'Occupied'),
(13, 'Fabulous', 2, 2, 'Occupied'),
(14, 'Fabulous', 2, 2, 'Occupied'),
(15, 'Fabulous Sky', 2, 2, 'Occupied'),
(16, 'Cozy', 2, 1, 'Free'),
(17, 'Cozy', 2, 1, 'Free'),
(18, 'Cozy', 2, 1, 'Free'),
(19, 'Cozy', 2, 1, 'Free');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectors`
--

CREATE TABLE `sectors` (
  `ID_sectors` int(11) NOT NULL,
  `name_sector` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sectors`
--

INSERT INTO `sectors` (`ID_sectors`, `name_sector`) VALUES
(1, 'Recepción'),
(2, 'Limpieza'),
(3, 'Servicio de Alimentos y bebidas'),
(4, 'Cocina'),
(5, 'Seguridad'),
(6, 'Contabilidad'),
(7, 'Recursos Humanos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `ID_services` int(11) NOT NULL,
  `name_service` varchar(60) NOT NULL,
  `provider` varchar(60) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`ID_services`, `name_service`, `provider`, `price`) VALUES
(1, 'room', 'Hotel', NULL),
(2, 'Breakfast', 'Restaurant', 20),
(3, 'Dinner', 'Restaurant', 50),
(4, 'Lunch', 'Restaurant', 30),
(5, 'Clothing repairing', 'Tailor Shop', 50),
(6, 'booking in a restaurant', 'Restaurant', 100),
(7, 'calling taxi', 'Reception', 50),
(8, 'Drinks', 'Bar', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `ID_status` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`ID_status`, `name`) VALUES
(1, 'booked'),
(2, 'checkin'),
(3, 'checkout');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiers`
--

CREATE TABLE `tiers` (
  `ID_tiers` int(11) NOT NULL,
  `name_tier` varchar(9) NOT NULL,
  `price_per_night` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiers`
--

INSERT INTO `tiers` (`ID_tiers`, `name_tier`, `price_per_night`) VALUES
(1, 'Common', '150.00'),
(2, 'Deluxe', '220.00'),
(3, 'Premium', '300.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiers_perks`
--

CREATE TABLE `tiers_perks` (
  `ID_tiers` int(11) NOT NULL,
  `ID_perks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tiers_perks`
--

INSERT INTO `tiers_perks` (`ID_tiers`, `ID_perks`) VALUES
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22);

-- --------------------------------------------------------

--
-- Estructura para la vista `customers`
--
DROP TABLE IF EXISTS `customers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customers`  AS SELECT `p`.`ID_persons` AS `ID_persons`, `p`.`DNI` AS `DNI`, `fullname`(`p`.`surname`,`p`.`firstname`) AS `Full_name`, `p`.`email` AS `email`, `age`(`p`.`birthday`) AS `Age`, `p`.`phone_number` AS `phone_number`, `pos`.`name_position` AS `Position` FROM (`persons` `p` left join `positions` `pos` on(`p`.`ID_position` = `pos`.`ID_positions`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `employees`
--
DROP TABLE IF EXISTS `employees`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `employees`  AS SELECT `p`.`ID_persons` AS `ID_persons`, `p`.`DNI` AS `DNI`, `fullname`(`p`.`surname`,`p`.`firstname`) AS `Full_name`, `p`.`email` AS `email`, `age`(`p`.`birthday`) AS `Age`, `p`.`phone_number` AS `phone_number`, `pos`.`name_position` AS `Position`, `s`.`name_sector` AS `Sector` FROM ((`persons` `p` join `positions` `pos` on(`p`.`ID_position` = `pos`.`ID_positions`)) join `sectors` `s` on(`pos`.`ID_sectors` = `s`.`ID_sectors`)) ORDER BY `p`.`ID_persons` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `hotel_cart_view`
--
DROP TABLE IF EXISTS `hotel_cart_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hotel_cart_view`  AS SELECT `room_name`(`h`.`ID_rooms`,`r`.`name_room`) AS `room`, `s`.`name_service` AS `services`, `h`.`quantity` AS `quantity`, `h`.`unit_price` AS `unit_price` FROM ((`hotel_cart` `h` join `rooms` `r` on(`h`.`ID_rooms` = `r`.`ID_rooms`)) join `services` `s` on(`h`.`ID_services` = `s`.`ID_services`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `orders_view`
--
DROP TABLE IF EXISTS `orders_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `orders_view`  AS SELECT `o`.`order_number` AS `order_number`, `room_name`(`o`.`ID_rooms`,`r`.`name_room`) AS `room`, `s`.`name_service` AS `services`, `o`.`quantity` AS `quantity`, `o`.`subtotal` AS `subtotal` FROM ((`orders` `o` join `rooms` `r` on(`o`.`ID_rooms` = `r`.`ID_rooms`)) join `services` `s` on(`o`.`ID_services` = `s`.`ID_services`)) ORDER BY `o`.`order_number` ASC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `reservations_view`
--
DROP TABLE IF EXISTS `reservations_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservations_view`  AS SELECT `res`.`ID_reservations` AS `ID_reservations`, `fullname`(`p`.`surname`,`p`.`firstname`) AS `customer_name`, `t`.`name_tier` AS `room_tier`, `room_name`(`res`.`ID_rooms`,`r`.`name_room`) AS `room`, `res`.`initial_date` AS `initial_date`, `res`.`final_date` AS `final_date`, `res`.`number_guests` AS `number_guests`, `res`.`total_price` AS `total_price`, `s`.`name` AS `status` FROM ((((`reservations` `res` join `persons` `p` on(`res`.`ID_persons` = `p`.`ID_persons`)) join `tiers` `t` on(`res`.`ID_tiers` = `t`.`ID_tiers`)) join `rooms` `r` on(`res`.`ID_rooms` = `r`.`ID_rooms`)) join `status` `s` on(`res`.`ID_status` = `s`.`ID_status`)) ORDER BY `res`.`ID_reservations` ASC ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hotel_cart`
--
ALTER TABLE `hotel_cart`
  ADD KEY `ID_rooms` (`ID_rooms`),
  ADD KEY `ID_services` (`ID_services`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD KEY `ID_rooms` (`ID_rooms`),
  ADD KEY `ID_services` (`ID_services`);

--
-- Indices de la tabla `perks`
--
ALTER TABLE `perks`
  ADD PRIMARY KEY (`ID_perks`);

--
-- Indices de la tabla `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`ID_persons`),
  ADD UNIQUE KEY `DNI` (`DNI`),
  ADD KEY `ID_position` (`ID_position`);

--
-- Indices de la tabla `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`ID_positions`),
  ADD KEY `ID_sectors` (`ID_sectors`);

--
-- Indices de la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ID_reservations`),
  ADD KEY `reservations_ibfk_1` (`ID_persons`),
  ADD KEY `reservations_ibfk_2` (`ID_rooms`),
  ADD KEY `ID_tiers` (`ID_tiers`),
  ADD KEY `ID_status` (`ID_status`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ID_review`);

--
-- Indices de la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`ID_rooms`),
  ADD KEY `ID_tiers` (`ID_tiers`);

--
-- Indices de la tabla `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`ID_sectors`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID_services`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID_status`);

--
-- Indices de la tabla `tiers`
--
ALTER TABLE `tiers`
  ADD PRIMARY KEY (`ID_tiers`);

--
-- Indices de la tabla `tiers_perks`
--
ALTER TABLE `tiers_perks`
  ADD KEY `ID_tiers` (`ID_tiers`),
  ADD KEY `ID_perks` (`ID_perks`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `perks`
--
ALTER TABLE `perks`
  MODIFY `ID_perks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `persons`
--
ALTER TABLE `persons`
  MODIFY `ID_persons` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=689;

--
-- AUTO_INCREMENT de la tabla `positions`
--
ALTER TABLE `positions`
  MODIFY `ID_positions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ID_reservations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `ID_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rooms`
--
ALTER TABLE `rooms`
  MODIFY `ID_rooms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `sectors`
--
ALTER TABLE `sectors`
  MODIFY `ID_sectors` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `ID_services` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `ID_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tiers`
--
ALTER TABLE `tiers`
  MODIFY `ID_tiers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `hotel_cart`
--
ALTER TABLE `hotel_cart`
  ADD CONSTRAINT `hotel_cart_ibfk_1` FOREIGN KEY (`ID_rooms`) REFERENCES `rooms` (`ID_rooms`),
  ADD CONSTRAINT `hotel_cart_ibfk_2` FOREIGN KEY (`ID_services`) REFERENCES `services` (`ID_services`);

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`ID_rooms`) REFERENCES `rooms` (`ID_rooms`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ID_services`) REFERENCES `services` (`ID_services`);

--
-- Filtros para la tabla `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `persons_ibfk_1` FOREIGN KEY (`ID_position`) REFERENCES `positions` (`ID_positions`);

--
-- Filtros para la tabla `positions`
--
ALTER TABLE `positions`
  ADD CONSTRAINT `positions_ibfk_1` FOREIGN KEY (`ID_sectors`) REFERENCES `sectors` (`ID_sectors`);

--
-- Filtros para la tabla `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`ID_persons`) REFERENCES `persons` (`ID_persons`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`ID_rooms`) REFERENCES `rooms` (`ID_rooms`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`ID_tiers`) REFERENCES `tiers` (`ID_tiers`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_4` FOREIGN KEY (`ID_status`) REFERENCES `status` (`ID_status`);

--
-- Filtros para la tabla `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`ID_tiers`) REFERENCES `tiers` (`ID_tiers`);

--
-- Filtros para la tabla `tiers_perks`
--
ALTER TABLE `tiers_perks`
  ADD CONSTRAINT `tiers_perks_ibfk_1` FOREIGN KEY (`ID_tiers`) REFERENCES `tiers` (`ID_tiers`),
  ADD CONSTRAINT `tiers_perks_ibfk_2` FOREIGN KEY (`ID_perks`) REFERENCES `perks` (`ID_perks`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
