USE INNOVACION;
-- TABLA CARRUSEL

-- ------------------------------------------------------------------------------------------------
-- 									| CARRUSEL |
-- ------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_carrusel_registrar(
	IN _idusuario		INT,
    IN _foto	VARCHAR(200)
)
BEGIN
	INSERT INTO carrusel
	(idusuario, foto)
	VALUES
		(_idusuario, _foto);
	SELECT @@last_insert_id 'idcarrusel';
END $$

select * from carrusel;


-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_carrusel_listar()
BEGIN
	SELECT
		idcarrusel,
        foto
	FROM carrusel
    WHERE inactive_at IS NULL;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN
	SELECT
		idusuario,
        nivelacceso
	FROM usuarios
    WHERE inactive_at IS NULL;
END $$

-- ##########################################################################################################################
