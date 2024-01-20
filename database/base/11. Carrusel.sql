USE INNOVACION;
-- TABLA CARRUSEL

-- ------------------------------------------------------------------------------------------------
-- 									| CARRUSEL |
-- ------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_carrusel_registrar(
    IN _fotografia		VARCHAR(200)
)
BEGIN
	INSERT INTO carrusel
	(fotografia)
	VALUES
		(_fotografia);
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

-- ##########################################################################################################################
