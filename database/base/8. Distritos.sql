USE INNOVACION;
-- TABLA DISTRITOS

DELIMITER $$
CREATE PROCEDURE spu_obtener_coordenadas(IN _iddistrito INT)
BEGIN
    SELECT *
		FROM distritos
        WHERE iddistrito = _iddistrito;
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_distritos_listar()
BEGIN
	SELECT 
		iddistrito,
        nomdistrito,
        latitud,
        longitud
	FROM distritos
    WHERE inactive_at IS NULL;
END $$

