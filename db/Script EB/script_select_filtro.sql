-- ===================================================

-- Where & Inner Join (Filtro e Relatório).

-- Exemplos de Filtros. ============================================
select * from tb_categoria where id_usuario = 2;

select * from tb_empresa where id_usuario = 1;

select * from tb_conta where id_usuario = 2;

select * from tb_movimento where id_usuario = 1;

select * from tb_movimento where tipo_movimento = 1;

select * from tb_movimento where tipo_movimento = 2 and id_usuario = 2;

select nome_usuario from tb_usuario where nome_usuario like '%alisson%';

select nome_usuario from tb_usuario where nome_usuario like '%m%';

select nome_usuario, data_cadastro from tb_usuario where data_cadastro between '2024-03-01' and '2024-04-06';

select nome_usuario, data_cadastro from tb_usuario where data_cadastro between '2024-01-01' and '2024-12-31';

-- Exemplos de Inner Join. ============================================
select nome_usuario, nome_categoria
	from tb_usuario
inner join tb_categoria
	on tb_categoria.id_usuario = tb_usuario.id_usuario;

select nome_usuario, nome_empresa, valor_movimento
	from tb_usuario
inner join tb_empresa
	on tb_empresa.id_usuario = tb_usuario.id_usuario
inner join tb_movimento
	on tb_movimento.id_usuario = tb_usuario.id_usuario;
    
select nome_empresa, valor_movimento
	from tb_empresa
inner join tb_movimento
	on tb_movimento.id_empresa = tb_empresa.id_empresa;

===================================================