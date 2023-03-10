-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-03-2023 a las 07:02:48
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
-- Base de datos: `039_hotel`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `039_addToCart`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `039_addToCart` (IN `var_id_reservation` INT, IN `var_service_name` VARCHAR(60), IN `var_qty` INT)  BEGIN
DECLARE var_id_service INT;
DECLARE var_total DECIMAL(10,2);

SELECT ID_service INTO var_id_service 
FROM 039_services
WHERE service_name = var_service_name;

SELECT (service_price * var_qty) INTO var_total
FROM 039_services
WHERE service_name = var_service_name;

INSERT INTO 039_cart (ID_reservation, ID_service, qty, total)
VALUES (var_id_reservation, var_id_service, var_qty, var_total);

END$$

DROP PROCEDURE IF EXISTS `039_availableCategoriesByDate`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `039_availableCategoriesByDate` (IN `var_initial_date` DATE, IN `var_final_date` DATE)  BEGIN
DECLARE var_qty_on_category, var_capacity, var_qty_categories, var_counter, aux_counter, i, j, var_number_of_days INT;
DECLARE aux_initial_day, aux_final_day DATE;

SET var_number_of_days = DATEDIFF(var_final_date, var_initial_date);
SET j = 1;
SET var_qty_on_category = 0;

TRUNCATE TABLE 039_categories_to_show;

/*qty categories*/
SELECT COUNT(*) INTO var_qty_categories
FROM 039_categories;

WHILE j <= var_qty_categories DO
    
	SET aux_initial_day = var_initial_date;
	SET i = 1;
    SET var_counter = 0;

    /*qty of rooms by category*/
    SELECT COUNT(*) INTO var_qty_on_category
    FROM 039_rooms
    WHERE ID_category = j;

    WHILE i <= var_number_of_days DO
		
        SET aux_counter = 0;
        SET aux_final_day = ADDDATE(aux_initial_day, 1);

        /*find qty of reservations each day*/
        SELECT COUNT(*) INTO aux_counter
        FROM 039_reservations
        WHERE ID_category = j AND (initial_date < aux_final_day AND  final_date > aux_initial_day);

        SET aux_initial_day = ADDDATE(aux_initial_day, 1);

        /*store the max qty of reservations*/
        IF var_counter < aux_counter THEN
            SET var_counter = aux_counter;
        END IF;

        SET i = i + 1;

    END WHILE;

    IF (var_qty_on_category > var_counter)  THEN
    
        SELECT capacity INTO var_capacity
        FROM 039_rooms
        WHERE ID_category = j;

        INSERT INTO 039_categories_to_show(ID_category, category_name, category_description, capacity, price)
        SELECT ID_category, category_name, category_description, var_capacity, (category_price * var_number_of_days) AS price
        FROM 039_categories
        WHERE ID_category = j;
        
    END IF;

    SET j = j + 1;

END WHILE;

END$$

DROP PROCEDURE IF EXISTS `039_ticket`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `039_ticket` (IN `var_id_reservation` INT)  BEGIN 
DECLARE present INT;

SET present = 0;

SELECT COUNT(*) INTO present
FROM 039_cart
WHERE ID_reservation = var_id_reservation AND ID_service = 0;


IF present = 0 THEN

	INSERT INTO 039_cart(ID_reservation, ID_service, qty, total)
	SELECT ID_reservation, 0, DATEDIFF(`final_date`,`initial_date`), total_price  
	FROM 039_reservations
	WHERE ID_reservation = var_id_reservation;

END IF;


END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_amenities`
--

DROP TABLE IF EXISTS `039_amenities`;
CREATE TABLE IF NOT EXISTS `039_amenities` (
  `ID_amenity` int(11) NOT NULL AUTO_INCREMENT,
  `amenity_name` varchar(60) NOT NULL,
  PRIMARY KEY (`ID_amenity`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_amenities`
--

TRUNCATE TABLE `039_amenities`;
--
-- Volcado de datos para la tabla `039_amenities`
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
-- Estructura de tabla para la tabla `039_cart`
--

DROP TABLE IF EXISTS `039_cart`;
CREATE TABLE IF NOT EXISTS `039_cart` (
  `ID_reservation` int(11) NOT NULL,
  `ID_service` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_cart`
--

TRUNCATE TABLE `039_cart`;
--
-- Volcado de datos para la tabla `039_cart`
--

INSERT INTO `039_cart` (`ID_reservation`, `ID_service`, `qty`, `total`) VALUES
(1, 1, 2, '40.00'),
(1, 2, 1, '15.00'),
(1, 0, 2, '300.00'),
(14, 0, 1, '300.00'),
(15, 0, 3, '300.00'),
(16, 0, 1, '230.00'),
(27, 0, 1, '230.00'),
(28, 0, 1, '240.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_categories`
--

DROP TABLE IF EXISTS `039_categories`;
CREATE TABLE IF NOT EXISTS `039_categories` (
  `ID_category` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(60) NOT NULL,
  `category_description` text NOT NULL,
  `category_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_category`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_categories`
--

TRUNCATE TABLE `039_categories`;
--
-- Volcado de datos para la tabla `039_categories`
--

INSERT INTO `039_categories` (`ID_category`, `category_name`, `category_description`, `category_price`) VALUES
(1, 'Habitacion Deluxe', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ea incidunt quasi sint! Nobis fugiat, reprehenderit vitae ducimus nesciunt, est officia voluptas quisquam, nihil illum ipsum molestias quaerat pariatur accusamus.\r\nSit tempore animi a praesentium quidem dolorum aut earum possimus pariatur quae asperiores autem velit alias veniam consectetur deleniti incidunt, fuga laudantium sunt error eaque rem? Velit omnis odio molestias!\r\nSapiente, corrupti? Numquam consequatur nobis repellat at porro ipsum eius ex ipsam ipsa quo, voluptatum doloribus dignissimos recusandae quas, cumque facere, commodi officia distinctio accusantium? Corporis excepturi incidunt odio porro!', '230.00'),
(2, 'Serenity Suite', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ea incidunt quasi sint! Nobis fugiat, reprehenderit vitae ducimus nesciunt, est officia voluptas quisquam, nihil illum ipsum molestias quaerat pariatur accusamus.\r\nSit tempore animi a praesentium quidem dolorum aut earum possimus pariatur quae asperiores autem velit alias veniam consectetur deleniti incidunt, fuga laudantium sunt error eaque rem? Velit omnis odio molestias!\r\nSapiente, corrupti? Numquam consequatur nobis repellat at porro ipsum eius ex ipsam ipsa quo, voluptatum doloribus dignissimos recusandae quas, cumque facere, commodi officia distinctio accusantium? Corporis excepturi incidunt odio porro!', '240.00'),
(3, 'Suite Familiar del Lago', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ea incidunt quasi sint! Nobis fugiat, reprehenderit vitae ducimus nesciunt, est officia voluptas quisquam, nihil illum ipsum molestias quaerat pariatur accusamus.\r\nSit tempore animi a praesentium quidem dolorum aut earum possimus pariatur quae asperiores autem velit alias veniam consectetur deleniti incidunt, fuga laudantium sunt error eaque rem? Velit omnis odio molestias!\r\nSapiente, corrupti? Numquam consequatur nobis repellat at porro ipsum eius ex ipsam ipsa quo, voluptatum doloribus dignissimos recusandae quas, cumque facere, commodi officia distinctio accusantium? Corporis excepturi incidunt odio porro!', '560.00'),
(4, 'Bungalow', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ea incidunt quasi sint! Nobis fugiat, reprehenderit vitae ducimus nesciunt, est officia voluptas quisquam, nihil illum ipsum molestias quaerat pariatur accusamus.\r\nSit tempore animi a praesentium quidem dolorum aut earum possimus pariatur quae asperiores autem velit alias veniam consectetur deleniti incidunt, fuga laudantium sunt error eaque rem? Velit omnis odio molestias!\r\nSapiente, corrupti? Numquam consequatur nobis repellat at porro ipsum eius ex ipsam ipsa quo, voluptatum doloribus dignissimos recusandae quas, cumque facere, commodi officia distinctio accusantium? Corporis excepturi incidunt odio porro!', '500.00'),
(5, 'Villa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ea incidunt quasi sint! Nobis fugiat, reprehenderit vitae ducimus nesciunt, est officia voluptas quisquam, nihil illum ipsum molestias quaerat pariatur accusamus.\r\nSit tempore animi a praesentium quidem dolorum aut earum possimus pariatur quae asperiores autem velit alias veniam consectetur deleniti incidunt, fuga laudantium sunt error eaque rem? Velit omnis odio molestias!\r\nSapiente, corrupti? Numquam consequatur nobis repellat at porro ipsum eius ex ipsam ipsa quo, voluptatum doloribus dignissimos recusandae quas, cumque facere, commodi officia distinctio accusantium? Corporis excepturi incidunt odio porro!', '530.00'),
(6, 'Suite Presidencial', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ea incidunt quasi sint! Nobis fugiat, reprehenderit vitae ducimus nesciunt, est officia voluptas quisquam, nihil illum ipsum molestias quaerat pariatur accusamus.\r\nSit tempore animi a praesentium quidem dolorum aut earum possimus pariatur quae asperiores autem velit alias veniam consectetur deleniti incidunt, fuga laudantium sunt error eaque rem? Velit omnis odio molestias!\r\nSapiente, corrupti? Numquam consequatur nobis repellat at porro ipsum eius ex ipsam ipsa quo, voluptatum doloribus dignissimos recusandae quas, cumque facere, commodi officia distinctio accusantium? Corporis excepturi incidunt odio porro!', '420.00'),
(7, 'Suite Colonial', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ea incidunt quasi sint! Nobis fugiat, reprehenderit vitae ducimus nesciunt, est officia voluptas quisquam, nihil illum ipsum molestias quaerat pariatur accusamus.\r\nSit tempore animi a praesentium quidem dolorum aut earum possimus pariatur quae asperiores autem velit alias veniam consectetur deleniti incidunt, fuga laudantium sunt error eaque rem? Velit omnis odio molestias!\r\nSapiente, corrupti? Numquam consequatur nobis repellat at porro ipsum eius ex ipsam ipsa quo, voluptatum doloribus dignissimos recusandae quas, cumque facere, commodi officia distinctio accusantium? Corporis excepturi incidunt odio porro!', '375.00'),
(8, 'Junior Suite Colonial', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ea incidunt quasi sint! Nobis fugiat, reprehenderit vitae ducimus nesciunt, est officia voluptas quisquam, nihil illum ipsum molestias quaerat pariatur accusamus.\r\nSit tempore animi a praesentium quidem dolorum aut earum possimus pariatur quae asperiores autem velit alias veniam consectetur deleniti incidunt, fuga laudantium sunt error eaque rem? Velit omnis odio molestias!\r\nSapiente, corrupti? Numquam consequatur nobis repellat at porro ipsum eius ex ipsam ipsa quo, voluptatum doloribus dignissimos recusandae quas, cumque facere, commodi officia distinctio accusantium? Corporis excepturi incidunt odio porro!', '350.00'),
(9, 'Habitacion Colonial', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ea incidunt quasi sint! Nobis fugiat, reprehenderit vitae ducimus nesciunt, est officia voluptas quisquam, nihil illum ipsum molestias quaerat pariatur accusamus.\r\nSit tempore animi a praesentium quidem dolorum aut earum possimus pariatur quae asperiores autem velit alias veniam consectetur deleniti incidunt, fuga laudantium sunt error eaque rem? Velit omnis odio molestias!\r\nSapiente, corrupti? Numquam consequatur nobis repellat at porro ipsum eius ex ipsam ipsa quo, voluptatum doloribus dignissimos recusandae quas, cumque facere, commodi officia distinctio accusantium? Corporis excepturi incidunt odio porro!', '260.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_categories_to_show`
--

DROP TABLE IF EXISTS `039_categories_to_show`;
CREATE TABLE IF NOT EXISTS `039_categories_to_show` (
  `ID_category` int(11) NOT NULL,
  `category_name` varchar(60) NOT NULL,
  `category_description` varchar(60) NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_categories_to_show`
--

TRUNCATE TABLE `039_categories_to_show`;
--
-- Volcado de datos para la tabla `039_categories_to_show`
--

INSERT INTO `039_categories_to_show` (`ID_category`, `category_name`, `category_description`, `capacity`, `price`) VALUES
(1, 'Habitacion Deluxe', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nec', 2, '230.00'),
(2, 'Serenity Suite', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nec', 2, '240.00'),
(3, 'Suite Familiar del Lago', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nec', 6, '560.00'),
(4, 'Bungalow', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nec', 4, '500.00'),
(5, 'Villa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nec', 4, '530.00'),
(6, 'Suite Presidencial', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nec', 2, '420.00'),
(7, 'Suite Colonial', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nec', 2, '375.00'),
(8, 'Junior Suite Colonial', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nec', 3, '350.00'),
(9, 'Habitacion Colonial', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nec', 2, '260.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_clients`
--

DROP TABLE IF EXISTS `039_clients`;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_clients`
--

TRUNCATE TABLE `039_clients`;
--
-- Volcado de datos para la tabla `039_clients`
--

INSERT INTO `039_clients` (`ID_client`, `dni`, `firstname`, `surname`, `email`, `phone_number`, `birthday`, `pwd`) VALUES
(1, '95265142G', 'juan', 'qwer', 'ema33@gmail.com', 653689524, '1990-08-08', '123'),
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
(15, '77526272F', 'Herrod', 'Prince', 'molestie.sodales@outlook.org', 686155111, '1992-08-08', '123'),
(16, '12411125F', 'juandd', 'poom', 'asdf@correo.com', 123321123, '1986-11-13', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_documents_json`
--

DROP TABLE IF EXISTS `039_documents_json`;
CREATE TABLE IF NOT EXISTS `039_documents_json` (
  `ID_document_json` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` varchar(60) NOT NULL,
  `document_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`document_json`)),
  `document_date` datetime NOT NULL,
  PRIMARY KEY (`ID_document_json`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_documents_json`
--

TRUNCATE TABLE `039_documents_json`;
--
-- Volcado de datos para la tabla `039_documents_json`
--

INSERT INTO `039_documents_json` (`ID_document_json`, `document_name`, `document_json`, `document_date`) VALUES
(11, '2023-03-10 02-06-57_weatherObj.json', '[{\"LocalObservationDateTime\":\"2023-03-10T01:58:00 01:00\",\"EpochTime\":1678409880,\"WeatherText\":\"Clear\",\"WeatherIcon\":33,\"HasPrecipitation\":false,\"PrecipitationType\":null,\"IsDayTime\":false,\"Temperature\":{\"Metric\":{\"Value\":14.8,\"Unit\":\"C\",\"UnitType\":17},\"Imperial\":{\"Value\":59.0,\"Unit\":\"F\",\"UnitType\":18}},\"MobileLink\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\",\"Link\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\"}]', '2023-03-10 01:43:10'),
(12, '2023-03-10 02-13-12_weatherObj.json', '[{\"LocalObservationDateTime\":\"2023-03-10T01:58:00 01:00\",\"EpochTime\":1678409880,\"WeatherText\":\"Clear\",\"WeatherIcon\":33,\"HasPrecipitation\":false,\"PrecipitationType\":null,\"IsDayTime\":false,\"Temperature\":{\"Metric\":{\"Value\":14.8,\"Unit\":\"C\",\"UnitType\":17},\"Imperial\":{\"Value\":59.0,\"Unit\":\"F\",\"UnitType\":18}},\"MobileLink\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\",\"Link\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\"}]', '2023-03-10 02:13:12'),
(13, '2023-03-10 04-24-29_weatherObj.json', '[{\"LocalObservationDateTime\":\"2023-03-10T04:17:00 01:00\",\"EpochTime\":1678418220,\"WeatherText\":\"Partly cloudy\",\"WeatherIcon\":35,\"HasPrecipitation\":false,\"PrecipitationType\":null,\"IsDayTime\":false,\"Temperature\":{\"Metric\":{\"Value\":14.1,\"Unit\":\"C\",\"UnitType\":17},\"Imperial\":{\"Value\":57.0,\"Unit\":\"F\",\"UnitType\":18}},\"MobileLink\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\",\"Link\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\"}]', '2023-03-10 04:24:29'),
(14, '2023-03-10 04-55-17_weatherObj.json', '[{\"LocalObservationDateTime\":\"2023-03-10T04:47:00 01:00\",\"EpochTime\":1678420020,\"WeatherText\":\"Partly cloudy\",\"WeatherIcon\":35,\"HasPrecipitation\":false,\"PrecipitationType\":null,\"IsDayTime\":false,\"Temperature\":{\"Metric\":{\"Value\":14.9,\"Unit\":\"C\",\"UnitType\":17},\"Imperial\":{\"Value\":59.0,\"Unit\":\"F\",\"UnitType\":18}},\"MobileLink\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\",\"Link\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\"}]', '2023-03-10 04:55:17'),
(15, '2023-03-10 05-28-40_weatherObj.json', '[{\"LocalObservationDateTime\":\"2023-03-10T05:17:00 01:00\",\"EpochTime\":1678421820,\"WeatherText\":\"Mostly clear\",\"WeatherIcon\":34,\"HasPrecipitation\":false,\"PrecipitationType\":null,\"IsDayTime\":false,\"Temperature\":{\"Metric\":{\"Value\":14.1,\"Unit\":\"C\",\"UnitType\":17},\"Imperial\":{\"Value\":57.0,\"Unit\":\"F\",\"UnitType\":18}},\"MobileLink\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\",\"Link\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\"}]', '2023-03-10 05:28:40'),
(16, '2023-03-10 06-03-19_weatherObj.json', '[{\"LocalObservationDateTime\":\"2023-03-10T05:52:00 01:00\",\"EpochTime\":1678423920,\"WeatherText\":\"Mostly clear\",\"WeatherIcon\":34,\"HasPrecipitation\":false,\"PrecipitationType\":null,\"IsDayTime\":false,\"Temperature\":{\"Metric\":{\"Value\":14.3,\"Unit\":\"C\",\"UnitType\":17},\"Imperial\":{\"Value\":58.0,\"Unit\":\"F\",\"UnitType\":18}},\"MobileLink\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\",\"Link\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\"}]', '2023-03-10 06:03:19'),
(17, '2023-03-10 06-37-59_weatherObj.json', '[{\"LocalObservationDateTime\":\"2023-03-10T06:23:00 01:00\",\"EpochTime\":1678425780,\"WeatherText\":\"Mostly cloudy\",\"WeatherIcon\":38,\"HasPrecipitation\":false,\"PrecipitationType\":null,\"IsDayTime\":false,\"Temperature\":{\"Metric\":{\"Value\":14.3,\"Unit\":\"C\",\"UnitType\":17},\"Imperial\":{\"Value\":58.0,\"Unit\":\"F\",\"UnitType\":18}},\"MobileLink\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\",\"Link\":\"http://www.accuweather.com/en/es/mao/305482/current-weather/305482?lang=en-us\"}]', '2023-03-10 06:37:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_reservations`
--

DROP TABLE IF EXISTS `039_reservations`;
CREATE TABLE IF NOT EXISTS `039_reservations` (
  `ID_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `ID_client` int(11) NOT NULL,
  `ID_room` int(11) DEFAULT NULL,
  `ID_category` int(11) NOT NULL,
  `initial_date` date NOT NULL,
  `final_date` date NOT NULL,
  `number_guests` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `ID_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_reservation`),
  KEY `ID_client` (`ID_client`),
  KEY `ID_room` (`ID_room`),
  KEY `ID_status` (`ID_status`),
  KEY `ID_category` (`ID_category`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_reservations`
--

TRUNCATE TABLE `039_reservations`;
--
-- Volcado de datos para la tabla `039_reservations`
--

INSERT INTO `039_reservations` (`ID_reservation`, `ID_client`, `ID_room`, `ID_category`, `initial_date`, `final_date`, `number_guests`, `total_price`, `ID_status`) VALUES
(1, 1, 1, 1, '2022-06-17', '2022-06-19', 2, 300, 3),
(14, 1, 2, 2, '2022-06-18', '2022-06-19', 2, 300, 3),
(15, 1, 3, 3, '2022-06-21', '2022-06-24', 2, 300, 3),
(16, 1, 1, 1, '2022-12-07', '2022-12-08', 2, 230, 3),
(24, 3, 5, 2, '2022-12-07', '2022-12-09', 2, 480, 1),
(27, 1, 1, 1, '2022-12-09', '2022-12-10', 2, 230, 3),
(28, 1, 2, 2, '2022-12-21', '2022-12-22', 2, 240, 3),
(29, 1, 4, 4, '2022-12-23', '2022-12-24', 4, 500, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_rooms`
--

DROP TABLE IF EXISTS `039_rooms`;
CREATE TABLE IF NOT EXISTS `039_rooms` (
  `ID_room` int(11) NOT NULL AUTO_INCREMENT,
  `ID_category` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`ID_room`),
  KEY `ID_category` (`ID_category`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_rooms`
--

TRUNCATE TABLE `039_rooms`;
--
-- Volcado de datos para la tabla `039_rooms`
--

INSERT INTO `039_rooms` (`ID_room`, `ID_category`, `capacity`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 6),
(4, 4, 4),
(5, 5, 4),
(6, 6, 2),
(7, 7, 2),
(8, 8, 3),
(9, 9, 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `039_rooms_view`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `039_rooms_view`;
CREATE TABLE IF NOT EXISTS `039_rooms_view` (
`ID_room` int(11)
,`category_name` varchar(60)
,`capacity` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_services`
--

DROP TABLE IF EXISTS `039_services`;
CREATE TABLE IF NOT EXISTS `039_services` (
  `ID_service` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(60) NOT NULL,
  `service_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_service`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_services`
--

TRUNCATE TABLE `039_services`;
--
-- Volcado de datos para la tabla `039_services`
--

INSERT INTO `039_services` (`ID_service`, `service_name`, `service_price`) VALUES
(1, 'Spa', '20.00'),
(2, 'Bar', '15.00'),
(3, 'Restaurant', '25.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_status`
--

DROP TABLE IF EXISTS `039_status`;
CREATE TABLE IF NOT EXISTS `039_status` (
  `ID_status` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_status`
--

TRUNCATE TABLE `039_status`;
--
-- Volcado de datos para la tabla `039_status`
--

INSERT INTO `039_status` (`ID_status`, `status_name`) VALUES
(1, 'booked'),
(2, 'checkin'),
(3, 'checkout'),
(4, 'canceled');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `039_users`
--

DROP TABLE IF EXISTS `039_users`;
CREATE TABLE IF NOT EXISTS `039_users` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pwd` varchar(60) NOT NULL,
  `user_pfp` varchar(60) NOT NULL DEFAULT 'default.png',
  PRIMARY KEY (`ID_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `039_users`
--

TRUNCATE TABLE `039_users`;
--
-- Volcado de datos para la tabla `039_users`
--

INSERT INTO `039_users` (`ID_user`, `username`, `email`, `pwd`, `user_pfp`) VALUES
(1, 'dwesteacher', 'dwesteacher@correo.com', 'enrique', 'enrique.jpg'),
(2, 'hugo', 'correo@correo.com', '123', 'default.png'),
(7, 'abc', 'a@a.a', '123', '906ae00e589cedfbcf8a9ae3be32337f.png');

-- --------------------------------------------------------

--
-- Estructura para la vista `039_rooms_view`
--
DROP TABLE IF EXISTS `039_rooms_view`;

DROP VIEW IF EXISTS `039_rooms_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `039_rooms_view`  AS SELECT `r`.`ID_room` AS `ID_room`, `c`.`category_name` AS `category_name`, `r`.`capacity` AS `capacity` FROM (`039_rooms` `r` join `039_categories` `c` on(`r`.`ID_category` = `c`.`ID_category`)) ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `039_reservations`
--
ALTER TABLE `039_reservations`
  ADD CONSTRAINT `039_reservations_ibfk_1` FOREIGN KEY (`ID_client`) REFERENCES `039_clients` (`ID_client`),
  ADD CONSTRAINT `039_reservations_ibfk_2` FOREIGN KEY (`ID_room`) REFERENCES `039_rooms` (`ID_room`),
  ADD CONSTRAINT `039_reservations_ibfk_3` FOREIGN KEY (`ID_status`) REFERENCES `039_status` (`ID_status`),
  ADD CONSTRAINT `039_reservations_ibfk_4` FOREIGN KEY (`ID_category`) REFERENCES `039_categories` (`ID_category`);

--
-- Filtros para la tabla `039_rooms`
--
ALTER TABLE `039_rooms`
  ADD CONSTRAINT `039_rooms_ibfk_1` FOREIGN KEY (`ID_category`) REFERENCES `039_categories` (`ID_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
