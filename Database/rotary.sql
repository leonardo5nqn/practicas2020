-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2020 a las 00:35:21
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

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
CREATE DATABASE IF NOT EXISTS `rotary` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `rotary`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridad`
--

CREATE TABLE `prioridad` (
  `idPrioridad` int(255) NOT NULL,
  `fechaUltimoCambio` date NOT NULL,
  `prioridad` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(255) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idSolicitud` int(255) NOT NULL,
  `descripcion` text NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `estado` int(255) NOT NULL,
  `validacion` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudestado`
--

CREATE TABLE `solicitudestado` (
  `idSolicitudEstado` int(255) NOT NULL,
  `descripcion` text NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `estado` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudvalidacion`
--

CREATE TABLE `solicitudvalidacion` (
  `idValidacion` int(255) NOT NULL,
  `fechaUltimoCambio` date NOT NULL,
  `descripcion` text NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `prioridad` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombreDeUsuario` varchar(100) NOT NULL,
  `contrasenia` char(32) NOT NULL,
  `rol` int(255) NOT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioprivado`
--

CREATE TABLE `usuarioprivado` (
  `nombreUsuario` varchar(100) NOT NULL,
  `posicion` varchar(100) NOT NULL
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
-- Indices de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD PRIMARY KEY (`idPrioridad`),
  ADD KEY `prioridad_ibfk_1` (`usuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idBeneficio`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `validacion` (`validacion`),
  ADD KEY `beneficio_ibfk_3` (`estado`);

--
-- Indices de la tabla `solicitudestado`
--
ALTER TABLE `solicitudestado`
  ADD PRIMARY KEY (`idSolicitudEstado`),
  ADD KEY `estado` (`estado`),
  ADD KEY `solicitudestado_ibfk_2` (`usuario`);

--
-- Indices de la tabla `solicitudvalidacion`
--
ALTER TABLE `solicitudvalidacion`
  ADD PRIMARY KEY (`idValidacion`),
  ADD KEY `prioridad` (`prioridad`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombreDeUsuario`),
  ADD KEY `rol` (`rol`);

--
-- Indices de la tabla `usuarioprivado`
--
ALTER TABLE `usuarioprivado`
  ADD PRIMARY KEY (`nombreUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idEstado` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  MODIFY `idPrioridad` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idBeneficio` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudestado`
--
ALTER TABLE `solicitudestado`
  MODIFY `idSolicitudEstado` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudvalidacion`
--
ALTER TABLE `solicitudvalidacion`
  MODIFY `idValidacion` int(255) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD CONSTRAINT `prioridad_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarioprivado` (`nombreUsuario`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`nombreDeUsuario`),
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`validacion`) REFERENCES `solicitudvalidacion` (`idValidacion`),
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `solicitudestado` (`idSolicitudEstado`);

--
-- Filtros para la tabla `solicitudestado`
--
ALTER TABLE `solicitudestado`
  ADD CONSTRAINT `solicitudestado_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado` (`idEstado`),
  ADD CONSTRAINT `solicitudestado_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarioprivado` (`nombreUsuario`);

--
-- Filtros para la tabla `solicitudvalidacion`
--
ALTER TABLE `solicitudvalidacion`
  ADD CONSTRAINT `solicitudvalidacion_ibfk_1` FOREIGN KEY (`prioridad`) REFERENCES `prioridad` (`idPrioridad`),
  ADD CONSTRAINT `solicitudvalidacion_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarioprivado` (`nombreUsuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idRol`);

--
-- Filtros para la tabla `usuarioprivado`
--
ALTER TABLE `usuarioprivado`
  ADD CONSTRAINT `usuarioprivado_ibfk_1` FOREIGN KEY (`nombreUsuario`) REFERENCES `usuario` (`nombreDeUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
