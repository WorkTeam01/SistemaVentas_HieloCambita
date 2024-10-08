-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-09-2024 a las 03:19:52
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
-- Base de datos: `bdhielocambita`
--
CREATE DATABASE IF NOT EXISTS `bdhielocambita` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bdhielocambita`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abasto`
--

CREATE TABLE IF NOT EXISTS `abasto` (
  `IdAbasto` int(11) NOT NULL AUTO_INCREMENT,
  `IdProducto` int(11) NOT NULL,
  `IdProveedor` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `IdPuesto` int(11) NOT NULL,
  `NroAbasto` int(11) NOT NULL,
  `ComprobanteAbasto` varchar(100) NOT NULL,
  `PrecioAbasto` decimal(10,2) NOT NULL,
  `CantidadAbasto` int(11) NOT NULL,
  `FechaAbasto` date NOT NULL,
  `Notas` varchar(100) DEFAULT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdAbasto`),
  KEY `IdProducto` (`IdProducto`),
  KEY `IdProveedor` (`IdProveedor`),
  KEY `IdUsuario` (`IdUsuario`),
  KEY `IdPuesto` (`IdPuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `abasto`:
--   `IdProducto`
--       `producto` -> `IdProducto`
--   `IdProveedor`
--       `proveedor` -> `IdProveedor`
--   `IdUsuario`
--       `usuario` -> `IdUsuario`
--   `IdPuesto`
--       `puesto` -> `IdPuesto`
--

--
-- Truncar tablas antes de insertar `abasto`
--

TRUNCATE TABLE `abasto`;
--
-- Volcado de datos para la tabla `abasto`
--

INSERT INTO `abasto` (`IdAbasto`, `IdProducto`, `IdProveedor`, `IdUsuario`, `IdPuesto`, `NroAbasto`, `ComprobanteAbasto`, `PrecioAbasto`, `CantidadAbasto`, `FechaAbasto`, `Notas`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 2, 1, 1, 1, 1, 'Factura', 80.00, 20, '2024-09-08', NULL, '2024-09-08 19:45:13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `IdCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCategoria` varchar(50) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `categoria`:
--

--
-- Truncar tablas antes de insertar `categoria`
--

TRUNCATE TABLE `categoria`;
--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `NombreCategoria`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 'Hielos', '2024-08-28 17:37:40', NULL),
(2, 'Bolsas', '2024-08-28 17:38:05', '2024-08-28 17:42:48'),
(3, 'Azúcar', '2024-08-29 12:45:49', NULL),
(4, 'Vasos', '2024-08-29 12:47:52', NULL),
(5, 'Plásticos', '2024-08-29 12:50:17', NULL),
(6, 'Aguas', '2024-08-29 12:51:37', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cjuridico`
--

CREATE TABLE IF NOT EXISTS `cjuridico` (
  `IdJuridico` int(11) NOT NULL AUTO_INCREMENT,
  `RazonSocial` varchar(50) NOT NULL,
  `RepresentanteLegal` varchar(50) NOT NULL,
  `EmailJuridico` varchar(50) DEFAULT NULL,
  `IdCliente` int(11) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdJuridico`),
  KEY `IdCliente` (`IdCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cjuridico`:
--   `IdCliente`
--       `cliente` -> `IdCliente`
--

--
-- Truncar tablas antes de insertar `cjuridico`
--

TRUNCATE TABLE `cjuridico`;
--
-- Volcado de datos para la tabla `cjuridico`
--

INSERT INTO `cjuridico` (`IdJuridico`, `RazonSocial`, `RepresentanteLegal`, `EmailJuridico`, `IdCliente`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 'Pilandina S.A.', 'John Smith', 'johnsmith@gmail.com', 2, '2024-09-04 11:20:09', NULL),
(2, 'Sofia S.A.', 'Mario Martinez', 'mariomartinez@gmail.com', 4, '2024-09-04 11:42:27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `IdCliente` int(11) NOT NULL AUTO_INCREMENT,
  `CelularCliente` varchar(20) NOT NULL,
  `DescuentoCliente` decimal(10,2) DEFAULT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cliente`:
--

--
-- Truncar tablas antes de insertar `cliente`
--

TRUNCATE TABLE `cliente`;
--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IdCliente`, `CelularCliente`, `DescuentoCliente`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, '78498446', 0.00, '2024-09-04 11:16:32', NULL),
(2, '78945621', 15.00, '2024-09-04 11:20:09', NULL),
(3, '78996522', 0.00, '2024-09-04 11:40:52', NULL),
(4, '79995530', 20.00, '2024-09-04 11:42:27', NULL),
(5, '78888850', 0.00, '2024-09-05 13:56:56', NULL),
(6, '73232558', 0.00, '2024-09-05 14:04:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cnatural`
--

CREATE TABLE IF NOT EXISTS `cnatural` (
  `IdNatural` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCliente` varchar(100) NOT NULL,
  `Genero` varchar(50) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdNatural`),
  KEY `IdCliente` (`IdCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cnatural`:
--   `IdCliente`
--       `cliente` -> `IdCliente`
--

--
-- Truncar tablas antes de insertar `cnatural`
--

TRUNCATE TABLE `cnatural`;
--
-- Volcado de datos para la tabla `cnatural`
--

INSERT INTO `cnatural` (`IdNatural`, `NombreCliente`, `Genero`, `IdCliente`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 'Jose', 'Masculino', 1, '2024-09-04 11:16:32', '2024-09-04 11:44:46'),
(2, 'Maria', 'Femenino', 3, '2024-09-04 11:40:52', NULL),
(3, 'Sofia', 'Femenino', 6, '2024-09-05 14:04:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `IdDetallePedido` int(11) NOT NULL AUTO_INCREMENT,
  `NroPedido` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdDetallePedido`),
  KEY `IdProducto` (`IdProducto`),
  KEY `NroPedido` (`NroPedido`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `detalle_pedido`:
--   `IdProducto`
--       `producto` -> `IdProducto`
--

--
-- Truncar tablas antes de insertar `detalle_pedido`
--

TRUNCATE TABLE `detalle_pedido`;
--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`IdDetallePedido`, `NroPedido`, `IdProducto`, `Cantidad`, `Precio`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 1, 2, 5, 6.00, '2024-09-08 20:17:50', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `IdPedido` int(11) NOT NULL AUTO_INCREMENT,
  `NroPedido` int(11) NOT NULL,
  `FechaPedido` date NOT NULL,
  `MontoPago` decimal(10,2) NOT NULL,
  `EstadoPedido` tinyint(1) NOT NULL DEFAULT 0,
  `IdTipoPago` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdPuesto` int(11) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdPedido`),
  KEY `IdUsuario` (`IdUsuario`),
  KEY `IdCliente` (`IdCliente`),
  KEY `NroPedido` (`NroPedido`),
  KEY `IdTipoPago` (`IdTipoPago`),
  KEY `IdPuesto` (`IdPuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `pedido`:
--   `IdUsuario`
--       `usuario` -> `IdUsuario`
--   `IdCliente`
--       `cliente` -> `IdCliente`
--   `NroPedido`
--       `detalle_pedido` -> `NroPedido`
--   `IdTipoPago`
--       `tipo_pago` -> `IdTipoPago`
--   `IdPuesto`
--       `puesto` -> `IdPuesto`
--

--
-- Truncar tablas antes de insertar `pedido`
--

TRUNCATE TABLE `pedido`;
--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`IdPedido`, `NroPedido`, `FechaPedido`, `MontoPago`, `EstadoPedido`, `IdTipoPago`, `IdUsuario`, `IdCliente`, `IdPuesto`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 1, '2024-09-08', 30.00, 1, 1, 1, 1, 1, '2024-09-08 20:18:40', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `IdProducto` int(11) NOT NULL AUTO_INCREMENT,
  `CodigoProducto` varchar(255) NOT NULL,
  `NombreProducto` varchar(50) NOT NULL,
  `DescripcionProducto` varchar(100) DEFAULT NULL,
  `Stock` int(11) NOT NULL,
  `StockMinimo` int(11) DEFAULT NULL,
  `StockMaximo` int(11) DEFAULT NULL,
  `PrecioCompra` decimal(10,2) NOT NULL,
  `PrecioVenta` decimal(10,2) NOT NULL,
  `ImagenProducto` text NOT NULL DEFAULT '\'producto_default.png\'',
  `FechaIngreso` date NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `IdPuesto` int(11) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdProducto`),
  KEY `IdCategoria` (`IdCategoria`),
  KEY `IdPuesto` (`IdPuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `producto`:
--   `IdCategoria`
--       `categoria` -> `IdCategoria`
--   `IdPuesto`
--       `puesto` -> `IdPuesto`
--

--
-- Truncar tablas antes de insertar `producto`
--

TRUNCATE TABLE `producto`;
--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `CodigoProducto`, `NombreProducto`, `DescripcionProducto`, `Stock`, `StockMinimo`, `StockMaximo`, `PrecioCompra`, `PrecioVenta`, `ImagenProducto`, `FechaIngreso`, `IdCategoria`, `IdPuesto`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(2, 'P-00001', 'Azúcar unagro', 'Azúcar unagro de 1 Kg', 15, 10, 40, 4.00, 6.00, '2024-09-08-02-25-55__AzucarUnagro.jpg', '2024-09-08', 3, 1, '2024-09-08 02:25:55', '2024-09-08 20:18:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `IdProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `NombreProveedor` varchar(255) NOT NULL,
  `EmailProveedor` varchar(100) DEFAULT NULL,
  `DireccionProveedor` varchar(100) NOT NULL,
  `CelularProveedor` varchar(20) NOT NULL,
  `TelefonoProveedor` varchar(20) DEFAULT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdProveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `proveedor`:
--

--
-- Truncar tablas antes de insertar `proveedor`
--

TRUNCATE TABLE `proveedor`;
--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`IdProveedor`, `NombreProveedor`, `EmailProveedor`, `DireccionProveedor`, `CelularProveedor`, `TelefonoProveedor`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 'Unagro', '', 'Pasaje durazno Nº 102, Barrio La Santa Cruz', '78978464', '3437777', '2024-09-01 13:17:03', '2024-09-01 17:20:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE IF NOT EXISTS `puesto` (
  `IdPuesto` int(11) NOT NULL AUTO_INCREMENT,
  `NombrePuesto` varchar(100) NOT NULL,
  `UbicacionPuesto` varchar(255) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdPuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `puesto`:
--

--
-- Truncar tablas antes de insertar `puesto`
--

TRUNCATE TABLE `puesto`;
--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`IdPuesto`, `NombrePuesto`, `UbicacionPuesto`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 'Puesto principal', 'Mercado Abasto', '2024-09-03 14:04:07', '2024-09-03 14:17:07'),
(2, 'Segundo puesto', 'Mercado abasto', '2024-09-08 02:13:42', NULL),
(3, 'Tercer puesto', 'Mercado abasto', '2024-09-08 02:14:05', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE IF NOT EXISTS `rol_usuario` (
  `IdRolUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `RolUsuario` varchar(50) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdRolUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `rol_usuario`:
--

--
-- Truncar tablas antes de insertar `rol_usuario`
--

TRUNCATE TABLE `rol_usuario`;
--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`IdRolUsuario`, `RolUsuario`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 'Administrador', '2024-08-27 16:46:04', NULL),
(2, 'Vendedor', '2024-08-27 16:46:04', NULL),
(3, 'Comprador', '2024-08-28 15:02:54', '2024-09-01 12:18:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `IdTipoPago` int(11) NOT NULL AUTO_INCREMENT,
  `TipoPago` varchar(50) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdTipoPago`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `tipo_pago`:
--

--
-- Truncar tablas antes de insertar `tipo_pago`
--

TRUNCATE TABLE `tipo_pago`;
--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`IdTipoPago`, `TipoPago`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 'Al contado', '2024-09-03 20:50:45', '2024-09-04 19:38:31'),
(2, 'QR', '2024-09-03 20:51:03', '2024-09-04 19:38:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(50) NOT NULL,
  `NombresUsuario` varchar(255) NOT NULL,
  `ApellidosUsuario` varchar(255) NOT NULL,
  `EmailUsuario` varchar(50) NOT NULL,
  `PasswordUsuario` text NOT NULL,
  `EstadoUsuario` tinyint(1) NOT NULL DEFAULT 1,
  `IdRolUsuario` int(11) NOT NULL,
  `IdPuesto` int(11) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdUsuario`),
  KEY `IdRolUsuario` (`IdRolUsuario`),
  KEY `IdPuesto` (`IdPuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `usuario`:
--   `IdRolUsuario`
--       `rol_usuario` -> `IdRolUsuario`
--   `IdPuesto`
--       `puesto` -> `IdPuesto`
--

--
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Usuario`, `NombresUsuario`, `ApellidosUsuario`, `EmailUsuario`, `PasswordUsuario`, `EstadoUsuario`, `IdRolUsuario`, `IdPuesto`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 'Admin', 'User', 'Administrador', 'usuario@gmail.com', '$2y$10$6./.duT5yvuKtU92mj1xE.CbxBlh8uWyo5qynA0GJ9Xro7pDrmcmG', 1, 1, 1, '2024-09-05 18:36:12', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abasto`
--
ALTER TABLE `abasto`
  ADD CONSTRAINT `abasto_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `abasto_ibfk_2` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`IdProveedor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `abasto_ibfk_3` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `abasto_ibfk_4` FOREIGN KEY (`IdPuesto`) REFERENCES `puesto` (`IdPuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cjuridico`
--
ALTER TABLE `cjuridico`
  ADD CONSTRAINT `cjuridico_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cnatural`
--
ALTER TABLE `cnatural`
  ADD CONSTRAINT `cnatural_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`NroPedido`) REFERENCES `detalle_pedido` (`NroPedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pedido_ibfk_5` FOREIGN KEY (`IdTipoPago`) REFERENCES `tipo_pago` (`IdTipoPago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pedido_ibfk_6` FOREIGN KEY (`IdPuesto`) REFERENCES `puesto` (`IdPuesto`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`IdPuesto`) REFERENCES `puesto` (`IdPuesto`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdRolUsuario`) REFERENCES `rol_usuario` (`IdRolUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`IdPuesto`) REFERENCES `puesto` (`IdPuesto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
