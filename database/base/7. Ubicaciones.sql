USE INNOVACION;
-- TABLA UBICACIONES

-- ------------------------------------------------------------------------
-- 								| UBICACIONES |
-- ------------------------------------------------------------------------

/* FALTA CREARLO */
DELIMITER $$
CREATE PROCEDURE spu_ubicaciones_registrar(
	IN _idhorario			INT,
    IN _idnegocio 			INT,
    IN _latitud				DOUBLE,
    IN _longitud			DOUBLE
)
BEGIN
	INSERT INTO ubicaciones
		(idhorario, idnegocio, latitud, longitud)
	VALUES
		(_idhorario, idnegocio, _latitud, _longitud);
	-- SELECT @@last_insert_id 'idubicacion';
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_ubicaciones_listar()
BEGIN
	SELECT * FROM ubicaciones;
END $$

-- ##########################################################################################################################
