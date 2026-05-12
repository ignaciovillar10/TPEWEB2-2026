-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2026 a las 15:04:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemaliga_tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id_equipo` int(11) NOT NULL,
  `nombre_equipo` varchar(110) NOT NULL,
  `nombre_liga` varchar(110) NOT NULL,
  `escudo` text DEFAULT NULL,
  `ciudad_equipo` varchar(100) NOT NULL DEFAULT '',
  `dt` varchar(100) NOT NULL DEFAULT '',
  `presidente` varchar(100) NOT NULL DEFAULT '',
  `nombre_estadio` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id_equipo`, `nombre_equipo`, `nombre_liga`, `escudo`, `ciudad_equipo`, `dt`, `presidente`, `nombre_estadio`) VALUES
(1, 'Club y Biblioteca Ramón Santamarina', 'liga de tandil', '', 'Tandil', '', '', 'Estadio Municipal Gral San Martín'),
(5, 'El fortin', 'Liga de Olavarria', '...', 'Olavarria', '...', '..', '...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ligas`
--

CREATE TABLE `ligas` (
  `id_liga` int(11) NOT NULL,
  `nombre_liga` varchar(110) NOT NULL,
  `ciudad_sede` varchar(100) NOT NULL DEFAULT '',
  `cant_equipos` int(11) NOT NULL DEFAULT 0,
  `temporada` int(11) NOT NULL DEFAULT 2026
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ligas`
--

INSERT INTO `ligas` (`id_liga`, `nombre_liga`, `ciudad_sede`, `cant_equipos`, `temporada`) VALUES
(1, 'liga de tandil', 'Tandil', 15, 2026),
(4, 'Liga de Olavarria', 'Olavarria', 10, 2026),
(5, 'Liga de Bolivar', 'Bolivar', 10, 2026),
(6, 'Liga de Azul', 'Azul', 12, 2026);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`, `rol`) VALUES
(6, 'nacho', '$2y$10$9Nd.uUdg7fq93LE6eHwdAuXHiff69LBWGHKM0MgAJilUNyTbdRBOK', 'admin'),
(8, 'webadmin', '$2y$10$6PTipQWFr1BZQan.vqiYBOjTri7n/nU597uhqA2IFoe/l7RK5BQDm', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `idx_equipo_liga` (`nombre_liga`);

--
-- Indices de la tabla `ligas`
--
ALTER TABLE `ligas`
  ADD PRIMARY KEY (`id_liga`),
  ADD UNIQUE KEY `uk_ligas_nombre` (`nombre_liga`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id_equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ligas`
--
ALTER TABLE `ligas`
  MODIFY `id_liga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `fk_equipo_liga` FOREIGN KEY (`nombre_liga`) REFERENCES `ligas` (`nombre_liga`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
