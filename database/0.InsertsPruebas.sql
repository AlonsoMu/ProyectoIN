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
('10:00:00', '16:00:00', 'Viernes'),
('07:45:00', '16:45:00', 'Sábado'),
('08:30:00', '15:30:00', 'Domingo');



INSERT INTO ubicaciones (idhorario, latitud, longitud) VALUES
(1, -13.4180228, -76.1346424),
(2, -13.4183725, -76.1337673),
(3, -13.4128998, -76.1294291);

INSERT INTO negocios (idpersona, idusuario, idsubcategoria, idubicacion, nroruc, nombre,
 descripcion, distrito, direccion, telefono, correo, valoracion) VALUES
(1, 1, 1, 1, '12345678901', 'Norkys', 'ricos pollos a la brasa','Chincha Alta', 'Av. Principal 123', '987654321', 'info@tiendatech.com', 4),
(2, 1, 2, 2, '98765432101', 'Yump Place', 'juegos entretenidos','Chincha Alta', 'Calle Secundaria 456', '987654322', 'info@modaelegante.com', 5),
(3, 1, 3, 3, '11112222333', 'Topitop', 'lo mejor en tops','Pueblo Nuevo', 'Av. Deportiva 789', '987654323', 'info@deportesxtreme.com', 3);

SELECT * FROM negocios;

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