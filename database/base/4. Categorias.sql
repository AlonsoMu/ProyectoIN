USE innovacion;
-- TABLA CATEGORIAS

-- ----------------------------------------------------------------------------
-- 								| CATEGORIAS |
-- ------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_categorias_registrar(
	IN _nomcategoria		VARCHAR(50)
)
BEGIN
	INSERT INTO categorias
		(nomcategoria)
	VALUES
		(_nomcategoria);
	-- SELECT @@last_insert_id 'idcategoria';
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_categorias_listar()
BEGIN
	SELECT 
		idcategoria,
        nomcategoria
	FROM categorias
    WHERE inactive_at IS NULL;
END $$
CALL spu_categorias_listar();
SELECT * FROM categorias;
SELECT * FROM subcategorias;

-- ##########################################################################################################################