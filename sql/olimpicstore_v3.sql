-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2023 a las 09:50:35
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `olimpicstore_v3`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`olympicadmin`@`localhost` PROCEDURE `juegos` ()   BEGIN
    SELECT * FROM juegos WHERE PEGI > 1;
END$$

CREATE DEFINER=`olympicadmin`@`localhost` PROCEDURE `juegos_mayoredad` ()   BEGIN
    SELECT * FROM juegos WHERE PEGI > 17;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `administracion_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `administracion_usuarios` (
`nombre` varchar(50)
,`nickname` varchar(50)
,`ID_usuario` int(3)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliotecas`
--

CREATE TABLE `bibliotecas` (
  `ID_biblioteca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bibliotecas`
--

INSERT INTO `bibliotecas` (`ID_biblioteca`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliotecas_juegos`
--

CREATE TABLE `bibliotecas_juegos` (
  `ID_biblioteca` int(3) NOT NULL,
  `ID_juego` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bibliotecas_juegos`
--

INSERT INTO `bibliotecas_juegos` (`ID_biblioteca`, `ID_juego`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 2),
(2, 3),
(3, 1),
(3, 3),
(3, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `ID_juego` int(3) NOT NULL,
  `nombre` varchar(500) DEFAULT NULL,
  `PEGI` int(2) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`ID_juego`, `nombre`, `PEGI`, `descripcion`) VALUES
(1, 'Metal Gear Solid', 18, 'Juego de sigilo'),
(2, 'Street Fighter', 12, 'Juego de peleas'),
(3, 'Hollow Knight', 12, 'Juego estilo Metroidvaina'),
(4, 'Call Of Duty', 18, 'Juego Shooter');

--
-- Disparadores `juegos`
--
DELIMITER $$
CREATE TRIGGER `tr_juegos` BEFORE INSERT ON `juegos` FOR EACH ROW BEGIN
    IF EXISTS (SELECT * FROM juegos WHERE nombre = NEW.nombre) THEN
        SIGNAL SQLSTATE "45000" 
        SET MESSAGE_TEXT = 'No se puede insertar el juego porque ya existe zopenco.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `juegos_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `juegos_usuarios` (
`ID_usuario` int(3)
,`nickname` varchar(50)
,`ID_juego` int(3)
,`nombre` varchar(500)
,`PEGI` int(2)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_usuario` int(3) NOT NULL,
  `ID_biblioteca` int(3) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `contraseña` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_usuario`, `ID_biblioteca`, `nombre`, `nickname`, `contraseña`) VALUES
(1, 1, 'Iñaki', 'ElLocoMoroco', 'iñaki'),
(2, 2, 'Ismael', 'Xx_Isma_xX', 'ismael'),
(3, 3, 'Abderrahman', 'AbdeGamerXD', 'abde'),
(4, 4, 'Asier', 'NotOtaku', 'asier'),
(5, 5, 'prueba', 'prueba', 'prueba');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `tr_usuario` BEFORE INSERT ON `usuarios` FOR EACH ROW BEGIN
  IF EXISTS (SELECT * FROM usuarios WHERE nickname = NEW.nickname) THEN
    SIGNAL SQLSTATE "45000" SET MESSAGE_TEXT = "No se puede insertar el usuario. Ya existe un usuario con el mismo nombre de usuario.";
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura para la vista `administracion_usuarios`
--
DROP TABLE IF EXISTS `administracion_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`olympicadmin`@`localhost` SQL SECURITY DEFINER VIEW `administracion_usuarios`  AS SELECT `usuarios`.`nombre` AS `nombre`, `usuarios`.`nickname` AS `nickname`, `usuarios`.`ID_usuario` AS `ID_usuario` FROM `usuarios` AS `usuarios`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `juegos_usuarios`
--
DROP TABLE IF EXISTS `juegos_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `juegos_usuarios`  AS SELECT `usuarios`.`ID_usuario` AS `ID_usuario`, `usuarios`.`nickname` AS `nickname`, `juegos`.`ID_juego` AS `ID_juego`, `juegos`.`nombre` AS `nombre`, `juegos`.`PEGI` AS `PEGI` FROM ((`usuarios` join `bibliotecas_juegos` on(`usuarios`.`ID_biblioteca` = `bibliotecas_juegos`.`ID_biblioteca`)) join `juegos` on(`bibliotecas_juegos`.`ID_juego` = `juegos`.`ID_juego`))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bibliotecas`
--
ALTER TABLE `bibliotecas`
  ADD PRIMARY KEY (`ID_biblioteca`);

--
-- Indices de la tabla `bibliotecas_juegos`
--
ALTER TABLE `bibliotecas_juegos`
  ADD PRIMARY KEY (`ID_biblioteca`,`ID_juego`),
  ADD KEY `ID_juego` (`ID_juego`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`ID_juego`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_usuario`),
  ADD KEY `fk_biblioteca` (`ID_biblioteca`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_biblioteca` FOREIGN KEY (`ID_biblioteca`) REFERENCES `bibliotecas` (`ID_biblioteca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
