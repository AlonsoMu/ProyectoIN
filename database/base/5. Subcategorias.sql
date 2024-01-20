USE INNOVACION;
-- TABLA SUBCATEGORIAS

-- ---------------------------------------------------------------------------
-- 								| SUBCATEGORIAS |
-- ----------------------------------------------------------------------------

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

/*DELIMITER $$
CREATE PROCEDURE spu_subcategorias_listar(IN _idcategoria INT)
BEGIN 
    SELECT 
		sub.idsubcategoria,
		sub.nomsubcategoria
		FROM subcategorias sub
		WHERE sub.idcategoria = _idcategoria
          AND sub.inactive_at IS NULL;
END $$*/

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
    
/*DELIMITER $$
CREATE PROCEDURE spu_subcategorias_listar(IN _idcategoria INT)
BEGIN 
    SELECT 
		sub.idsubcategoria,
        cat.idcategoria,
        cat.nomcategoria,
		sub.nomsubcategoria
		FROM subcategorias sub
        INNER JOIN categorias cat ON cat.idcategoria = sub.idcategoria
		WHERE sub.idcategoria = _idcategoria
          AND sub.inactive_at IS NULL;
END $$
CALL spu_subcategorias_listar(1);*/

SELECT * FROM categorias;
SELECT * FROM subcategorias;

-- ##########################################################################################################################
