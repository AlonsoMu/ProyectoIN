use innovacion;

DELIMITER $$
CREATE PROCEDURE spu_disponible_negocio(
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

    -- Mostrar el estado del negocio
    SELECT estado AS 'Estado';
END $$

-- ##########################################################################################################################

CALL spu_disponible_negocio('sabado');


DELIMITER $$
CREATE PROCEDURE spu_disponible2_negocio(
    IN _dia_actual VARCHAR(20)
)
BEGIN
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
END $$

-- ##########################################################################################################################

CALL spu_disponible2_negocio('Domingo');

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

CALL spu_obtener_negocios_y_disponibilidad(7, 'miercoles');



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


-- PROCEDIMIENTO BUSCAR POR PRIMERA LETRA DE NEGOCIO
DELIMITER $$
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
END $$

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