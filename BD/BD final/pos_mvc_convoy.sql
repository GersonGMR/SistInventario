-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2021 a las 17:10:14
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos_mvc_convoy`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` text NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `representante` varchar(100) NOT NULL,
  `cant_ninios` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `id_frecuencia` int(11) NOT NULL,
  `ingreso_beneficiario` date NOT NULL DEFAULT current_timestamp(),
  `DUI` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `ruc`, `nombre`, `direccion`, `telefono`, `representante`, `cant_ninios`, `estado`, `id_frecuencia`, `ingreso_beneficiario`, `DUI`) VALUES
(1, '202020', 'Iglesia Evangélica Emanuel', 'Urbanización Nuevo Lourdes Senda 20, Casa 2, Block 45 Lourdes La Libertad', '898939', 'Gerson Salazar', 200, 1, 2, '2021-06-10', '202020200'),
(2, '111111', 'Escuela La Plegaria Ahuachapan', 'Avenida 5 Colonia Ejemplo Ahuachapan Ahuachapan', '32431233', 'Rocio Elias', 400, 1, 3, '2021-06-10', '7777770000'),
(3, '303030', 'German Caceres comunity', 'San Salvador', '22577777', 'Caceres German ', 22, 1, 3, '2021-06-10', '055898985'),
(4, '404040', 'Leon Trujillo comunity', 'San Salvador', '123', 'Leon Trujillo', 15, 1, 2, '2021-06-10', '095958955'),
(5, '505050', 'Milton Mejia comunity', 'San Salvador', '75364380', 'Milton Mejia', 1, 1, 1, '2021-06-10', '088985985'),
(6, '222222', 'DATTI Escuela bilingue san salvador', 'San Salvador 5 de noviembre avenida tal, col tal', '79203456', 'Stephany Vargas', 600, 0, 1, '2021-06-10', '789030900');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `total` int(20) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `total`, `estado`, `fecha`) VALUES
(1, 220, 1, '2021-05-13 23:22:12'),
(2, 250, 1, '2021-05-13 23:48:40'),
(3, 50, 1, '2021-05-14 23:46:35'),
(4, 40, 1, '2021-05-15 00:02:07'),
(5, 2, 1, '2021-05-16 23:28:15'),
(6, 250, 1, '2021-06-10 17:37:11'),
(7, 130, 1, '2021-06-11 02:29:27'),
(8, 280, 1, '2021-06-11 17:52:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `ruc` varchar(20) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `razon` varchar(200) DEFAULT NULL,
  `autoriza` varchar(100) DEFAULT NULL,
  `entrega` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `ruc`, `nombre`, `telefono`, `direccion`, `razon`, `autoriza`, `entrega`) VALUES
(2, '22222', 'Convoy of Hope de El Salvador', '2345 9845', 'San Salvador', '', 'Aida Guardado', 'Julio Arias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenedor`
--

CREATE TABLE `contenedor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contenedor`
--

INSERT INTO `contenedor` (`id`, `nombre`, `estado`) VALUES
(1, '01010', 1),
(2, '02020', 1),
(3, '03030', 1),
(4, '04040', 1),
(5, '01111', 1),
(6, '05055', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `producto` varchar(200) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `producto`, `id_producto`, `cantidad`, `precio`, `id_usuario`, `fecha`) VALUES
(1, 1, 'Arroz San Francisco', 3, 20, '0.00', 1, '2021-05-13'),
(2, 1, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 200, '0.00', 1, '2021-05-13'),
(3, 2, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 200, '0.00', 1, '2021-05-13'),
(4, 2, 'Arroz San Francisco', 3, 50, '0.00', 1, '2021-05-13'),
(5, 3, 'Producto prueba', 4, 50, '0.00', 1, '2021-05-14'),
(6, 4, 'Producto prueba', 4, 40, '0.00', 1, '2021-05-14'),
(7, 5, 'Producto prueba', 4, 1, '0.00', 1, '2021-05-16'),
(8, 5, 'Leche en botella marca X', 2, 1, '0.00', 1, '2021-05-16'),
(9, 6, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 50, '0.00', 2, '2021-06-10'),
(10, 6, 'Leche en botella marca X', 2, 200, '0.00', 2, '2021-06-10'),
(11, 7, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 60, '0.00', 1, '2021-06-10'),
(12, 7, 'Leche en botella marca X', 2, 70, '0.00', 1, '2021-06-10'),
(13, 8, 'Arroz San Francisco', 3, 50, '0.00', 1, '2021-06-11'),
(14, 8, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 200, '0.00', 1, '2021-06-11'),
(15, 8, 'Producto prueba', 4, 30, '0.00', 1, '2021-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `medida` varchar(250) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `producto` varchar(200) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `precio` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `id_venta`, `producto`, `id_producto`, `cantidad`, `id_usuario`, `fecha`, `precio`) VALUES
(1, 2, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 50, 1, '2021-05-13', '0'),
(2, 3, 'Arroz San Francisco', 3, 20, 1, '2021-05-13', '0'),
(3, 4, 'Producto prueba', 4, 150, 1, '2021-05-14', '0'),
(4, 5, 'Producto prueba', 4, 20, 1, '2021-05-15', '0'),
(5, 5, 'Arroz San Francisco', 3, 20, 1, '2021-05-15', '0'),
(6, 5, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 5, 1, '2021-05-15', '0'),
(7, 6, 'Maiz en granos', 6, 40, 1, '2021-05-15', '0'),
(8, 7, 'Producto prueba', 4, 5, 1, '2021-05-16', '0'),
(9, 8, 'Maiz en granos', 6, 10, 1, '2021-05-16', '0'),
(10, 8, 'Leche en botella marca X', 2, 10, 1, '2021-05-16', '0'),
(11, 8, 'Arroz San Francisco', 3, 5, 1, '2021-05-16', '0'),
(12, 9, 'Arroz San Francisco', 3, 5, 1, '2021-05-17', '0'),
(13, 9, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 3, 1, '2021-05-17', '0'),
(14, 11, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 15, 1, '2021-06-10', '0'),
(15, 11, 'Leche en botella marca X', 2, 20, 1, '2021-06-10', '0'),
(16, 12, 'Maiz en granos', 6, 102, 1, '2021-06-11', '0'),
(17, 12, 'Leche en botella marca X', 2, 50, 1, '2021-06-11', '0'),
(18, 13, 'Prueba 1', 11, 20, 1, '2021-06-11', '0'),
(19, 13, 'Prueba 2', 12, 40, 1, '2021-06-11', '0'),
(20, 13, 'Prueba 3', 13, 30, 1, '2021-06-11', '0'),
(21, 13, 'Prueba 4', 14, 20, 1, '2021-06-11', '0'),
(22, 13, 'Prueba 5', 15, 30, 1, '2021-06-11', '0'),
(23, 13, 'Prueba 6', 16, 20, 1, '2021-06-11', '0'),
(24, 13, 'Prueba 7', 17, 30, 1, '2021-06-11', '0'),
(25, 13, 'Cereal Kellogs Frotes Mini Wheats Caja', 1, 30, 1, '2021-06-11', '0'),
(26, 13, 'Maiz en granos', 6, 30, 1, '2021-06-11', '0'),
(27, 13, 'Prueba 8', 18, 30, 1, '2021-06-11', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE `familia` (
  `id_familia` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`id_familia`, `nombre`, `estado`) VALUES
(1, 'Granos', 1),
(2, 'Lacteos', 1),
(3, 'Cereales', 1),
(4, 'Embutidos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frecuencia`
--

CREATE TABLE `frecuencia` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `frecuencia`
--

INSERT INTO `frecuencia` (`id`, `descripcion`) VALUES
(1, 'MENSUAL'),
(2, 'BIMENSUAL'),
(3, 'TRIMESTRAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `medida` varchar(255) NOT NULL,
  `vencimiento` date NOT NULL,
  `id_familia` int(11) NOT NULL,
  `id_contenedor` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `fecha_ingreso` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `cantidad`, `medida`, `vencimiento`, `id_familia`, `id_contenedor`, `estado`, `fecha_ingreso`) VALUES
(1, '202020', 'Cereal Kellogs Frotes Mini Wheats Caja', 272, 'Caja de 15 unidades', '2021-09-16', 3, 4, 1, '2021-05-16'),
(2, '303030', 'Leche en botella marca X', 211, 'Caja de 20 botellas', '2021-07-08', 2, 2, 1, '2021-05-16'),
(3, '111111', 'Arroz San Francisco', 55, 'Caja de 20 bolsas', '2021-05-01', 1, 2, 1, '2021-05-16'),
(4, '121212', 'Producto prueba', 36, 'Prueba de medidas', '2021-01-07', 4, 1, 1, '2021-05-16'),
(6, '404040', 'Maiz en granos', 58, '1 Saco', '2022-03-26', 1, 3, 1, '2021-05-16'),
(10, 'FADAFA', 'Prueba piloto', 20, 'Prueba piloto', '2021-05-29', 3, 3, 0, '2021-05-16'),
(11, '20001', 'Prueba 1', 80, 'Prueba 1', '2021-10-14', 1, 1, 1, '2021-06-11'),
(12, '20002', 'Prueba 2', 60, 'Prueba 2', '2021-09-17', 2, 3, 1, '2021-06-11'),
(13, '20003', 'Prueba 3', 70, 'Prueba 3', '2021-08-13', 4, 1, 1, '2021-06-11'),
(14, '20004', 'Prueba 4', 80, 'Prueba 4', '2021-07-02', 3, 3, 1, '2021-06-11'),
(15, '20005', 'Prueba 5', 70, 'Prueba 5', '2021-06-25', 3, 3, 1, '2021-06-11'),
(16, '20006', 'Prueba 6', 80, 'Prueba 6', '2021-06-30', 1, 3, 1, '2021-06-11'),
(17, '20007', 'Prueba 7', 70, 'Prueba 7', '2021-07-09', 4, 3, 1, '2021-06-11'),
(18, '20008', 'Prueba 8', 70, 'Prueba 8', '2021-07-02', 1, 1, 1, '2021-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `correo`, `clave`, `rol`, `estado`) VALUES
(1, 'Gerson Salazar', 'gersongm', 'ggerson777@gmail.com', '1604212c8eef59782e1c3956a0e0e965c93406a1bb5963b2604d5f42186478b1', 'Administrador', 1),
(2, 'Gerson Salazar', 'supergerson', 'ggerson@live.com.ar', '1604212c8eef59782e1c3956a0e0e965c93406a1bb5963b2604d5f42186478b1', 'Vendedor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_cliente`, `total`, `estado`, `fecha`) VALUES
(1, 1, 50, 1, '2021-05-13'),
(2, 1, 50, 0, '2021-05-13'),
(3, 2, 20, 0, '2021-05-13'),
(4, 1, 150, 0, '2021-05-14'),
(5, 2, 45, 0, '2021-05-15'),
(6, 2, 40, 0, '2021-05-15'),
(7, 1, 5, 0, '2021-05-16'),
(8, 2, 25, 0, '2021-05-16'),
(9, 1, 8, 0, '2021-05-17'),
(11, 1, 35, 0, '2021-06-10'),
(12, 1, 152, 0, '2021-06-11'),
(13, 1, 280, 0, '2021-06-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_frecuencia` (`id_frecuencia`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contenedor`
--
ALTER TABLE `contenedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_compra_ibfk_1` (`id_compra`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_venta`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `familia`
--
ALTER TABLE `familia`
  ADD PRIMARY KEY (`id_familia`);

--
-- Indices de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contenedor` (`id_contenedor`),
  ADD KEY `productos_ibfk_2` (`id_familia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contenedor`
--
ALTER TABLE `contenedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `familia`
--
ALTER TABLE `familia`
  MODIFY `id_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `frecuencia`
--
ALTER TABLE `frecuencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_frecuencia` FOREIGN KEY (`id_frecuencia`) REFERENCES `frecuencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_temp_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_contenedor` FOREIGN KEY (`id_contenedor`) REFERENCES `contenedor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_familia` FOREIGN KEY (`id_familia`) REFERENCES `familia` (`id_familia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
