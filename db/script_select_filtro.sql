

-- exemplos de filtros

select * from tb_categoria where id_usuario = 2;

select * from tb_empresa where id_usuario = 1;

select * from tb_conta where id_usuario = 1;

select * from tb_movimento where id_usuario = 3;

select * from tb_movimento where tipo_movimento = 2 and id_usuario = 2;

select nome_usuario, data_cadastro
from tb_usuario
where nome_usuario like 'd%';

select nome_usuario, data_cadastro
from tb_usuario
where nome_usuario like '%b%';

select nome_usuario, data_cadastro
from tb_usuario
where nome_usuario like '%l';

select nome_usuario, data_cadastro
from tb_usuario
where data_cadastro between '2024-09-28' and '2024-02-04';

select data_movimento
from tb_movimento
where data_movimento between '2024-09-28' and '2024-02-04';

select banco_conta, agencia_conta, saldo_conta
from tb_conta
where id_usuario = 1;

 select tb_movimento.id_usuario,
			tipo_movimento, date_format(data_movimento, "%d/%m/%Y") as data_movimento, valor_movimento, obs_movimento,
            nome_categoria, nome_empresa, nome_usuario, banco_conta
    from   tb_movimento
inner join tb_categoria
    on     tb_categoria.id_categoria = tb_movimento.id_categoria
inner join tb_empresa
	on     tb_empresa.id_empresa = tb_movimento.id_empresa
inner join tb_usuario
	on     tb_usuario.id_usuario = tb_movimento.id_usuario
inner join tb_conta
	on     tb_conta.id_conta = tb_movimento.id_conta
    where  tb_movimento.tipo_movimento = 2
    and    tb_movimento.valor_movimento > 500;
    
select sum(valor_movimento) as total
	from   tb_movimento
	where tipo_movimento = 2
    and   id_usuario = 1