<?php
require_once './DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once 'DAO/EmpresaDAO.php';

if(isset($_POST['btn_salvar'])){
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $objdao = new EmpresaDAO();
    $ret = $objdao->CadastrarEmpresa($nome, $telefone, $endereco);
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
                        <?php include_once '_msg.php';?>
                        <h2>Nova Empresa</h2>
                        <h5>Aqui você poderá cadastrar todos os nomes das empresas.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_empresa.php" method="post">
                <div class="form-group">
                    <label>Nome da empresa</label>
                    <input class="form-control" name= "nome" id="nome" placeholder="Digite o nome da empresa. Exemplo: Casas Bahia" maxlength="40" value="<?= isset($nome) ? $nome : ''?>" />
                </div>
                <div class="form-group">
                    <label>Telefone/WhatsApp</label>
                    <input class="form-control" name= "telefone" id="telefone" placeholder="Digite telefone/WhattsApp (Opcional)" maxlength="12" value="<?= isset($telefone) ? $telefone : ''?>" />
                </div>
                <div class="form-group">
                    <label>Endereço</label>
                    <input class="form-control" name= "endereco"  id="endereco" placeholder="Digite o endereço da empresa (Opcional)" maxlength="45" value="<?= isset($endereco) ? $endereco : ''?>" />
                </div>
                <button type="submit" name="btn_salvar" onclick="return ValidarEmpresa()" class="btn btn-success">Salvar</button>
                </form>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</body>

</html>