<?php

require_once './DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once './DAO/ContaDAO.php';

$dao = new ContaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idConta = $_GET['cod'];

    $dados = $dao->DetalharConta($idConta);

    if (count($dados) == 0) {
        header('location: consultar_conta.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    $idConta = $_POST['cod'];
    $banco = $_POST['banco'];
    $numero = $_POST['numero'];
    $agencia = $_POST['agencia'];
    $saldo = $_POST['saldo'];

    $ret = $dao->AlterarConta($banco, $numero, $agencia, $saldo, $idConta);

    header('location: consultar_conta.php?ret=' . $ret);
} else if (isset($_POST['btnExcluir'])) {

    $idConta = $_POST['cod'];
    $ret = $dao->ExcluirConta($idConta);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_conta.php');
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
                        <h2>Alterar Conta</h2>
                        <h5>Aqui você poderá alterar suas contas.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_conta.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">
                        <label>Nome do banco:</label>
                        <input class="form-control" placeholder="digite o nome do banco aqui..." name="banco" id="banco" maxlength="20" value="<?= $dados[0]['banco_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Agência:</label>
                        <input class="form-control" placeholder="digite o número da agência aqui..." name="agencia" id="agencia" maxlength="8" value="<?= $dados[0]['agencia_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Número da conta:</label>
                        <input class="form-control" placeholder="digite o número da conta aqui..." name="numero" id="numero" maxlength="12" value="<?= $dados[0]['numero_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Saldo bancário:</label>
                        <input class="form-control" placeholder="digite o saldo bancário aqui..." name="saldo" id="saldo" value="<?= $dados[0]['saldo_conta'] ?>" />
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return ValidarConta()" name="btnSalvar">Salvar</button>
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
                                        <span>Banco:</span>
                                        <strong><?= $dados[0]['banco_conta'] ?>.</strong>
                                        <br>
                                        <span>Agência:</span>
                                        <strong><?= $dados[0]['agencia_conta'] ?>.</strong>
                                        <br>
                                        <span>Número da Conta:</span>
                                        <strong><?= $dados[0]['numero_conta'] ?>.</strong>
                                        <br>
                                        <span>Saldo da Conta:</span>
                                        <strong><?= $dados[0]['saldo_conta'] ?>.</strong>
                                        <br>
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
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>