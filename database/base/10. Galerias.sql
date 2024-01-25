USE INNOVACION;
-- TABLA GALERIAS

-- ------------------------------------------------------------------------------------------------
-- 									| GALERIAS |
-- ------------------------------------------------------------------------------------------------
delimiter $$
create procedure spu_galeria_registrar
(
    in _idnegocio        int,
    in _rutafoto        varchar(250)
)
begin 
    declare count_foto int;

    select count(*) into count_foto
    from galerias
    where 
        idnegocio = _idnegocio;

    if count_foto <= 11 then

    insert into galerias
        (idnegocio,rutafoto)
        values
        (_idnegocio,_rutafoto);

    else

    signal     sqlstate '45000'
    set message_text = 'solo se puede ingresar 2 fotos';

    end if;
end $$
delimiter ;

DELIMITER $$
CREATE PROCEDURE spu_galerias_registrar(
	IN _idnegocio		INT,
    IN _rutafoto		VARCHAR(100)
)
BEGIN
	INSERT INTO galerias
		(idnegocio, rutafoto)
	VALUES
		(_idnegocio, NULLIF(_rutafoto, ''));
	 SELECT @@last_insert_id 'idgaleria';
END $$

CALL spu_galerias_registrar(8,'alo.jpg');
SELECT * FROM galerias;
SELECT * FROM negocios;
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
CALL spu_galerias_listar(1);

-- ##########################################################################################################################

delimiter $$
create procedure spu_galeria_registrar
(
	in _idnegocio		int,
    in _rutafoto		varchar(250)
)
begin 
	declare count_foto int;
    
    select count(*) into count_foto
    from galerias
    where 
		idnegocio = _idnegocio;
	
    if count_foto <= 11 then
    
	insert into galerias
		(idnegocio,rutafoto)
        values
        (_idnegocio,_rutafoto);
        
	else
    
    signal 	sqlstate '45000'
    set message_text = 'solo se puede ingresar 2 fotos';
    
    end if;
end $$
delimiter ;