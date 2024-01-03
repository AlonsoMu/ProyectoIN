USE innovacion;

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

-- -------------------------------------------------------------------------------------
--  							| USUARIOS |
-- --------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE  spu_usuarios_registrar(
	IN _idpersona		INT,
    IN _avatar			VARCHAR(200),
    IN _correo 			VARCHAR(100),
    IN _claveacceso 	VARCHAR(100),
    IN _celular			CHAR(11),
    IN _nivelacceso 	CHAR(3)
)
BEGIN
	INSERT INTO usuarios
		(idpersona, avatar, correo, claveacceso, celular, nivelacceso)
	VALUES
		(_idpersona, NULLIF(_avatar, ''), _correo, _claveacceso, _celular, _nivelacceso);
	-- SELECT @@last_insert_id 'idusuario';
END $$

-- ------------------------------------------------------------------------------
-- 		 							| PLANES |
-- ------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_planes_registrar(
	IN _tipoplan 	CHAR(8),
    IN _precio		DECIMAL(9,2)
)
BEGIN
	INSERT INTO planes
		(tipoplan, precio)
	VALUES
		(_tipoplan, _precio);
	-- SELECT @@last_insert_id 'idplan';
END $$

-- ----------------------------------------------------------------------------
-- 								| CATEGORIAS |
-- ------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_categorias_registrar(
	IN _nomcategoria		VARCHAR(50)
)
BEGIN
	INSERT INTO categorias
		(nomcategoria)
	VALUES
		(_nomcategoria);
	-- SELECT @@last_insert_id 'idcategoria';
END $$

-- ---------------------------------------------------------------------------
-- 								| SUBCATEGORIAS |
-- ----------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_subcategorias_registrar(
	IN _idcategoria			INT,
    IN _nomsubcategoria		VARCHAR(100)
)
BEGIN
	INSERT INTO subcategorias
		(idcategoria, nomsubcategoria)
    VALUES
		(_idcategoria, _nomsubcategoria);
	-- SELECT @@last_insert_id 'idsubcategoria';
END $$

-- ------------------------------------------------------------------------------
-- 								| HORARIOS |
-- -------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_horarios_registrar(
	IN _apertura		TIME,
    IN _cierre			TIME,
    IN _dia				VARCHAR(20)
)
BEGIN
	INSERT INTO horarios
		(apertura, cierre, dia)
	VALUES
		(_apertura, _cierre, _dia);
	-- SELECT @@last_insert_id 'idhorario';
END $$

-- ------------------------------------------------------------------------
-- 								| UBICACIONES |
-- ------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_ubicaciones_registrar(
	IN _idhorario			INT,
    IN _latitud				DOUBLE,
    IN _longitud			DOUBLE
)
BEGIN
	INSERT INTO ubicaciones
		(idhorario, latitud, longitud)
	VALUES
		(_idhorario, _latitud, _longitud);
	-- SELECT @@last_insert_id 'idubicacion';
END $$

-- -------------------------------------------------------------------------------------------------
-- 											| NEGOCIOS |
-- -------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_negocios_registrar(
	IN _idpersona 			INT,
    IN _idusuario			INT,
    IN _idsubcategoria		INT,
    IN _idubicacion			INT,
    IN _nroruc				CHAR(15),
    IN _nombre				VARCHAR(200),
    IN _descripcion 		VARCHAR(200),
    IN _distrito 			VARCHAR(60),
    IN _direccion			VARCHAR(100),
    IN _telefono			CHAR(11),
    IN _correo				VARCHAR(100),
    IN _facebook			VARCHAR(200),
    IN _whatsapp			VARCHAR(100),
    IN _instagram			VARCHAR(100),
    IN _tiktok				VARCHAR(100),
    IN _logo				VARCHAR(100),
	IN _valoracion			INT
)
BEGIN
	INSERT INTO negocios
		(idpersona, idusuario, idsubcategoria, idubicacion, nroruc, nombre, descripcion, 
		distrito, direccion, telefono, correo, facebook, whatsapp, instagram, tiktok, logo, valoracion)
    VALUES
		(_idpersona, _idusuario, _idsubcategoria, _idubicacion, _nroruc, _nombre, _descripcion, 
		_distrito, _direccion, _telefono, _correo, _facebook, _whatsapp, _instagram, _tiktok, _logo, _valoracion);
	-- SELECT @@last_insert_id 'idnegocio';
END $$

-- ------------------------------------------------------------------------------------------------
-- 									| GALERIAS |
-- ------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_galerias_registrar(
	IN _idnegocio		INT,
    IN _rutafoto		VARCHAR(100)
)
BEGIN
	INSERT INTO galerias
		(idnegocio, rutafoto)
	VALUES
		(_idnegocio, _rutafoto);
	-- SELECT @@last_insert_id 'idgaleria';
END $$

-- ------------------------------------------------------------------------------------------------------
-- 										| CONTRATOS |
-- ------------------------------------------------------------------------------------------------------

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