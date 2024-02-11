USE INNOVACION;
-- TABLA SUBCATEGORIAS

-- ---------------------------------------------------------------------------
-- 								| SUBCATEGORIAS |
-- ----------------------------------------------------------------------------
/* NO OLVIDAR    */
DELIMITER $$
CREATE PROCEDURE spu_subcategorias_registrar(
	IN _idcategoria			INT,
    IN _nomsubcategoria		VARCHAR(100)
)
BEGIN
	INSERT INTO subcategorias
		(idcategoria, nomsubcategoria)
    VALUES
		(_idcategoria, _nomsubcategoria);
	-- SELECT @@last_insert_id 'idsubcategoria';
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_subcategorias_listartodo()
BEGIN
	SELECT 
		sub.idsubcategoria,
        cat.nomcategoria,
		sub.nomsubcategoria
		FROM subcategorias sub
        INNER JOIN categorias cat ON cat.idcategoria = sub.idcategoria;
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_subcategorias_listar()
BEGIN
	SELECT * FROM subcategorias;
END $$
