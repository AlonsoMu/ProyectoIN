-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2024 a las 05:41:49
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerPortadaYEstado` (IN `_idnegocio` INT)   BEGIN
    DECLARE _portada VARCHAR(255);
    DECLARE _estado VARCHAR(10);

    -- Obtener la portada por el idnegocio
    SELECT portada INTO _portada
    FROM negocios
    WHERE idnegocio = _idnegocio;

    -- Verificar el estado del negocio
    SELECT
        CASE
            WHEN EXISTS (
                SELECT 1
                FROM negocios n
                INNER JOIN ubicaciones u ON n.idnegocio = u.idnegocio
                INNER JOIN horarios h ON u.idhorario = h.idhorario
                WHERE n.idnegocio = _idnegocio
                  AND _hora_actual BETWEEN h.apertura AND h.cierre
            ) THEN 'Abierto'
            ELSE 'Cerrado'
        END INTO _estado;

    -- Devolver los resultados
    SELECT _portada AS portada, _estado AS estado;
END$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_busquedas_negocios3` (IN `nombre_comercial` VARCHAR(200))   BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_categorias_registrar` (IN `_nomcategoria` VARCHAR(50))   BEGIN
	INSERT INTO categorias
		(nomcategoria)
	VALUES
		(_nomcategoria);
	-- SELECT @@last_insert_id 'idcategoria';
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_registrar` (IN `_idnegocio` INT, IN `_rutafoto` VARCHAR(100))   BEGIN
	INSERT INTO galerias
		(idnegocio, rutafoto)
	VALUES
		(_idnegocio, NULLIF(_rutafoto, ''));
	 SELECT @@last_insert_id 'idgaleria';
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_horarios_listar` ()   BEGIN
	SELECT
		idhorario,
        apertura,
        cierre,
        dia
	FROM horarios
    WHERE inactive_at IS NULL;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_horarios_negocios` (IN `_idnegocio` INT)   BEGIN
    SELECT h.*
    FROM horarios h
    JOIN ubicaciones u ON h.idhorario = u.idhorario
    JOIN negocios n ON u.idnegocio = n.idnegocio
    WHERE n.idnegocio = _idnegocio
    ORDER BY h.idhorario ASC;
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
    WHERE n.inactive_at IS NULL
    ORDER BY n.create_at;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_negocios_total` ()   BEGIN
	SELECT
    N.idnegocio,
    D.iddistrito,
    D.nomdistrito,
    N.nombre,
    N.direccion,
    N.logo,
    N.telefono
    FROM negocios N
    INNER JOIN distritos D On N.iddistrito = D.iddistrito;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `xd` (IN `p_idSubcategoria` INT)   BEGIN
    SELECT d.iddistrito, d.nomdistrito, d.latitud, d.longitud
    FROM distritos d
    INNER JOIN negocios n ON d.iddistrito = n.iddistrito
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE s.idsubcategoria = p_idSubcategoria;
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
(1, 'chincha alta', -13.4177194, -76.1320961, '2024-01-22 16:57:11', NULL, NULL),
(2, 'alto larán', -13.4423379, -76.082938, '2024-01-22 16:57:11', NULL, NULL),
(3, 'chavín', -13.0770802, -75.9129889, '2024-01-22 16:57:11', NULL, NULL),
(4, 'chincha baja', -13.4589023, -76.161858, '2024-01-22 16:57:11', NULL, NULL),
(5, 'el carmen', -13.499493, -76.0574846, '2024-01-22 16:57:11', NULL, NULL),
(6, 'grocio prado', -13.3981128, -76.1562338, '2024-01-22 16:57:11', NULL, NULL),
(7, 'pueblo nuevo', -13.4046044, -76.1263104, '2024-01-22 16:57:11', NULL, NULL),
(8, 'san juan de yanac', -13.2109521, -75.7868747, '2024-01-22 16:57:11', NULL, NULL),
(9, 'san pedro de huacarpana', -13.122306, -75.792899, '2024-01-22 16:57:11', NULL, NULL),
(10, 'sunampe', -13.4275754, -76.164317, '2024-01-22 16:57:11', NULL, NULL),
(11, 'tambo de mora', -13.4584529, -76.1826597, '2024-01-22 16:57:11', NULL, NULL);

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
(1, 8, '0dbe4d5e8341d9e36ba82fefba1c8538ad0ec5df.jpg', '2024-01-25 00:08:09', NULL, NULL),
(2, 8, '64d84c5173c451058ba79036f66363d03baec3ca.jpg', '2024-01-25 00:08:09', NULL, NULL),
(3, 8, 'a721bac8617922085f893e864411795f4d314e65.jpg', '2024-01-25 00:09:13', NULL, NULL),
(4, 8, '4dc7e179377199ae05a39dd7d71d1d5ae714b04c.jpg', '2024-01-25 00:09:13', NULL, NULL),
(5, 8, 'bcab9c72943b657a6ff18f28b8b61776bcbf51eb.jpg', '2024-01-25 00:09:13', NULL, NULL),
(6, 8, '7b9cedb8dd55f8e70c247fda3d79aa03ad325314.jpg', '2024-01-25 00:09:49', NULL, NULL),
(7, 8, 'db0d4dc421328514fa0c8e889464583c1bf4e605.jpg', '2024-01-25 00:12:32', NULL, NULL),
(8, 8, '2e78766e32002cf8e37266b8a39837013cd8a96e.jpg', '2024-01-25 00:12:49', NULL, NULL),
(9, 8, 'f1bba2ef26bbd3758e285cdfdd5598cbb483f715.jpg', '2024-01-25 00:13:23', NULL, NULL),
(10, 1, '7e6f57c66d5862393290bc4c42e3aff12e21c702.jpg', '2024-01-25 00:13:54', NULL, NULL),
(11, 1, 'f89dfae97bac1998bb8cde0fd919cc2d227006ed.jpg', '2024-01-25 00:13:54', NULL, NULL),
(12, 1, 'a2adb86900c28a3232ec2da4f10e1a3b07c307d1.jpg', '2024-01-25 00:14:26', NULL, NULL),
(13, 1, 'a7215135914b66865965d395a174823eb71c15ae.jpg', '2024-01-25 00:14:26', NULL, NULL),
(14, 1, '9cf1d0b5a8e1c5b929eae1bf006a22602afc7c18.jpg', '2024-01-25 00:14:26', NULL, NULL),
(15, 1, '818e65c66cca02c752972723e97b4f3706ffeecc.jpg', '2024-01-25 00:15:07', NULL, NULL),
(16, 1, '18d0d98dde11d56d6ec56a86051f8b2811aca78a.jpg', '2024-01-25 00:15:07', NULL, NULL),
(17, 1, 'd7cb93cfc49396736996c3f6eca29bd128bb5e27.jpg', '2024-01-25 00:19:52', NULL, NULL),
(18, 1, '7273e903d3266d6a64180378e8cad11a7e459dad.jpg', '2024-01-25 00:20:56', NULL, NULL),
(19, 1, '98e69697dc12e5817c5d2912ab7cb4525d4b506c.jpg', '2024-01-25 00:20:56', NULL, NULL),
(20, 8, '79eaded254d6c1e66efb6e1cada53c59fef25f08.jpg', '2024-01-25 01:03:31', NULL, NULL),
(21, 8, 'cce893506084b08e095143824d9d67d31f35eba7.jpg', '2024-01-25 01:20:43', NULL, NULL),
(22, 4, '4a9449e9a719217af151bc072f4a105976d6366f.jpg', '2024-01-25 01:25:51', NULL, NULL),
(23, 4, '51b79dae7188a4e947a9a49b27f7728a7cc9dd10.jpg', '2024-01-25 01:27:10', NULL, NULL),
(24, 4, '119b035f8740587293b6f618336842f5871e5f10.jpg', '2024-01-25 01:27:10', NULL, NULL),
(25, 4, '01b6980d3d29f3d04dfda8ab41a59f000863067b.jpg', '2024-01-25 01:27:10', NULL, NULL),
(26, 4, 'f537c6d66b451942f32317b2973e12d3317e9b09.jpg', '2024-01-25 01:27:10', NULL, NULL),
(27, 8, '6f1fb8b0cdd07c487067fb905d9b8672be1bb790.jpg', '2024-01-25 01:52:06', NULL, NULL),
(28, 4, 'e55eb15f97bf83d3f19799f11fc1c327a4540d4d.jpg', '2024-01-25 01:54:14', NULL, NULL),
(29, 8, 'alo.jpg', '2024-01-25 01:55:44', NULL, NULL),
(30, 8, 'alo.jpg', '2024-01-25 01:55:49', NULL, NULL),
(31, 8, 'alo.jpg', '2024-01-25 01:55:51', NULL, NULL),
(32, 8, 'alo.jpg', '2024-01-25 01:55:52', NULL, NULL),
(33, 8, 'alo.jpg', '2024-01-25 01:55:52', NULL, NULL),
(34, 8, 'alo.jpg', '2024-01-25 01:55:53', NULL, NULL),
(35, 8, 'alo.jpg', '2024-01-25 01:55:54', NULL, NULL),
(36, 8, 'alo.jpg', '2024-01-25 01:55:54', NULL, NULL),
(37, 8, 'alo.jpg', '2024-01-25 01:55:54', NULL, NULL),
(38, 8, 'alo.jpg', '2024-01-25 01:55:54', NULL, NULL),
(39, 8, 'alo.jpg', '2024-01-25 01:55:55', NULL, NULL),
(40, 8, 'alo.jpg', '2024-01-25 01:55:55', NULL, NULL),
(41, 8, 'alo.jpg', '2024-01-25 01:55:55', NULL, NULL),
(42, 8, 'alo.jpg', '2024-01-25 01:55:55', NULL, NULL),
(43, 8, 'alo.jpg', '2024-01-25 01:55:55', NULL, NULL),
(44, 8, 'alo.jpg', '2024-01-25 01:55:55', NULL, NULL),
(45, 8, 'alo.jpg', '2024-01-25 01:56:10', NULL, NULL),
(46, 8, 'alo.jpg', '2024-01-25 01:56:10', NULL, NULL),
(47, 8, 'alo.jpg', '2024-01-25 01:56:10', NULL, NULL),
(48, 8, 'alo.jpg', '2024-01-25 01:56:10', NULL, NULL),
(49, 8, 'alo.jpg', '2024-01-25 01:56:11', NULL, NULL),
(50, 8, 'alo.jpg', '2024-01-25 01:56:11', NULL, NULL),
(51, 8, 'alo.jpg', '2024-01-25 01:56:11', NULL, NULL),
(52, 8, 'alo.jpg', '2024-01-25 01:56:11', NULL, NULL),
(53, 8, 'alo.jpg', '2024-01-25 01:56:11', NULL, NULL),
(54, 8, 'alo.jpg', '2024-01-25 01:56:12', NULL, NULL),
(55, 8, 'alo.jpg', '2024-01-25 01:56:12', NULL, NULL),
(56, 8, 'alo.jpg', '2024-01-25 01:56:12', NULL, NULL),
(57, 8, 'alo.jpg', '2024-01-25 01:56:13', NULL, NULL),
(58, 8, 'alo.jpg', '2024-01-25 01:56:13', NULL, NULL),
(59, 8, 'alo.jpg', '2024-01-25 01:56:13', NULL, NULL),
(60, 8, 'alo.jpg', '2024-01-25 01:56:13', NULL, NULL),
(61, 8, 'alo.jpg', '2024-01-25 01:56:13', NULL, NULL),
(62, 8, 'alo.jpg', '2024-01-25 01:56:14', NULL, NULL),
(63, 8, 'alo.jpg', '2024-01-25 01:56:14', NULL, NULL),
(64, 8, 'alo.jpg', '2024-01-25 01:56:14', NULL, NULL),
(65, 8, 'alo.jpg', '2024-01-25 01:56:15', NULL, NULL),
(66, 8, 'alo.jpg', '2024-01-25 01:56:15', NULL, NULL),
(67, 8, 'alo.jpg', '2024-01-25 01:56:15', NULL, NULL),
(68, 8, 'alo.jpg', '2024-01-25 01:56:15', NULL, NULL),
(69, 8, 'alo.jpg', '2024-01-25 01:56:16', NULL, NULL),
(70, 8, 'alo.jpg', '2024-01-25 01:56:16', NULL, NULL),
(71, 8, 'alo.jpg', '2024-01-25 01:56:16', NULL, NULL),
(72, 8, 'alo.jpg', '2024-01-25 01:56:16', NULL, NULL),
(73, 4, 'e33a99e8ff10d15cff2804148be10a1c6e9f4ee5.jpg', '2024-01-25 01:59:48', NULL, NULL),
(74, 4, 'cb9beceded52184c07d7c5a9bc6fe63b6c7dca08.jpg', '2024-01-25 02:00:18', NULL, NULL),
(75, 11, 'ad9f5b15f7d99c1bc0231eafa8ba15f9e73964ec.jpg', '2024-01-26 00:44:53', NULL, NULL);

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
(1, '10:00:00', '16:00:00', 'lunes', '2024-01-31 00:37:38', NULL, NULL),
(2, '07:45:00', '16:45:00', 'martes', '2024-01-31 00:37:38', NULL, NULL),
(3, '11:00:00', '15:30:00', 'miercoles', '2024-01-31 00:37:38', NULL, NULL),
(4, '09:00:00', '16:00:00', 'jueves', '2024-01-31 00:37:38', NULL, NULL),
(5, '11:30:00', '16:00:00', 'Viernes', '2024-01-31 00:37:38', NULL, NULL),
(6, '07:45:00', '16:45:00', 'Sábado', '2024-01-31 00:37:38', NULL, NULL),
(7, '08:30:00', '15:30:00', 'Domingo', '2024-01-31 00:37:38', NULL, NULL);

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
  `valoracion` int(11) DEFAULT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  `portada` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Muñoz', 'Alonso', 'DNI', '74136969', '2024-02-07 19:04:35', NULL, NULL),
(3, 'Yeren Carbajal p', 'Margarita Elena', 'DNI', '21819126', '2024-02-07 19:16:42', '2024-02-07 22:57:07', NULL),
(19, 'hola', 'hola', 'DNI', '18753248', '2024-02-07 21:30:26', '2024-02-07 21:44:16', NULL);

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
(12, 4, 'general', '2024-01-19 23:03:53', NULL, NULL),
(13, 3, 'ejemplo', '2024-01-24 22:52:01', NULL, NULL),
(14, 3, 'abc', '2024-01-24 22:56:53', NULL, NULL),
(15, 3, 'hola', '2024-01-24 22:56:53', NULL, NULL),
(16, 3, 'a', '2024-01-24 22:57:18', NULL, NULL);

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
(1, 1, 1, -13.4176253, -76.1345425, '2024-01-19 23:57:13', NULL, NULL),
(3, 4, 2, -13.4029212, -76.1600548, '2024-01-20 02:17:42', NULL, NULL),
(4, 5, 3, -13.4053329, -76.1272912, '2024-01-20 02:17:42', NULL, NULL),
(5, 6, 4, -13.4182674, -76.1349002, '2024-01-20 02:17:42', NULL, NULL),
(6, 3, 5, -13.4047002, -76.1582921, '2024-01-21 23:26:33', NULL, NULL),
(7, 1, 16, -13.4176253, -76.1345425, '2024-01-30 00:56:23', NULL, NULL),
(15, 2, 1, -13.4176253, -76.1345425, '2024-01-31 00:40:13', NULL, NULL),
(16, 3, 1, -13.4176253, -76.1345425, '2024-01-31 00:46:06', NULL, NULL),
(17, 4, 1, -13.4176253, -76.1345425, '2024-01-31 00:46:51', NULL, NULL),
(18, 5, 1, -13.4176253, -76.1345425, '2024-01-31 00:50:56', NULL, NULL),
(19, 6, 1, -13.4176253, -76.1345425, '2024-01-31 00:50:56', NULL, NULL),
(20, 7, 1, -13.4176253, -76.1345425, '2024-01-31 00:50:56', NULL, NULL),
(21, 2, 9, -13.4176256, -76.1345428, '2024-02-01 21:55:03', NULL, NULL),
(22, 1, 8, -13.4639408, -76.1741061, '2024-02-01 21:55:03', NULL, NULL);

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
(1, 1, NULL, 'alonsomunoz263@gmail.com', '$2y$10$tscB5kpl9CrfPawev3s2KuCtlM3/fBrX/LptFJRGTHebydNc7GEKO', '970526015', '2217', 'ADM', '1', '2024-01-19 23:00:04', NULL, NULL, '0', '2024-01-19 23:33:23');

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
  MODIFY `idgaleria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idhorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `negocios`
--
ALTER TABLE `negocios`
  MODIFY `idnegocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `idplan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `idsubcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `idubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
-- Filtros para la tabla `negocios`
--
ALTER TABLE `negocios`
  ADD CONSTRAINT `fk_iddistrito_neg` FOREIGN KEY (`iddistrito`) REFERENCES `distritos` (`iddistrito`),
  ADD CONSTRAINT `fk_idpersona_neg` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`),
  ADD CONSTRAINT `fk_idsubcategoria_neg` FOREIGN KEY (`idsubcategoria`) REFERENCES `subcategorias` (`idsubcategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
