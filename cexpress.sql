-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2018 a las 16:09:05
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cexpress`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_banco`
--

CREATE TABLE `admin_banco` (
  `id` int(11) NOT NULL,
  `banco` varchar(80) DEFAULT NULL,
  `cuenta` varchar(80) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `alias` varchar(80) DEFAULT NULL,
  `titular` varchar(80) DEFAULT NULL,
  `documento` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `telefono` varchar(80) DEFAULT NULL,
  `pais` varchar(80) NOT NULL,
  `diminutivo` varchar(10) NOT NULL,
  `monto` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco_pais`
--

CREATE TABLE `banco_pais` (
  `id` int(11) NOT NULL,
  `pais` varchar(80) DEFAULT NULL,
  `banco` varchar(80) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `banco_pais`
--

INSERT INTO `banco_pais` (`id`, `pais`, `banco`, `status`) VALUES
(1, 'Venezuela', 'Banco Banesco', 1),
(2, 'Colombia', 'Bancolombia', 1),
(3, 'Estados Unidos', 'Bank of America', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_cuenta`
--

CREATE TABLE `estado_cuenta` (
  `id` int(11) NOT NULL,
  `id_cuenta` int(11) DEFAULT NULL,
  `monto_variable` float DEFAULT NULL,
  `monto` float NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha` varchar(25) DEFAULT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `pais` varchar(250) NOT NULL,
  `moneda` varchar(250) NOT NULL,
  `diminutivo` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `created` varchar(250) NOT NULL,
  `modified` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `pais`, `moneda`, `diminutivo`, `status`, `created`, `modified`) VALUES
(1, 'Venezuela', 'Bolívar Soberano', 'BsS', 1, '03/10/2018', ''),
(2, 'Colombia', 'Pesos Colombianos', 'COP', 1, '03/10/2018', ''),
(3, 'Estados Unidos', 'Dólar Estadounidense', 'USD $', 1, '03/10/2018', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `comprobante` varchar(255) DEFAULT NULL,
  `pais_receptor` varchar(80) DEFAULT NULL,
  `banco_receptor` varchar(255) DEFAULT NULL,
  `monto_pagado` varchar(80) DEFAULT NULL,
  `diminutivo_pagado` varchar(15) NOT NULL,
  `monto_operacion` float NOT NULL,
  `num_operacion` varchar(80) NOT NULL,
  `pais_beneficiario` varchar(80) DEFAULT NULL,
  `banco_beneficiario` int(11) DEFAULT NULL,
  `monto_beneficiario` varchar(80) DEFAULT NULL,
  `fecha_pedido` varchar(15) DEFAULT NULL,
  `mensaje` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `archivo` int(11) NOT NULL,
  `notificacion` int(11) NOT NULL,
  `notificacion_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_complemento`
--

CREATE TABLE `pedidos_complemento` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `banco` varchar(80) DEFAULT NULL,
  `monto` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `pais` varchar(250) NOT NULL,
  `moneda` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `tasa` float NOT NULL,
  `comision` float NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tax`
--

INSERT INTO `tax` (`id`, `pais`, `moneda`, `date`, `tasa`, `comision`, `status`) VALUES
(1, 'Venezuela', 'BsS', '', 0, 0, 1),
(2, 'Colombia', 'COP', '03/10/2018', 50, 0, 1),
(3, 'Estados Unidos', 'USD $', '03/10/2018', 100, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `tipo_documento` varchar(250) NOT NULL,
  `dni` varchar(250) NOT NULL,
  `nacionalidad` varchar(250) NOT NULL,
  `telefono` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `codigo_postal` varchar(255) NOT NULL,
  `confirma_img` varchar(255) NOT NULL,
  `ultima_conexion` varchar(25) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `confirmated` int(11) NOT NULL,
  `conectado` int(11) NOT NULL,
  `verificado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `tipo_documento`, `dni`, `nacionalidad`, `telefono`, `email`, `usuario`, `password`, `direccion`, `ciudad`, `codigo_postal`, `confirma_img`, `ultima_conexion`, `role`, `status`, `confirmated`, `conectado`, `verificado`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'Estados Unidos', 'admin', 'admin@mail.com', 'admin', '$2y$10$oMdLetBR02OUyuZcWBi7w.xXnIfRTVz7PicU61U/EwrMvLP.GcHLC', '', '', '', '', '03/10/2018', 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_banco`
--

CREATE TABLE `usuario_banco` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `banco` varchar(80) NOT NULL,
  `cuenta` varchar(25) DEFAULT NULL,
  `tipo` varchar(80) DEFAULT NULL,
  `alias` varchar(20) NOT NULL,
  `titular` varchar(100) DEFAULT NULL,
  `documento` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `telefono` varchar(80) DEFAULT NULL,
  `pais` varchar(80) NOT NULL,
  `diminutivo` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin_banco`
--
ALTER TABLE `admin_banco`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banco_pais`
--
ALTER TABLE `banco_pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_cuenta`
--
ALTER TABLE `estado_cuenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_complemento`
--
ALTER TABLE `pedidos_complemento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_banco`
--
ALTER TABLE `usuario_banco`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin_banco`
--
ALTER TABLE `admin_banco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `banco_pais`
--
ALTER TABLE `banco_pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `estado_cuenta`
--
ALTER TABLE `estado_cuenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedidos_complemento`
--
ALTER TABLE `pedidos_complemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario_banco`
--
ALTER TABLE `usuario_banco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
