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

SELECT * FROM comentarios;
-- REGISTRAR COMWENTARIO
DELIMITER $$
CREATE PROCEDURE spu_registrar_comentarios(
	IN _idvisita 			INT,
	IN _idnegocio 			INT,
    IN _comentario 			TEXT,
    IN _valoracion 			SMALLINT
)
BEGIN
	INSERT INTO comentarios (idvisita, idnegocio, comentarios, valoracion) VALUES
    (_idvista, _idnegocio, _comentarios, _valoracion);
END $$

CALL spu_registrar_comentarios(1,1, 'LO MEJOR DE LO MEJOR', 5);

DELIMITER $$
CREATE PROCEDURE spu_obtener_comentarios()
BEGIN
	select * from notas;
END $$

DELIMITER $$
CREATE PROCEDURE spu_obtener_comentarios_id(
	IN _idcomentario INT
)
BEGIN
	SELECT c.idvisita, c.idnegocio, v.email, v.name_google, v.picture, c.comentarios, c.valoracion, c.create_at
    FROM comentarios c
    INNER JOIN visitas v ON c.idvisita = v.idvisita
    WHERE c.idcomentario = _idcomentario;
END $$

CALL spu_obtener_comentarios_id(6);

DELIMITER $$
CREATE PROCEDURE spu_actualizar_comentario(
    IN _idcomentario INT,
    IN _comentario TEXT,
    IN _valoracion SMALLINT
)
BEGIN
    UPDATE comentarios
    SET comentarios = _comentario,
        valoracion = _valoracion,
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