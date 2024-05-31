-- Coamndo para excluir (delete)
delete from tb_usuario
where id_usuario = 11;

delete from tb_usuario
where id_usuario = 12;

delete from tb_usuario
where id_usuario = 14;

delete from tb_conta
where id_conta = 21;

delete from tb_conta
where id_conta = 22;

delete from tb_conta
where id_conta = 23;

delete from tb_conta
where id_conta = 24;

delete from tb_conta
where id_conta = 27;

delete from tb_conta
where id_conta = 28;


delete from tb_movimento
where id_movimento = 24;




-- ===================================================

-- CRUD (Create, Read, Update, Delete)
-- Delete: Excluir.

-- Deleta todo o banco de dados com todas as suas tabelas.
drop database db_exemplo;

-- Deleta a tabela especifica do banco de dados.
drop table tb_exemplo;

delete from tb_conta
	where id_conta = 1;
    
delete from tb_categoria
	where id_categoria = 1;
    
delete from tb_movimento
	where id_movimento = 1;    
    
delete from tb_empresa
	where id_empresa = 1;

-- ===================================================