<?php
require_once './DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/CategoriaDAO.php';

if(isset($_POST['btn_gravar'])){
    $categoria = $_POST['nome'];
    $objdao = new CategoriaDAO();

    $ret = $objdao->CadastrarCategoria($categoria);
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
                        <h2>Nova Categoria</h2>
                        <h5>Aqui você poderá cadastrar todas as suas categorias.</h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_categoria.php" method="post">
                <div class="form-group">
                    <label>Nome da categoria</label>
                    <input class="form-control" name="nome" placeholder="Digite o nome da categoria. Exemplo: conta de luz" name="nome" id="nome" maxlength="45" value="<?= isset($categoria) ? $categoria : '' ?>"/>
                </div>
                <button type="submit" name= "btn_gravar" onclick="return ValidarCategoria()" class="btn btn-success">Gravar</button>

            </div>
            </form>
            <!-- /. PAGE INNER  -->
        </div>



</body>

</html>