USE INNOVACION;
-- TABLA GALERIAS

-- ------------------------------------------------------------------------------------------------
-- 									| GALERIAS |
-- ------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_galerias_registrar(
	IN _idnegocio		INT,
    IN _rutafoto		VARCHAR(100)
)
BEGIN
	INSERT INTO galerias
		(idnegocio, rutafoto)
	VALUES
		(_idnegocio, NULLIF(_rutafoto, ''));
	-- SELECT @@last_insert_id 'idgaleria';
END $$

CALL spu_galerias_registrar(1,'alo.jpg');
SELECT * FROM galerias;
-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_galerias_listar(
	IN _idnegocio	INT
)
BEGIN
	SELECT
        idgaleria,
        rutafoto
    FROM galerias
    WHERE idnegocio = _idnegocio;
END $$
CALL spu_galerias_listar(1);

-- ##########################################################################################################################

