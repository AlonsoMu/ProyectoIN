use innovacion;



INSERT INTO personas (apellidos, nombres, tipodoc, numerodoc) VALUES
('Muñoz','Alonso','DNI','74136969'),
('Hernandez','Yorghet','DNI','72159736'),
('Napa','Harold','DNI','78291819');

SELECT * FROM PERSONAS;

INSERT INTO usuarios (idpersona,correo, claveacceso, celular, nivelacceso) VALUES
(1,'alonsomunoz263@gmail.com','12345','970526015','ADM');



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
('08:30:00', '15:30:00', 'Domingo');

SELECT *  FROM horarios;


INSERT INTO ubicaciones (idhorario, latitud, longitud) VALUES
(3, -13.4176253, -76.1345425),
(4, -13.4029212, -76.1600548),
(5, -13.4053329, -76.1272912);

INSERT INTO ubicaciones (idhorario, latitud, longitud) VALUES
(3, -13.4054328, -76.1275315);


INSERT INTO negocios (iddistrito, idpersona, idusuario, idsubcategoria, idubicacion, nroruc, nombre,
 descripcion, direccion, telefono, correo, valoracion) VALUES
(1, 1, 1, 7, 1, '12345678901', 'oishi', 'comida japonea', 'Av. Principal 123', '987654321', 'info@tiendatech.com', 4),
(6, 2, 1, 8, 2, '98765432101', 'costumbres', 'comida italiana','Calle Secundaria 456', '987654322', 'info@modaelegante.com', 5),
(7, 1, 1, 9, 3, '11112222333', 'naoky', 'comida mexicana','Av. Deportiva 789', '987654323', 'info@deportesxtreme.com', 3);

INSERT INTO negocios (iddistrito, idpersona, idusuario, idsubcategoria, idubicacion, nroruc, nombre,
 descripcion, direccion, telefono, correo, valoracion) VALUES
 (1, 1, 1, 7, 4, '1111222233', 'boulevard', 'comida japonesa','Av. Deportiva 789', '980526013', 'info@deportesxtreme.com', 3);

SELECT * FROM negocios;
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
	('chincha alta', -13.4255087, -76.1470108),
    ('alto larán', -13.4367338, -76.0884531),
    ('chavín', -13.4366365, -76.1245031),
    ('chincha baja', -13.4949757, -76.192646),
    ('el carmen', -13.4986644, -76.0630971),
    ('grocio prado', -13.2903374, -76.3373479),
    ('pueblo nuevo', -13.3193912, -76.1088001),
    ('san juan de yanac', -13.2082954, -75.9906011),
    ('san pedro de huacarpana', -13.0694787, -75.7914073),
    ('sunampe', -13.4291925, -76.1821982),
    ('tambo de mora', -13.4579713, -76.2041976);
SELECT * FROM distritos;
SELECT * FROM negocios;
SELECT * FROM ubicaciones;
SELECT * FROM horarios;
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
