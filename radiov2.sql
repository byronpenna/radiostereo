-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2014 a las 18:15:50
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `radiov2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cli_cliente`
--

CREATE TABLE IF NOT EXISTS `cli_cliente` (
`cli_id` int(11) NOT NULL,
  `cli_nombres` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `cli_apellidos` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `com_compania`
--

CREATE TABLE IF NOT EXISTS `com_compania` (
`com_id` int(11) NOT NULL,
  `com_nombre` varchar(70) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cot_encabezado_cotizacion`
--

CREATE TABLE IF NOT EXISTS `cot_encabezado_cotizacion` (
`cot_id` int(11) NOT NULL,
  `cot_fecha_elaboracion` date NOT NULL,
  `cot_valor_agregado` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `cot_cli_id` int(11) NOT NULL,
  `cot_tip_id` int(11) NOT NULL,
  `cot_est_id` int(11) NOT NULL,
  `cot_usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_detalle_bloque`
--

CREATE TABLE IF NOT EXISTS `det_detalle_bloque` (
`det_id` int(11) NOT NULL,
  `det_enc_id` int(11) NOT NULL,
  `det_serv_id` int(11) NOT NULL,
  `det_rad_id` int(11) NOT NULL,
  `det_cantidad` int(11) NOT NULL,
  `det_duracion` int(11) NOT NULL,
  `det_subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enc_encabezado_bloque`
--

CREATE TABLE IF NOT EXISTS `enc_encabezado_bloque` (
`enc_id` int(11) NOT NULL,
  `enc_cot_id` int(11) NOT NULL,
  `enc_prog_id` int(11) NOT NULL,
  `enc_precio_venta` float NOT NULL,
  `enc_fecha_inicio` date NOT NULL,
  `enc_fecha_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `est_estado`
--

CREATE TABLE IF NOT EXISTS `est_estado` (
`est_id` int(11) NOT NULL,
  `est_estado` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_opciones`
--

CREATE TABLE IF NOT EXISTS `menu_opciones` (
`menu_id` int(11) NOT NULL,
  `menu_opcion` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opc_rol_opcion`
--

CREATE TABLE IF NOT EXISTS `opc_rol_opcion` (
`opc_id` int(11) NOT NULL,
  `opc_rol_id` int(11) NOT NULL,
  `opc_menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_precio`
--

CREATE TABLE IF NOT EXISTS `pre_precio` (
`pre_id` int(11) NOT NULL,
  `pre_precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prog_programa`
--

CREATE TABLE IF NOT EXISTS `prog_programa` (
`prog_id` int(11) NOT NULL,
  `prog_nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rad_radio`
--

CREATE TABLE IF NOT EXISTS `rad_radio` (
`rad_id` int(11) NOT NULL,
  `rad_nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE IF NOT EXISTS `rol_usuario` (
`rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `rol_usu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serv_servicio`
--

CREATE TABLE IF NOT EXISTS `serv_servicio` (
`serv_id` int(11) NOT NULL,
  `serv_nombre` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tip_tipo`
--

CREATE TABLE IF NOT EXISTS `tip_tipo` (
`tip_id` int(11) NOT NULL,
  `tip_tipo` varchar(25) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usu_usuario`
--

CREATE TABLE IF NOT EXISTS `usu_usuario` (
`usu_id` int(11) NOT NULL,
  `usu_nombre` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_password` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `usu_com_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cli_cliente`
--
ALTER TABLE `cli_cliente`
 ADD PRIMARY KEY (`cli_id`);

--
-- Indices de la tabla `com_compania`
--
ALTER TABLE `com_compania`
 ADD PRIMARY KEY (`com_id`);

--
-- Indices de la tabla `cot_encabezado_cotizacion`
--
ALTER TABLE `cot_encabezado_cotizacion`
 ADD PRIMARY KEY (`cot_id`);

--
-- Indices de la tabla `det_detalle_bloque`
--
ALTER TABLE `det_detalle_bloque`
 ADD PRIMARY KEY (`det_id`);

--
-- Indices de la tabla `enc_encabezado_bloque`
--
ALTER TABLE `enc_encabezado_bloque`
 ADD PRIMARY KEY (`enc_id`);

--
-- Indices de la tabla `est_estado`
--
ALTER TABLE `est_estado`
 ADD PRIMARY KEY (`est_id`);

--
-- Indices de la tabla `menu_opciones`
--
ALTER TABLE `menu_opciones`
 ADD PRIMARY KEY (`menu_id`);

--
-- Indices de la tabla `opc_rol_opcion`
--
ALTER TABLE `opc_rol_opcion`
 ADD PRIMARY KEY (`opc_id`);

--
-- Indices de la tabla `pre_precio`
--
ALTER TABLE `pre_precio`
 ADD PRIMARY KEY (`pre_id`);

--
-- Indices de la tabla `prog_programa`
--
ALTER TABLE `prog_programa`
 ADD PRIMARY KEY (`prog_id`);

--
-- Indices de la tabla `rad_radio`
--
ALTER TABLE `rad_radio`
 ADD PRIMARY KEY (`rad_id`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
 ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `serv_servicio`
--
ALTER TABLE `serv_servicio`
 ADD PRIMARY KEY (`serv_id`);

--
-- Indices de la tabla `tip_tipo`
--
ALTER TABLE `tip_tipo`
 ADD PRIMARY KEY (`tip_id`);

--
-- Indices de la tabla `usu_usuario`
--
ALTER TABLE `usu_usuario`
 ADD PRIMARY KEY (`usu_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cli_cliente`
--
ALTER TABLE `cli_cliente`
MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `com_compania`
--
ALTER TABLE `com_compania`
MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cot_encabezado_cotizacion`
--
ALTER TABLE `cot_encabezado_cotizacion`
MODIFY `cot_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `det_detalle_bloque`
--
ALTER TABLE `det_detalle_bloque`
MODIFY `det_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `enc_encabezado_bloque`
--
ALTER TABLE `enc_encabezado_bloque`
MODIFY `enc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `est_estado`
--
ALTER TABLE `est_estado`
MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `menu_opciones`
--
ALTER TABLE `menu_opciones`
MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `opc_rol_opcion`
--
ALTER TABLE `opc_rol_opcion`
MODIFY `opc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pre_precio`
--
ALTER TABLE `pre_precio`
MODIFY `pre_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prog_programa`
--
ALTER TABLE `prog_programa`
MODIFY `prog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rad_radio`
--
ALTER TABLE `rad_radio`
MODIFY `rad_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `serv_servicio`
--
ALTER TABLE `serv_servicio`
MODIFY `serv_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tip_tipo`
--
ALTER TABLE `tip_tipo`
MODIFY `tip_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usu_usuario`
--
ALTER TABLE `usu_usuario`
MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
