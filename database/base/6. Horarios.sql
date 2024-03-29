USE INNOVACION;
-- TABLA HORARIOS

-- ------------------------------------------------------------------------------
-- 								| HORARIOS |
-- -------------------------------------------------------------------------------

/* NO OLVIDAR CREAR */
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

/* falta crear XS*/
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
