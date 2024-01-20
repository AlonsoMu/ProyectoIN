USE INNOVACION;
-- TABLA UBICACIONES

-- ------------------------------------------------------------------------
-- 								| UBICACIONES |
-- ------------------------------------------------------------------------

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

SELECT * FROM ubicaciones;
-- ##########################################################################################################################

/*DELIMITER $$
CREATE PROCEDURE spu_ubicaciones_listar()
BEGIN
	SELECT
		u.idubicacion,
		u.latitud,
		u.longitud,
        h.idhorario,
		h.apertura,
		h.cierre,
		h.dia
	FROM
		ubicaciones u
	INNER JOIN horarios h ON u.idubicacion = h.idhorario;
END $$
CALL spu_ubicaciones_listar();
*/
-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_ubicaciones_listar()
BEGIN
	SELECT * FROM ubicaciones;
END $$

