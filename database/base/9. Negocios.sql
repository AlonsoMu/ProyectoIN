USE INNOVACION;

-- TABLA NEGOCIOS

-- -------------------------------------------------------------------------------------------------
-- 											| NEGOCIOS |
-- -------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_editar_negocio(
    IN _idnegocio INT,
    IN _iddistrito INT,
    IN _idpersona INT,
    IN _idsubcategoria INT,
    IN _nroruc CHAR(15),
    IN _nombre VARCHAR(200),
    IN _descripcion VARCHAR(200),
    IN _direccion VARCHAR(100),
    IN _telefono CHAR(11),
    IN _correo VARCHAR(100),
    IN _facebook VARCHAR(200),
    IN _whatsapp VARCHAR(200),
    IN _instagram VARCHAR(200),
    IN _tiktok VARCHAR(200),
    IN _pagweb VARCHAR(200),
    IN _logo VARCHAR(100),
    IN _portada VARCHAR(200),
    IN _valoracion INT
)
BEGIN
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
        logo = _logo,
        portada = _portada,
        valoracion = _valoracion,
        update_at = NOW()
    WHERE idnegocio = _idnegocio;
END $$

CALL spu_editar_negocio(
    1,            -- _idnegocio
    3,            -- _iddistrito
    3,            -- _idpersona
    5,            -- _idsubcategoria
    '123456789',  -- _nroruc
    'Nuevo Nombre Comercial',    -- _nombre
    'Nueva Descripción',         -- _descripcion
    'Nueva Dirección',           -- _direccion
    '12345678901',               -- _telefono
    'correo@ejemplo.com',        -- _correo
    'Nuevo Facebook',            -- _facebook
    'Nuevo WhatsApp',            -- _whatsapp
    'Nuevo Instagram',           -- _instagram
    'Nuevo TikTok',               -- _tiktok
    'www.nuevapagweb.com',       -- _pagweb
    'nuevologo.jpg',             -- _logo
    'nuevaportada.jpg',          -- _portada
    2             -- _valoracion
);

SELECT * FROM negocios;

DELIMITER $$
CREATE PROCEDURE spu_negocios_listar_adm()
BEGIN
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
END $$
CALL spu_negocios_listar_adm();

SELECT * FROM negocios;
DELIMITER $$
CREATE PROCEDURE spu_negocios_listar_obt(IN p_idnegocio INT)
BEGIN
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
END $$

SELECT * FROM negocios;
CALL spu_negocios_listar_obt(1);

DELIMITER $$
CREATE PROCEDURE spu_eliminar_negocio(
IN _idnegocio	INT
)
BEGIN
	UPDATE negocios
    SET inactive_at = NOW()
    WHERE idnegocio = _idnegocio;
END $$

DELIMITER $$
CREATE PROCEDURE buscar_negocios(IN negocio VARCHAR(200))
BEGIN
    SELECT idnegocio, nombre FROM negocios WHERE nombre LIKE CONCAT('%', negocio, '%');
END $$
CALL buscar_negocios('xd');

DELIMITER $$
CREATE PROCEDURE spu_negocios_listaCardsDistrito(IN _iddistrito INT)
BEGIN
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
END $$

SELECT * FROM negocios;

DELIMITER $$
CREATE PROCEDURE spu_negocios_registrar(
	IN _iddistrito 			INT,
    IN _idpersona			INT,
    IN _idsubcategoria		INT,
    IN _nroruc				CHAR(15),
    IN _nombre				VARCHAR(200),
    IN _descripcion 		VARCHAR(200),
    IN _direccion			VARCHAR(100),
    IN _telefono			CHAR(11),
    IN _correo				VARCHAR(200),
    IN _facebook			VARCHAR(200),
    IN _whatsapp			VARCHAR(200),
    IN _instagram			VARCHAR(200),
    IN _tiktok				VARCHAR(200),
    IN _pagweb 			VARCHAR(200),
    IN _logo				VARCHAR(200),
	IN _valoracion			INT,
    IN _portada 			VARCHAR(200)
)
BEGIN
	INSERT INTO negocios
		(iddistrito, idpersona, idsubcategoria, nroruc, nombre, descripcion, 
		 direccion, telefono, correo, facebook, whatsapp, instagram, tiktok, pagweb, logo, valoracion, portada)
    VALUES
		(_iddistrito, _idpersona, _idsubcategoria, _nroruc, _nombre, _descripcion, 
		_direccion, _telefono, _correo, _facebook, _whatsapp, _instagram, _tiktok, _pagweb, NULLIF(_logo, ''), _valoracion, _portada);
	 SELECT @@last_insert_id 'idnegocio';
END $$
CALL spu_negocios_registrar(6, 2, 5, 21481260159, 'vegas', 'vegas, cuidamos tu salud y tu economía.', '486 av. grocio prado', 
				953656344, 'vega@prueba.es', 'https://www.facebook.com/novafarmachinchaalta', 953686344, NULL, NULL, NULL, NULL,3, 'hola.jpg');
SELECT * FROM distritos;
SELECt * FROM galerias;
SELECt * FROM personas;
SELECT * FROM usuarios;
SELECT * FROM subcategorias;
SELECT * FROM ubicaciones;
SELECT * FROM horarios;
SELECT * FROM negocios;
SELECT * FROM contratos;
-- ##########################################################################################################################

/*DELIMITER $$
CREATE PROCEDURE spu_obtener_negocios(IN _idsubcategoria INT)
BEGIN
    SELECT 
        n.idnegocio,
        u.idubicacion,
        h.idhorario,
        d.iddistrito,
        s.idsubcategoria,
        s.nomsubcategoria,
        u.latitud,
        u.longitud,
        n.nombre,
        n.direccion,
        d.nomdistrito,
        n.telefono
        FROM negocios n
        INNER JOIN horarios h ON h.idhorario = n.idhorario
        INNER JOIN ubicaciones u ON h.idubicacion = u.idubicacion
        INNER JOIN distritos d ON n.iddistrito = d.iddistrito
        INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
        WHERE n.idsubcategoria = 7
        AND n.inactive_at IS NULL; 
END $$
CALL spu_obtener_negocios(7);*/

SELECT * FROM negocios;
-- ##########################################################################################################################


DELIMITER $$
CREATE PROCEDURE spu_negocios_listar()
BEGIN
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
END $$
CALL spu_negocios_listar();
-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_negocios_listaCardsSub(IN _idsubcategoria INT)
BEGIN
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
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_negocios_listarSubyDis(IN _idsubcategoria INT, IN _iddistrito INT)
BEGIN
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
END $$
CALL spu_negocios_listarSubyDis(7,1);

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_negocios_listaCardsDistrito(IN _iddistrito INT)
BEGIN
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
END $$
CALL spu_negocios_listaCardsDistrito(1);

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_negocios_buscar(
    IN nombre_comercial VARCHAR(200)
)
BEGIN
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
END $$
CALL spu_negocios_buscar('naoky');

-- ##########################################################################################################################

/*DELIMITER $$
CREATE PROCEDURE spu_obtener_negocios_y_disponibilidad(
    IN _idsubcategoria INT,
    IN _dia_actual VARCHAR(20)
)
BEGIN
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
    INNER JOIN ubicaciones u ON n.idubicacion = u.idubicacion
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE n.idsubcategoria = _idsubcategoria
    AND n.inactive_at IS NULL; 
END $$

DELIMITER ;*/

-- ##########################################################################################################################

/*DELIMITER $$
CREATE PROCEDURE spu_obtener_negocios_subdis(
	IN _idsubcategoria 		INT,
    IN _iddistrito 			INT 
)
BEGIN
	SELECT 
        n.idnegocio,
        s.idsubcategoria,
        d.iddistrito,
        n.nombre,
        n.descripcion,
        n.direccion,
        n.telefono,
        s.nomsubcategoria,
        d.nomdistrito
    FROM negocios n
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE s.idsubcategoria = _idsubcategoria AND d.iddistrito = _iddistrito;
END  $$
CALL spu_obtener_negocios_subdis(8,6);*/

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_obtener_nyh(
    IN _idsubcategoria INT,
    IN _dia_actual VARCHAR(20)
)
BEGIN
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
END $$
CALL spu_obtener_nyh(1, 'viernes');

DELIMITER $$
CREATE PROCEDURE spu_obtener_dist(
    IN _idsubcategoria INT,
    IN _iddistrito INT,
    IN _dia_actual VARCHAR(20)
)
BEGIN
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
END $$


CALL spu_obtener_dist(1, 1, 'viernes');

SELECT * FROM galerias;
SELECT * FROM ubicaciones;
SELECT * FROM horarios;
SELECT * FROM negocios;
SELECT * FROM usuarios;
-- ##########################################################################################################################

-- PROCEDIMIENTO BUSCAR POR PRIMERA LETRA DE NEGOCIO
/*DELIMITER $$
CREATE PROCEDURE spu_negocios_busqueda(
IN _valor VARCHAR(30)
)
BEGIN
	SELECT 
		n.idnegocio,
        d.iddistrito,
        u.idubicacion,
        n.nombre,
        d.nomdistrito,
        u.latitud,
        u.longitud,
        n.telefono
        FROM negocios n
        INNER JOIN distritos d ON 
			d.iddistrito = n.iddistrito
		INNER JOIN ubicaciones u ON
			u.idubicacion = n.idubicacion
            WHERE n.nombre  LIKE CONCAT('%',_valor,'%');
END $$*/

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_negocios_busqueda(
    IN _valor VARCHAR(30),
    IN _dia_actual VARCHAR(20)
)
BEGIN
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
END $$
SELECT * FROM negocios;
CALL spu_negocios_busqueda('oishi','jueves');

-- ##########################################################################################################################

/*DELIMITER $$
CREATE PROCEDURE spu_obtener_negocios(IN _idsubcategoria INT)
BEGIN
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
END $$
CALL spu_obtener_negocios(3);*/
SELECT * FROM distritos;

-- ##########################################################################################################################
DELIMITER $$
CREATE PROCEDURE spu_negocios_busquedaCard(
    IN nombre_comercial VARCHAR(200)
)
BEGIN
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
END $$
CALL spu_negocios_busquedaCard('xd');



DELIMITER $$
CREATE PROCEDURE spu_obtener_id(
    IN _idnegocio INT,
    IN _dia_actual VARCHAR(20)
)
BEGIN
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
END $$

CALL spu_obtener_id(1, 'viernes');


DELIMITER $$
CREATE PROCEDURE negocioMap(
    IN _idnegocio INT
)
BEGIN
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
END $$
CALL negocioMap(1);
	