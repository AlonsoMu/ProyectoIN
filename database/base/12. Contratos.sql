USE INNOVACION;
-- TABLA CONTRATOS

-- ------------------------------------------------------------------------------------------------------
-- 										| CONTRATOS |
-- ------------------------------------------------------------------------------------------------------
/* FALTA CREAR - OJITO */
DELIMITER $$
CREATE PROCEDURE spu_contratos_registrar(
	IN _idplan			INT,
    IN _idnegocio		INT,
    IN _idusuario		INT,
    IN _fechainicio		DATE,
    IN _fechafin		DATE
)
BEGIN 
	INSERT INTO negocios
		(idplan, idnegocio, idusuario, fechainicio, fechafin)
	VALUES
		(idplan, idnegocio, idusuario, fechainicio, fechafin);
	-- SELECT @@last_insert_id 'idcontrato';
END $$