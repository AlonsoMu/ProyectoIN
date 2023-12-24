USE innovacion;
    
DELIMITER $$
CREATE PROCEDURE spu_personas_listar()
BEGIN
	SELECT 
		idpersona,
        CONCAT(apellidos,',', nombres) 'Nombres y Apellidos',
        tipodoc,
        numerodoc
	FROM personas
    WHERE inactive_at IS NULL;
END $$

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_personas_listar()
BEGIN
	SELECT 
    idpersona,
    CONCAT(apellidos, ',', nombres) AS 'Nombres y Apellidos',
    tipodoc,
    numerodoc
	FROM personas
	WHERE inactive_at IS NULL
    AND idpersona NOT IN (
        SELECT idpersona
        FROM usuarios
    );
END $$

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

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_subcategorias_listar()
BEGIN
	SELECT
		c.nomcategoria,
		s.nomsubcategoria
	FROM categorias c
	INNER JOIN subcategorias s ON c.idcategoria = s.idcategoria;
END $$

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
	INNER JOIN personas p ON n.idcliente = p.idpersona
	INNER JOIN usuarios u ON n.idusuario = u.idusuario
	INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria;
END $$

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

