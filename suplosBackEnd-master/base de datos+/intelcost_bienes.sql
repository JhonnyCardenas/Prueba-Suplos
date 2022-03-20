-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2022 a las 02:16:41
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `intelcost_bienes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_intelcost_guardados`
--

CREATE TABLE `tb_intelcost_guardados` (
  `intel_id` int(11) NOT NULL,
  `intel_estado` varchar(20) NOT NULL,
  `intel_bienes` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_intelcost_guardados`
--

INSERT INTO `tb_intelcost_guardados` (`intel_id`, `intel_estado`, `intel_bienes`) VALUES
(1, 'comprado', '1'),
(2, 'comprado', '1'),
(3, 'comprado', '1'),
(4, 'comprado', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_intelcost_guardados`
--
ALTER TABLE `tb_intelcost_guardados`
  ADD PRIMARY KEY (`intel_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_intelcost_guardados`
--
ALTER TABLE `tb_intelcost_guardados`
  MODIFY `intel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
