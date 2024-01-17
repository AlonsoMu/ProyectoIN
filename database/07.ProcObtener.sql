-- OBTENER
USE innovacion;

DELIMITER $$
CREATE PROCEDURE spu_obtener_negocios(IN _idsubcategoria INT)
BEGIN
    SELECT 
		n.idnegocio,
		u.idubicacion,
		u.latitud,
		u.longitud,
		n.nombre,
		n.direccion
		FROM negocios n
		INNER JOIN ubicaciones u ON n.idubicacion = u.idubicacion
		WHERE n.idsubcategoria = _idsubcategoria
        AND n.inactive_at IS NULL; 
END $$
CALL spu_obtener_negocios(3);
SELECT * FROM distritos;


DELIMITER $$
CREATE PROCEDURE spu_obtener_coordenadas(IN _iddistrito INT)
BEGIN
    SELECT *
		FROM distritos
        WHERE iddistrito = _iddistrito;
END $$
CALL spu_obtener_coordenadas(1);