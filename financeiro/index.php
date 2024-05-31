<?php

require_once './DAO/UsuarioDAO.php';
if (isset($_POST['btnAcessar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $objdao = new UsuarioDAO();
    $ret = $objdao->ValidarLogin($email, $senha);
}



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> Controle Finaceiro: Acesso</h2>

                <h5>(Faça seu login aqui)</h5>

                <br />
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Entre com seus dados:</strong>
                    </div>
                    <div class="panel-body">
                        <?php include_once '_msg.php' ?>
                        <form role="form" action="index.php" method="post">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Seu e-mail" value="<?= isset($email) ? $email : '' ?>" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="senha" id="senha" class="form-control" placeholder="Sua senha" value="<?= isset($senha) ? $senha : ''  ?>" />
                            </div>
                            <div style="text-align: center;">
                                <button class="btn btn-success" name="btnAcessar" onclick="return ValidarLogin()">Acessar</button>
                           
                            <hr />
                            <span>Caso não tenha cadastro, </span><a href="cadastro.php">clique aqui! </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>