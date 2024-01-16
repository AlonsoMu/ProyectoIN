-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2024 a las 04:10:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `innovacion`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_actualizar_pass` (IN `_correo` VARCHAR(100), IN `_token` CHAR(6), IN `_claveacceso` VARCHAR(100))   BEGIN 
	UPDATE usuarios SET
    claveacceso = _claveacceso,
    token_estado = '1',
    token = NULL
    WHERE correo = _correo AND token = _token;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_buscar_correo` (IN `_correo` VARCHAR(100))   BEGIN
 SELECT
	*
    FROM usuarios
    WHERE correo = _correo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_buscar_token` (IN `_correo` VARCHAR(100), IN `_token` CHAR(6))   BEGIN
	SELECT *
    FROM usuarios
    WHERE correo = _correo AND token = _token;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_categorias_listar` ()   BEGIN
	SELECT 
		idcategoria,
        nomcategoria
	FROM categorias
    WHERE inactive_at IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_categorias_registrar` (IN `_nomcategoria` VARCHAR(50))   BEGIN
	INSERT INTO categorias
		(nomcategoria)
	VALUES
		(_nomcategoria);
	-- SELECT @@last_insert_id 'idcategoria';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_contratos_registrar` (IN `_idplan` INT, IN `_idnegocio` INT, IN `_idusuario` INT, IN `_fechainicio` DATE, IN `_fechafin` DATE)   BEGIN 
	INSERT INTO negocios
		(idplan, idnegocio, idusuario, fechainicio, fechafin)
	VALUES
		(idplan, idnegocio, idusuario, fechainicio, fechafin);
	-- SELECT @@last_insert_id 'idcontrato';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_disponible2_negocio` (IN `_dia_actual` VARCHAR(20))   BEGIN
    DECLARE estado VARCHAR(10);

    -- Verificar el estado del negocio
    SELECT
        CASE
            WHEN CURRENT_TIME() BETWEEN h.apertura AND h.cierre THEN 'Abierto'
            ELSE 'Cerrado'
        END INTO estado
    FROM horarios h
    WHERE h.dia = _dia_actual;

    -- Mostrar el estado del negocio
    SELECT estado AS 'Estado';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_disponible_negocio` (IN `_dia_actual` VARCHAR(20))   BEGIN
    DECLARE _hora_actual TIME;
    DECLARE estado VARCHAR(10);

    -- Obtener la hora actual
    SET _hora_actual = CURRENT_TIME();

    -- Verificar el estado del negocio
    SELECT
        CASE
            WHEN _hora_actual BETWEEN h.apertura AND h.cierre THEN 'Abierto'
            ELSE 'Cerrado'
        END INTO estado
    FROM horarios h
    WHERE h.dia = _dia_actual;

    -- Mostrar el estado del negocio
    SELECT estado AS 'Estado';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_listar` (IN `_idnegocio` INT)   BEGIN
	SELECT
        idgaleria,
        rutafoto
    FROM galerias
    WHERE idnegocio = _idnegocio;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_registrar` (IN `_idnegocio` INT, IN `_rutafoto` VARCHAR(100))   BEGIN
	INSERT INTO galerias
		(idnegocio, rutafoto)
	VALUES
		(_idnegocio, _rutafoto);
	-- SELECT @@last_insert_id 'idgaleria';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_horarios_listar` ()   BEGIN
	SELECT
		idhorario,
        apertura,
        cierre,
        dia
	FROM horarios
    WHERE inactive_at IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_horarios_registrar` (IN `_apertura` TIME, IN `_cierre` TIME, IN `_dia` VARCHAR(20))   BEGIN
	INSERT INTO horarios
		(apertura, cierre, dia)
	VALUES
		(_apertura, _cierre, _dia);
	-- SELECT @@last_insert_id 'idhorario';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_login` (IN `_correo` VARCHAR(90))   BEGIN
	SELECT 
		USU.idusuario,
        USU.idpersona,
        PER.apellidos,
        PER.nombres,
        USU.correo,
        USU.claveacceso,
        USU.nivelacceso
	FROM usuarios USU 
    INNER JOIN personas PER ON USU.idpersona = PER.idpersona
    WHERE correo = _correo AND USU.inactive_at IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_buscar` (IN `nombre_comercial` VARCHAR(200))   BEGIN
    SELECT
        n.idnegocio,
        s.idsubcategoria,
        p.idpersona,
        n.nombre AS NombreComercial,
        s.nomsubcategoria,
        CONCAT(p.nombres, ' ', p.apellidos) AS Cliente,
        n.nroruc,
        n.telefono,
        n.whatsapp,
        n.facebook,
        n.instagram,
        n.tiktok,
        n.descripcion
    FROM negocios n
    INNER JOIN personas p ON n.idpersona = p.idpersona
    INNER JOIN usuarios u ON n.idusuario = u.idusuario
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE n.nombre LIKE CONCAT('%', nombre_comercial, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_listar` ()   BEGIN
	SELECT
    n.idnegocio,
    s.idsubcategoria,
    p.idpersona,
    n.nombre AS NombreComercial,
    s.nomsubcategoria,
    CONCAT(p.apellidos, ', ', p.nombres) AS Cliente,
    n.nroruc,
    n.telefono,
    n.whatsapp,
    n.facebook,
    n.instagram,
    n.tiktok,
    n.descripcion
	FROM negocios n
	INNER JOIN personas p ON n.idpersona = p.idpersona
	INNER JOIN usuarios u ON n.idusuario = u.idusuario
	INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_registrar` (IN `_idpersona` INT, IN `_idusuario` INT, IN `_idsubcategoria` INT, IN `_idubicacion` INT, IN `_nroruc` CHAR(15), IN `_nombre` VARCHAR(200), IN `_descripcion` VARCHAR(200), IN `_distrito` VARCHAR(60), IN `_direccion` VARCHAR(100), IN `_telefono` CHAR(11), IN `_correo` VARCHAR(100), IN `_facebook` VARCHAR(200), IN `_whatsapp` VARCHAR(100), IN `_instagram` VARCHAR(100), IN `_tiktok` VARCHAR(100), IN `_logo` VARCHAR(100), IN `_valoracion` INT)   BEGIN
	INSERT INTO negocios
		(idpersona, idusuario, idsubcategoria, idubicacion, nroruc, nombre, descripcion, 
		distrito, direccion, telefono, correo, facebook, whatsapp, instagram, tiktok, logo, valoracion)
    VALUES
		(_idpersona, _idusuario, _idsubcategoria, _idubicacion, _nroruc, _nombre, _descripcion, 
		_distrito, _direccion, _telefono, _correo, _facebook, _whatsapp, _instagram, _tiktok, _logo, _valoracion);
	-- SELECT @@last_insert_id 'idnegocio';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_negocios` (IN `_idsubcategoria` INT)   BEGIN
    SELECT 
		n.idnegocio,
		u.idubicacion,
		u.latitud,
		u.longitud,
		n.nombre,
		n.direccion
		FROM negocios n
		INNER JOIN ubicaciones u ON n.idubicacion = u.idubicacion
		WHERE n.idsubcategoria = _idsubcategoria
        AND n.inactive_at IS NULL; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_buscar` (IN `nombre_apellido` VARCHAR(100))   BEGIN
    SELECT
        p.idpersona,
        CONCAT(p.nombres, ' ', p.apellidos) AS 'Nombres y Apellidos',
        p.numerodoc
    FROM personas p
    WHERE NOT EXISTS (
        SELECT 1
        FROM usuarios u
        WHERE u.idpersona = p.idpersona
        AND u.nivelacceso = 'ADM'
    )
    AND (
        CONCAT(p.nombres, ' ', p.apellidos) LIKE CONCAT('%', nombre_apellido, '%')
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_listar` ()   BEGIN
    SELECT 
        idpersona,
        CONCAT(nombres, ' ', apellidos) AS 'Nombres y Apellidos',
        tipodoc,
        numerodoc
    FROM personas
    WHERE inactive_at IS NULL
        AND idpersona NOT IN (
            SELECT idpersona
            FROM usuarios
        );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_registrar` (IN `_apellidos` VARCHAR(100), IN `_nombres` VARCHAR(100), IN `_tipodoc` VARCHAR(15), IN `_numerodoc` VARCHAR(15))   BEGIN
	INSERT INTO personas
		(apellidos, nombres, tipodoc, numerodoc)
	VALUES
		(_apellidos, _nombres, _tipodoc, _numerodoc);
	-- SELECT @@last_insert_id 'idpersona';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_planes_registrar` (IN `_tipoplan` CHAR(8), IN `_precio` DECIMAL(9,2))   BEGIN
	INSERT INTO planes
		(tipoplan, precio)
	VALUES
		(_tipoplan, _precio);
	-- SELECT @@last_insert_id 'idplan';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_token` (IN `_correo` VARCHAR(100), IN `_token` CHAR(6))   BEGIN
	UPDATE usuarios SET
		token_estado = '0', 
		token = _token,
		fechatoken = NOW()
		WHERE _correo = correo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_subcategorias_listar` (IN `_idcategoria` INT)   BEGIN 
    SELECT 
		sub.idsubcategoria,
        cat.idcategoria,
        cat.nomcategoria,
		sub.nomsubcategoria
		FROM subcategorias sub
        INNER JOIN categorias cat ON cat.idcategoria = sub.idcategoria
		WHERE sub.idcategoria = _idcategoria
          AND sub.inactive_at IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_subcategorias_registrar` (IN `_idcategoria` INT, IN `_nomsubcategoria` VARCHAR(100))   BEGIN
	INSERT INTO subcategorias
		(idcategoria, nomsubcategoria)
    VALUES
		(_idcategoria, _nomsubcategoria);
	-- SELECT @@last_insert_id 'idsubcategoria';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_ubicaciones_listar` ()   BEGIN
	SELECT
		u.idubicacion,
		u.latitud,
		u.longitud,
        h.idhorario,
		h.apertura,
		h.cierre,
		h.dia
	FROM
		ubicaciones u
	INNER JOIN horarios h ON u.idubicacion = h.idhorario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_ubicaciones_registrar` (IN `_idhorario` INT, IN `_latitud` DOUBLE, IN `_longitud` DOUBLE)   BEGIN
	INSERT INTO ubicaciones
		(idhorario, latitud, longitud)
	VALUES
		(_idhorario, _latitud, _longitud);
	-- SELECT @@last_insert_id 'idubicacion';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_registrar` (IN `_idpersona` INT, IN `_avatar` VARCHAR(200), IN `_correo` VARCHAR(100), IN `_claveacceso` VARCHAR(100), IN `_celular` CHAR(11), IN `_nivelacceso` CHAR(3))   BEGIN
	INSERT INTO usuarios
		(idpersona, avatar, correo, claveacceso, celular, nivelacceso)
	VALUES
		(_idpersona, NULLIF(_avatar, ''), _correo, _claveacceso, _celular, _nivelacceso);
	-- SELECT @@last_insert_id 'idusuario';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL,
  `nomcategoria` varchar(50) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nomcategoria`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 'Hoteles', '2024-01-15 21:56:19', NULL, NULL),
(2, 'Farmacias', '2024-01-15 21:56:19', NULL, NULL),
(3, 'Restaurantes', '2024-01-15 21:56:19', NULL, NULL),
(4, 'Bodegas', '2024-01-15 21:56:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `idcontrato` int(11) NOT NULL,
  `idplan` int(11) NOT NULL,
  `idnegocio` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galerias`
--

CREATE TABLE `galerias` (
  `idgaleria` int(11) NOT NULL,
  `idnegocio` int(11) NOT NULL,
  `rutafoto` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galerias`
--

INSERT INTO `galerias` (`idgaleria`, `idnegocio`, `rutafoto`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 1, 'prueba.jpg', '2024-01-05 23:12:15', NULL, NULL),
(2, 2, 'prueba2.jpg', '2024-01-05 23:12:15', NULL, NULL),
(3, 3, 'prueba3.jpg', '2024-01-05 23:12:15', NULL, NULL),
(4, 1, 'prueba4.jpg', '2024-01-05 23:12:15', NULL, NULL),
(5, 1, 'prueba5.jpg', '2024-01-05 23:12:15', NULL, NULL),
(6, 1, 'prueba6.jpg', '2024-01-05 23:12:15', NULL, NULL),
(7, 2, 'prueba7.jpg', '2024-01-05 23:12:15', NULL, NULL),
(8, 2, 'prueba8.jpg', '2024-01-05 23:12:15', NULL, NULL),
(9, 2, 'prueba9.jpg', '2024-01-05 23:12:15', NULL, NULL),
(10, 3, 'prueba10.jpg', '2024-01-05 23:12:15', NULL, NULL),
(11, 3, 'prueba11.jpg', '2024-01-05 23:12:15', NULL, NULL),
(12, 3, 'prueba12.jpg', '2024-01-05 23:12:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idhorario` int(11) NOT NULL,
  `apertura` time NOT NULL,
  `cierre` time DEFAULT NULL,
  `dia` varchar(20) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`idhorario`, `apertura`, `cierre`, `dia`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, '10:00:00', '16:00:00', 'Viernes', '2024-01-05 23:12:15', NULL, NULL),
(2, '07:45:00', '16:45:00', 'Sábado', '2024-01-05 23:12:15', NULL, NULL),
(3, '08:30:00', '15:30:00', 'Domingo', '2024-01-05 23:12:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `idnegocio` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idsubcategoria` int(11) NOT NULL,
  `idubicacion` int(11) NOT NULL,
  `nroruc` char(15) DEFAULT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `distrito` varchar(60) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` char(11) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `whatsapp` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `tiktok` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `valoracion` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `tipodoc` char(15) NOT NULL,
  `numerodoc` char(15) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idpersona`, `apellidos`, `nombres`, `tipodoc`, `numerodoc`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 'Muñoz', 'Alonso', 'DNI', '74136969', '2024-01-05 23:11:49', NULL, NULL),
(2, 'Hernandez', 'Yorghet', 'DNI', '72159736', '2024-01-05 23:11:49', NULL, NULL),
(3, 'Napa', 'Harold', 'DNI', '78291819', '2024-01-05 23:11:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `idplan` int(11) NOT NULL,
  `tipoplan` char(8) NOT NULL,
  `precio` decimal(9,2) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`idplan`, `tipoplan`, `precio`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 'FREE', 0.00, '2024-01-05 23:12:02', NULL, NULL),
(2, 'PREMIUM', 9.99, '2024-01-05 23:12:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `idsubcategoria` int(11) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `nomsubcategoria` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`idsubcategoria`, `idcategoria`, `nomsubcategoria`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 1, 'Playa', '2024-01-15 21:58:08', NULL, NULL),
(2, 1, 'Urbano', '2024-01-15 21:58:08', NULL, NULL),
(3, 1, 'Lujo', '2024-01-15 21:58:08', NULL, NULL),
(4, 2, 'Pediátrica', '2024-01-15 21:58:08', NULL, NULL),
(5, 2, 'Comercial', '2024-01-15 21:58:08', NULL, NULL),
(6, 2, 'Clínica', '2024-01-15 21:58:08', NULL, NULL),
(7, 3, 'Japones', '2024-01-15 21:58:08', NULL, NULL),
(8, 3, 'Italiano', '2024-01-15 21:58:08', NULL, NULL),
(9, 3, 'Mexicano', '2024-01-15 21:58:08', NULL, NULL),
(10, 4, 'Abarrotes', '2024-01-15 21:58:08', NULL, NULL),
(11, 4, 'Artesanal', '2024-01-15 21:58:08', NULL, NULL),
(12, 4, 'General', '2024-01-15 21:58:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `idubicacion` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`idubicacion`, `idhorario`, `latitud`, `longitud`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 1, -13.4180228, -76.1346424, '2024-01-05 23:12:15', NULL, NULL),
(2, 2, -13.4183725, -76.1337673, '2024-01-05 23:12:15', NULL, NULL),
(3, 3, -13.4128998, -76.1294291, '2024-01-05 23:12:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `avatar` varchar(200) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `claveacceso` varchar(100) NOT NULL,
  `celular` char(11) DEFAULT NULL,
  `token` char(6) DEFAULT NULL,
  `nivelacceso` char(3) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `token_estado` char(1) DEFAULT NULL,
  `fechatoken` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `idpersona`, `avatar`, `correo`, `claveacceso`, `celular`, `token`, `nivelacceso`, `estado`, `create_at`, `update_at`, `inactive_at`, `token_estado`, `fechatoken`) VALUES
(1, 1, NULL, 'alonsomunoz263@gmail.com', '$2y$10$UJh/oSgSpfHc7Uai8sRKLuovDWrgK5z7PbEPHzPeeZukscHnbn9uC', '970526015', NULL, 'ADM', '1', '2024-01-05 23:11:58', NULL, NULL, NULL, NULL),
(2, 2, NULL, 'yorghetyauri123@gmail.com', '$2y$10$.aD8Zo1ovlOFJQ4nXvvgWOciwYIzAfKAxebW/dOk2rqE7o/RHMJdm', '946989937', NULL, 'ADM', '1', '2024-01-11 00:01:47', NULL, NULL, '1', '2024-01-14 22:31:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`idcontrato`),
  ADD KEY `fk_idplan_con` (`idplan`),
  ADD KEY `fk_idnegocio_con` (`idnegocio`),
  ADD KEY `fk_idusuario_con` (`idusuario`);

--
-- Indices de la tabla `galerias`
--
ALTER TABLE `galerias`
  ADD PRIMARY KEY (`idgaleria`),
  ADD KEY `fk_idnegocio_gal` (`idnegocio`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idhorario`);

--
-- Indices de la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD PRIMARY KEY (`idnegocio`),
  ADD UNIQUE KEY `uk_nroruc_neg` (`nroruc`),
  ADD KEY `fk_idpersona_neg` (`idpersona`),
  ADD KEY `fk_idusuario_neg` (`idusuario`),
  ADD KEY `fk_idsubcategoria_neg` (`idsubcategoria`),
  ADD KEY `fk_idubicacion_neg` (`idubicacion`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idpersona`),
  ADD UNIQUE KEY `uk_numerodoc_per` (`numerodoc`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`idplan`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`idsubcategoria`),
  ADD KEY `fk_idcategoria_sub` (`idcategoria`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`idubicacion`),
  ADD KEY `fk_idhorario_ubi` (`idhorario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `uk_correo_per` (`correo`),
  ADD KEY `fk_idpersona_per` (`idpersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `idcontrato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `galerias`
--
ALTER TABLE `galerias`
  MODIFY `idgaleria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `idnegocio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `idplan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `idsubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `idubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `fk_idnegocio_con` FOREIGN KEY (`idnegocio`) REFERENCES `negocios` (`idnegocio`),
  ADD CONSTRAINT `fk_idplan_con` FOREIGN KEY (`idplan`) REFERENCES `planes` (`idplan`),
  ADD CONSTRAINT `fk_idusuario_con` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `galerias`
--
ALTER TABLE `galerias`
  ADD CONSTRAINT `fk_idnegocio_gal` FOREIGN KEY (`idnegocio`) REFERENCES `negocios` (`idnegocio`);

--
-- Filtros para la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD CONSTRAINT `fk_idpersona_neg` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`),
  ADD CONSTRAINT `fk_idsubcategoria_neg` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategorias` (`idsubcategoria`),
  ADD CONSTRAINT `fk_idubicacion_neg` FOREIGN KEY (`idubicacion`) REFERENCES `ubicaciones` (`idubicacion`),
  ADD CONSTRAINT `fk_idusuario_neg` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_idcategoria_sub` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`);

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `fk_idhorario_ubi` FOREIGN KEY (`idhorario`) REFERENCES `horarios` (`idhorario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_idpersona_per` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
