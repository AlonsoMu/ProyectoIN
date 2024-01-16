USE innovacion;
    
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

DELIMITER $$
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
CALL spu_subcategorias_listar(1);

SELECT * FROM categorias;
SELECT * FROM subcategorias;
-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_horarios_listar()
BEGIN
	SELECT
		idhorario,
        apertura,
        cierre,
        dia
	FROM horarios
    WHERE inactive_at IS NULL;
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_ubicaciones_listar()
BEGIN
	SELECT
		u.idubicacion,
		u.latitud,
		u.longitud,
        h.idhorario,
		h.apertura,
		h.cierre,
		h.dia
	FROM
		ubicaciones u
	INNER JOIN horarios h ON u.idubicacion = h.idhorario;
END $$
CALL spu_ubicaciones_listar();
-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_negocios_listar()
BEGIN
	SELECT
    n.idnegocio,
    s.idsubcategoria,
    p.idpersona,
    n.nombre AS NombreComercial,
    s.nomsubcategoria,
    CONCAT(p.apellidos, ', ', p.nombres) AS Cliente,
    n.nroruc,
    n.telefono,
    n.whatsapp,
    n.facebook,
    n.instagram,
    n.tiktok,
    n.descripcion
	FROM negocios n
	INNER JOIN personas p ON n.idpersona = p.idpersona
	INNER JOIN usuarios u ON n.idusuario = u.idusuario
	INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria;
END $$
CALL spu_negocios_listar();
-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_galerias_listar(
	IN _idnegocio	INT
)
BEGIN
	SELECT
        idgaleria,
        rutafoto
    FROM galerias
    WHERE idnegocio = _idnegocio;
END $$

-- ##########################################################################################################################

CALL spu_galerias_listar(1);

