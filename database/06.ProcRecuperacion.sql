use innovacion;

DELIMITER $$
CREATE PROCEDURE spu_buscar_correo(
	IN _correo		VARCHAR(100)
)
BEGIN
 SELECT *
    FROM usuarios
    WHERE correo = _correo;
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_registrar_token(
	IN _correo		VARCHAR(100),
    IN _token		CHAR(6)
)
BEGIN
	UPDATE usuarios SET
		token_estado = '0', 
		token = _token,
		fechatoken = NOW()
		WHERE _correo = correo;
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_buscar_token(
	IN _correo		VARCHAR(100),
    IN _token 		CHAR(6)
)
BEGIN
	SELECT *
    FROM usuarios
    WHERE correo = _correo AND token = _token;
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_actualizar_pass(
	IN _correo			VARCHAR(100),
    IN _token			CHAR(6),
    IN _claveacceso		VARCHAR(100)
)
BEGIN 
	UPDATE usuarios SET
    claveacceso = _claveacceso,
    token_estado = '1',
    token = NULL
    WHERE correo = _correo AND token = _token;
END $$

-- ##########################################################################################################################

CALL spu_buscar_correo('alonsomunoz263@gmail.com');