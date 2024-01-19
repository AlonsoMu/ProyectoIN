CREATE DATABASE innovacion;

USE innovacion;

-- TABLAS NO CREADAS!!!!!!!!!

-- -------------------------------------------------------------------------
-- 									| TABLA PERSONAS |
-- --------------------------------------------------------------------------
CREATE TABLE personas(
	idpersona 				INT 			AUTO_INCREMENT PRIMARY KEY,
    apellidos 				VARCHAR(100)	NOT NULL,
    nombres 				VARCHAR(100) 	NOT NULL,
    tipodoc					CHAR(15) 		NOT NULL,
    numerodoc				CHAR(15) 		NOT NULL,
    create_at				DATETIME		NOT NULL DEFAULT NOW(),
    update_at				DATETIME		NULL,
    inactive_at				DATETIME 		NULL,
    CONSTRAINT uk_numerodoc_per				UNIQUE(numerodoc)
)ENGINE = INNODB;

-- -------------------------------------------------------------------------------------
--  							| TABLA USUARIOS |
-- --------------------------------------------------------------------------------------
CREATE TABLE usuarios(
	idusuario 				INT 			AUTO_INCREMENT PRIMARY KEY,
    idpersona 				INT 			NOT NULL, -- FK
    avatar 					VARCHAR(200) 	NULL,
    correo					VARCHAR(100) 	NOT NULL, -- UNIQUE
    claveacceso				VARCHAR(100) 	NOT NULL,
    celular 				CHAR(11) 		NULL,
    token 					CHAR(6) 		NULL, -- CLAVE DE RECUPERACION
    nivelacceso 			CHAR(3)			NOT NULL, -- ADM
    estado					CHAR(1) 		NOT NULL DEFAULT '1',
    create_at				DATETIME		NOT NULL DEFAULT NOW(),
    update_at				DATETIME		NULL,
    inactive_at				DATETIME 		NULL,
    CONSTRAINT fk_idpersona_per 			FOREIGN KEY(idpersona) REFERENCES personas (idpersona),
    CONSTRAINT uk_correo_per 				UNIQUE(correo)
)ENGINE = INNODB;

-- ------------------------------------------------------------------------------
-- 		 							| TABLA PLANES |
-- ------------------------------------------------------------------------------
CREATE TABLE planes(
	idplan 					INT 			AUTO_INCREMENT PRIMARY KEY,
    tipoplan 				CHAR(8) 		NOT NULL, -- FREE | PREMIUM
    precio 					DECIMAL(9,2)	NOT NULL,
    create_at				DATETIME		NOT NULL DEFAULT NOW(),
    update_at				DATETIME		NULL,
    inactive_at				DATETIME 		NULL
)ENGINE = INNODB;

-- ----------------------------------------------------------------------------
-- 								| TABLA CATEGORIAS |
-- ------------------------------------------------------------------------------
CREATE TABLE categorias(
	idcategoria 			INT 			AUTO_INCREMENT PRIMARY KEY,
    nomcategoria 			VARCHAR(50) 	NOT NULL,
    create_at				DATETIME		NOT NULL DEFAULT NOW(),
    update_at				DATETIME		NULL,
    inactive_at				DATETIME 		NULL
)ENGINE = INNODB;

-- ---------------------------------------------------------------------------
-- 								| TABLA SUBCATEGORIAS |
-- ----------------------------------------------------------------------------
CREATE TABLE subcategorias(
	idsubcategoria 			INT 			AUTO_INCREMENT PRIMARY KEY,
    idcategoria 			INT 			NOT NULL, -- FK
    nomsubcategoria 		VARCHAR(100) 	NOT NULL,
    create_at				DATETIME		NOT NULL DEFAULT NOW(),
    update_at				DATETIME		NULL,
    inactive_at				DATETIME 		NULL,
    CONSTRAINT fk_idcategoria_sub 			FOREIGN KEY (idcategoria) REFERENCES categorias (idcategoria)
)ENGINE = INNODB;

-- ------------------------------------------------------------------------------
-- 								| TABLA HORARIOS |
-- -------------------------------------------------------------------------------
CREATE TABLE horarios(
	idhorario 				INT 			AUTO_INCREMENT PRIMARY KEY,
    apertura 				TIME 			NOT NULL,
    cierre 					TIME 			NULL,
    dia 					VARCHAR(20) 	NOT NULL,
    create_at				DATETIME		NOT NULL DEFAULT NOW(),
    update_at				DATETIME		NULL,
    inactive_at				DATETIME 		NULL
)ENGINE = INNODB;

-- ------------------------------------------------------------------------
-- 								| TABLA UBICACIONES |
-- ------------------------------------------------------------------------
CREATE TABLE ubicaciones(
	idubicacion 			INT 			AUTO_INCREMENT	PRIMARY KEY,
    idhorario 				INT 			NOT NULL, -- FK
    latitud					DOUBLE 			NOT NULL,
	longitud 				DOUBLE 			NOT NULL,
    create_at				DATETIME		NOT NULL DEFAULT NOW(),
    update_at				DATETIME		NULL,
    inactive_at				DATETIME 		NULL,
    CONSTRAINT fk_idhorario_ubi				FOREIGN KEY (idhorario) REFERENCES horarios (idhorario)
)ENGINE = INNODB;
SELECT * FROM galerias;
-- -------------------------------------------------------------------------------------------------
-- 											| TABLA NEGOCIOS |
-- -------------------------------------------------------------------------------------------------
CREATE TABLE negocios(
	idnegocio 				INT 			AUTO_INCREMENT 	PRIMARY KEY,
    iddistrito				INT 			NOT NULL, -- FK | campo agregado
    idgaleria 				INT 			NOT NULL, -- FK
    idpersona 				INT 			NOT NULL, -- FK
    idusuario 				INT 			NOT NULL, -- FK
    idsubcategoria 			INT 			NOT NULL, -- FK
    idubicacion 			INT 			NOT NULL, -- FK
    nroruc 					CHAR(15) 		NULL, -- UK
    nombre					VARCHAR(200)	NOT NULL,
    descripcion 			VARCHAR(200) 	NULL,
    -- distrito 				VARCHAR(60) 	NOT NULL,
    direccion 				VARCHAR(100) 	NOT NULL,
    telefono				CHAR(11) 		NULL,
    correo 					VARCHAR(100) 	NULL,
    facebook				VARCHAR(200) 	NULL,
    whatsapp				VARCHAR(100) 	NULL,
    instagram				VARCHAR(100)	NULL,
    tiktok					VARCHAR(100)	NULL,
    logo 					VARCHAR(100) 	NULL,
    valoracion				INT 			NULL,
    create_at 				DATETIME		DEFAULT NOW(),
	update_at				DATETIME		NULL,
	inactive_at				DATETIME	 	NULL,
    CONSTRAINT fk_iddistrito_neg			FOREIGN KEY (iddistrito) REFERENCES distritos (iddistrito),
    CONSTRAINT fk_idgaleria_gal 			FOREIGN KEY (idgaleria) REFERENCES galerias (idgaleria),
    CONSTRAINT fk_idpersona_neg 			FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
    CONSTRAINT fk_idusuario_neg 			FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
    CONSTRAINT fk_idsubcategoria_neg		FOREIGN KEY (idsubcategoria) REFERENCES subcategorias (idsubcategoria),
    CONSTRAINT fk_idubicacion_neg 			FOREIGN KEY (idubicacion) REFERENCES ubicaciones (idubicacion),
    CONSTRAINT uk_nroruc_neg 				UNIQUE(nroruc)
)ENGINE = INNODB;
SELECT * FROM negocios;
-- ------------------------------------------------------------------------------------------------
-- 									| TABLA GALERIAS |
-- ------------------------------------------------------------------------------------------------
CREATE TABLE galerias(
	idgaleria 				INT 			AUTO_INCREMENT PRIMARY KEY,
    idnegocio				INT 			NOT NULL, -- FK
    rutafoto				VARCHAR(100) 	NULL,
    create_at 				DATETIME		DEFAULT NOW(),
	update_at				DATETIME		NULL,
	inactive_at				DATETIME	 	NULL,
    CONSTRAINT fk_idnegocio_gal				FOREIGN KEY(idnegocio) REFERENCES negocios (idnegocio)
)ENGINE = INNODB;

-- ------------------------------------------------------------------------------------------------------
-- 										| TABLA CONTRATOS |
-- ------------------------------------------------------------------------------------------------------
CREATE TABLE contratos(
	idcontrato 				INT 			AUTO_INCREMENT PRIMARY KEY,
    idplan 					INT 			NOT NULL, -- FK
    idnegocio 				INT 			NOT NULL, -- FK
    idusuario 				INT 			NOT NULL, -- FK
    fechainicio 			DATE			NOT NULL,
    fechafin				DATE 			NOT NULL,
    create_at 				DATETIME		DEFAULT NOW(),
	update_at				DATETIME		NULL,
	inactive_at				DATETIME	 	NULL,
    CONSTRAINT fk_idplan_con 				FOREIGN KEY (idplan) REFERENCES planes (idplan),
    CONSTRAINT fk_idnegocio_con 			FOREIGN KEY (idnegocio) REFERENCES negocios (idnegocio),
    CONSTRAINT fk_idusuario_con 			FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
    CONSTRAINT chk_fechafin_con 			CHECK (fechafin > fechainicio)
)ENGINE = INNODB;
DELETE FROM ubicaciones;
ALTER TABLE ubicaciones AUTO_INCREMENT 1;
-- Volver a activar la restricción de clave externa
SET foreign_key_checks = 1;

SELECT * FROM ubicaciones;

-- TABLA DISTRITOS
CREATE TABLE distritos(
	iddistrito					INT 			AUTO_INCREMENT PRIMARY KEY,
    nomdistrito					VARCHAR(50)		NOT NULL,
    latitud						DOUBLE 			NOT NULL,
    longitud 					DOUBLE			NOT NULL,
	create_at 				DATETIME		DEFAULT NOW(),
	update_at				DATETIME		NULL,
	inactive_at				DATETIME	 	NULL
)ENGINE = INNODB;

-- TABLA DISTRITOS
CREATE TABLE carrusel(
	idcarrusel				INT 			AUTO_INCREMENT PRIMARY KEY,
    fotografia				VARCHAR(200)	NULL,
	create_at 				DATETIME		DEFAULT NOW(),
	update_at				DATETIME		NULL,
	inactive_at				DATETIME	 	NULL
)ENGINE = INNODB;
ALTER TABLE carrusel MODIFY foto VARCHAR(200) NULL;
