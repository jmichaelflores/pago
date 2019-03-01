-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-03-2019 a las 07:32:56
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pagodeconsejeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleta`
--

DROP TABLE IF EXISTS `boleta`;
CREATE TABLE IF NOT EXISTS `boleta` (
  `idboleta` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_emision` date NOT NULL,
  `fecha_limite` date NOT NULL,
  `NPE` varchar(32) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `inscripciones_idinscripciones` int(11) NOT NULL,
  PRIMARY KEY (`idboleta`),
  KEY `fk_boleta_inscripciones1_idx` (`inscripciones_idinscripciones`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `boleta`
--

INSERT INTO `boleta` (`idboleta`, `fecha_emision`, `fecha_limite`, `NPE`, `estado`, `inscripciones_idinscripciones`) VALUES
(1, '2019-03-01', '2019-03-02', '12', 0, 1),
(2, '2019-03-01', '2019-03-02', '123', 0, 2),
(3, '2019-03-01', '2019-03-02', '83', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

DROP TABLE IF EXISTS `calendario`;
CREATE TABLE IF NOT EXISTS `calendario` (
  `idcalendario` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` varchar(20) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT '0',
  `inscripciones_idinscripciones` int(11) NOT NULL,
  `subservicios_idsubservicios` int(11) NOT NULL,
  PRIMARY KEY (`idcalendario`),
  KEY `fk_calendario_inscripciones1_idx` (`inscripciones_idinscripciones`),
  KEY `fk_calendario_subservicios1` (`subservicios_idsubservicios`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`idcalendario`, `fecha`, `hora`, `estado`, `inscripciones_idinscripciones`, `subservicios_idsubservicios`) VALUES
(10, '2019-03-07', '12:00', '0', 1, 1),
(11, '2019-03-13', '06:00', '1', 1, 5),
(12, '2019-03-15', '07:00', '1', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

DROP TABLE IF EXISTS `inscripciones`;
CREATE TABLE IF NOT EXISTS `inscripciones` (
  `idinscripciones` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `edad` int(11) NOT NULL,
  `institucion` varchar(45) NOT NULL,
  `grado` varchar(45) NOT NULL,
  `correo` varchar(75) NOT NULL,
  `nombre_pago` varchar(45) NOT NULL,
  `correo_pago` varchar(75) NOT NULL,
  `telefono_pago` varchar(9) NOT NULL,
  `servicio_idservicio` int(11) NOT NULL,
  PRIMARY KEY (`idinscripciones`),
  KEY `fk_inscripciones_servicio_idx` (`servicio_idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`idinscripciones`, `nombre`, `edad`, `institucion`, `grado`, `correo`, `nombre_pago`, `correo_pago`, `telefono_pago`, `servicio_idservicio`) VALUES
(1, 'Michael', 20, 'Jerysa', 'Tercer aÃ±o de Bachillerato Tecnico', 'jm.michaelflores@gmail.com', 'asas', 'juan@gmail.com', '2222-2222', 1),
(2, 'Michael', 20, 'Jerysa', 'Tercer aÃ±o de Bachillerato Tecnico', 'jm.michaelflores@gmail.com', 'asas', 'juan@gmail.com', '2222-2222', 1),
(3, 'Michael JUAN', 17, 'Jerysa', 'Segundo aÃ±o de Bachillerato General', 'asas@gmail.com', 'Juan', 'juan@gmail.com', '2222-2222', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_servicio` varchar(45) NOT NULL,
  `precio_servicio` float NOT NULL,
  PRIMARY KEY (`idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `nombre_servicio`, `precio_servicio`) VALUES
(1, 'servicio A', 20),
(2, 'servicio B', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subservicios`
--

DROP TABLE IF EXISTS `subservicios`;
CREATE TABLE IF NOT EXISTS `subservicios` (
  `idsubservicios` int(11) NOT NULL AUTO_INCREMENT,
  `subservicio` varchar(45) DEFAULT NULL,
  `servicio_idservicio` int(11) NOT NULL,
  PRIMARY KEY (`idsubservicios`),
  KEY `fk_subservicios_servicio1_idx` (`servicio_idservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subservicios`
--

INSERT INTO `subservicios` (`idsubservicios`, `subservicio`, `servicio_idservicio`) VALUES
(1, 'Subservicio A1', 1),
(2, 'subservicio A2', 1),
(5, 'subservicio A3', 1),
(8, 'subservicio B1', 2),
(9, 'subservicio B2', 2),
(10, 'subservicio B3', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(75) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tipousuario` varchar(225) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `usuario`, `password`, `tipousuario`) VALUES
(1, 'admin', '123', 'administrador');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD CONSTRAINT `fk_boleta_inscripciones1` FOREIGN KEY (`inscripciones_idinscripciones`) REFERENCES `inscripciones` (`idinscripciones`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `fk_calendario_inscripciones1` FOREIGN KEY (`inscripciones_idinscripciones`) REFERENCES `inscripciones` (`idinscripciones`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_calendario_subservicios1` FOREIGN KEY (`subservicios_idsubservicios`) REFERENCES `subservicios` (`idsubservicios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `fk_inscripciones_servicio` FOREIGN KEY (`servicio_idservicio`) REFERENCES `servicio` (`idservicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subservicios`
--
ALTER TABLE `subservicios`
  ADD CONSTRAINT `fk_subservicios_servicio1` FOREIGN KEY (`servicio_idservicio`) REFERENCES `servicio` (`idservicio`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
