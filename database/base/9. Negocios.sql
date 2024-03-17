USE INNOVACION;

-- TABLA NEGOCIOS

-- -------------------------------------------------------------------------------------------------
-- 											| NEGOCIOS |
-- -------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_eliminar_negocio_final(
    IN _idpersona INT
)
BEGIN

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
END $$

-- ##########################################################################################################################

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
    IN _portada VARCHAR(200)
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
        logo = IFNULL(_logo, logo),
        portada = IFNULL(_portada, portada),
        update_at = NOW()
    WHERE idnegocio = _idnegocio;
END $$

-- ##########################################################################################################################

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
    n.portada
	FROM negocios n
	INNER JOIN personas p ON n.idpersona = p.idpersona
	INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE n.inactive_at IS NULL;
END $$

-- ##########################################################################################################################

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
        n.portada
    FROM
        negocios n
    INNER JOIN personas p ON n.idpersona = p.idpersona
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    WHERE
        n.inactive_at IS NULL AND n.idnegocio = p_idnegocio;
END $$

-- ##########################################################################################################################

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

-- ##########################################################################################################################

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
    IN _pagweb 				VARCHAR(200),
    IN _logo				VARCHAR(200),
    IN _portada 			VARCHAR(200)
)
BEGIN
	INSERT INTO negocios
		(iddistrito, idpersona, idsubcategoria, nroruc, nombre, descripcion, 
		 direccion, telefono, correo, facebook, whatsapp, instagram, tiktok, pagweb, logo, portada)
    VALUES
		(_iddistrito, _idpersona, _idsubcategoria, _nroruc, _nombre, _descripcion, 
		_direccion, _telefono, _correo, _facebook, _whatsapp, _instagram, _tiktok, _pagweb, NULLIF(_logo, ''), _portada);
	 SELECT @@last_insert_id 'idnegocio';
END $$

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


-- ##########################################################################################################################

/*DELIMITER $$
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
END $$*/

-- ##########################################################################################################################

/*DELIMITER $$
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
END $$*/

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
      AND n.inactive_at IS NULL; 
END $$

-- ##########################################################################################################################

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

-- ##########################################################################################################################

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
        estado AS 'Estado'
    FROM negocios n
    WHERE n.idnegocio = _idnegocio
      AND n.inactive_at IS NULL; 
END $$

-- ##########################################################################################################################

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

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_busquedas_negocios(
    IN nombre_comercial VARCHAR(200)
)
BEGIN
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
        n.portada
    FROM negocios n
    INNER JOIN personas p ON n.idpersona = p.idpersona
    INNER JOIN distritos d ON n.iddistrito = d.iddistrito
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE n.nombre LIKE CONCAT('%', nombre_comercial, '%')
    AND n.inactive_at IS NULL;
END $$

-- -------------------------------------------------------------------------------------------------
-- 											| BÚSQUEDA |
-- -------------------------------------------------------------------------------------------------


DELIMITER $$
CREATE PROCEDURE spu_busqueda_general()
BEGIN
    SELECT 
		idnegocio,
        logo,
        nombre
	FROM negocios
    WHERE inactive_at IS NULL;
END $$



-- LOGIN
DELIMITER $$
CREATE PROCEDURE spu_registrar_visita(
    IN _user_google_id VARCHAR(25),
    IN _user_first_name VARCHAR(50),
    IN _user_last_name VARCHAR(50),
    IN _user_email_address VARCHAR(100),
    IN _user_image VARCHAR(200)
)
BEGIN
    INSERT INTO visitas (user_google_id, user_first_name, user_last_name, user_email_address, user_image)
    VALUES (_user_google_id, _user_first_name, _user_last_name, _user_email_address, _user_image);
END $$

CALL spu_registrar_visita(116714666818250717371, 'Darce', 'Gg', 'alonsomunoz263@gmail.com','https://lh3.googleusercontent.com/a/ACg8ocK4pA-TGizBsFTMktodiLwXCz5YwfsVGUjM9lt2FVCe=s96-c');

SELECT * FROM comentarios;
-- REGISTRAR COMWENTARIO
DELIMITER $$
CREATE PROCEDURE spu_registrar_comentarios(
	IN _idvisita 			INT,
	IN _idnegocio 			INT,
    IN _comentario 			TEXT,
    IN _valoracion 			SMALLINT
)
BEGIN
	INSERT INTO comentarios (idvisita, idnegocio, comentarios, valoracion) VALUES
    (_idvista, _idnegocio, _comentarios, _valoracion);
END $$


-- LISTAR COMENTNARIONS
DELIMITER $$
CREATE PROCEDURE spu_listar_comentarios(IN _idnegocio INT)
BEGIN 
	SELECT 
		c.idnegocio, 
        c.idcomentario, 
        c.comentarios, 
        c.valoracion,
		v.user_first_name, 
        v.user_last_name
	FROM comentarios c
	INNER JOIN visitas v ON c.idvisita = v.idvisita
	WHERE c.idnegocio = _idnegocio;
END $$
CALL spu_listar_comentarios(1);