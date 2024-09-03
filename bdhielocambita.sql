-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2024 a las 23:48:54
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
  KEY `IdUsuario` (`IdUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `abasto`:
--   `IdProducto`
--       `producto` -> `IdProducto`
--   `IdProveedor`
--       `proveedor` -> `IdProveedor`
--   `IdUsuario`
--       `usuario` -> `IdUsuario`
--

--
-- Truncar tablas antes de insertar `abasto`
--

TRUNCATE TABLE `abasto`;
--
-- Volcado de datos para la tabla `abasto`
--

INSERT INTO `abasto` (`IdAbasto`, `IdProducto`, `IdProveedor`, `IdUsuario`, `NroAbasto`, `ComprobanteAbasto`, `PrecioAbasto`, `CantidadAbasto`, `FechaAbasto`, `Notas`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(2, 7, 1, 3, 1, 'Factura', 120.00, 20, '2024-09-02', NULL, '2024-09-02 21:37:40', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `cjuridico`:
--   `IdCliente`
--       `cliente` -> `IdCliente`
--

--
-- Truncar tablas antes de insertar `cjuridico`
--

TRUNCATE TABLE `cjuridico`;
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

--
-- Truncar tablas antes de insertar `cliente`
--

TRUNCATE TABLE `cliente`;
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

--
-- Truncar tablas antes de insertar `cnatural`
--

TRUNCATE TABLE `cnatural`;
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

--
-- Truncar tablas antes de insertar `detalle_pedido`
--

TRUNCATE TABLE `detalle_pedido`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE IF NOT EXISTS `pago` (
  `IdPago` int(11) NOT NULL AUTO_INCREMENT,
  `IdTipoPago` int(11) NOT NULL,
  `MontoPago` decimal(10,2) NOT NULL,
  `FechaPago` date NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdPago`),
  KEY `IdTipoPago` (`IdTipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `pago`:
--   `IdTipoPago`
--       `tipo_pago` -> `IdTipoPago`
--

--
-- Truncar tablas antes de insertar `pago`
--

TRUNCATE TABLE `pago`;
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
  `IdPago` int(11) NOT NULL,
  `FechaHoraCreacion` datetime DEFAULT current_timestamp(),
  `FechaHoraActualizacion` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`IdPedido`),
  KEY `IdUsuario` (`IdUsuario`),
  KEY `IdCliente` (`IdCliente`),
  KEY `IdPuesto` (`IdPuesto`),
  KEY `IdPago` (`IdPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `pedido`:
--   `IdUsuario`
--       `usuario` -> `IdUsuario`
--   `IdCliente`
--       `cliente` -> `IdCliente`
--   `IdPuesto`
--       `puesto` -> `IdPuesto`
--   `IdPago`
--       `pago` -> `IdPago`
--

--
-- Truncar tablas antes de insertar `pedido`
--

TRUNCATE TABLE `pedido`;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `producto`:
--   `IdCategoria`
--       `categoria` -> `IdCategoria`
--

--
-- Truncar tablas antes de insertar `producto`
--

TRUNCATE TABLE `producto`;
--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `CodigoProducto`, `NombreProducto`, `DescripcionProducto`, `Stock`, `StockMinimo`, `StockMaximo`, `PrecioCompra`, `PrecioVenta`, `ImagenProducto`, `FechaIngreso`, `IdCategoria`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(1, 'P-00001', 'Cubitos 2 Kg', 'Cubos de hielo de 2 Kg', 0, 5, 40, 12.00, 15.00, '2024-08-29-12-32-08__caracteristicas-del-hielo-1200x600.jpg', '2024-08-29', 1, '2024-08-29 11:29:51', '2024-08-29 12:40:47'),
(3, 'P-00003', 'Belen 2 Kg', 'Bolsas negras de marca Belen de 2 kg', 0, 5, 30, 20.00, 25.00, '2024-08-29-06-24-07__Bolsas-32x40-1024x1024.jpg', '2024-08-29', 2, '2024-08-29 12:42:23', '2024-08-29 18:24:07'),
(6, 'P-00004', 'Barra', 'Hielo en barra', 0, 5, 40, 0.00, 20.00, '2024-08-29-06-22-22__barra.fw_.png', '2024-08-29', 1, '2024-08-29 13:03:11', '2024-08-29 18:22:22'),
(7, 'P-00004', 'Azúcar blanca de 1 kg', 'Azúcar blanca de 1 Kg de unagro', 20, 5, 20, 4.00, 6.00, '2024-09-01-08-19-04__AzucarUnagro.jpg', '2024-09-01', 3, '2024-09-01 20:18:49', '2024-09-02 21:38:46'),
(9, 'P-00005', 'Bolsas', '', 0, 5, 25, 5.00, 8.00, '2024-09-02-06-50-58__bolsa-p-basura-90x110-1.jpg', '2024-09-02', 2, '2024-09-02 18:50:58', NULL),
(10, 'P-00006', 'Cubitos de hielo 3 Kg', 'Cubitos de hielo de 3 Kg', 0, 5, 40, 15.00, 20.00, 'producto_default.png', '2024-09-02', 1, '2024-09-02 18:52:01', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Puesto principal', 'Mercado Abasto', '2024-09-03 14:04:07', '2024-09-03 14:17:07');

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
  PRIMARY KEY (`IdTipoPago`),
  UNIQUE KEY `TipoPago` (`TipoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `tipo_pago`:
--

--
-- Truncar tablas antes de insertar `tipo_pago`
--

TRUNCATE TABLE `tipo_pago`;
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
-- Truncar tablas antes de insertar `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `Usuario`, `NombresUsuario`, `ApellidosUsuario`, `EmailUsuario`, `PasswordUsuario`, `EstadoUsuario`, `IdRolUsuario`, `FechaHoraCreacion`, `FechaHoraActualizacion`) VALUES
(3, 'Admin', 'Andres', 'Meneces', 'jandrespb4@gmail.com', '$2y$10$6./.duT5yvuKtU92mj1xE.CbxBlh8uWyo5qynA0GJ9Xro7pDrmcmG', 1, 1, '2024-08-27 16:49:25', '2024-08-27 20:27:42'),
(6, 'Usuario', 'Pruebas', 'Prueba', 'UserTest@gmail.com', '$2y$10$aGQjeBRgKjSP7wekaEYIKuzb4CmqMHAzEiS.vO/K.USe3TYaV3V5K', 0, 2, '2024-08-27 20:28:38', '2024-08-28 13:12:31');

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
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`IdTipoPago`) REFERENCES `tipo_pago` (`IdTipoPago`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`IdPuesto`) REFERENCES `puesto` (`IdPuesto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`IdPago`) REFERENCES `pago` (`IdPago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
