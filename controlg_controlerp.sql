-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2015 a las 00:06:47
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `controlg_controlerp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE IF NOT EXISTS `almacen` (
  `almacen_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `almacen` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `subalmacen` tinyint(1) NOT NULL COMMENT 'True si es Subalmacen. 0 = Si es subalmacen, 1 = No es subalmacen',
  `dependencia` int(11) NOT NULL COMMENT 'almacén_id identifica al almacén principal',
  PRIMARY KEY (`almacen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`almacen_id`, `usuario_id`, `almacen`, `subalmacen`, `dependencia`) VALUES
(1, 1, 'Almacen Central', 0, 0),
(2, 1, 'Ventas1', 1, 1),
(3, 1, 'Ventas2', 1, 1),
(4, 1, 'Ventas3', 1, 1),
(5, 1, 'Ventas4', 1, 1),
(6, 1, 'Oficina', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_det`
--

CREATE TABLE IF NOT EXISTS `almacen_det` (
  `almacendet_id` int(11) NOT NULL AUTO_INCREMENT,
  `almacen_id` int(11) NOT NULL,
  `transferencia_id` int(11) NOT NULL,
  `compra_id` int(11) NOT NULL,
  `ventas_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL COMMENT 'Producto que registra movimiento',
  `producto_ensamblado_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL COMMENT 'Registra Positivo si es Ingreso o Compra y Negativo si es venta',
  `activo` tinyint(1) NOT NULL,
  PRIMARY KEY (`almacendet_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `almacen_det`
--

INSERT INTO `almacen_det` (`almacendet_id`, `almacen_id`, `transferencia_id`, `compra_id`, `ventas_id`, `producto_id`, `producto_ensamblado_id`, `cantidad`, `activo`) VALUES
(1, 1, 0, 1, 0, 1, 85, 1200, 1),
(2, 1, 0, 1, 0, 40, 85, 1200, 1),
(3, 1, 0, 1, 0, 43, 85, 100, 1),
(4, 1, 1, 0, 0, 1, 85, -120, 1),
(5, 1, 1, 0, 0, 40, 85, -120, 1),
(6, 1, 1, 0, 0, 43, 85, -10, 1),
(7, 2, 1, 0, 0, 1, 85, 120, 1),
(8, 2, 1, 0, 0, 40, 85, 120, 1),
(9, 2, 1, 0, 0, 43, 85, 10, 1),
(10, 2, 0, 0, 1, 1, 85, -24, 1),
(11, 2, 0, 0, 1, 40, 85, 0, 1),
(12, 2, 0, 0, 1, 43, 85, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_transferencia`
--

CREATE TABLE IF NOT EXISTS `almacen_transferencia` (
  `transferencia_id` int(11) NOT NULL AUTO_INCREMENT,
  `almacen_origen_id` int(11) DEFAULT NULL,
  `almacen_destino_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`transferencia_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `almacen_transferencia`
--

INSERT INTO `almacen_transferencia` (`transferencia_id`, `almacen_origen_id`, `almacen_destino_id`, `fecha`) VALUES
(1, 1, 2, '2015-02-07 23:38:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_transferencias_detalle`
--

CREATE TABLE IF NOT EXISTS `almacen_transferencias_detalle` (
  `almacen_transferencias_detalle_id` int(11) NOT NULL AUTO_INCREMENT,
  `almacen_transferencias_id` int(11) DEFAULT NULL,
  `producto_ensamblado_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT '0',
  `cantidad` int(11) DEFAULT '0',
  `faltante` int(11) DEFAULT '0',
  PRIMARY KEY (`almacen_transferencias_detalle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `almacen_transferencias_detalle`
--

INSERT INTO `almacen_transferencias_detalle` (`almacen_transferencias_detalle_id`, `almacen_transferencias_id`, `producto_ensamblado_id`, `producto_id`, `cantidad`, `faltante`) VALUES
(1, 1, 85, 0, 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
  `caja_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `fecha_cierre` datetime DEFAULT NULL,
  PRIMARY KEY (`caja_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja_det`
--

CREATE TABLE IF NOT EXISTS `caja_det` (
  `cajadet_id` int(11) NOT NULL,
  `caja_id` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `detalle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria`) VALUES
(1, 'Cerveza'),
(2, 'Gaseosa'),
(3, 'Agua'),
(4, 'Envase'),
(5, 'XCaja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8mb4_spanish_ci NOT NULL,
  `empresa` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `zona_id` int(11) NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `nombres`, `apellidos`, `dni`, `empresa`, `ruc`, `direccion`, `zona_id`, `fecha_nac`, `fecha`, `activo`) VALUES
(1, 'Rosa', 'Alvarez Ibarra', '', '', '', 'Yucay', 1, '1990-05-05', '2015-02-04 14:10:48', 1),
(2, 'Eusebia', 'Raya Tocre', '', '', '', 'Chichubamba', 1, '1990-05-05', '2015-02-04 14:11:28', 1),
(3, 'Guido', 'Sanchez Airampo', '', '', '', '', 1, '1990-05-05', '2015-02-04 14:11:56', 1),
(4, 'Usuario', 'General', '12345678', 'empresa', '12345678912', 'Urubamba', 1, '1990-05-05', '2015-02-05 13:08:59', 1),
(5, 'Paul', 'Navarro', '12345678', '', '', 'Cusco', 1, '1990-05-05', '2015-02-06 10:35:21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `compra_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `almacen_id` int(11) NOT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci NOT NULL COMMENT '1 = En proceso..., 2 = Registrado,3 = Recibido, 4 = Rechazado',
  `proveedor_id` int(11) NOT NULL,
  `comprobtipo_id` int(11) NOT NULL COMMENT 'Tipo de comprobante',
  `serie` varchar(11) COLLATE utf8mb4_spanish_ci NOT NULL,
  `numero` varchar(11) COLLATE utf8mb4_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL COMMENT 'Fecha actual en la que se registra el documento.',
  `fecha_doc` date NOT NULL,
  `condic_pago` char(1) COLLATE utf8mb4_spanish_ci NOT NULL COMMENT 'Efectivo, Credito, Tarjeta',
  `impuesto1` float(11,0) NOT NULL,
  `impuesto2` float(11,0) NOT NULL,
  `impuesto3` float(11,0) NOT NULL,
  `impuesto4` float(11,0) NOT NULL,
  `valor_neto` float NOT NULL,
  `descuento` float NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY (`compra_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Comentario' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`compra_id`, `usuario_id`, `almacen_id`, `estado`, `proveedor_id`, `comprobtipo_id`, `serie`, `numero`, `fecha`, `fecha_doc`, `condic_pago`, `impuesto1`, `impuesto2`, `impuesto3`, `impuesto4`, `valor_neto`, `descuento`, `total`) VALUES
(1, NULL, 1, '2', 1, 0, '', '', '0000-00-00 00:00:00', '2015-02-07', '1', 1080, 0, 0, 0, 6000, 0, 7080);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_det`
--

CREATE TABLE IF NOT EXISTS `compra_det` (
  `compra_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `compra_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `monto` float NOT NULL,
  PRIMARY KEY (`compra_det_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `compra_det`
--

INSERT INTO `compra_det` (`compra_det_id`, `compra_id`, `producto_id`, `cantidad`, `monto`) VALUES
(1, 1, 85, 100, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE IF NOT EXISTS `comprobante` (
  `comprobante_id` int(11) NOT NULL AUTO_INCREMENT,
  `comprobante_tipo_id` int(11) NOT NULL,
  `serie` varchar(5) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ultimo_numero` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`comprobante_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Mantiene un registro de los documentos a emitir' AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`comprobante_id`, `comprobante_tipo_id`, `serie`, `ultimo_numero`, `activo`) VALUES
(1, 1, '0001', 9, 1),
(2, 1, '0002', 3, 1),
(3, 1, '0003', 2, 1),
(4, 1, '0004', 2, 1),
(5, 2, '0001', 54453, 1),
(6, 2, '0002', 64351, 1),
(7, 2, '0003', 44651, 1),
(8, 2, '0004', 45501, 1),
(9, 4, '0001', 73, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_det`
--

CREATE TABLE IF NOT EXISTS `comprobante_det` (
  `comprobante_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `comprobante_id` int(11) NOT NULL,
  `ventas_id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `monto` float NOT NULL,
  `anulado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comprobante_det_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `comprobante_det`
--

INSERT INTO `comprobante_det` (`comprobante_det_id`, `comprobante_id`, `ventas_id`, `numero`, `monto`, `anulado`) VALUES
(1, 9, 1, 73, 141.6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_tipo`
--

CREATE TABLE IF NOT EXISTS `comprobante_tipo` (
  `comprobante_tipo_id` int(11) NOT NULL AUTO_INCREMENT,
  `comprobante_tipo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `comprobante_tipo_abrev` varchar(3) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`comprobante_tipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `comprobante_tipo`
--

INSERT INTO `comprobante_tipo` (`comprobante_tipo_id`, `comprobante_tipo`, `comprobante_tipo_abrev`) VALUES
(1, 'Factura', 'F'),
(2, 'Boleta', 'B'),
(3, 'Guia de Remision', 'GR'),
(4, 'Ticket', 'Tkt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctacorriente_cliente`
--

CREATE TABLE IF NOT EXISTS `ctacorriente_cliente` (
  `ctacorriente_cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `cliente_id` int(11) NOT NULL,
  `ventas_id` int(11) NOT NULL,
  `pago_id` int(11) DEFAULT '0',
  `monto` float DEFAULT NULL,
  `anulado` bit(1) DEFAULT b'0',
  PRIMARY KEY (`ctacorriente_cliente_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ctacorriente_cliente`
--

INSERT INTO `ctacorriente_cliente` (`ctacorriente_cliente_id`, `fecha`, `cliente_id`, `ventas_id`, `pago_id`, `monto`, `anulado`) VALUES
(1, '2015-02-07 23:40:47', 1, 1, 0, -141.6, b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctacorriente_cliente_env`
--

CREATE TABLE IF NOT EXISTS `ctacorriente_cliente_env` (
  `ctacorriente_cliente_env_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctacorriente_cliente_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`ctacorriente_cliente_env_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ctacorriente_cliente_env`
--

INSERT INTO `ctacorriente_cliente_env` (`ctacorriente_cliente_env_id`, `ctacorriente_cliente_id`, `producto_id`, `cantidad`) VALUES
(1, 1, 40, 0),
(2, 1, 43, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctacorriente_vendedor`
--

CREATE TABLE IF NOT EXISTS `ctacorriente_vendedor` (
  `ctacorriente_vendedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `transferencia_id` int(11) NOT NULL,
  `pago_id` int(11) DEFAULT '0',
  `monto` float DEFAULT NULL,
  `anulado` bit(1) DEFAULT b'0',
  PRIMARY KEY (`ctacorriente_vendedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ctacorriente_vendedor_env`
--

CREATE TABLE IF NOT EXISTS `ctacorriente_vendedor_env` (
  `ctacorriente_vendedor_env_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctacorriente_vendedor_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`ctacorriente_vendedor_env_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `empresa_id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `propiedtario` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `ciudad` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`empresa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `empresa`, `propiedtario`, `ruc`, `direccion`, `ciudad`, `pais`) VALUES
(1, 'INVERVALLE EIRL.', 'NapoleÃ³n Taco Quispe', '20490379291', 'Av. Cabo Conchatupa s/n. ', 'Urubamba - Cusco', 'PerÃº');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envase`
--

CREATE TABLE IF NOT EXISTS `envase` (
  `envase_id` int(11) NOT NULL,
  `unidad_id` int(11) DEFAULT NULL,
  `envase` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`envase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `envase`
--

INSERT INTO `envase` (`envase_id`, `unidad_id`, `envase`) VALUES
(1, 4, 'Cerveza Lt. 100'),
(2, 4, 'Cerveza 620'),
(3, 4, 'Cerveza 330'),
(4, 2, 'CPB Litro 100'),
(5, 2, 'CPB  620'),
(6, 2, 'CPB 330');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imp`
--

CREATE TABLE IF NOT EXISTS `imp` (
  `imp_id` int(11) NOT NULL AUTO_INCREMENT,
  `imp_tipo_id` int(11) DEFAULT NULL,
  `impuesto` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `valor` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'Es el porcentaje, del impuesto.',
  PRIMARY KEY (`imp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `imp`
--

INSERT INTO `imp` (`imp_id`, `imp_tipo_id`, `impuesto`, `valor`) VALUES
(1, 1, 'IGV', '0.18'),
(2, 2, 'IGV', '0.18'),
(3, 2, 'ISC', '0.02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imp_tipo`
--

CREATE TABLE IF NOT EXISTS `imp_tipo` (
  `imp_tipo_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'El tipo de Impuesto',
  `descripcion` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`imp_tipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `imp_tipo`
--

INSERT INTO `imp_tipo` (`imp_tipo_id`, `descripcion`) VALUES
(1, 'Cerveza'),
(2, 'Bebidas Alcoholicas'),
(3, 'Gaseosas'),
(4, 'Envases');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE IF NOT EXISTS `moneda` (
  `moneda_id` int(11) NOT NULL AUTO_INCREMENT,
  `moneda` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `abrev` varchar(3) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'Abreviatura',
  `prefijo` varchar(3) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`moneda_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`moneda_id`, `moneda`, `abrev`, `prefijo`) VALUES
(1, 'Nuevo Sol', 'PEN', 'S/.'),
(2, 'Dolar', 'USD', '$ ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_cliente`
--

CREATE TABLE IF NOT EXISTS `pago_cliente` (
  `pago_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `anulado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`pago_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `pago_cliente`
--

INSERT INTO `pago_cliente` (`pago_id`, `fecha`, `cliente_id`, `monto`, `anulado`) VALUES
(1, '2015-01-25 00:00:00', 2, 10.65, b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_cliente_det`
--

CREATE TABLE IF NOT EXISTS `pago_cliente_det` (
  `pago_cliente_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `pago_cliente_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`pago_cliente_det_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `envase_id_bot` int(11) NOT NULL,
  `envase_id_cj` int(11) NOT NULL,
  `unidad_id` int(11) DEFAULT NULL,
  `moneda_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imp_tipo_id` int(11) DEFAULT '3',
  `producto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `factor` int(11) DEFAULT NULL COMMENT 'Es el númeo de botellas por pack',
  `activo` tinyint(1) DEFAULT NULL COMMENT '1 = Activo, 0 = Inactivo',
  `num_serie` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `notas` text COLLATE utf8mb4_spanish_ci,
  PRIMARY KEY (`producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=48 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `envase_id_bot`, `envase_id_cj`, `unidad_id`, `moneda_id`, `categoria_id`, `imp_tipo_id`, `producto`, `factor`, `activo`, `num_serie`, `precio`, `imagen`, `notas`) VALUES
(1, 1, 4, 1, 1, 1, 1, 'Pilsen L100', 12, 1, '', 6.5, 'images/productos/', '0'),
(2, 2, 5, 1, 1, 1, 1, 'Pilsen 630', 12, 1, '', 4.5, 'images/productos/', '0'),
(3, 3, 6, 1, 1, 1, 1, 'Pilsen 310', 24, 1, '', 3.5, 'images/productos/', '0'),
(4, 0, 0, 1, 1, 1, 1, 'Pilsen NR', 24, 1, '', 3.5, 'images/productos/', '0'),
(5, 0, 0, 1, 1, 1, 1, 'Pilsen Lata', 6, 1, '', 3.5, 'images/productos/', '0'),
(6, 2, 5, 1, 1, 1, 1, 'Bckus Ice', 12, 1, '', 5, 'images/productos/', '0'),
(7, 1, 4, 1, 1, 1, 1, 'Cusquena Litro', 12, 1, '', 7, 'images/productos/', '0'),
(8, 2, 5, 1, 1, 1, 1, 'Cusquena 620', 12, 1, '', 5, 'images/productos/', '0'),
(9, 3, 6, 1, 1, 1, 1, 'Cusquena 330', 24, 1, '', 3.8, 'images/productos/', '0'),
(10, 2, 5, 1, 1, 1, 1, 'Malta 620', 12, 1, '', 5, 'images/productos/', '0'),
(11, 3, 6, 1, 1, 1, 1, 'Malta 330', 24, 1, '', 4, 'images/productos/', '0'),
(12, 0, 0, 1, 1, 1, 1, 'Cusquena BNR', 24, 1, '', 4, 'images/productos/', '0'),
(13, 0, 0, 1, 1, 1, 1, 'Cusquena MNR', 24, 1, '', 4, 'images/productos/', '0'),
(14, 0, 0, 1, 1, 1, 1, 'Cusquena Lata', 6, 1, '', 4, 'images/productos/', '0'),
(15, 3, 6, 1, 1, 1, 1, 'Cusquena RL', 12, 1, '', 5, 'images/productos/', '0'),
(16, 3, 6, 1, 1, 1, 1, 'Cusquena Trigo', 12, 1, '', 5, 'images/productos/', '0'),
(17, 0, 0, 1, 1, 2, 3, 'Guarana', 6, 1, '', 3, 'images/productos/', '0'),
(18, 0, 0, 1, 1, 2, 3, 'Guarana Lata', 6, 1, '', 2.5, 'images/productos/', '0'),
(19, 0, 0, 1, 1, 2, 3, 'Maltin Lata', 12, 1, '', 2.5, 'images/productos/', '0'),
(20, 0, 0, 1, 1, 2, 3, 'Maltin Litro', 6, 1, '', 4.5, 'images/productos/', '0'),
(21, 0, 0, 1, 1, 2, 3, 'Maltin 330', 12, 1, '', 2, 'images/productos/', '0'),
(22, 0, 0, 1, 1, 2, 3, 'San Mateo', 15, 1, '', 1, 'images/productos/', '0'),
(23, 0, 0, 1, 1, 2, 3, 'Coca Cola 2.25', 6, 1, '', 6, 'images/productos/', '0'),
(24, 0, 0, 1, 1, 2, 3, 'Fanta 2.25', 6, 1, '', 6, 'images/productos/', '0'),
(25, 0, 0, 1, 1, 2, 3, 'Inka Kola 2.25', 6, 1, '', 6, 'images/productos/', '0'),
(26, 0, 0, 1, 1, 2, 3, 'Sprite 2.25', 6, 1, '', 5, 'images/productos/', '0'),
(27, 0, 0, 1, 1, 2, 3, 'Coca Cola 1.5', 12, 1, '', 4, 'images/productos/', '0'),
(28, 0, 0, 1, 1, 2, 3, 'Coca Cola Litro', 12, 1, '', 3, 'images/productos/', '0'),
(29, 0, 0, 1, 1, 2, 3, 'Inka Kola Litro', 12, 1, '', 3, 'images/productos/', '0'),
(30, 0, 0, 1, 1, 2, 3, 'Coca Cola 625', 12, 1, '', 3, 'images/productos/', '0'),
(31, 0, 0, 1, 1, 2, 3, 'Coca Cola 500', 12, 1, '', 2, 'images/productos/', '0'),
(32, 0, 0, 1, 1, 2, 3, 'Fanta 500', 12, 1, '', 2, 'images/productos/', '0'),
(33, 0, 0, 1, 1, 2, 3, 'Inka Kola 500', 12, 1, '', 2, 'images/productos/', '0'),
(34, 0, 0, 1, 1, 2, 3, 'Sprite 500', 12, 1, '', 2, 'images/productos/', '0'),
(35, 0, 0, 1, 1, 2, 3, 'Coca Cola Personal', 24, 1, '', 1, 'images/productos/', '0'),
(36, 0, 0, 1, 1, 2, 3, 'Inka Kola Personal', 24, 1, '', 1, 'images/productos/', '0'),
(37, 0, 0, 1, 1, 2, 3, 'Fanta Personal', 24, 1, '', 1, 'images/productos/', '0'),
(38, 0, 0, 1, 1, 2, 3, 'Sprite Personal', 24, 1, '', 1, 'images/productos/', '0'),
(39, 0, 0, 1, 1, 2, 3, 'Coca Cola Zero', 12, 1, '', 5, 'images/productos/', '0'),
(40, 0, 0, 1, 1, 4, 4, 'Botella Litro 100', 12, 1, '', 1, 'images/productos/', '0'),
(41, 0, 0, 1, 1, 4, 4, 'Botella 620', 12, 1, '', 1, 'images/productos/', '0'),
(42, 0, 0, 1, 1, 4, 4, 'Botella 310', 24, 1, '', 1, 'images/productos/', '0'),
(43, 0, 0, 2, 1, 4, 4, 'CPB Litro 100', 1, 1, '', 5, 'images/productos/', '0'),
(44, 0, 0, 2, 1, 4, 4, 'CPB 620 ml', 1, 1, '', 5, 'images/productos/', '0'),
(45, 0, 0, 2, 1, 4, 1, 'CPB 310ml', 1, 1, '', 5, 'cusquena_caja.jpg', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_ensamblado`
--

CREATE TABLE IF NOT EXISTS `producto_ensamblado` (
  `producto_ensamblado_id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_id` int(11) DEFAULT NULL,
  `moneda_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `imp_tipo_id` int(11) DEFAULT '3',
  `producto` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `factor` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL COMMENT '1 = Activo, 0 = Inactivo',
  `num_serie` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `notas` text COLLATE utf8mb4_spanish_ci,
  PRIMARY KEY (`producto_ensamblado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=136 ;

--
-- Volcado de datos para la tabla `producto_ensamblado`
--

INSERT INTO `producto_ensamblado` (`producto_ensamblado_id`, `unidad_id`, `moneda_id`, `categoria_id`, `imp_tipo_id`, `producto`, `factor`, `activo`, `num_serie`, `precio`, `imagen`, `notas`) VALUES
(46, 1, 1, 1, 1, 'Bt Pilsen L100', 1, 1, '', 6.5, 'images/productos/', '                            0                        '),
(47, 1, 1, 1, 1, 'Bt Pilsen 630', 1, 1, '', 4.5, 'images/productos/', '0'),
(48, 1, 1, 1, 1, 'Bt Pilsen 310', 1, 1, '', 3.5, 'images/productos/', '0'),
(49, 1, 1, 1, 1, 'Bt Pilsen NR', 1, 1, '', 3.5, 'images/productos/', '0'),
(50, 1, 1, 1, 1, 'Bt Pilsen Lata', 1, 1, '', 3.5, 'images/productos/', '0'),
(51, 1, 1, 1, 1, 'Bt Bckus Ice', 1, 1, '', 5, 'images/productos/', '0'),
(52, 1, 1, 1, 1, 'Bt Cusquena Litro', 1, 1, '', 7, 'images/productos/', '0'),
(53, 1, 1, 1, 1, 'Bt Cusquena 620', 1, 1, '', 5, 'images/productos/', '0'),
(54, 1, 1, 1, 1, 'Bt Cusquena 330', 1, 1, '', 3.8, 'images/productos/', '0'),
(55, 1, 1, 1, 1, 'Bt Malta 620', 1, 1, '', 5, 'images/productos/', '0'),
(56, 1, 1, 1, 1, 'Bt Malta 330', 1, 1, '', 4, 'images/productos/', '0'),
(57, 1, 1, 1, 1, 'Bt Cusquena BNR', 1, 1, '', 4, 'images/productos/', '0'),
(58, 1, 1, 1, 1, 'Bt Cusquena MNR', 1, 1, '', 4, 'images/productos/', '0'),
(59, 1, 1, 1, 1, 'Bt Cusquena Lata', 1, 1, '', 4, 'images/productos/', '0'),
(60, 1, 1, 1, 1, 'Bt Cusquena RL', 1, 1, '', 5, 'images/productos/', '0'),
(61, 1, 1, 1, 1, 'Bt Cusquena Trigo', 1, 1, '', 5, 'images/productos/', '0'),
(62, 1, 1, 2, 3, 'Bt Guarana', 1, 1, '', 3, 'images/productos/', '0'),
(63, 1, 1, 2, 3, 'Bt Guarana Lata', 1, 1, '', 2.5, 'images/productos/', '0'),
(64, 1, 1, 2, 3, 'Bt Maltin Lata', 1, 1, '', 2.5, 'images/productos/', '0'),
(65, 1, 1, 2, 3, 'Bt Maltin Litro', 1, 1, '', 4.5, 'images/productos/', '0'),
(66, 1, 1, 2, 3, 'Bt Maltin 330', 1, 1, '', 2, 'images/productos/', '0'),
(67, 1, 1, 3, 3, 'Bt San Mateo', 1, 1, '', 1, 'images/productos/', '0'),
(68, 1, 1, 2, 3, 'Bt Coca Cola 2.25', 1, 1, '', 6, 'images/productos/', '0'),
(69, 1, 1, 2, 3, 'Bt Fanta 2.25', 1, 1, '', 6, 'images/productos/', '0'),
(70, 1, 1, 2, 3, 'Bt Inka Kola 2.25', 1, 1, '', 6, 'images/productos/', '0'),
(71, 1, 1, 2, 3, 'Bt Sprite 2.25', 1, 1, '', 5, 'images/productos/', '0'),
(72, 1, 1, 2, 3, 'Bt Coca Cola 1.5', 1, 1, '', 4, 'images/productos/', '0'),
(73, 1, 1, 2, 3, 'Bt Coca Cola Litro', 1, 1, '', 3, 'images/productos/', '0'),
(74, 1, 1, 2, 3, 'Bt Inka Kola Litro', 1, 1, '', 3, 'images/productos/', '0'),
(75, 1, 1, 2, 3, 'Bt Coca Cola 625', 1, 1, '', 3, 'images/productos/', '0'),
(76, 1, 1, 2, 3, 'Bt Coca Cola 500', 1, 1, '', 2, 'images/productos/', '0'),
(77, 1, 1, 2, 3, 'Bt Fanta 500', 1, 1, '', 2, 'images/productos/', '0'),
(78, 1, 1, 2, 3, 'Bt Inka Kola 500', 1, 1, '', 2, 'images/productos/', '0'),
(79, 1, 1, 2, 3, 'Bt Sprite 500', 1, 1, '', 2, 'images/productos/', '0'),
(80, 1, 1, 2, 3, 'Bt Coca Cola Personal', 1, 1, '', 1, 'images/productos/', '0'),
(81, 1, 1, 2, 3, 'Bt Inka Kola Personal', 1, 1, '', 1, 'images/productos/', '0'),
(82, 1, 1, 2, 3, 'Bt Fanta Personal', 1, 1, '', 1, 'images/productos/', '0'),
(83, 1, 1, 2, 3, 'Bt Sprite Personal', 1, 1, '', 1, 'images/productos/', '0'),
(84, 1, 1, 2, 3, 'Bt Coca Cola Zero', 1, 1, '', 5, 'images/productos/', '0'),
(85, 2, 1, 5, 1, 'Cj Pilsen L100', 12, 1, '', 60, 'images/productos/', '0'),
(86, 2, 1, 5, 1, 'Cj Pilsen 630', 12, 1, '', 4.5, 'images/productos/', '0'),
(87, 2, 1, 5, 1, 'Cj Pilsen 310', 24, 1, '', 3.5, 'images/productos/', '0'),
(88, 2, 1, 5, 1, 'Cj Pilsen NR', 24, 1, '', 3.5, 'images/productos/', '0'),
(89, 2, 1, 5, 1, 'Cj Pilsen Lata', 6, 1, '', 3.5, 'images/productos/', '0'),
(90, 2, 1, 5, 1, 'Cj Bckus Ice', 12, 1, '', 5, 'images/productos/', '0'),
(91, 2, 1, 5, 1, 'Cj Cusquena Litro', 12, 1, '', 7, 'images/productos/', '0'),
(92, 2, 1, 5, 1, 'Cj Cusquena 620', 12, 1, '', 5, 'images/productos/', '0'),
(93, 2, 1, 5, 1, 'Cj Cusquena 330', 24, 1, '', 3.8, 'images/productos/', '0'),
(94, 2, 1, 5, 1, 'Cj Malta 620', 12, 1, '', 5, 'images/productos/', '0'),
(95, 2, 1, 5, 1, 'Cj Malta 330', 24, 1, '', 4, 'images/productos/', '0'),
(96, 2, 1, 5, 1, 'Cj Cusquena BNR', 24, 1, '', 4, 'images/productos/', '0'),
(97, 2, 1, 5, 1, 'Cj Cusquena MNR', 24, 1, '', 4, 'images/productos/', '0'),
(98, 2, 1, 5, 1, 'Cj Cusquena Lata', 6, 1, '', 4, 'images/productos/', '0'),
(99, 2, 1, 5, 1, 'Cj Cusquena RL', 12, 1, '', 5, 'images/productos/', '0'),
(100, 2, 1, 5, 1, 'Cj Cusquena Trigo', 12, 1, '', 5, 'images/productos/', '0'),
(101, 2, 1, 5, 3, 'Cj Guarana', 6, 1, '', 3, 'images/productos/', '0'),
(102, 2, 1, 5, 3, 'Cj Guarana Lata', 6, 1, '', 2.5, 'images/productos/', '0'),
(103, 2, 1, 5, 3, 'Cj Maltin Lata', 12, 1, '', 2.5, 'images/productos/', '0'),
(104, 2, 1, 5, 3, 'Cj Maltin Litro', 6, 1, '', 4.5, 'images/productos/', '0'),
(105, 2, 1, 5, 3, 'Cj Maltin 330', 12, 1, '', 2, 'images/productos/', '0'),
(106, 2, 1, 5, 3, 'Cj San Mateo', 15, 1, '', 1, 'images/productos/', '0'),
(107, 2, 1, 5, 3, 'Cj Coca Cola 2.25', 6, 1, '', 6, 'images/productos/', '0'),
(108, 2, 1, 5, 3, 'Cj Fanta 2.25', 6, 1, '', 6, 'images/productos/', '0'),
(109, 2, 1, 5, 3, 'Cj Inka Kola 2.25', 6, 1, '', 6, 'images/productos/', '0'),
(110, 2, 1, 5, 3, 'Cj Sprite 2.25', 6, 1, '', 5, 'images/productos/', '0'),
(111, 2, 1, 5, 3, 'Cj Coca Cola 1.5', 12, 1, '', 4, 'images/productos/', '0'),
(112, 2, 1, 5, 3, 'Cj Coca Cola Litro', 12, 1, '', 3, 'images/productos/', '0'),
(113, 2, 1, 5, 3, 'Cj Inka Kola Litro', 12, 1, '', 3, 'images/productos/', '0'),
(114, 2, 1, 5, 3, 'Cj Coca Cola 625', 12, 1, '', 3, 'images/productos/', '0'),
(115, 2, 1, 5, 3, 'Cj Coca Cola 500', 12, 1, '', 2, 'images/productos/', '0'),
(116, 2, 1, 5, 3, 'Cj Fanta 500', 12, 1, '', 2, 'images/productos/', '0'),
(117, 2, 1, 5, 3, 'Cj Inka Kola 500', 12, 1, '', 2, 'images/productos/', '0'),
(118, 2, 1, 5, 3, 'Cj Sprite 500', 12, 1, '', 2, 'images/productos/', '0'),
(119, 2, 1, 5, 3, 'Cj Coca Cola Personal', 24, 1, '', 1, 'images/productos/', '0'),
(120, 2, 1, 5, 3, 'Cj Inka Kola Personal', 24, 1, '', 1, 'images/productos/', '0'),
(121, 2, 1, 5, 3, 'Cj Fanta Personal', 24, 1, '', 1, 'images/productos/', '0'),
(122, 2, 1, 5, 3, 'Cj Sprite Personal', 24, 1, '', 1, 'images/productos/', '0'),
(123, 2, 1, 5, 3, 'Cj Coca Cola Zero', 12, 1, '', 5, 'images/productos/', '0'),
(124, 1, 1, 4, 4, 'Botella Litro 100', 12, 1, '', 1, 'images/productos/', '0'),
(125, 1, 1, 4, 4, 'Botella 620', 12, 1, '', 1, 'images/productos/', '0'),
(126, 1, 1, 4, 4, 'Botella 310', 24, 1, '', 1, 'images/productos/', '0'),
(127, 1, 1, 4, 4, 'CPB Litro 100', 1, 1, '', 5, 'images/productos/', '0'),
(128, 1, 1, 4, 4, 'CPB 620 ml', 1, 1, '', 5, 'images/productos/', '0'),
(129, 1, 1, 4, 4, 'CPB 310ml', 1, 1, '', 5, 'images/productos/', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_ensamblado_det`
--

CREATE TABLE IF NOT EXISTS `producto_ensamblado_det` (
  `producto_kit_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_ensamblado_id` int(11) NOT NULL COMMENT 'Identifica al Producto KIT',
  `producto_id` int(11) NOT NULL COMMENT 'Indentifica al producto componente del Kit',
  `cantidad` int(11) NOT NULL COMMENT 'Cantidad de Componentes',
  `descripcion` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL COMMENT 'Descripcion Detallada',
  PRIMARY KEY (`producto_kit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=112 ;

--
-- Volcado de datos para la tabla `producto_ensamblado_det`
--

INSERT INTO `producto_ensamblado_det` (`producto_kit_id`, `producto_ensamblado_id`, `producto_id`, `cantidad`, `descripcion`) VALUES
(1, 46, 1, 1, '0'),
(2, 46, 40, 1, '0'),
(3, 47, 2, 1, '0'),
(4, 47, 41, 1, '0'),
(5, 48, 3, 1, '0'),
(6, 48, 42, 1, '0'),
(7, 49, 4, 1, '0'),
(8, 50, 5, 1, '0'),
(9, 51, 6, 1, '0'),
(10, 52, 7, 1, '0'),
(11, 52, 40, 1, '0'),
(12, 53, 8, 1, '0'),
(13, 53, 41, 1, '0'),
(14, 54, 9, 1, '0'),
(15, 54, 42, 1, '0'),
(16, 55, 10, 1, '0'),
(17, 55, 41, 1, '0'),
(18, 56, 11, 1, '0'),
(19, 56, 42, 1, '0'),
(20, 57, 12, 1, '0'),
(21, 58, 13, 1, '0'),
(22, 59, 14, 1, '0'),
(23, 60, 15, 1, '0'),
(24, 61, 16, 1, '0'),
(25, 61, 41, 1, '0'),
(26, 62, 17, 1, '0'),
(27, 63, 18, 1, '0'),
(28, 64, 19, 1, '0'),
(29, 65, 20, 1, '0'),
(30, 66, 21, 1, '0'),
(31, 67, 22, 1, '0'),
(32, 68, 23, 1, '0'),
(33, 69, 24, 1, '0'),
(34, 70, 25, 1, '0'),
(35, 71, 26, 1, '0'),
(36, 72, 27, 1, '0'),
(37, 73, 28, 1, '0'),
(38, 74, 29, 1, '0'),
(39, 75, 30, 1, '0'),
(40, 76, 31, 1, '0'),
(41, 77, 32, 1, '0'),
(42, 78, 33, 1, '0'),
(43, 79, 34, 1, '0'),
(44, 80, 35, 1, '0'),
(45, 81, 36, 1, '0'),
(46, 82, 37, 1, '0'),
(47, 83, 38, 1, '0'),
(48, 84, 39, 1, '0'),
(49, 85, 1, 12, '0'),
(50, 85, 40, 12, '0'),
(51, 85, 43, 1, '0'),
(52, 86, 2, 12, '0'),
(53, 86, 41, 12, '0'),
(54, 86, 44, 1, '0'),
(55, 87, 3, 24, '0'),
(56, 87, 42, 24, '0'),
(57, 87, 45, 1, '0'),
(58, 88, 4, 24, '0'),
(59, 89, 5, 6, '0'),
(60, 90, 6, 12, '0'),
(61, 91, 7, 12, '0'),
(62, 91, 40, 12, '0'),
(63, 91, 43, 1, '0'),
(64, 92, 8, 12, '0'),
(65, 92, 41, 12, '0'),
(66, 92, 44, 1, '0'),
(67, 93, 9, 24, '0'),
(68, 93, 42, 24, '0'),
(69, 93, 45, 1, '0'),
(70, 94, 10, 12, '0'),
(71, 94, 41, 12, '0'),
(72, 94, 44, 1, '0'),
(73, 95, 11, 24, '0'),
(74, 95, 42, 24, '0'),
(75, 95, 45, 1, '0'),
(76, 96, 12, 24, '0'),
(77, 97, 13, 24, '0'),
(78, 98, 14, 6, '0'),
(79, 99, 15, 12, '0'),
(80, 100, 16, 12, '0'),
(81, 100, 41, 12, '0'),
(82, 100, 44, 1, '0'),
(83, 101, 17, 6, '0'),
(84, 102, 18, 6, '0'),
(85, 103, 19, 12, '0'),
(86, 104, 20, 6, '0'),
(87, 105, 21, 12, '0'),
(88, 106, 22, 15, '0'),
(89, 107, 23, 6, '0'),
(90, 108, 24, 6, '0'),
(91, 109, 25, 6, '0'),
(92, 110, 26, 6, '0'),
(93, 111, 27, 12, '0'),
(94, 112, 28, 12, '0'),
(95, 113, 29, 12, '0'),
(96, 114, 30, 12, '0'),
(97, 115, 31, 12, '0'),
(98, 116, 32, 12, '0'),
(99, 117, 33, 12, '0'),
(100, 118, 34, 12, '0'),
(101, 119, 35, 24, '0'),
(102, 120, 36, 24, '0'),
(103, 121, 37, 24, '0'),
(104, 122, 38, 24, '0'),
(105, 123, 39, 12, '0'),
(106, 124, 40, 1, '0'),
(107, 125, 41, 1, '0'),
(108, 126, 42, 1, '0'),
(109, 127, 43, 1, '0'),
(110, 128, 44, 1, '0'),
(111, 129, 45, 1, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `proveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `contacto` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono1` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono2` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `logo` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`proveedor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`proveedor_id`, `proveedor`, `activo`, `contacto`, `direccion`, `telefono1`, `telefono2`, `email`, `logo`, `fecha_registro`, `ruc`) VALUES
(1, 'Backus', 1, 'Junior Suarez Gomez', 'Cusco', '984 123456', '984 123456', 'admin@admin.com', '', '2015-01-15 13:43:05', NULL),
(2, 'ANDINO SA', 1, NULL, 'Cusco', NULL, NULL, NULL, NULL, '2015-01-19 00:00:00', '20202020220'),
(3, 'ANDINO SA', 1, NULL, 'Cusco', NULL, NULL, NULL, NULL, '2015-01-19 00:00:00', '20202020220');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE IF NOT EXISTS `unidad` (
  `unidad_id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `abrev` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'Abreviaruta',
  PRIMARY KEY (`unidad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`unidad_id`, `unidad`, `abrev`) VALUES
(1, 'Unidad', 'Und'),
(2, 'Caja', 'Cj'),
(3, 'Pack ', 'PK12'),
(4, 'Botella', 'Bot');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `activo` bit(1) DEFAULT NULL,
  `clave` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombres` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `apellidos` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nivel` char(1) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT '1: administrador(admin), 2:usuario(user)',
  `direccion` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono1` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono2` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `sexo` char(1) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_registro` datetime NOT NULL,
  `ultimo_acceso` datetime NOT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario`, `activo`, `clave`, `nombres`, `apellidos`, `nivel`, `direccion`, `telefono1`, `telefono2`, `email`, `fecha_nac`, `sexo`, `foto`, `fecha_registro`, `ultimo_acceso`) VALUES
(1, 'admin', b'1', 'admin', 'Elvis', 'Rodriguez', '1', 'Cusco', '984 123456', '984 123456', 'admin@admin.com', '1990-05-15', 'M', '', '0000-00-00 00:00:00', '2015-02-07 09:02:53'),
(2, 'napoleon', b'1', '0000', 'Napoleon ', 'apellidos', '1', '', '', '', 'user@user.com', '1990-01-12', 'M', NULL, '2014-11-29 00:00:00', '2015-11-30 00:00:00'),
(8, 'paul', b'1', '0000', 'Paul', 'apellidos', '1', '', 'telefono1', 'telefono2', 'usuario@gmail.com', '2015-01-13', 'M', NULL, '2015-01-13 03:31:12', '0000-00-00 00:00:00'),
(11, 'victor', b'1', '4018', 'Victor Manuel', 'Taco Choque', '2', 'Urubamba', 'telefono1', 'telefono2', 'admin@gmail.com', '2015-01-15', 'M', NULL, '2015-01-15 01:29:19', '0000-00-00 00:00:00'),
(15, 'pilar', b'0', 'password', 'Pilar', ' HuamÃ¡n Lucana', '2', 'direccion', 'telefono1', 'telefono2', 'admin@gmail.com', '2015-01-19', 'M', NULL, '2015-01-19 10:57:01', '0000-00-00 00:00:00'),
(16, 'marisol', b'1', 'password', 'Marisol', 'Orellana ', '2', 'Urubamba', 'telefono1', 'telefono2', 'admin@gmail.com', '2015-01-19', 'F', NULL, '2015-01-19 10:57:01', '2015-01-21 23:01:41'),
(17, 'pilar', b'0', 'password', 'Pilar', ' HuamÃ¡n Lucana', '2', 'direccion', 'telefono1', 'telefono2', 'admin@gmail.com', '2015-01-19', 'M', NULL, '2015-01-19 10:57:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `ventas_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `moneda_id` int(11) NOT NULL DEFAULT '1',
  `almacen_id` int(11) NOT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci NOT NULL COMMENT 'Ingresado, Rechazado, Aprobado, En espera',
  `condicion_pago` char(1) COLLATE utf8mb4_spanish_ci NOT NULL COMMENT 'Al Contado Credito',
  `descuento` int(11) NOT NULL,
  `impuesto1` float(11,0) NOT NULL,
  `impuesto2` float(11,0) NOT NULL,
  `fechapago` date NOT NULL,
  `impuesto3` float(11,0) NOT NULL,
  `impuesto4` float(11,0) NOT NULL,
  `valor_neto` float(11,0) NOT NULL,
  `total` float(11,0) NOT NULL,
  `nota` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `envases` bit(1) NOT NULL COMMENT 'Pregunta si lleva o no envases (botella, etc)',
  PRIMARY KEY (`ventas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ventas_id`, `usuario_id`, `cliente_id`, `fecha`, `moneda_id`, `almacen_id`, `estado`, `condicion_pago`, `descuento`, `impuesto1`, `impuesto2`, `fechapago`, `impuesto3`, `impuesto4`, `valor_neto`, `total`, `nota`, `envases`) VALUES
(1, 1, 1, '2015-02-07 23:40:47', 1, 2, '2', '9', 0, 22, 0, '0000-00-00', 0, 0, 120, 142, '', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_det`
--

CREATE TABLE IF NOT EXISTS `ventas_det` (
  `ventas_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `ventas_id` int(11) DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`ventas_det_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ventas_det`
--

INSERT INTO `ventas_det` (`ventas_det_id`, `ventas_id`, `producto_id`, `cantidad`, `precio`) VALUES
(1, 1, 85, 2, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_env`
--

CREATE TABLE IF NOT EXISTS `ventas_env` (
  `ventas_env_id` int(11) NOT NULL AUTO_INCREMENT,
  `ventas_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL COMMENT 'id de prodcutos',
  `lleva` int(11) DEFAULT NULL,
  `devuelve` int(11) DEFAULT NULL,
  PRIMARY KEY (`ventas_env_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ventas_env`
--

INSERT INTO `ventas_env` (`ventas_env_id`, `ventas_id`, `producto_id`, `lleva`, `devuelve`) VALUES
(1, 1, 40, 24, 24),
(2, 1, 43, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE IF NOT EXISTS `zona` (
  `zona_id` int(11) NOT NULL AUTO_INCREMENT,
  `zona` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`zona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`zona_id`, `zona`) VALUES
(1, 'Urubamba'),
(2, 'Ollantaytambo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
