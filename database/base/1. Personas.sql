USE INNOVACION;

-- TABLA PERSONAS

-- -------------------------------------------------------------------------
-- 									| PERSONAS |
-- --------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_personas_registrar(
	IN _apellidos		VARCHAR(100),
    IN _nombres 		VARCHAR(100),
    IN _numerodoc 		VARCHAR(15)
)
BEGIN
	INSERT INTO personas
		(apellidos, nombres, numerodoc)
	VALUES
		(_apellidos, _nombres, _numerodoc);
	SELECT @@last_insert_id 'idpersona';
END $$

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

-- ##########################################################################################################################
/* spu_buscar_cliente : Diferencia en vistas de poryecto */
DELIMITER $$
CREATE PROCEDURE spu_buscar_cliente(
    IN _cliente VARCHAR(45)
)
BEGIN
    SELECT
        p.idpersona,
        CONCAT(p.nombres, ' ', p.apellidos) AS 'datos',
        p.numerodoc,
        COUNT(n.idnegocio) AS cantidad
    FROM
        personas p
    LEFT JOIN
        negocios n ON p.idpersona = n.idpersona
    WHERE
        CONCAT(p.nombres, ' ', p.apellidos) LIKE CONCAT('%', _cliente, '%')
        AND NOT EXISTS (
            SELECT 1
            FROM usuarios u
            WHERE u.idpersona = p.idpersona
            AND u.nivelacceso = 'ADM'
        )
    GROUP BY
        p.idpersona, datos;
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_clientes_listar()
BEGIN
	SELECT
		p.idpersona,
		CONCAT(p.nombres, ' ', p.apellidos) AS 'datos',
        p.numerodoc,
		COUNT(n.idnegocio) AS cantidad
		FROM
			personas p
		LEFT JOIN
			negocios n ON p.idpersona = n.idpersona
		WHERE NOT EXISTS (
			SELECT 1
				FROM usuarios u
				WHERE u.idpersona = p.idpersona
				AND u.nivelacceso = 'ADM'
		)
		GROUP BY
		p.idpersona, datos;
END $$	

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_cliente_actualizar
(
	_idpersona			INT,
	_apellidos	 		VARCHAR(100),
	_nombres 			VARCHAR(100),
	_numerodoc 			CHAR(15)
)
BEGIN
	UPDATE personas SET
		apellidos = _apellidos,
		nombres = _nombres,
		numerodoc = _numerodoc,
		update_at = NOW()
	WHERE idpersona = _idpersona;
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_clientes_obtener(IN _idpersona INT)
BEGIN
	SELECT *
		FROM personas
		WHERE idpersona = _idpersona;
END $$
CALL spu_clientes_obtener(3);