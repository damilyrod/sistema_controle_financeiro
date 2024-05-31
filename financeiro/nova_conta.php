<?php
require_once './DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once './DAO/ContaDAO.php';

if(isset($_POST['btnSalvar'])){
$banco = $_POST['banco'];
$agencia = $_POST['agencia']; 
$numero = $_POST['numero'];
$saldo = $_POST['saldo'];

$objdao = new ContaDAO();
$ret = $objdao-> CadastrarConta($banco, $agencia, $numero, $saldo);

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
                        <?php include_once '_msg.php' ?>
                        <h2>Cadastrar conta bancária</h2>
                        <h5>Aqui você poderá cadastrar todas as suas contas bancárias.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="form-group">
                    <form action="nova_conta.php" method="post">
                    <label>Nome do banco:</label>
                    <input class="form-control" placeholder="digite o nome do banco aqui..."name="banco" id="nome" maxlength="20" value="<?= isset($banco) ? $banco : '' ?>"/>
                </div>
                <div class="form-group">
                    <label>Agência:</label>
                    <input class="form-control" placeholder="digite o número da agência aqui..." name="agencia" id="agencia" maxlength="8" value="<?= isset($agencia) ? $agencia : '' ?>" />
                </div>
                <div class="form-group">
                    <label>Número da conta:</label>
                    <input class="form-control" placeholder="digite o número da conta aqui..." name="numero" id="numero" maxlength="12" value="<?= isset($numero) ? $numero : '' ?>" />
                </div>
                <div class="form-group">
                    <label>Saldo bancário:</label>
                    <input class="form-control" placeholder="digite o saldo bancário aqui..." name="saldo" id="saldo" value="<?= isset($saldo) ? $saldo : '' ?>" />
                </div>
                <button type="submit" class="btn btn-success" onclick="return ValidarConta()" name="btnSalvar">Salvar</button>
                </form>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>