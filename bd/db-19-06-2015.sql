-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-06-2015 a las 22:17:28
-- Versión del servidor: 5.5.43-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `seguridadlandia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alarma`
--

CREATE TABLE IF NOT EXISTS `alarma` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_hogar` int(10) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_hogar` (`id_hogar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `alarma`
--

INSERT INTO `alarma` (`id`, `id_hogar`, `password`, `estado`) VALUES
(1, 1, 'parrilla', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente`
--

CREATE TABLE IF NOT EXISTS `ambiente` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `id_hogar` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_hogar` (`id_hogar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ambiente`
--

INSERT INTO `ambiente` (`id`, `descripcion`, `id_hogar`) VALUES
(1, 'cocina', 1),
(2, 'comedor', 1),
(3, 'garage', 1),
(4, 'habitacion principal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente_elemento`
--

CREATE TABLE IF NOT EXISTS `ambiente_elemento` (
  `id_ambiente` int(10) NOT NULL,
  `id_elemento` int(10) NOT NULL,
  PRIMARY KEY (`id_ambiente`,`id_elemento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ambiente_elemento`
--

INSERT INTO `ambiente_elemento` (`id_ambiente`, `id_elemento`) VALUES
(1, 4),
(1, 5),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(4, 4),
(4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camara`
--

CREATE TABLE IF NOT EXISTS `camara` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `posicion` varchar(30) CHARACTER SET utf8 NOT NULL,
  `id_ambiente` int(10) NOT NULL,
  `ip_camara` varchar(20) CHARACTER SET utf8 NOT NULL,
  `activado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `camara`
--

INSERT INTO `camara` (`id`, `posicion`, `id_ambiente`, `ip_camara`, `activado`) VALUES
(1, 'rotatoria 160°', 3, '192.168.10.3', 1),
(2, 'fija', 2, '192.168.10.2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `visualizacion` tinyint(1) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`visualizacion`, `id_usuario`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_hogar`
--

CREATE TABLE IF NOT EXISTS `cliente_hogar` (
  `id_hogar` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  PRIMARY KEY (`id_hogar`,`id_cliente`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente_hogar`
--

INSERT INTO `cliente_hogar` (`id_hogar`, `id_cliente`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE IF NOT EXISTS `contrato` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(10) NOT NULL,
  `id_hogar` int(10) NOT NULL,
  `ip_hogar` varchar(15) CHARACTER SET utf8 NOT NULL,
  `plan` int(2) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_hogar` (`id_hogar`),
  KEY `plan` (`plan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`id`, `id_cliente`, `id_hogar`, `ip_hogar`, `plan`, `fecha`) VALUES
(1, 2, 1, '192.168.10.0', 3, '2014-10-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_elemento`
--

CREATE TABLE IF NOT EXISTS `contrato_elemento` (
  `id_contrato` int(10) NOT NULL,
  `id_elemento` int(10) NOT NULL,
  PRIMARY KEY (`id_contrato`,`id_elemento`),
  KEY `id_elemento` (`id_elemento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contrato_elemento`
--

INSERT INTO `contrato_elemento` (`id_contrato`, `id_elemento`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elemento`
--

CREATE TABLE IF NOT EXISTS `elemento` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8 NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 NOT NULL,
  `precio` int(10) NOT NULL,
  `opcional` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `elemento`
--

INSERT INTO `elemento` (`id`, `nombre`, `descripcion`, `precio`, `opcional`) VALUES
(1, 'router centralizado', 'router centralizado de seguridad', 1000, 0),
(2, 'alarma blindada', 'alarma blindada marca acme', 2000, 0),
(3, 'bateria de sistema d', 'bateria de sistema de seguridad marca duacell para', 500, 0),
(4, 'sensor de presencia', 'sensor de presencia, necesario  uno por ambiente', 200, 0),
(5, 'sensor de cierre de ', 'sensor de cierre de apertura para puertas y ventan', 200, 0),
(6, 'camara ip', 'camara ip que es opcional al cleinte', 1500, 1),
(7, 'comunicador 3g', 'comunicador 3g de ultima generacion marca sony', 1200, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(10) NOT NULL,
  `detalle` text CHARACTER SET utf8 NOT NULL,
  `importe` int(30) NOT NULL,
  `pago` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `id_cliente`, `detalle`, `importe`, `pago`, `fecha`) VALUES
(2, 2, 'router centralizado, 1000, 1 , 1000\n\r\nalarma blindada, 2000, 1, 2000\n\r\nbateria de sistema de seguridad, 500, 1, 500\n\r\nsensor de presencia, 200, 4, 800\n\r\nsensor de cierre de puertas y ventanas, 200, 4, 800\n\r\ncamara ip, 1500, 2, 3000\n\r\ncomunicador 3g, 1200, 1, 1200\n\r\ntotal, 9300 \n', 9300, 1, '2014-11-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hogar`
--

CREATE TABLE IF NOT EXISTS `hogar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `calle` varchar(30) CHARACTER SET utf8 NOT NULL,
  `numero` int(10) NOT NULL,
  `id_zona` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_zona` (`id_zona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `hogar`
--

INSERT INTO `hogar` (`id`, `calle`, `numero`, `id_zona`) VALUES
(1, 'arieta', 2500, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_alarma` int(10) NOT NULL,
  `id_hogar` int(10) NOT NULL,
  `id_zona` int(10) NOT NULL,
  `tipo_alarma` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_alarma` (`id_alarma`),
  KEY `id_zona` (`id_zona`),
  KEY `id_hogar` (`id_hogar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id`, `fecha`, `id_alarma`, `id_hogar`, `id_zona`, `tipo_alarma`) VALUES
(1, '2014-10-24', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monitoreador_camara`
--

CREATE TABLE IF NOT EXISTS `monitoreador_camara` (
  `id_camara` int(10) NOT NULL,
  `id_monitoreador` int(10) NOT NULL,
  PRIMARY KEY (`id_camara`,`id_monitoreador`),
  KEY `id_monitoreador` (`id_monitoreador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `monitoreador_camara`
--

INSERT INTO `monitoreador_camara` (`id_camara`, `id_monitoreador`) VALUES
(1, 4),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) CHARACTER SET utf8 NOT NULL,
  `descripcion` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`id`, `nombre`, `descripcion`) VALUES
(1, 'basico', 'plan basico que consta de 1 camaras y 3 sensores de movimiento, 4 sensores de apertura de puertas y ventanas, router centralizador de seguridad, alarma blindada '),
(2, 'plan premiun', 'plan premiun que consta de 2 camaras ip y 6 sensores de movimiento, 6 sensores de apertura de puertas y ventanas, router centralizador de seguridad, alarma blindada '),
(3, 'plan gold', 'plan gold que consta de 4 camaras ip y 6 sensores de movimiento, 6 sensores de apertura de puertas y ventanas, router centralizador de seguridad, alarma blindada, Comunicador 3G');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `id` int(10) NOT NULL,
  `hashToken` varchar(50) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `token`
--

INSERT INTO `token` (`id`, `hashToken`) VALUES
(2, '5h2welxvt9mtia4im9zgmedjs5xqib0j');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8 NOT NULL,
  `apellido` varchar(30) CHARACTER SET utf8 NOT NULL,
  `dni` bigint(10) NOT NULL,
  `telefono` int(12) NOT NULL,
  `calle` varchar(20) CHARACTER SET utf8 NOT NULL,
  `numero` int(8) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`,`password`),
  UNIQUE KEY `nombre_2` (`nombre`,`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `tipo_usuario`, `email`, `nombre`, `apellido`, `dni`, `telefono`, `calle`, `numero`, `password`) VALUES
(1, 'admin', 'roberto.braile@gmail.com', 'Roberto', 'braile', 22222222, 4444444, 'brasil', 3891, '7aa99682f9d3a129f54e0eae9ccd3628'),
(2, 'cliente', 'juan.peres@gemail.com', 'Juan', 'peres', 33333333, 4445555, 'arieta', 2438, '92eaf3719159c372f3d50337e0a14f57'),
(3, 'vigilador', 'maxi@gemail.com', 'maximiliano', 'scalzotto', 22444555, 4446666, 'san juan', 1234, '81e8a7c05d92fd692c5995e3457fb645'),
(4, 'monitoreador', 'carlos@gemail.com', 'carlos', 'perez', 221223456, 4441234, ' calle falsa', 123, 'dc599a9972fde3045dab59dbd1ae170b'),
(6, 'cliente', 'juan@cliente.com', 'Juan', 'Doe', 12332145, 44554455, 'calle falsa', 4321, 'a1c134fc5aa7a0e76630b6e8b8d671e1'),
(7, 'cliente', 'pedro@picapiedra.com', 'pedro', 'picapiedra', 99999999, 44667789, 'arieta', 1234, 'pedro'),
(8, 'cliente', 'pedro@picapiedra2.com', 'pedro2', 'picapiedra2', 999999992, 446677892, 'arieta22', 12342, 'pedro22'),
(10, 'cliente', 'pedro@picapiedra3.com', 'pedro3', 'picapiedra3', 999999993, 446677893, 'arieta3', 1233, 'pedro3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE IF NOT EXISTS `zona` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8 NOT NULL,
  `partido` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id`, `nombre`, `partido`) VALUES
(1, 'san justo', 'la matanza'),
(2, 'villa luzuriaga', 'la matanza'),
(3, 'ramos mejia', 'la matanza'),
(4, 'haedo', 'moron'),
(5, 'hurlingham', 'moron'),
(6, 'villa tesei', 'moron'),
(7, 'lomas del mirador', 'la matanza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona_vigilador`
--

CREATE TABLE IF NOT EXISTS `zona_vigilador` (
  `id_zona` int(10) NOT NULL,
  `id_vigilador` int(10) NOT NULL,
  PRIMARY KEY (`id_zona`,`id_vigilador`),
  KEY `id_vigilador` (`id_vigilador`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `zona_vigilador`
--

INSERT INTO `zona_vigilador` (`id_zona`, `id_vigilador`) VALUES
(1, 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alarma`
--
ALTER TABLE `alarma`
  ADD CONSTRAINT `alarma_ibfk_1` FOREIGN KEY (`id_hogar`) REFERENCES `hogar` (`id`);

--
-- Filtros para la tabla `ambiente`
--
ALTER TABLE `ambiente`
  ADD CONSTRAINT `ambiente_ibfk_1` FOREIGN KEY (`id_hogar`) REFERENCES `hogar` (`id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `cliente_hogar`
--
ALTER TABLE `cliente_hogar`
  ADD CONSTRAINT `cliente_hogar_ibfk_1` FOREIGN KEY (`id_hogar`) REFERENCES `hogar` (`id`),
  ADD CONSTRAINT `cliente_hogar_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `cliente_hogar_ibfk_3` FOREIGN KEY (`id_hogar`) REFERENCES `hogar` (`id`),
  ADD CONSTRAINT `cliente_hogar_ibfk_4` FOREIGN KEY (`id_hogar`) REFERENCES `hogar` (`id`),
  ADD CONSTRAINT `cliente_hogar_ibfk_5` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `contrato_ibfk_3` FOREIGN KEY (`plan`) REFERENCES `plan` (`id`),
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_usuario`),
  ADD CONSTRAINT `contrato_ibfk_2` FOREIGN KEY (`id_hogar`) REFERENCES `hogar` (`id`);

--
-- Filtros para la tabla `contrato_elemento`
--
ALTER TABLE `contrato_elemento`
  ADD CONSTRAINT `contrato_elemento_ibfk_1` FOREIGN KEY (`id_contrato`) REFERENCES `contrato` (`id`),
  ADD CONSTRAINT `contrato_elemento_ibfk_2` FOREIGN KEY (`id_elemento`) REFERENCES `elemento` (`id`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_usuario`);

--
-- Filtros para la tabla `hogar`
--
ALTER TABLE `hogar`
  ADD CONSTRAINT `hogar_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `zona` (`id`);

--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id_alarma`) REFERENCES `alarma` (`id`),
  ADD CONSTRAINT `log_ibfk_2` FOREIGN KEY (`id_zona`) REFERENCES `zona` (`id`),
  ADD CONSTRAINT `log_ibfk_3` FOREIGN KEY (`id_hogar`) REFERENCES `hogar` (`id`);

--
-- Filtros para la tabla `monitoreador_camara`
--
ALTER TABLE `monitoreador_camara`
  ADD CONSTRAINT `monitoreador_camara_ibfk_1` FOREIGN KEY (`id_camara`) REFERENCES `camara` (`id`),
  ADD CONSTRAINT `monitoreador_camara_ibfk_2` FOREIGN KEY (`id_monitoreador`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `zona_vigilador`
--
ALTER TABLE `zona_vigilador`
  ADD CONSTRAINT `zona_vigilador_ibfk_1` FOREIGN KEY (`id_zona`) REFERENCES `zona` (`id`),
  ADD CONSTRAINT `zona_vigilador_ibfk_2` FOREIGN KEY (`id_vigilador`) REFERENCES `usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
