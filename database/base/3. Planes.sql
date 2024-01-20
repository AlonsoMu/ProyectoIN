USE INNOVAVACION;

-- TABLA PLANES

-- ------------------------------------------------------------------------------
-- 		 							| PLANES |
-- ------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_planes_registrar(
	IN _tipoplan 	CHAR(8),
    IN _precio		DECIMAL(9,2)
)
BEGIN
	INSERT INTO planes
		(tipoplan, precio)
	VALUES
		(_tipoplan, _precio);
	-- SELECT @@last_insert_id 'idplan';
END $$