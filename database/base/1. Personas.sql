USE INNOVACION;

-- TABLA PERSONAS

-- -------------------------------------------------------------------------
-- 									| PERSONAS |
-- --------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_personas_registrar(
	IN _apellidos		VARCHAR(100),
    IN _nombres 		VARCHAR(100),
    IN _tipodoc 		VARCHAR(15),
    IN _numerodoc 		VARCHAR(15)
)
BEGIN
	INSERT INTO personas
		(apellidos, nombres, tipodoc, numerodoc)
	VALUES
		(_apellidos, _nombres, _tipodoc, _numerodoc);
	-- SELECT @@last_insert_id 'idpersona';
END $$

/*DELIMITER $$
CREATE PROCEDURE spu_personas_listar()
BEGIN
	SELECT 
		idpersona,
        CONCAT(apellidos,',', nombres) 'Nombres y Apellidos',
        tipodoc,
        numerodoc
	FROM personas
    WHERE inactive_at IS NULL;
END $$*/

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_personas_listar()
BEGIN
    SELECT 
        idpersona,
        CONCAT(nombres, ' ', apellidos) AS 'Nombres y Apellidos',
        tipodoc,
        numerodoc
    FROM personas
    WHERE inactive_at IS NULL
        AND idpersona NOT IN (
            SELECT idpersona
            FROM usuarios
        );
END $$
CALL spu_personas_listar();

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_personas_buscar(
    IN nombre_apellido VARCHAR(100)
)
BEGIN
    SELECT
        p.idpersona,
        CONCAT(p.nombres, ' ', p.apellidos) AS 'datos',
        p.numerodoc
    FROM personas p
    WHERE NOT EXISTS (
        SELECT 1
        FROM usuarios u
        WHERE u.idpersona = p.idpersona
        AND u.nivelacceso = 'ADM'
    )
    AND (
        CONCAT(p.nombres, ' ', p.apellidos) LIKE CONCAT('%', nombre_apellido, '%')
    );
END $$
CALL spu_personas_buscar('angel');
