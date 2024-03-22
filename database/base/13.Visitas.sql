USE innovacion;

-- LOGIN
	DELIMITER $$
	CREATE PROCEDURE spu_registrar_visita(
		IN _email VARCHAR(100),
		IN _name_google VARCHAR(50),
		IN _picture VARCHAR(200)
	)
	BEGIN
		INSERT INTO visitas (email, name_google, picture)
		VALUES (_email, _name_google, _picture);
	END $$

CALL spu_registrar_visita('alonsomunoz263@gmail.com', 'Darce', 'https://lh3.googleusercontent.com/a/ACg8ocK4pA-TGizBsFTMktodiLwXCz5YwfsVGUjM9lt2FVCe=s96-c');

select * from visitas;
SELECT * FROM comentarios;
-- REGISTRAR COMWENTARIO
DELIMITER $$
CREATE PROCEDURE spu_registrar_comentarios(
	IN _idvisita				INT,
	IN _idnegocio 			INT,
    IN _comentarios			TEXT
    -- IN _valoracion 			SMALLINT
)
BEGIN
	INSERT INTO comentarios (idvisita, idnegocio, comentarios) VALUES
    (_idvisita, _idnegocio, _comentarios);
END $$

CALL spu_registrar_comentarios(1,1,'xd');
SELECT * FROM comentarios;
INSERT INTO comentarios (email, );

DELIMITER $$
CREATE PROCEDURE spu_obtener_comentarios()
BEGIN
	select * from comentarios;
END $$

DELIMITER $$
CREATE PROCEDURE spu_obtener_comentarios_id(
	IN _idnegocio INT
)
BEGIN
	SELECT c.idcomentario, c.idnegocio, c.idvisita, c.comentarios, c.valoracion, c.create_at,
           v.name_google, v.picture
    FROM comentarios c
    INNER JOIN visitas v ON c.idvisita = v.idvisita
    WHERE c.idnegocio = _idnegocio;
END $$



CALL spu_obtener_comentarios_id(1);

DELIMITER $$
CREATE PROCEDURE spu_actualizar_comentario(
    IN _idcomentario INT,
    IN _comentario TEXT
    -- IN _valoracion SMALLINT
)
BEGIN
    UPDATE comentarios
    SET comentarios = _comentario,
        -- valoracion = _valoracion,
        update_at = NOW()
    WHERE idcomentario = _idcomentario;
END $$

CALL spu_actualizar_comentario(6, 'a veces solo falta un pollito', 2);

DELIMITER $$
CREATE PROCEDURE spu_eliminar_comentario(
	IN _idcomentario		INT
)
BEGIN
	DELETE FROM comentarios
    WHERE idcomentario = _idcomentario;
END $$

CALL spu_eliminar_comentario(5);

DELIMITER $$
CREATE PROCEDURE spu_verificar_usuario(
    IN _email VARCHAR(100)
)
BEGIN
	 DECLARE cantidad INT;

    SELECT COUNT(*) INTO cantidad FROM visitas WHERE email = _email;
    
    IF cantidad > 0 THEN
        SELECT 'Existe' AS resultado;
    ELSE
        SELECT 'No existe' AS resultado;
    END IF;
END $$
CALL spu_verificar_usuario('axd@gmail.com');

DELIMITER $$
CREATE PROCEDURE spu_buscar_correo_visita(
    IN _email VARCHAR(90)
)
BEGIN
    SELECT *
    FROM visitas
    WHERE email = _email;
END $$

DELIMITER $$
CREATE PROCEDURE spu_verificar_id(
    IN _email VARCHAR(90)
)
BEGIN
    SELECT idvisita
    FROM visitas
    WHERE email = _email;
END $$
select * from visitas;


DELIMITER $$
CREATE PROCEDURE spu_obtener_idvisita_por_comentario(
    IN _idcomentario INT
)
BEGIN
     -- Obtener el ID de la visita relacionada con el comentario
    SELECT idvisita
    FROM comentarios
    WHERE idcomentario = _idcomentario;
END $$

select * from comentarios;
CALL spu_obtener_idvisita_por_comentario(1);
call spu_verificar_id('alonsomunoz263@gmail.com');