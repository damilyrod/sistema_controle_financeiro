<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CategoriaDAO extends Conexao
{
    public function CadastrarCategoria($nome)
    {
        if (trim($nome) == '') {
            return 0;
        } else {
            //return 1;

            // 1 passo - criar uma variável que receberá o objeto de conexao
            $conexao = parent::retornarConexao();

            // 2 passo - criar uma variável que receberá o texto do comando SQL que deverá ser executado no banco de dados
            $comando_sql = 'insert into tb_categoria(nome_categoria, id_usuario)values (?,?);';

            // 3 passo - criar um objeto que será configurado e levado no BD para ser executado
            $sql = new PDOStatement();

            // 4 passo - colocar dentro do obj $sql a conexão para executar o comando_sql
            $sql = $conexao->prepare($comando_sql);

            // 5 passo - verificar se no comando_sql eu tenho ? para ser configurado. Se tiver, configurar os bindValues(valor vinculado)
            $sql->bindValue(1, $nome);
            $sql->bindValue(2, UtilDAO::UsuarioLogado());
        }
        try {
            // 6 passo - executar no BD
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    public function AlterarCategoria($nome, $idCategoria)
    {
        if (trim($nome) == '' || $idCategoria == '') {
            return 0;
        } else {
            $conexao = parent::retornarConexao();
            $comando_sql = 'update tb_categoria set nome_categoria = ? where id_categoria = ? and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $idCategoria);
            $sql->bindValue(3, UtilDAO::UsuarioLogado());

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
    }
    public function ConsultarCategoria()
    {
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_categoria, nome_categoria from tb_categoria where id_usuario = ? order by nome_categoria ASC';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::UsuarioLogado());
// realizar uma consulta via PDO de todos os dados solicitados pelo script sql
//essa consulta realizada via PDO, retorna os dados em um array.
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        return $sql->fetchAll();
    }

    public function DetalharCategoria($idCategoria)
    { if($idCategoria == ''){
        return 0;
    }else{
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_categoria, nome_categoria from tb_categoria where id_categoria = ? and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::UsuarioLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
    }
    public function ExcluirCategoria($idCategoria)
    {
        if ($idCategoria == '') {
            return 0;
        }else{
            $conexao = parent::retornarConexao();
            $comando_sql = 'delete from tb_categoria where id_categoria = ? and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idCategoria);
            $sql->bindValue(2, UtilDAO::UsuarioLogado());
    
    
            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                return -4;
            }
        }
    }
}
