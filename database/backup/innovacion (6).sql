-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-02-2024 a las 07:32:59
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_negocios` (IN `negocio` VARCHAR(200))   BEGIN
    SELECT idnegocio, nombre FROM negocios WHERE nombre LIKE CONCAT('%', negocio, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `negocioMap` (IN `_idnegocio` INT)   BEGIN
    DECLARE _latitud DOUBLE;
    DECLARE _longitud DOUBLE;

    SELECT latitud, longitud
	INTO _latitud, _longitud
	FROM ubicaciones
	WHERE idnegocio = _idnegocio
	AND inactive_at IS NULL
	LIMIT 1;


    -- Mostrar los resultados
    SELECT _latitud AS latitud_obtenida, _longitud AS longitud_obtenida;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_actualizar_pass` (IN `_correo` VARCHAR(100), IN `_token` CHAR(6), IN `_claveacceso` VARCHAR(100))   BEGIN 
	UPDATE usuarios SET
    claveacceso = _claveacceso,
    token_estado = '1',
    token = NULL
    WHERE correo = _correo AND token = _token;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_buscar_cliente` (IN `_cliente` VARCHAR(45))   BEGIN
    SELECT
        p.idpersona,
        CONCAT(p.nombres, ' ', p.apellidos) AS 'datos',
        p.numerodoc,
        COUNT(n.idnegocio) AS cantidad
    FROM
        personas p
    LEFT JOIN
        negocios n ON p.idpersona = n.idpersona
    WHERE
        CONCAT(p.nombres, ' ', p.apellidos) LIKE CONCAT('%', _cliente, '%')
        AND NOT EXISTS (
            SELECT 1
            FROM usuarios u
            WHERE u.idpersona = p.idpersona
            AND u.nivelacceso = 'ADM'
        )
    GROUP BY
        p.idpersona, datos;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_busquedas_negocios` (IN `nombre_comercial` VARCHAR(200))   BEGIN
    SELECT
        n.idnegocio,
        s.idsubcategoria,
        d.iddistrito,
        p.idpersona,
        n.nombre AS NombreComercial,
        s.nomsubcategoria,
        CONCAT(p.nombres, ' ', p.apellidos) AS Cliente,
        n.nroruc,
        d.nomdistrito,
        n.direccion,
        n.correo,
        n.whatsapp,
		n.telefono,
        n.facebook,
        n.instagram,
        n.tiktok,
        n.descripcion,
        n.pagweb,
        n.logo,
        n.portada,
        n.valoracion
    FROM negocios n
    INNER JOIN personas p ON n.idpersona = p.idpersona
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE n.nombre LIKE CONCAT('%', nombre_comercial, '%')
    AND n.inactive_at IS NULL;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_clientes_listar` ()   BEGIN
	SELECT
		p.idpersona,
		CONCAT(p.nombres, ' ', p.apellidos) AS 'datos',
        p.numerodoc,
		COUNT(n.idnegocio) AS cantidad
		FROM
			personas p
		LEFT JOIN
			negocios n ON p.idpersona = n.idpersona
		WHERE NOT EXISTS (
			SELECT 1
				FROM usuarios u
				WHERE u.idpersona = p.idpersona
				AND u.nivelacceso = 'ADM'
		)
		GROUP BY
		p.idpersona, datos;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_clientes_obtener` (IN `_idpersona` INT)   BEGIN
	SELECT *
		FROM personas
		WHERE idpersona = _idpersona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_actualizar` (`_idpersona` INT, `_apellidos` VARCHAR(100), `_nombres` VARCHAR(100), `_numerodoc` CHAR(15))   BEGIN
	UPDATE personas SET
		apellidos = _apellidos,
		nombres = _nombres,
		numerodoc = _numerodoc,
		update_at = NOW()
	WHERE idpersona = _idpersona;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_editar_negocio` (IN `_idnegocio` INT, IN `_iddistrito` INT, IN `_idpersona` INT, IN `_idsubcategoria` INT, IN `_nroruc` CHAR(15), IN `_nombre` VARCHAR(200), IN `_descripcion` VARCHAR(200), IN `_direccion` VARCHAR(100), IN `_telefono` CHAR(11), IN `_correo` VARCHAR(100), IN `_facebook` VARCHAR(200), IN `_whatsapp` VARCHAR(200), IN `_instagram` VARCHAR(200), IN `_tiktok` VARCHAR(200), IN `_pagweb` VARCHAR(200), IN `_logo` VARCHAR(100), IN `_portada` VARCHAR(200), IN `_valoracion` INT)   BEGIN
    -- Actualizar los datos del negocio
    UPDATE negocios
    SET 
        iddistrito = _iddistrito,
        idpersona = _idpersona,
        idsubcategoria = _idsubcategoria,
        nroruc = _nroruc,
        nombre = _nombre,
        descripcion = _descripcion,
        direccion = _direccion,
        telefono = _telefono,
        correo = _correo,
        facebook = _facebook,
        whatsapp = _whatsapp,
        instagram = _instagram,
        tiktok = _tiktok,
        pagweb = _pagweb,
        logo = IFNULL(_logo, logo),
        portada = IFNULL(_portada, portada),
        valoracion = _valoracion,
        update_at = NOW()
    WHERE idnegocio = _idnegocio;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_eliminar_negocio` (IN `_idnegocio` INT)   BEGIN
	UPDATE negocios
    SET inactive_at = NOW()
    WHERE idnegocio = _idnegocio;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_eliminar_negocio_final` (IN `_idpersona` INT)   BEGIN

    -- Eliminar filas asociadas en la tabla contratos
    DELETE FROM contratos WHERE idnegocio IN (SELECT idnegocio FROM negocios WHERE idpersona = _idpersona);

    -- Eliminar filas asociadas en la tabla ubicaciones
    DELETE FROM ubicaciones WHERE idnegocio IN (SELECT idnegocio FROM negocios WHERE idpersona = _idpersona);

    -- Eliminar filas asociadas en la tabla galerias
    DELETE FROM galerias WHERE idnegocio IN (SELECT idnegocio FROM negocios WHERE idpersona = _idpersona);

    -- Eliminar el negocio principal
    DELETE FROM negocios WHERE idpersona = _idpersona;
    
    DELETE FROM personas WHERE idpersona = _idpersona;

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_listar` (IN `_idnegocio` INT)   BEGIN
    SELECT
        g.idgaleria,
        n.idnegocio,
        g.rutafoto
        FROM galerias g
        INNER JOIN negocios n ON n.idnegocio = g.idnegocio
        WHERE g.idnegocio = _idnegocio;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galeria_registrar` (IN `_idnegocio` INT, IN `_rutafoto` VARCHAR(250))   begin 
    declare count_foto int;

    select count(*) into count_foto
    from galerias
    where 
        idnegocio = _idnegocio;

    if count_foto <= 11 then

    insert into galerias
        (idnegocio,rutafoto)
        values
        (_idnegocio,_rutafoto);

    else

    signal     sqlstate '45000'
    set message_text = 'solo se puede ingresar 2 fotos';

    end if;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_horarios_negocios` (IN `_idnegocio` INT)   BEGIN
    SELECT h.*
    FROM horarios h
    JOIN ubicaciones u ON h.idhorario = u.idhorario
    JOIN negocios n ON u.idnegocio = n.idnegocio
    WHERE n.idnegocio = _idnegocio
    ORDER BY h.idhorario ASC;
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
        n.logo,
        estado AS 'Estado'
    FROM negocios n
    INNER JOIN ubicaciones u ON n.idnegocio = u.idnegocio
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE n.nombre LIKE CONCAT('%',_valor,'%')
      AND n.inactive_at IS NULL; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_busquedaCard` (IN `nombre_comercial` VARCHAR(200))   BEGIN
    SELECT
        n.idnegocio,
        s.idsubcategoria,
        d.iddistrito,
        n.nombre AS NombreComercial,
        s.nomsubcategoria,
        d.nomdistrito,
        n.direccion,
        n.telefono,
        n.logo
    FROM negocios n
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE n.nombre LIKE CONCAT('%', nombre_comercial, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_listaCardsDistrito` (IN `_iddistrito` INT)   BEGIN
    SELECT
        n.idnegocio,
        s.idsubcategoria,
        d.iddistrito,
        n.nombre AS NombreComercial,
        s.nomsubcategoria,
        d.nomdistrito,
        n.direccion,
        n.telefono,
        n.logo
    FROM negocios n
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE n.iddistrito = _iddistrito;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_listaCardsSub` (IN `_idsubcategoria` INT)   BEGIN
    SELECT
        n.idnegocio,
        s.idsubcategoria,
        d.iddistrito,
        n.nombre AS NombreComercial,
        s.nomsubcategoria,
        d.nomdistrito,
        n.direccion,
        n.telefono,
        n.logo
        FROM negocios n
        INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
        INNER JOIN distritos d ON n.iddistrito = d.iddistrito
        WHERE n.idsubcategoria = _idsubcategoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_listar` ()   BEGIN
	SELECT
    n.idnegocio,
    d.iddistrito,
    n.nombre AS NombreComercial,
    d.nomdistrito,
    n.direccion,
    n.telefono,
    n.logo
	FROM negocios n
	INNER JOIN distritos d ON n.iddistrito = d.iddistrito;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_listarSubyDis` (IN `_idsubcategoria` INT, IN `_iddistrito` INT)   BEGIN
    SELECT
        n.idnegocio,
        s.idsubcategoria,
        d.iddistrito,
        n.nombre AS NombreComercial,
        s.nomsubcategoria,
        d.nomdistrito,
        n.direccion,
        n.telefono,
        n.logo
        FROM negocios n
        INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
        INNER JOIN distritos d ON n.iddistrito = d.iddistrito
        WHERE n.idsubcategoria = _idsubcategoria
        AND n.iddistrito = _iddistrito;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_listar_adm` ()   BEGIN
	SELECT
    n.idnegocio,
    s.idsubcategoria,
     d.iddistrito,
    n.nombre AS NombreComercial,
    s.nomsubcategoria,
    p.idpersona,
    CONCAT(p.apellidos, ', ', p.nombres) AS Cliente,
    n.nroruc,
    d.nomdistrito,
    n.direccion,
    n.correo,
    n.whatsapp,
    n.telefono,
    n.facebook,
    n.instagram,
    n.tiktok,
    n.descripcion,
    n.pagweb,
    n.logo,
    n.portada,
    n.valoracion
	FROM negocios n
	INNER JOIN personas p ON n.idpersona = p.idpersona
	INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE n.inactive_at IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_listar_obt` (IN `p_idnegocio` INT)   BEGIN
    SELECT
        n.idnegocio,
        s.idsubcategoria,
		d.iddistrito,
        n.nombre AS NombreComercial,
        s.nomsubcategoria,
        p.idpersona,
        CONCAT(p.apellidos, ', ', p.nombres) AS Cliente,
        n.nroruc,
        d.nomdistrito,
        n.direccion,
        n.correo,
        n.whatsapp,
        n.telefono,
        n.facebook,
        n.instagram,
        n.tiktok,
        n.descripcion,
        n.pagweb,
        n.logo,
        n.portada,
        n.valoracion
    FROM
        negocios n
    INNER JOIN personas p ON n.idpersona = p.idpersona
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE
        n.inactive_at IS NULL AND n.idnegocio = p_idnegocio;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_registrar` (IN `_iddistrito` INT, IN `_idpersona` INT, IN `_idsubcategoria` INT, IN `_nroruc` CHAR(15), IN `_nombre` VARCHAR(200), IN `_descripcion` VARCHAR(200), IN `_direccion` VARCHAR(100), IN `_telefono` CHAR(11), IN `_correo` VARCHAR(200), IN `_facebook` VARCHAR(200), IN `_whatsapp` VARCHAR(200), IN `_instagram` VARCHAR(200), IN `_tiktok` VARCHAR(200), IN `_pagweb` VARCHAR(200), IN `_logo` VARCHAR(200), IN `_valoracion` INT, IN `_portada` VARCHAR(200))   BEGIN
	INSERT INTO negocios
		(iddistrito, idpersona, idsubcategoria, nroruc, nombre, descripcion, 
		 direccion, telefono, correo, facebook, whatsapp, instagram, tiktok, pagweb, logo, valoracion, portada)
    VALUES
		(_iddistrito, _idpersona, _idsubcategoria, _nroruc, _nombre, _descripcion, 
		_direccion, _telefono, _correo, _facebook, _whatsapp, _instagram, _tiktok, _pagweb, NULLIF(_logo, ''), _valoracion, _portada);
	 SELECT @@last_insert_id 'idnegocio';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_coordenadas` (IN `_iddistrito` INT)   BEGIN
    SELECT *
		FROM distritos
        WHERE iddistrito = _iddistrito;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_dist` (IN `_idsubcategoria` INT, IN `_iddistrito` INT, IN `_dia_actual` VARCHAR(20))   BEGIN
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
        n.logo,
        estado AS 'Estado'
    FROM negocios n
    INNER JOIN ubicaciones u ON n.idnegocio = u.idnegocio
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE n.idsubcategoria = _idsubcategoria
      AND n.iddistrito = _iddistrito  -- Agregamos el filtro por distrito
      AND n.inactive_at IS NULL
	  LIMIT 1; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_obtener_id` (IN `_idnegocio` INT, IN `_dia_actual` VARCHAR(20))   BEGIN
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
                WHERE n.idnegocio = _idnegocio
                  AND h.dia = _dia_actual
                  AND _hora_actual BETWEEN h.apertura AND h.cierre
            ) THEN 'Abierto'
            ELSE 'Cerrado'
        END INTO estado
    FROM dual;

    -- Mostrar la información simplificada del negocio
    SELECT 
        n.idnegocio,
        n.descripcion,
        n.portada,
        n.nombre,
        n.facebook,
        n.whatsapp,
        n.instagram,
        n.tiktok,
        n.direccion,
        n.pagweb,
        n.logo,
        n.valoracion,
        estado AS 'Estado'
    FROM negocios n
    WHERE n.idnegocio = _idnegocio
      AND n.inactive_at IS NULL; 
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
        n.logo,
        estado AS 'Estado'
    FROM negocios n
    INNER JOIN ubicaciones u ON n.idnegocio = u.idnegocio
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE n.idsubcategoria = _idsubcategoria
      AND n.inactive_at IS NULL
      ; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_buscar` (IN `nombre_apellido` VARCHAR(100))   BEGIN
    SELECT
        p.idpersona,
        CONCAT(p.nombres, ' ', p.apellidos) AS 'datos',
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_registrar` (IN `_apellidos` VARCHAR(100), IN `_nombres` VARCHAR(100), IN `_numerodoc` VARCHAR(15))   BEGIN
	INSERT INTO personas
		(apellidos, nombres, numerodoc)
	VALUES
		(_apellidos, _nombres, _numerodoc);
	SELECT @@last_insert_id 'idpersona';
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_token` (IN `_correo` VARCHAR(100), IN `_token` CHAR(6))   BEGIN
	UPDATE usuarios SET
		token_estado = '0', 
		token = _token,
		fechatoken = NOW()
		WHERE _correo = correo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_subcategorias_listar` ()   BEGIN
	SELECT * FROM subcategorias;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_subcategorias_listartodo` ()   BEGIN
	SELECT 
		sub.idsubcategoria,
        cat.nomcategoria,
		sub.nomsubcategoria
		FROM subcategorias sub
        INNER JOIN categorias cat ON cat.idcategoria = sub.idcategoria;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_ubicaciones_listar` ()   BEGIN
	SELECT * FROM ubicaciones;
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
(1, 1, '', '2024-02-11 01:10:12', NULL, NULL),
(2, 1, '9b72419b0d46ad7219a26f398348dbe8dd0a895e.jpg', '2024-02-11 01:13:35', NULL, NULL);

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
(1, 'Hoteles', '2024-02-11 00:42:42', NULL, NULL),
(2, 'Farmacias', '2024-02-11 00:42:42', NULL, NULL),
(3, 'Restaurantes', '2024-02-11 00:42:42', NULL, NULL),
(4, 'Bodegas', '2024-02-11 00:42:42', NULL, NULL);

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
(1, 'Chincha Alta', -13.4177194, -76.1320961, '2024-02-11 00:51:25', NULL, NULL),
(2, 'Alto Larán', -13.4423379, -76.082938, '2024-02-11 00:51:25', NULL, NULL),
(3, 'Chavín', -13.0770802, -75.9129889, '2024-02-11 00:51:25', NULL, NULL),
(4, 'Chincha Baja', -13.4589023, -76.161858, '2024-02-11 00:51:25', NULL, NULL),
(5, 'El Carmen', -13.499493, -76.0574846, '2024-02-11 00:51:25', NULL, NULL),
(6, 'Grocio Prado', -13.3981128, -76.1562338, '2024-02-11 00:51:25', NULL, NULL),
(7, 'Pueblo Nuevo', -13.4046044, -76.1263104, '2024-02-11 00:51:25', NULL, NULL),
(8, 'San Juan De Yanac', -13.2109521, -75.7868747, '2024-02-11 00:51:25', NULL, NULL),
(9, 'San Pedro De Huacarpana', -13.122306, -75.792899, '2024-02-11 00:51:25', NULL, NULL),
(10, 'Sunampe', -13.4275754, -76.164317, '2024-02-11 00:51:25', NULL, NULL),
(11, 'Tambo De Mora', -13.4584529, -76.1826597, '2024-02-11 00:51:25', NULL, NULL);

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
(1, 1, 'aa69bfb7055fb322412e5cd36a6ef4ce51739369.jpg', '2024-02-11 01:28:59', NULL, NULL),
(2, 1, 'd60bd1fdcf9cb9bb847354a0a40c3dc592beacf8.jpg', '2024-02-11 01:28:59', NULL, NULL),
(3, 1, '045a517fd38794963cf23bd1e549a602739089bc.jpg', '2024-02-11 01:28:59', NULL, NULL);

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
(1, '10:00:00', '16:00:00', 'lunes', '2024-02-11 00:47:02', NULL, NULL),
(2, '07:45:00', '16:45:00', 'martes', '2024-02-11 00:47:02', NULL, NULL),
(3, '11:00:00', '15:30:00', 'miercoles', '2024-02-11 00:47:02', NULL, NULL),
(4, '09:00:00', '16:00:00', 'jueves', '2024-02-11 00:47:02', NULL, NULL),
(5, '11:30:00', '16:00:00', 'Viernes', '2024-02-11 00:47:02', NULL, NULL),
(6, '07:45:00', '16:45:00', 'Sábado', '2024-02-11 00:47:02', NULL, NULL),
(7, '01:30:00', '15:30:00', 'Domingo', '2024-02-11 00:47:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocios`
--

CREATE TABLE `negocios` (
  `idnegocio` int(11) NOT NULL,
  `iddistrito` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
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
  `portada` varchar(200) DEFAULT NULL,
  `valoracion` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `negocios`
--

INSERT INTO `negocios` (`idnegocio`, `iddistrito`, `idpersona`, `idsubcategoria`, `nroruc`, `nombre`, `descripcion`, `direccion`, `telefono`, `correo`, `facebook`, `whatsapp`, `instagram`, `tiktok`, `pagweb`, `logo`, `portada`, `valoracion`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 1, 1, 7, '10101010101', 'Platanitos', 'Carsa en tu casa', 'av. centenerio', '944', '99@gmail.com', '99', '99', '99', '99', '99', '9f5e748140dbc8892987d4731390457321408a17.jpg', 'c27b48e6106407cef8a68a51e2a53fd3ee4fc65e.jpg', 1, '2024-02-11 01:19:06', '2024-02-11 01:30:27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `tipodoc` char(15) NOT NULL DEFAULT 'DNI',
  `numerodoc` char(15) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idpersona`, `apellidos`, `nombres`, `tipodoc`, `numerodoc`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 'Muñoz', 'Alonso', 'DNI', '74136969', '2024-02-11 00:35:16', '2024-02-11 00:37:19', NULL),
(2, 'hernandez', 'yorghet', 'DNI', '21873894', '2024-02-11 00:35:45', NULL, NULL);

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
(1, 1, 'Playa', '2024-02-11 00:44:58', NULL, NULL),
(2, 1, 'Urbano', '2024-02-11 00:44:58', NULL, NULL),
(3, 1, 'Lujo', '2024-02-11 00:44:58', NULL, NULL),
(4, 2, 'Pediátrica', '2024-02-11 00:44:58', NULL, NULL),
(5, 2, 'Comercial', '2024-02-11 00:44:58', NULL, NULL),
(6, 2, 'Clínica', '2024-02-11 00:44:58', NULL, NULL),
(7, 3, 'Japones', '2024-02-11 00:44:58', NULL, NULL),
(8, 3, 'Italiano', '2024-02-11 00:44:58', NULL, NULL),
(9, 3, 'Mexicano', '2024-02-11 00:44:58', NULL, NULL),
(10, 4, 'Abarrotes', '2024-02-11 00:44:58', NULL, NULL),
(11, 4, 'Artesanal', '2024-02-11 00:44:58', NULL, NULL),
(12, 4, 'General', '2024-02-11 00:44:58', NULL, NULL);

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
(1, 1, 1, -13.4047002, -76.1582921, '2024-02-11 01:21:12', NULL, NULL);

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
  `token_estado` char(1) DEFAULT NULL,
  `fechatoken` datetime DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `idpersona`, `avatar`, `correo`, `claveacceso`, `celular`, `token`, `nivelacceso`, `estado`, `token_estado`, `fechatoken`, `create_at`, `update_at`, `inactive_at`) VALUES
(1, 2, NULL, 'yorghetyauri123@gmail.com', '$2y$10$hzn0UHipXocXPMWZi2ipDuwjV3XIv18DmxDa26Vf2hGuxhE7xNxey', '946989937', NULL, 'ADM', '1', '1', '2024-02-11 00:40:27', '2024-02-11 00:38:17', NULL, NULL);

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
  MODIFY `idcarrusel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `distritos`
--
ALTER TABLE `distritos`
  MODIFY `iddistrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `galerias`
--
ALTER TABLE `galerias`
  MODIFY `idgaleria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `idnegocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `idplan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `idsubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `idubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `fk_idsubcategoria_neg` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategorias` (`idsubcategoria`);

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
