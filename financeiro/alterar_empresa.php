<?php

require_once './DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once './DAO/EmpresaDAO.php';

$dao = new EmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idEmpresa = $_GET['cod'];
    $dados = $dao->DetalharEmpresa($idEmpresa);
    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btn_salvar'])) {
    $idEmpresa = $_POST['cod'];
    $nome = $_POST['nome'];
    $tel = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $ret = $dao->AlterarEmpresa($nome, $tel, $endereco, $idEmpresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;

} else if (isset($_POST['btn_excluir'])) {
    $idEmpresa = $_POST['cod'];
    $ret = $dao->ExcluirEmpresa($idEmpresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_empresa.php');
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
                        <h2>Alterar ou excluir empresa</h2>
                        <h5>Aqui você poderá alterar ou excluir todas empresas.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_empresa.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                    <div class="form-group">
                        <label>Nome da empresa </label>
                        <input class="form-control" placeholder="Digite o nome da empresa. Exemplo: Casas Bahia" name="nome" id="nome" maxlength="40" value="<?= $dados[0]['nome_empresa'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Telefone/WhatsApp</label>
                        <input class="form-control" placeholder="Digite telefone/WhattsApp (Opcional)" name="telefone" id="telefone" maxlength="12" value="<?= $dados[0]['telefone_empresa'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" placeholder="Digite o endereço da empresa (Opcional)" name="endereco" id="endereco" maxlength="45" value="<?= $dados[0]['endereco_empresa'] ?>" />
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return ValidarEmpresa()" name="btn_salvar">Salvar</button>
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
                                    <span>Nome da Empresa:</span>
                                        <strong><?= $dados[0]['nome_empresa'] ?>.</strong>
                                        <br>
                                        <span>Telefone (WhatsApp):</span>
                                        <strong><?= $dados[0]['telefone_empresa'] ?>.</strong>
                                        <br>
                                        <span>Endereço:</span>
                                        <strong><?= $dados[0]['endereco_empresa'] ?>.</strong>
                                        <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Não, cancelar!</button>
                                        <button type="submit" class="btn btn-danger" name="btn_excluir">Sim, excluir!</button>
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