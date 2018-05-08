-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-04-2018 a las 00:27:20
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sagrario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosbautismos`
--

CREATE TABLE `datosbautismos` (
  `fechabau` date NOT NULL,
  `libro` int(5) NOT NULL,
  `foja` int(5) NOT NULL,
  `partida` int(5) NOT NULL,
  `partidaab` text COLLATE utf8_spanish2_ci NOT NULL,
  `ministro` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='solo un registro de parametros';

--
-- Volcado de datos para la tabla `datosbautismos`
--

INSERT INTO `datosbautismos` (`fechabau`, `libro`, `foja`, `partida`, `partidaab`, `ministro`) VALUES
('2018-04-25', 555, 1, 1, 'A', 'Ministro Bautizante');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
