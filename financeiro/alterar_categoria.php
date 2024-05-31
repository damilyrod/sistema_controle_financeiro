<?php

require_once './DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

    require_once './DAO/CategoriaDAO.php';

    //objeto global
    $dao = new CategoriaDAO();

    if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
        $idCategoria = $_GET['cod'];

        $dados = $dao->DetalharCategoria($idCategoria);

        //var_dump($dados);

        //Se tem alguma coisa dentro do array $dados
        if (count($dados) == 0) {
            header('location: consultar_categoria.php');
            exit;
        }
    } else if (isset($_POST['btnSalvar'])) {
        $idCategoria = $_POST['cod'];
        $nome = $_POST['nome'];

        $ret = $dao->AlterarCategoria($nome, $idCategoria);

        header('location: consultar_categoria.php?ret=' . $ret);
        exit;
    } else if (isset($_POST['btnExcluir'])) {
        $idCategoria = $_POST['cod'];
        
        $ret = $dao->ExcluirCategoria($idCategoria);

        header('location: consultar_categoria.php?ret=' . $ret);
        exit;
    } else {
        header('location: consultar_categoria.php');
        exit;
    }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php'; ?>
                        <h2>Alterar ou excluir categoria</h2>
                        <h5>Aqui você poderá alterar ou excluir suas categorias.</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_categoria.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>" />
                    <div class="form-group">
                        <label>Nome da categoria</label>
                        <input class="form-control" placeholder="Digite o nome da categoria. Exemplo: conta de luz" name="nome" id="nome" maxlength="45" value="<?= $dados[0]['nome_categoria'] ?>" />
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return ValidarCategoria()" name="btnSalvar">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button>
                    <div class="panel-body">
                        <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Você realmente deseja excluir?</h4>
                                    </div>
                                    <div class="modal-body">
                                    <span>Categoria:</span>
                                    <strong><?= $dados[0]['nome_categoria']?>.</strong>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Não, cancelar!</button>
                                        <button type="submit" class="btn btn-danger" name="btnExcluir">Sim, excluir!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->
</body>

</html>