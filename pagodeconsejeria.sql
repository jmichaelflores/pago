-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2019 a las 21:33:48
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `boleta` (
  `idboleta` int(11) NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_limite` date NOT NULL,
  `NPE` varchar(32) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `inscripciones_idinscripciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `boleta`
--

INSERT INTO `boleta` (`idboleta`, `fecha_emision`, `fecha_limite`, `NPE`, `estado`, `inscripciones_idinscripciones`) VALUES
(1, '2019-02-23', '2019-02-24', '123456789', 0, 1),
(2, '2019-02-24', '2019-02-25', '2344', 0, 2),
(3, '2019-02-24', '2019-02-25', '12', 0, 3),
(4, '2019-02-24', '2019-02-25', '34', 0, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `idcalendario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(20) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT '0',
  `inscripciones_idinscripciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`idcalendario`, `fecha`, `hora`, `estado`, `inscripciones_idinscripciones`) VALUES
(14, '2019-03-01', '10:00', '1', 2),
(16, '2019-03-01', '13:00', '1', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `idinscripciones` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `edad` int(11) NOT NULL,
  `institucion` varchar(45) NOT NULL,
  `grado` varchar(45) NOT NULL,
  `correo` varchar(75) NOT NULL,
  `nombre_pago` varchar(45) NOT NULL,
  `correo_pago` varchar(75) NOT NULL,
  `telefono_pago` varchar(9) NOT NULL,
  `servicio_idservicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`idinscripciones`, `nombre`, `edad`, `institucion`, `grado`, `correo`, `nombre_pago`, `correo_pago`, `telefono_pago`, `servicio_idservicio`) VALUES
(1, 'Michael', 14, 'Jerysa', 'primeraniotecni', 'jm.michaelflores@gmail.com', 'Juan', 'juan@gmail.com', '2222-2222', 1),
(2, 'JUAN', 18, 'Jerysa', 'segunaniotecni', 'jm.michaelflores@gmail.com', 'Juan', 'juan@gmail.com', '2222-2222', 2),
(3, 'Valeria', 14, 'Colegio EspaÃ±ol Padre Arrupe', 'noveno', 'kvab3456@yahoo.com', 'Marta ', 'martita.lopez@hotmail.com', '2213-3456', 1),
(4, 'Michael', 20, 'La Lomita', 'terceraniotecni', 'canosito@gmail.com', 'Michael', 'holi.10@hotmail.com', '2245-7890', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idservicio` int(11) NOT NULL,
  `nombre_servicio` varchar(45) NOT NULL,
  `precio_servicio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idservicio`, `nombre_servicio`, `precio_servicio`) VALUES
(1, 'Servicio', 20),
(2, 'Otro Servicio', 500),
(3, 'Paquete Informativo Bachillerato', 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(75) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tipousuario` varchar(225) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `usuario`, `password`, `tipousuario`) VALUES
(1, 'admin', 'michaelmedijo', 'administrador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD PRIMARY KEY (`idboleta`),
  ADD KEY `fk_boleta_inscripciones1_idx` (`inscripciones_idinscripciones`);

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`idcalendario`),
  ADD KEY `fk_calendario_inscripciones1_idx` (`inscripciones_idinscripciones`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`idinscripciones`),
  ADD KEY `fk_inscripciones_servicio_idx` (`servicio_idservicio`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idservicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boleta`
--
ALTER TABLE `boleta`
  MODIFY `idboleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `idcalendario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `idinscripciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idservicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD CONSTRAINT `fk_boleta_inscripciones1` FOREIGN KEY (`inscripciones_idinscripciones`) REFERENCES `inscripciones` (`idinscripciones`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `fk_calendario_inscripciones1` FOREIGN KEY (`inscripciones_idinscripciones`) REFERENCES `inscripciones` (`idinscripciones`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `fk_inscripciones_servicio` FOREIGN KEY (`servicio_idservicio`) REFERENCES `servicio` (`idservicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
