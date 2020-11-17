-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2020 a las 02:22:55
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

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `descripcion`) VALUES
(0, 'admin');

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

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`idSolicitud`, `descripcion`, `usuario`, `estado`, `validacion`) VALUES
(0, 'asdasdas', 'admin', 0, 0),
(0, 'asdasdas', 'admin', 0, 0),
(0, 'asdasdas', 'admin', 0, 0),
(0, 'lalalallala', 'admin', 0, 0),
(0, 'lalalallala', 'admin', 0, 0),
(0, '[object Object]', '[object Object]', 0, 0),
(0, '[object Object]', '[object Object]', 0, 0),
(0, '[object Object]', '[object Object]', 0, 0),
(0, '[object Object]', '[object Object]', 0, 0),
(0, '[object Object]', '[object Object]', 0, 0),
(0, '[object Object]', 'Obaseki Nosa', 0, 0),
(0, 'lalalallala', 'admin', 0, 0),
(0, '[object Object]', 'Obaseki Nosa', 0, 0),
(0, '[object Object]', 'Obaseki Nosa', 0, 0),
(0, '[object Object]', '{\"logeado\":true,\"admin\":false}', 0, 0);

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
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
