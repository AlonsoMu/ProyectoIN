use innovacion;



INSERT INTO personas (apellidos, nombres, tipodoc, numerodoc) VALUES
('Muñoz','Alonso','DNI','74136969'),
('Hernandez','Yorghet','DNI','78654321'),
('Napa','Harold','DNI','78291819');

SELECT * FROM PERSONAS;

INSERT INTO usuarios (idpersona,correo, claveacceso, celular, nivelacceso) VALUES
(1,'alonsomunoz263@gmail.com','12345','970526015','ADM');



INSERT INTO planes (tipoplan, precio) VALUES
('FREE', 0.00),
('PREMIUM', 9.99);




INSERT INTO categorias (nomcategoria) VALUES
('comida'),
('entretenimiento'),
('tiendas');


INSERT INTO subcategorias (idcategoria, nomsubcategoria ) VALUES
(1,'pollerias'),
(2,'juegos'),
(3,'ropa');


INSERT INTO horarios (apertura, cierre, dia) VALUES
('10:00:00', '16:00:00', 'Viernes'),
('07:45:00', '16:45:00', 'Sábado'),
('08:30:00', '15:30:00', 'Domingo');



INSERT INTO ubicaciones (idhorario, latitud, longitud) VALUES
(1, -13.4180228, -76.1346424),
(2, -13.4183725, -76.1337673),
(3, -13.4128998, -76.1294291);

INSERT INTO negocios (idcliente, idusuario, idsubcategoria, idubicacion, nroruc, nombre,
 descripcion, distrito, direccion, telefono, correo, valoracion) VALUES
(1, 1, 1, 1, '12345678901', 'Norkys', 'ricos pollos a la brasa','Chincha Alta', 'Av. Principal 123', '987654321', 'info@tiendatech.com', 4),
(2, 1, 2, 2, '98765432101', 'Yump Place', 'juegos entretenidos','Chincha Alta', 'Calle Secundaria 456', '987654322', 'info@modaelegante.com', 5),
(3, 1, 3, 3, '11112222333', 'Topitop', 'lo mejor en tops','Pueblo Nuevo', 'Av. Deportiva 789', '987654323', 'info@deportesxtreme.com', 3);


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

