-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-09-2024 a las 04:40:07
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
  `CantidadAbasto` int(11) NOT NULL,
  `FechaAbasto` date NOT NULL,
  `Notas` varchar(100) DEFAULT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdAbasto`),
  KEY `IdProducto` (`IdProducto`),
  KEY `IdProveedor` (`IdProveedor`),
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `abasto`:
--   `IdProducto`
--       `producto` -> `IdProducto`
--   `IdProveedor`
--       `proveedor` -> `IdProveedor`
--   `IdUsuario`
--       `usuario` -> `IdUsuario`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cjuridico`:
--   `IdCliente`
--       `cliente` -> `IdCliente`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cliente`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cnatural`
--

CREATE TABLE IF NOT EXISTS `cnatural` (
  `IdNatural` int(11) NOT NULL AUTO_INCREMENT,
  `NombreCliente` varchar(100) NOT NULL,
  `Genero` tinyint(1) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdNatural`),
  KEY `IdCliente` (`IdCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cnatural`:
--   `IdCliente`
--       `cliente` -> `IdCliente`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `IdDetallePedido` int(11) NOT NULL AUTO_INCREMENT,
  `IdPedido` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdDetallePedido`),
  KEY `IdPedido` (`IdPedido`),
  KEY `IdProducto` (`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `detalle_pedido`:
--   `IdPedido`
--       `pedido` -> `IdPedido`
--   `IdProducto`
--       `producto` -> `IdProducto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `IdPago` int(11) NOT NULL AUTO_INCREMENT,
  `IdPedido` int(11) NOT NULL,
  `IdTipoPago` int(11) NOT NULL,
  `MontoPago` decimal(10,2) NOT NULL,
  `FechaPago` date NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdPago`),
  KEY `IdPedido` (`IdPedido`),
  KEY `IdTipoPago` (`IdTipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `pago`:
--   `IdPedido`
--       `pedido` -> `IdPedido`
--   `IdTipoPago`
--       `tipo_pago` -> `IdTipoPago`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `IdPedido` int(11) NOT NULL AUTO_INCREMENT,
  `FechaPedido` date NOT NULL,
  `EstadoPedido` tinyint(1) NOT NULL DEFAULT 0,
  `IdUsuario` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdPuesto` int(11) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdPedido`),
  KEY `IdUsuario` (`IdUsuario`),
  KEY `IdCliente` (`IdCliente`),
  KEY `IdPuesto` (`IdPuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `pedido`:
--   `IdUsuario`
--       `usuario` -> `IdUsuario`
--   `IdCliente`
--       `cliente` -> `IdCliente`
--   `IdPuesto`
--       `puesto` -> `IdPuesto`
--

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
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdProducto`),
  KEY `IdCategoria` (`IdCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `producto`:
--   `IdCategoria`
--       `categoria` -> `IdCategoria`
--

--
-- Volcado de datos para la tabla `producto`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `proveedor`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE IF NOT EXISTS `puesto` (
  `IdPuesto` int(11) NOT NULL AUTO_INCREMENT,
  `NumeroPuesto` int(11) NOT NULL,
  `UbicacionPuesto` varchar(255) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdPuesto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `puesto`:
--

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `IdTipoPago` int(11) NOT NULL AUTO_INCREMENT,
  `TipoPago` varchar(50) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdTipoPago`),
  UNIQUE KEY `TipoPago` (`TipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `tipo_pago`:
--

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
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdUsuario`),
  KEY `IdRolUsuario` (`IdRolUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `usuario`:
--   `IdRolUsuario`
--       `rol_usuario` -> `IdRolUsuario`
--

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abasto`
--
ALTER TABLE `abasto`
  ADD CONSTRAINT `abasto_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `abasto_ibfk_2` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`IdProveedor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `abasto_ibfk_3` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`IdPedido`) REFERENCES `pedido` (`IdPedido`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`IdPedido`) REFERENCES `pedido` (`IdPedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`IdTipoPago`) REFERENCES `tipo_pago` (`IdTipoPago`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`IdPuesto`) REFERENCES `puesto` (`IdPuesto`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdRolUsuario`) REFERENCES `rol_usuario` (`IdRolUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
