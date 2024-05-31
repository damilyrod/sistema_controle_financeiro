<?php

if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}


if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}
if (isset($ret)) {
    switch ($ret) {
        case 2:
            echo '<div class="alert alert-success">Cadastro realizado com sucesso. Faça seu login!</div>';
            break;
        case 1:
            echo '<div class="alert alert-success">Ação realizada com sucesso!</div>';
            break;
        case 0:
            echo '<div class="alert alert-warning">Preencha TODOS os campos obrigatórios!</div>';
            break;
        case -1:
            echo '<div class="alert alert-danger">Ocorreu um ERRO na operação. Tente mais tarde!</div>';
            break;
        case -2:
            echo '<div class="alert alert-warning">A SENHA deve conter entre 6 e 8 caracteres!</div>';
            break;
        case -3:
            echo '<div class="alert alert-warning">As SENHAS devem ser iguais!</div>';
            break;
        case -4:
            echo '<div class="alert alert-warning">O registro não poderá ser excluído, pois está em uso!</div>';
        case -5:
            echo '<div class="alert alert-warning">E-mail já cadatrado. Digite um outro e-mail!</div>';
            break;
        case -6:
            echo '<div class="alert alert-warning">Usuário não encontrado!</div>';
            break;
        case -7:
            echo '<div class="alert alert-warning">E-mail inválido!</div>';
            break;
    }
}
