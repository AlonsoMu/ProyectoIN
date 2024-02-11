USE INNOVACION;
-- TABLA GALERIAS

-- ------------------------------------------------------------------------------------------------
-- 									| GALERIAS |
-- ------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_galerias_listar(IN _idnegocio INT)
BEGIN
    SELECT
        g.idgaleria,
        n.idnegocio,
        g.rutafoto
        FROM galerias g
        INNER JOIN negocios n ON n.idnegocio = g.idnegocio
        WHERE g.idnegocio = _idnegocio;
END $$

-- ##########################################################################################################################

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

-- ##########################################################################################################################
