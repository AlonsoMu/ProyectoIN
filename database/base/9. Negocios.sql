USE INNOVACION;

-- TABLA NEGOCIOS

-- -------------------------------------------------------------------------------------------------
-- 											| NEGOCIOS |
-- -------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_negocios_registrar(
	IN _iddistrito 			INT,
    IN _idpersona			INT,
    IN _idusuario			INT,
    IN _idsubcategoria		INT,
    IN _idubicacion 		INT,
    IN _nroruc				CHAR(15),
    IN _nombre				VARCHAR(200),
    IN _descripcion 		VARCHAR(200),
    IN _direccion			VARCHAR(100),
    IN _telefono			CHAR(11),
    IN _correo				VARCHAR(100),
    IN _facebook			VARCHAR(200),
    IN _whatsapp			VARCHAR(100),
    IN _instagram			VARCHAR(100),
    IN _tiktok				VARCHAR(100),
    IN _logo				VARCHAR(100),
	IN _valoracion			INT
)
BEGIN
	INSERT INTO negocios
		(iddistrito, idpersona, idusuario, idsubcategoria, idubicacion, nroruc, nombre, descripcion, 
		 direccion, telefono, correo, facebook, whatsapp, instagram, tiktok, logo, valoracion)
    VALUES
		(_iddistrito, _idpersona, _idusuario, _idsubcategoria, _idubicacion, _nroruc, _nombre, _descripcion, 
		_direccion, _telefono, _correo, _facebook, _whatsapp, _instagram, _tiktok, NULLIF(_logo, ''), _valoracion);
	-- SELECT @@last_insert_id 'idnegocio';
END $$
CALL spu_negocios_registrar(7, 2, 2, 5, 5, 20481460159, 'novafarma', 'novafarma, cuidamos tu salud y tu economía.', '656 av. grocio prado', 953656344, 'novafarma@prueba.es', 'https://www.facebook.com/novafarmachinchaalta', 953656344, NULL, NULL, NULL, 2);
SELECT * FROM distritos;
SELECt * FROM galerias;
SELECt * FROM personas;
SELECT * FROM usuarios;
SELECT * FROM subcategorias;
SELECT * FROM ubicaciones;
SELECT * FROM horarios;
SELECT * FROM negocios;
-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_obtener_negocios(IN _idsubcategoria INT)
BEGIN
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
        n.telefono
        FROM negocios n
        INNER JOIN ubicaciones u ON n.idubicacion = u.idubicacion
        INNER JOIN distritos d ON n.iddistrito = d.iddistrito
        INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
        WHERE n.idsubcategoria = _idsubcategoria
        AND n.inactive_at IS NULL; 
END $$
CALL spu_obtener_negocios(7);

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_negocios_listar()
BEGIN
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
END $$
CALL spu_negocios_listar();

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

DELIMITER $$
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

DELIMITER ;

-- ##########################################################################################################################

DELIMITER $$
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
CALL spu_obtener_negocios_subdis(8,6);

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
                INNER JOIN ubicaciones u ON n.idubicacion = u.idubicacion
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
    INNER JOIN ubicaciones u ON n.idubicacion = u.idubicacion
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE n.idsubcategoria = _idsubcategoria
      AND n.inactive_at IS NULL; 
END $$
CALL spu_obtener_nyh(7, 'miercole');

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
                INNER JOIN ubicaciones u ON n.idubicacion = u.idubicacion
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
    INNER JOIN ubicaciones u ON n.idubicacion = u.idubicacion
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE n.nombre LIKE CONCAT('%',_valor,'%')
      AND n.inactive_at IS NULL; 
END $$
SELECT * FROM negocios;
CALL spu_negocios_busqueda('naoky','jueves');

-- ##########################################################################################################################

DELIMITER $$
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
CALL spu_obtener_negocios(3);
SELECT * FROM distritos;

-- ##########################################################################################################################