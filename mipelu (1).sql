-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2024 a las 14:31:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mipelu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `idAdmin` int(11) NOT NULL,
  `nombreAdmin` varchar(50) NOT NULL,
  `contraseña` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`idAdmin`, `nombreAdmin`, `contraseña`) VALUES
(1, 'root', 'pass');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `Id` int(11) NOT NULL,
  `estilista_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `title` varchar(100) NOT NULL,
  `color` varchar(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`Id`, `estilista_id`, `cliente_id`, `fecha`, `title`, `color`, `start`, `end`) VALUES
(3, 1, 1, '2024-04-23', '1', '#7fff00', '2024-04-23 14:00:00', '2024-04-23 14:00:00'),
(12, 1, 1, '2024-04-23', 'Peinado señorita', '#7fff00', '2024-04-23 10:30:00', '0000-00-00 00:00:00'),
(15, 1, 1, '2024-04-27', 'Peinado señorita', '#7fff00', '2024-04-27 16:00:00', '2024-04-27 16:00:00'),
(16, 1, 1, '2024-04-27', 'Peinado señorita', '#7fff00', '2024-04-27 16:00:00', '2024-04-27 16:00:00'),
(17, 1, 1, '2024-04-25', 'Peinado señorita 2 min', '#7fff00', '2024-04-25 15:00:00', '2024-04-25 15:00:00'),
(19, 1, 1, '2024-04-24', 'Peinado señorita 2 min', '#7fff00', '2024-04-24 17:30:00', '2024-04-24 17:30:00'),
(20, 1, 1, '2024-04-24', 'Peinado señorita 2 min', '#7fff00', '2024-04-24 17:30:00', '2024-04-24 17:30:00'),
(21, 1, 1, '2024-04-25', 'Peinado señorita 2 min', '#7fff00', '2024-04-25 16:00:00', '2024-04-25 16:00:00'),
(22, 1, 1, '2024-04-25', 'Peinado señorita 2 min', '#7fff00', '2024-04-25 16:00:00', '2024-04-25 16:00:00'),
(23, 1, 1, '2024-04-25', 'Peinado señorita 2 min', '#7fff00', '2024-04-25 16:30:00', '2024-04-25 16:30:00'),
(25, 1, 1, '2024-04-24', 'Peinado señorita 2 min', '#ff0000', '2024-04-24 17:30:00', '2024-04-24 17:30:00'),
(26, 1, 1, '2024-04-24', 'Peinado señorita 2 min', '#ff0000', '2024-04-24 17:30:00', '2024-04-24 17:30:00'),
(27, 1, 1, '2024-04-26', 'Peinado señorita 2 min', '#ff0000', '2024-04-26 13:30:00', '2024-04-26 13:30:00'),
(28, 1, 1, '2024-04-26', 'Peinado señorita 2 min', '#ff0000', '2024-04-26 13:30:00', '2024-04-26 13:30:00'),
(29, 1, 1, '2024-04-24', 'Peinado señorita 5 min', '#ff0000', '2024-04-24 09:30:00', '2024-04-24 09:30:00'),
(30, 1, 1, '2024-04-24', 'Peinado señorita 5 min', '#ff0000', '2024-04-24 09:30:00', '2024-04-24 09:30:00'),
(31, 1, 2, '2024-04-25', 'rulos 5 min', '#2a1313', '2024-04-25 11:30:00', '2024-04-25 11:30:00'),
(32, 1, 2, '2024-04-25', 'rulos 5 min', '#2a1313', '2024-04-25 11:30:00', '2024-04-25 11:30:00'),
(33, 1, 1, '2024-04-27', 'Peinado señorita 5 min', '#ff0000', '2024-04-27 10:00:00', '2024-04-27 10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `IdCliente` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `Apellido1` varchar(50) DEFAULT NULL,
  `Apellido2` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`IdCliente`, `nombre`, `Apellido1`, `Apellido2`, `telefono`, `observaciones`, `email`, `contraseña`) VALUES
(1, 'Björn', 'Bear', 'Oso', '666666666', 'se queja mucho ', '', ''),
(2, 'Björn', 'Bear', 'Oso', '666666666', 'se queja mucho ', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilista`
--

CREATE TABLE `estilista` (
  `IdEstilista` int(11) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `Apellido1` varchar(50) NOT NULL,
  `Apellido2` varchar(50) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `foto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estilista`
--

INSERT INTO `estilista` (`IdEstilista`, `nif`, `nombre`, `Apellido1`, `Apellido2`, `telefono`, `foto`) VALUES
(1, '098765', 'pascasiez', 'pascar', '[value-5]', '[value-8]', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estilista_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientos`
--

CREATE TABLE `tratamientos` (
  `idTratamiemto` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `duracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tratamientos`
--

INSERT INTO `tratamientos` (`idTratamiemto`, `nombre`, `descripcion`, `duracion`) VALUES
(1, '2', '3', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `estilista_id` (`estilista_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`IdCliente`) USING BTREE;

--
-- Indices de la tabla `estilista`
--
ALTER TABLE `estilista`
  ADD PRIMARY KEY (`IdEstilista`),
  ADD UNIQUE KEY `dni` (`nif`);

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estilista_id` (`estilista_id`);

--
-- Indices de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  ADD PRIMARY KEY (`idTratamiemto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estilista`
--
ALTER TABLE `estilista`
  MODIFY `IdEstilista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tratamientos`
--
ALTER TABLE `tratamientos`
  MODIFY `idTratamiemto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`IdCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estilista_id` FOREIGN KEY (`estilista_id`) REFERENCES `estilista` (`IdEstilista`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD CONSTRAINT `galeria_ibfk_1` FOREIGN KEY (`estilista_id`) REFERENCES `estilista` (`IdEstilista`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
