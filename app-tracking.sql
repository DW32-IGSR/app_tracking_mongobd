-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2015 a las 10:33:03
-- Versión del servidor: 5.5.43-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `app-tracking`
--
CREATE DATABASE IF NOT EXISTS `app-tracking` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `app-tracking`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE IF NOT EXISTS `posicion` (
  `id_posicion` int(11) NOT NULL AUTO_INCREMENT,
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `hora` datetime DEFAULT NULL,
  PRIMARY KEY (`id_posicion`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Volcado de datos para la tabla `posicion`
--

INSERT INTO `posicion` (`id_posicion`, `latitud`, `longitud`, `id_usuario`, `hora`) VALUES
(2, 43.327325443400326, -1.9704635575119522, 1, '0000-00-00 12:23:00'),
(3, 43.327325443405456, -1.9704667667711953, 1, '2015-10-08 07:16:19'),
(6, 5465464, 4564564645, 1, '2015-10-08 07:43:05'),
(13, 15, 51, 1, '2015-10-08 17:08:50'),
(14, 15, 51, 1, '2015-10-08 15:09:09'),
(15, 500, 52, 1, '2015-10-08 15:14:10'),
(16, 40, 40, 1, '0000-00-00 00:00:00'),
(17, 50, 50, 1, '2015-10-09 06:13:54'),
(18, 500, 600, 1, '2015-10-09 07:10:01'),
(19, 5, 9, 1, '2015-10-09 08:56:04'),
(20, 5, 9, 1, '2015-10-09 08:56:36'),
(21, 5, 9, 1, '2015-10-09 08:56:44'),
(22, 15, 15, 17, '2015-10-09 09:19:13'),
(23, 8, 8, 17, '2015-10-09 09:24:49'),
(24, 8, 8, 17, '2015-10-09 09:24:53'),
(25, 20, 20, 17, '2015-10-09 09:25:00'),
(26, -4, -4, 17, '2015-10-09 09:26:51'),
(27, -4, -4, 17, '2015-10-09 09:29:50'),
(28, 34, 65, 17, '2015-10-09 09:29:52'),
(29, -4, -4, 17, '2015-10-09 09:30:39'),
(30, 34, 65, 17, '2015-10-09 09:30:48'),
(33, 20, 0, 3, '2015-10-13 11:14:34'),
(36, 51, 0, 3, '2015-10-13 11:14:49'),
(37, 66, -1, 3, '2015-10-15 08:48:44'),
(42, 43, -0, 3, '2015-10-15 08:53:20'),
(43, 40, -2, 1, '2015-10-20 10:13:13'),
(44, 45, 13, 18, '2015-10-20 10:27:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `pass`) VALUES
(1, 'iosu', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'gggg', '1234'),
(3, 'ruben', '81dc9bdb52d04dc20036dbd8313ed055'),
(17, 'nohtrim', '81dc9bdb52d04dc20036dbd8313ed055'),
(18, 'sergy', 'ab5d376f2dff11a3406cf7c50ee188e6');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD CONSTRAINT `posicion_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
