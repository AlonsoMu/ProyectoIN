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

CALL spu_disponible_negocio('Domingo');


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