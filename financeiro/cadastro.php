<?php

require_once './DAO/UsuarioDAO.php';

if (isset($_POST['btnCadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $repSenha = $_POST['repSenha'];


    $objdao = new UsuarioDAO();

    $ret = $objdao->CadastrarUsuario($nome, $email, $senha, $repSenha);

    if ($ret == 2) {
        header("location: index.php?ret=$ret");
        exit;
    }
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

                <h2> Controle Financeiro: Cadastro</h2>

                <h5>(Faça seu cadastro aqui!)</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <div style="text-align: center;">
                        <strong> Preencha todos os campos!</strong>
                    </div>
                    </div>
                    <div class="panel-body">
                        <?php include_once '_msg.php' ?>
                        <form role="form" action="cadastro.php" method="post">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"></i></span>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Seu nome" maxlength="60" value="<?= isset($nome) ? $nome : '' ?>" />
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Seu e-mail" maxlength="50" value="<?= isset($email) ? $email : '' ?>" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Crie uma senha (mínino 6 caracteres)" maxlength="8" value="<?= isset($senha) ? $senha : '' ?>" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="repSenha" id="repSenha" class="form-control" placeholder="Repita a senha criada" value="<?= isset($repSenha) ? $repSenha : '' ?>" />
                            </div>
                            <div style="text-align: center;">
                                <button class="btn btn-primary" onclick="return ValidarCampos()" name="btnCadastrar">Cadastrar</button>
                        </form>
                        <hr />
                        Já possui cadastro? <a href="index.php">Clique aqui!</a>
                    </div>
                </div>

            </div>
        </div>


    </div>
    </div>



</body>

</html>