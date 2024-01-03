USE innovacion;

DELIMITER $$
CREATE PROCEDURE spu_personas_buscar(
    IN nombre_apellido VARCHAR(100)
)
BEGIN
    SELECT
        p.idpersona,
        CONCAT(p.nombres, ' ', p.apellidos) AS 'Nombres y Apellidos',
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
CALL spu_personas_buscar('Harold Napa');

-- ##########################################################################################################################

DELIMITER $$
CREATE PROCEDURE spu_negocios_buscar(
    IN nombre_comercial VARCHAR(200)
)
BEGIN
    SELECT
        n.idnegocio,
        s.idsubcategoria,
        p.idpersona,
        n.nombre AS NombreComercial,
        s.nomsubcategoria,
        CONCAT(p.nombres, ' ', p.apellidos) AS Cliente,
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
    INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
    WHERE n.nombre LIKE CONCAT('%', nombre_comercial, '%');
END $$

-- ##########################################################################################################################
CALL spu_negocios_buscar('Norkys');




    

