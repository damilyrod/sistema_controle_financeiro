<?php
// verificação de permissão para acesso (sessão do usuário)
require_once './DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
// fim da verificação de acesso!!!
require_once './DAO/MovimentoDAO.php';
$dao = new MovimentoDAO();
$total_entrada = $dao->TotalEntrada();
$total_saida = $dao->TotalSaida();
$movs = $dao->MostrarUltimosLancamentos();


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
                        <h2>Sistema de Controle Financeiro</h2>
                        <h5>Seja bem-vindo(a), <strong><?= UtilDAO::NomeLogado() ?></strong> este é seu sistema web de controle financeiro.</h5>
                        <h5>Todos os módulos da aplicação, estão no menu lateral.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>R$ <?= $total_entrada[0]['total'] != '' ? number_format($total_entrada[0]['total'], 2, ',', '.') : '0' ?></h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            <span>Total de Entrada</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>R$ <?= $total_saida[0]['total'] != '' ? number_format($total_saida[0]['total'], 2, ',', '.') : '0' ?></h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            <span>Total de Saída</span>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if (count($movs) > 0) { ?>
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span>Últimas 10 operações realizadas </span>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Data do Movimento</th>
                                                <th>Tipo de Movimento</th>
                                                <th>Categoria</th>
                                                <th>Empresa</th>
                                                <th>Conta</th>
                                                <th>Valor</th>
                                                <th>Observação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // o motivo da variável total é somar todos os valores encontrados pelos ARRAYS MVOS
                                            // desta forma ele sempre irá somar os valores adicionados em cada posição do ARRAY

                                            $total = 0;
                                            for ($i = 0; $i < count($movs); $i++) {
                                                if ($movs[$i]['tipo_movimento'] == 1) {
                                                    $total = $total + $movs[$i]['valor_movimento'];
                                                } else {
                                                    $total = $total - $movs[$i]['valor_movimento'];
                                                }
                                            ?>
                                                <tr class="odd gradeX">
                                                    <td><?= $movs[$i]['data_movimento'] ?></td>
                                                    <td><?= $movs[$i]['tipo_movimento'] == 1  ? 'Entrada' : 'Saída' ?></td>
                                                    <td><?= $movs[$i]['nome_categoria'] ?></td>
                                                    <td><?= $movs[$i]['nome_empresa'] ?></td>
                                                    <td><?= $movs[$i]['banco_conta'] ?> / Ag. <?= $movs[$i]['agencia_conta'] ?> - Núm. <?= $movs[$i]['numero_conta'] ?> </td>
                                                    <td>R$<?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></td>
                                                    <td><?= $movs[$i]['obs_movimento'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <div style="text-align: center;">
                                        <span style=" color: <?= $total < 0 ? 'red' : 'green' ?>"><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                <?php } else { ?>
                    <div style="text-align: center;">
                        <div class="alert alert-info col-md-12">
                            <span>Não existe nenhum movimento para ser exibido!</span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->
    <!-- /. PAGE WRAPPER  -->

</body>

</html>