use innovacion;

SELECT * FROM ubicaciones;

INSERT INTO personas (apellidos, nombres, tipodoc, numerodoc) VALUES
('Muñoz','Alonso','DNI','74136969'),
('Hernandez','Yorghet','DNI','72159736');

SELECT * FROM PERSONAS;

INSERT INTO usuarios (idpersona,correo, claveacceso, celular, nivelacceso) VALUES
(2,'yorghetyauri123@gmail.com','12345','946989937','ADM');

select * from usuarios;

INSERT INTO planes (tipoplan, precio) VALUES
('FREE', 0.00),
('PREMIUM', 9.99);




INSERT INTO categorias (nomcategoria) VALUES
('Hoteles'),
('Farmacias'),
('Restaurantes'),
('Bodegas');


INSERT INTO subcategorias (idcategoria, nomsubcategoria ) VALUES
(1,'Playa'),
(1,'Urbano'),
(1,'Lujo'),
(2,'Pediátrica'),
(2,'Comercial'),
(2,'Clínica'),
(3,'Japones'),
(3,'Italiano'),
(3,'Mexicano'),
(4,'Abarrotes'),
(4,'Artesanal'),
(4,'General');


INSERT INTO horarios (apertura, cierre, dia) VALUES
('10:00:00', '16:00:00', 'lunes'),
('07:45:00', '16:45:00', 'martes'),
('11:00:00', '15:30:00', 'miercoles'),
('09:00:00', '16:00:00', 'jueves'),
('11:30:00', '16:00:00', 'Viernes'),
('07:45:00', '16:45:00', 'Sábado'),
('01:30:00', '15:30:00', 'Domingo');

SELECT *  FROM horarios;


INSERT INTO ubicaciones (idhorario, latitud, longitud) VALUES
(3, -13.4176253, -76.1345425),
(4, -13.4029212, -76.1600548),
(5, -13.4053329, -76.1272912);

INSERT INTO ubicaciones (idhorario, idnegocio, latitud, longitud) VALUES
(3, 1, 13.4176253, -76.1345425),
(4, 2, -13.4029212, -76.1600548),
(5, 3, -13.4053329, -76.1272912),
(6, 4, -13.4182674, -76.1349002);

INSERT INTO ubicaciones (idhorario, idnegocio, latitud, longitud) VALUES
(1, 1, -13.4047002, -76.1582921);



SELECT * FROM ubicaciones;
INSERT INTO negocios (iddistrito, idpersona, idusuario, idsubcategoria, nroruc, nombre,
 descripcion, direccion, telefono, correo, valoracion) VALUES
(1, 1, 1, 7, '12345678901', 'oishi', 'comida japonea', 'Av. Principal 123', '987654321', 'info@tiendatech.com', 4),
(6, 2, 1, 8, '98765432101', 'costumbres', 'comida italiana','Calle Secundaria 456', '987654322', 'info@modaelegante.com', 5),
(7, 1, 1, 9, '11112222333', 'naoky', 'comida mexicana','Av. Deportiva 789', '987654323', 'info@deportesxtreme.com', 3);

INSERT INTO negocios (iddistrito, idpersona, idusuario, idsubcategoria, nroruc, nombre,
 descripcion, direccion, telefono, correo, valoracion) VALUES
(6, 1, 1, 9, '12345672901', 'olivar', 'comida xd', 'Av. Principal 123', '987654321', 'info@tiendatech.com', 2);

-- CLAVE => 12345
UPDATE usuarios
	SET claveacceso = '$2y$10$4cRm3VvOaFVmAsetrnE5Y.hs8XexasbhwenpdZq.5kAegoJ7LZrTG';

SELECT * FROM negocios;
SELECT * FROM personas;
SELECT * FROM distritos;
SELECT * FROM galerias;
SELECT * FROM subcategorias;
SELECT * FROM ubicaciones;
INSERT INTO galerias (idnegocio, rutafoto)
VALUES
(1,'prueba.jpg'),
(2,'prueba2.jpg'),
(3,'prueba3.jpg');

INSERT INTO galerias (idnegocio, rutafoto)
VALUES
(1,'prueba4.jpg'),
(1,'prueba5.jpg'),
(1,'prueba6.jpg'),
(2,'prueba7.jpg'),
(2,'prueba8.jpg'),
(2,'prueba9.jpg'),
(3,'prueba10.jpg'),
(3,'prueba11.jpg'),
(3,'prueba12.jpg');

INSERT INTO contratos (idplan, idnegocio, idusuario, fechainicio, fechafin)
VALUES
(1, 1, 1, '2024-01-01', '2024-03-31'),
(2, 2, 1, '2024-01-15', '2024-02-15'),
(2, 3, 1, '2024-02-01', '2024-03-01');

SELECT * FROM categorias;
SELECT * FROM subcategorias;
SELECT * FROM negocios;


INSERT INTO distritos (nomdistrito, latitud, longitud)
VALUES
('chincha alta', -13.4177194, -76.1320961),
('alto larán', -13.4423379, -76.082938),
('chavín', -13.0770802, -75.9129889),
('chincha baja', -13.4589023, -76.161858),
('el carmen', -13.499493, -76.0574846),
('grocio prado', -13.3981128, -76.1562338),
('pueblo nuevo', -13.4046044, -76.1263104),
('san juan de yanac', -13.2109521, -75.7868747),
('san pedro de huacarpana', -13.122306, -75.792899),
('sunampe', -13.4275754, -76.164317),
('tambo de mora', -13.4584529, -76.1826597);

SELECT * FROM distritos;
SELECT * FROM negocios;
SELECT * FROM ubicaciones;
SELECT * FROM horarios;
SELECt  * FROM carrusel;
SELECT 
	n.idnegocio,
    s.idsubcategoria,
    d.iddistrito,
	n.nombre,
	n.descripcion,
    n.direccion,
    n.telefono,
	s.nomsubcategoria,
	d.nomdistrito
FROM negocios n
INNER JOIN subcategorias s ON n.idsubcategoria = s.idsubcategoria
INNER JOIN distritos d ON n.iddistrito = d.iddistrito
WHERE s.idsubcategoria =8 AND d.iddistrito = 6;



DELETE FROM galerias;
ALTER TABLE galerias AUTO_INCREMENT 1;
-- Volver a activar la restricción de clave externa
SET foreign_key_checks = 1;

ALTER TABLE usuarios MODIFY token_estado CHAR(1) NULL;
ALTER TABLE usuarios ADD fechatoken DATETIME NULL;