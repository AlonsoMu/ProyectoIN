-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2024 a las 08:29:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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
 SELECT *
    FROM usuarios
    WHERE correo = _correo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_buscar_token` (IN `_correo` VARCHAR(100), IN `_token` CHAR(6))   BEGIN
	SELECT *
    FROM usuarios
    WHERE correo = _correo AND token = _token;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_carrusel_listar` ()   BEGIN
	SELECT
		idcarrusel,
        foto
	FROM carrusel
    WHERE inactive_at IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_carrusel_registrar` (IN `_idusuario` INT, IN `_foto` VARCHAR(200))   BEGIN
	INSERT INTO carrusel
	(idusuario, foto)
	VALUES
		(_idusuario, _foto);
	SELECT @@last_insert_id 'idcarrusel';
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_distritos_listar` ()   BEGIN
	SELECT 
		iddistrito,
        nomdistrito,
        latitud,
        longitud
	FROM distritos
    WHERE inactive_at IS NULL;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_login` (IN `_correo` VARCHAR(100))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_busqueda` (IN `_valor` VARCHAR(30), IN `_dia_actual` VARCHAR(20))   BEGIN
    DECLARE _hora_actual TIME;
    DECLARE estado VARCHAR(10);

    -- Obtener la hora actual
    SET _hora_actual = CURRENT_TIME();

    -- Verificar el estado del negocio
    SELECT
        CASE
            WHEN EXISTS (
                SELECT 1
                FROM negocios n
                INNER JOIN ubicaciones u ON n.idnegocio = u.idnegocio
                INNER JOIN horarios h ON u.idhorario = h.idhorario
                WHERE n.nombre LIKE CONCAT('%',_valor,'%')
                  AND h.dia = _dia_actual
                  AND _hora_actual BETWEEN h.apertura AND h.cierre
            ) THEN 'Abierto'
            ELSE 'Cerrado'
        END INTO estado
    FROM dual;

    -- Mostrar la información de los negocios y su estado de disponibilidad
    SELECT 
        n.idnegocio,
        u.idubicacion,
        d.iddistrito,
        n.nombre,
        d.nomdistrito,
        u.latitud,
        u.longitud,
        n.telefono,
        estado AS 'Estado'
    FROM negocios n
    INNER JOIN ubicaciones u ON n.idnegocio = u.idnegocio
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE n.nombre LIKE CONCAT('%',_valor,'%')
      AND n.inactive_at IS NULL; 
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_registrar` (IN `_iddistrito` INT, IN `_idpersona` INT, IN `_idusuario` INT, IN `_idsubcategoria` INT, IN `_nroruc` CHAR(15), IN `_nombre` VARCHAR(200), IN `_descripcion` VARCHAR(200), IN `_direccion` VARCHAR(100), IN `_telefono` CHAR(11), IN `_correo` VARCHAR(200), IN `_facebook` VARCHAR(200), IN `_whatsapp` VARCHAR(200), IN `_instagram` VARCHAR(200), IN `_tiktok` VARCHAR(200), IN `_pagweb` VARCHAR(200), IN `_logo` VARCHAR(200), IN `_valoracion` INT)   BEGIN
	INSERT INTO negocios
		(iddistrito, idpersona, idusuario, idsubcategoria, nroruc, nombre, descripcion, 
		 direccion, telefono, correo, facebook, whatsapp, instagram, tiktok, pagweb, logo, valoracion)
    VALUES
		(_iddistrito, _idpersona, _idusuario, _idsubcategoria, _nroruc, _nombre, _descripcion, 
		_direccion, _telefono, _correo, _facebook, _whatsapp, _instagram, _tiktok, _pagweb, NULLIF(_logo, ''), _valoracion);
	-- SELECT @@last_insert_id 'idnegocio';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_coordenadas` (IN `_iddistrito` INT)   BEGIN
    SELECT *
		FROM distritos
        WHERE iddistrito = _iddistrito;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_nyh` (IN `_idsubcategoria` INT, IN `_dia_actual` VARCHAR(20))   BEGIN
    DECLARE _hora_actual TIME;
    DECLARE estado VARCHAR(10);

    -- Obtener la hora actual
    SET _hora_actual = CURRENT_TIME();

    -- Verificar el estado del negocio
    SELECT
        CASE
            WHEN EXISTS (
                SELECT 1
                FROM negocios n
                INNER JOIN ubicaciones u ON n.idnegocio = u.idnegocio
                INNER JOIN horarios h ON u.idhorario = h.idhorario
                WHERE n.idsubcategoria = _idsubcategoria
                  AND h.dia = _dia_actual
                  AND _hora_actual BETWEEN h.apertura AND h.cierre
            ) THEN 'Abierto'
            ELSE 'Cerrado'
        END INTO estado
    FROM dual;

    -- Mostrar la información de los negocios y su estado de disponibilidad
    SELECT 
        n.idnegocio,
        u.idubicacion,
        d.iddistrito,
        s.idsubcategoria,
        s.nomsubcategoria,
        u.latitud,
        u.longitud,
        n.nombre,
        n.direccion,
        d.nomdistrito,
        n.telefono,
        estado AS 'Estado'
    FROM negocios n
    INNER JOIN ubicaciones u ON n.idnegocio = u.idnegocio
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE n.idsubcategoria = _idsubcategoria
      AND n.inactive_at IS NULL; 
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_subcategorias_listartodo` ()   BEGIN
	SELECT 
		sub.idsubcategoria,
        cat.nomcategoria,
		sub.nomsubcategoria
		FROM subcategorias sub
        INNER JOIN categorias cat ON cat.idcategoria = sub.idcategoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_subcategorias_registrar` (IN `_idcategoria` INT, IN `_nomsubcategoria` VARCHAR(100))   BEGIN
	INSERT INTO subcategorias
		(idcategoria, nomsubcategoria)
    VALUES
		(_idcategoria, _nomsubcategoria);
	-- SELECT @@last_insert_id 'idsubcategoria';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_ubicaciones_registrar` (IN `_idhorario` INT, IN `_idnegocio` INT, IN `_latitud` DOUBLE, IN `_longitud` DOUBLE)   BEGIN
	INSERT INTO ubicaciones
		(idhorario, idnegocio, latitud, longitud)
	VALUES
		(_idhorario, idnegocio, _latitud, _longitud);
	-- SELECT @@last_insert_id 'idubicacion';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_listar` ()   BEGIN
	SELECT
		idusuario,
        nivelacceso
	FROM usuarios
    WHERE inactive_at IS NULL;
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
-- Estructura de tabla para la tabla `carrusel`
--

CREATE TABLE `carrusel` (
  `idcarrusel` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrusel`
--

INSERT INTO `carrusel` (`idcarrusel`, `idusuario`, `foto`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 1, '3fd5bded33e953c5709429ad6d5b0658c60e8754.jpg', '2024-01-20 02:01:36', NULL, NULL),
(2, 1, '65152c00c46b1eac7a2d89a6b36e6258d787901d.jpg', '2024-01-20 02:01:43', NULL, NULL),
(3, 1, '55a2b4bdb2b024298ff2888072ec4491f4822715.jpg', '2024-01-20 02:02:07', NULL, NULL),
(4, 1, '99e8fc938cbb3615f8f8332971322cd13b8ce16e.jpg', '2024-01-20 02:02:16', NULL, NULL),
(5, 1, 'd0576ad05a81539db9e75741c9585a69579c02d0.jpg', '2024-01-20 02:02:24', NULL, NULL),
(6, 1, '625b8c3f7d5b0f6705ada0829f5e5d6b36d3e7c0.jpg', '2024-01-20 02:02:31', NULL, NULL),
(7, 1, 'c3b5a5facea330276a51fa2c5e80833b232b4c79.jpg', '2024-01-20 02:13:25', NULL, NULL);

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
(1, 'hoteles', '2024-01-19 23:03:50', NULL, NULL),
(2, 'farmacias', '2024-01-19 23:03:50', NULL, NULL),
(3, 'restaurantes', '2024-01-19 23:03:50', NULL, NULL),
(4, 'bodegas', '2024-01-19 23:03:50', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`idcontrato`, `idplan`, `idnegocio`, `idusuario`, `fechainicio`, `fechafin`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 1, 1, 1, '2024-01-01', '2024-03-31', '2024-01-19 23:06:57', NULL, NULL),
(2, 2, 2, 1, '2024-01-15', '2024-02-15', '2024-01-19 23:06:57', NULL, NULL),
(3, 2, 3, 1, '2024-02-01', '2024-03-01', '2024-01-19 23:06:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE `distritos` (
  `iddistrito` int(11) NOT NULL,
  `nomdistrito` varchar(50) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`iddistrito`, `nomdistrito`, `latitud`, `longitud`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 'chincha alta', -13.417583, -76.1325496, '2024-01-20 02:28:22', NULL, NULL),
(2, 'alto larán', -13.4423161, -76.0828003, '2024-01-20 02:28:22', NULL, NULL),
(3, 'chavín', -13.0770802, -75.9129889, '2024-01-20 02:28:22', NULL, NULL),
(4, 'chincha baja', -13.4589572, -76.1615777, '2024-01-20 02:28:22', NULL, NULL),
(5, 'el carmen', -13.5001422, -76.05755, '2024-01-20 02:28:22', NULL, NULL),
(6, 'grocio prado', -13.3981459, -76.1561312, '2024-01-20 02:28:22', NULL, NULL),
(7, 'pueblo nuevo', -13.4048376, -76.1263936, '2024-01-20 02:28:22', NULL, NULL),
(8, 'san juan de yanac', -13.210744, -75.7861519, '2024-01-20 02:28:22', NULL, NULL),
(9, 'san pedro de huacarpana', -13.0694787, -75.7914073, '2024-01-20 02:28:22', NULL, NULL),
(10, 'sunampe', -13.4275167, -76.1643971, '2024-01-20 02:28:22', NULL, NULL),
(11, 'tambo de mora', -13.4585105, -76.1826305, '2024-01-20 02:28:22', NULL, NULL);

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
(1, '10:00:00', '16:00:00', 'lunes', '2024-01-19 23:04:01', NULL, NULL),
(2, '07:45:00', '16:45:00', 'martes', '2024-01-19 23:04:01', NULL, NULL),
(3, '11:00:00', '15:30:00', 'miercoles', '2024-01-19 23:04:01', NULL, NULL),
(4, '09:00:00', '16:00:00', 'jueves', '2024-01-19 23:04:01', NULL, NULL),
(5, '11:30:00', '16:00:00', 'Viernes', '2024-01-19 23:04:01', NULL, NULL),
(6, '07:45:00', '16:45:00', 'Sábado', '2024-01-19 23:04:01', NULL, NULL),
(7, '08:30:00', '15:30:00', 'Domingo', '2024-01-19 23:04:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `idnegocio` int(11) NOT NULL,
  `iddistrito` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idsubcategoria` int(11) NOT NULL,
  `nroruc` char(15) DEFAULT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` char(11) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  `whatsapp` varchar(200) DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `tiktok` varchar(200) DEFAULT NULL,
  `pagweb` varchar(200) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `valoracion` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`idnegocio`, `iddistrito`, `idpersona`, `idusuario`, `idsubcategoria`, `nroruc`, `nombre`, `descripcion`, `direccion`, `telefono`, `correo`, `facebook`, `whatsapp`, `instagram`, `tiktok`, `pagweb`, `logo`, `valoracion`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 1, 1, 1, 7, '12345678901', 'oishi', 'comida japonea', 'Av. Principal 123', '987654321', 'info@tiendatech.com', NULL, NULL, NULL, NULL, NULL, NULL, 4, '2024-01-19 23:06:36', NULL, NULL),
(2, 6, 2, 1, 8, '98765432101', 'costumbres', 'comida italiana', 'Calle Secundaria 456', '987654322', 'info@modaelegante.com', NULL, NULL, NULL, NULL, NULL, NULL, 5, '2024-01-19 23:06:36', NULL, NULL),
(3, 7, 1, 1, 9, '11112222333', 'naoky', 'comida mexicana', 'Av. Deportiva 789', '987654323', 'info@deportesxtreme.com', NULL, NULL, NULL, NULL, NULL, NULL, 3, '2024-01-19 23:06:36', NULL, NULL),
(4, 7, 2, 2, 5, '20481460159', 'novafarma', 'novafarma, cuidamos tu salud y tu economía.', '656 av. grocio prado', '953656344', 'novafarma@prueba.es', 'https://www.facebook.com/novafarmachinchaalta', '953656344', NULL, NULL, NULL, NULL, 2, '2024-01-19 23:45:00', NULL, NULL);

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
(1, 'Muñoz', 'Alonso', 'DNI', '74136969', '2024-01-19 22:59:53', NULL, NULL),
(2, 'Hernandez', 'Yorghet', 'DNI', '72159736', '2024-01-19 22:59:53', NULL, NULL);

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
(1, 'FREE', 0.00, '2024-01-19 23:00:30', NULL, NULL),
(2, 'PREMIUM', 9.99, '2024-01-19 23:00:30', NULL, NULL);

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
(1, 1, 'playa', '2024-01-19 23:03:53', NULL, NULL),
(2, 1, 'urbano', '2024-01-19 23:03:53', NULL, NULL),
(3, 1, 'lujo', '2024-01-19 23:03:53', NULL, NULL),
(4, 2, 'pediátrica', '2024-01-19 23:03:53', NULL, NULL),
(5, 2, 'comercial', '2024-01-19 23:03:53', NULL, NULL),
(6, 2, 'clínica', '2024-01-19 23:03:53', NULL, NULL),
(7, 3, 'japones', '2024-01-19 23:03:53', NULL, NULL),
(8, 3, 'italiano', '2024-01-19 23:03:53', NULL, NULL),
(9, 3, 'mexicano', '2024-01-19 23:03:53', NULL, NULL),
(10, 4, 'abarrotes', '2024-01-19 23:03:53', NULL, NULL),
(11, 4, 'artesanal', '2024-01-19 23:03:53', NULL, NULL),
(12, 4, 'general', '2024-01-19 23:03:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `idubicacion` int(11) NOT NULL,
  `idhorario` int(11) NOT NULL,
  `idnegocio` int(11) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`idubicacion`, `idhorario`, `idnegocio`, `latitud`, `longitud`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 1, 1, 13.4176253, -76.1345425, '2024-01-19 23:57:13', NULL, NULL),
(3, 4, 2, -13.4029212, -76.1600548, '2024-01-20 02:17:42', NULL, NULL),
(4, 5, 3, -13.4053329, -76.1272912, '2024-01-20 02:17:42', NULL, NULL),
(5, 6, 4, -13.4182674, -76.1349002, '2024-01-20 02:17:42', NULL, NULL);

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
(1, 1, NULL, 'alonsomunoz263@gmail.com', '$2y$10$tscB5kpl9CrfPawev3s2KuCtlM3/fBrX/LptFJRGTHebydNc7GEKO', '970526015', '2217', 'ADM', '1', '2024-01-19 23:00:04', NULL, NULL, '0', '2024-01-19 23:33:23'),
(2, 2, NULL, 'yorghetyauri123@gmail.com', '$2y$10$4cRm3VvOaFVmAsetrnE5Y.hs8XexasbhwenpdZq.5kAegoJ7LZrTG', '946989937', NULL, 'ADM', '1', '2024-01-19 23:00:26', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  ADD PRIMARY KEY (`idcarrusel`),
  ADD KEY `fk_idusuario_carr` (`idusuario`);

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
-- Indices de la tabla `distritos`
--
ALTER TABLE `distritos`
  ADD PRIMARY KEY (`iddistrito`);

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
  ADD KEY `fk_iddistrito_neg` (`iddistrito`),
  ADD KEY `fk_idpersona_neg` (`idpersona`),
  ADD KEY `fk_idusuario_neg` (`idusuario`),
  ADD KEY `fk_idsubcategoria_neg` (`idsubcategoria`);

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
  ADD KEY `fk_idhorario_ubi` (`idhorario`),
  ADD KEY `fk_idnegocio_ubi` (`idnegocio`);

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
-- AUTO_INCREMENT de la tabla `carrusel`
--
ALTER TABLE `carrusel`
  MODIFY `idcarrusel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `idcontrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `distritos`
--
ALTER TABLE `distritos`
  MODIFY `iddistrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `galerias`
--
ALTER TABLE `galerias`
  MODIFY `idgaleria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `idnegocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrusel`
--
ALTER TABLE `carrusel`
  ADD CONSTRAINT `fk_idusuario_carr` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);

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
  ADD CONSTRAINT `fk_iddistrito_neg` FOREIGN KEY (`iddistrito`) REFERENCES `distritos` (`iddistrito`),
  ADD CONSTRAINT `fk_idpersona_neg` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`),
  ADD CONSTRAINT `fk_idsubcategoria_neg` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategorias` (`idsubcategoria`),
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
  ADD CONSTRAINT `fk_idhorario_ubi` FOREIGN KEY (`idhorario`) REFERENCES `horarios` (`idhorario`),
  ADD CONSTRAINT `fk_idnegocio_ubi` FOREIGN KEY (`idnegocio`) REFERENCES `negocios` (`idnegocio`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_idpersona_per` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
