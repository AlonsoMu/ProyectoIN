USE INNOVACION;
-- TABLA HORARIOS

-- ------------------------------------------------------------------------------
-- 								| HORARIOS |
-- -------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_horarios_registrar(
	IN _apertura		TIME,
    IN _cierre			TIME,
    IN _dia				VARCHAR(20)
)
BEGIN
	INSERT INTO horarios
		(apertura, cierre, dia)
	VALUES
		(_apertura, _cierre, _dia);
	-- SELECT @@last_insert_id 'idhorario';
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_horarios_listar()
BEGIN
	SELECT
		idhorario,
        apertura,
        cierre,
        dia
	FROM horarios
    WHERE inactive_at IS NULL;
END $$

-- ##########################################################################################################################

/*DELIMITER $$
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
END $$*/

-- ##########################################################################################################################

/*DELIMITER $$
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
END $$*/

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_horarios_negocios(IN _idnegocio INT)
BEGIN
    SELECT h.*
    FROM horarios h
    JOIN ubicaciones u ON h.idhorario = u.idhorario
    JOIN negocios n ON u.idnegocio = n.idnegocio
    WHERE n.idnegocio = _idnegocio
    ORDER BY h.idhorario ASC;
END $$
CALL spu_horarios_negocios(1)