-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2020 a las 01:41:51
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rotary`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idEstado`, `descripcion`) VALUES
(1, 'Pedido'),
(2, 'Pre-Aprobado'),
(3, 'Etapa 1'),
(4, 'Revisión 1'),
(5, 'Etapa 2'),
(6, 'Revisión 2'),
(7, 'Etapa 3'),
(8, 'Revisión 3'),
(9, 'Etapa Final'),
(10, 'Revisión Final'),
(11, 'Finalizado'),
(12, 'Rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historicosolicitud`
--

CREATE TABLE `historicosolicitud` (
  `id` int(255) NOT NULL,
  `Solicitud` int(255) NOT NULL,
  `Estado` int(255) NOT NULL,
  `Usuario` int(255) NOT NULL,
  `FechaActualizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `descripcion`) VALUES
(0, 'admin'),
(1, 'publico'),
(2, 'socio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idSolicitud` int(255) NOT NULL,
  `descripcion` text NOT NULL,
  `usuario` int(255) NOT NULL,
  `fechaPedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(255) NOT NULL,
  `nombreDeUsuario` varchar(100) NOT NULL,
  `contrasenia` char(32) NOT NULL,
  `rol` int(255) NOT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreDeUsuario`, `contrasenia`, `rol`, `mail`) VALUES
(1, 'admin', 'admin', 0, 'admin@example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validacion`
--

CREATE TABLE `validacion` (
  `id` int(255) NOT NULL,
  `VotoFavor` int(255) NOT NULL,
  `VotoContra` int(255) NOT NULL,
  `Resultado` tinyint(1) NOT NULL,
  `FechaCierreVotacion` date NOT NULL,
  `HistoricoSolicitud` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `historicosolicitud`
--
ALTER TABLE `historicosolicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Estado` (`Estado`),
  ADD KEY `Solicitud` (`Solicitud`),
  ADD KEY `Usuario` (`Usuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idSolicitud`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `validacion`
--
ALTER TABLE `validacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `HistoricoSolicitud` (`HistoricoSolicitud`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historicosolicitud`
--
ALTER TABLE `historicosolicitud`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idSolicitud` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `validacion`
--
ALTER TABLE `validacion`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historicosolicitud`
--
ALTER TABLE `historicosolicitud`
  ADD CONSTRAINT `historicosolicitud_ibfk_1` FOREIGN KEY (`Estado`) REFERENCES `estado` (`idEstado`),
  ADD CONSTRAINT `historicosolicitud_ibfk_2` FOREIGN KEY (`Solicitud`) REFERENCES `solicitud` (`idSolicitud`),
  ADD CONSTRAINT `historicosolicitud_ibfk_3` FOREIGN KEY (`Usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idRol`);

--
-- Filtros para la tabla `validacion`
--
ALTER TABLE `validacion`
  ADD CONSTRAINT `validacion_ibfk_1` FOREIGN KEY (`HistoricoSolicitud`) REFERENCES `historicosolicitud` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
