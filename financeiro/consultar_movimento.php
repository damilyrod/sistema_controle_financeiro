<?php
require_once './DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once './DAO/MovimentoDAO.php';

$tipo = '';
$dataInicio = '';
$dataFim = '';

if (isset($_POST['btnFiltrar'])) {
    $tipo = $_POST['tipo'];
    $dataInicio = $_POST['dataInicio'];
    $dataFim = $_POST['dataFim'];

    $objDAO = new MovimentoDAO();
    $movs = $objDAO->ConsultarMovimento($tipo, $dataInicio, $dataFim);

   /*  echo '<pre>';
    print_r($movs);
    echo '</pre>'; */
}else if(isset($_POST['btn_excluir'])){
    $idMov = $_POST['idMov'];
    $idConta = $_POST['idConta'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];
$dao = new MovimentoDAO();
    $ret = $dao->ExcluirMovimento($idMov, $idConta, $valor, $tipo);
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
                        <h2>Consultar Movimentações Financeiras</h2>
                        <h5>Consulte todos os movimentos de um determinado período.</h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="consultar_movimento.php" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo do movimento</label>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="">Selecione</option>
                                    <option value="0" <?= $tipo == 0 ? 'selected' : '' ?>>Todos</option>
                                    <option value="1" <?= $tipo == 1 ? 'selected' : '' ?>>Entrada</option>
                                    <option value="2" <?= $tipo == 2 ? 'selected' : '' ?>>Saída</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Data de Início</label>
                                <input type="date" class="form-control" name="dataInicio" id="dataInicio" value="<?= $dataInicio ?>" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input type="date" class="form-control" name="dataFim" id="dataFim" value="<?= $dataFim ?>" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-success" onclick="return ValidarConsultaPeriodo()" name="btnFiltrar">Filtrar Movimento</button>
                            </div>
                        </div>
                </form>
                <hr>
                <?php if (isset($movs)) { ?>
            </div>
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span> Empresas cadastradas, caso deseje alterar, clique no botão. </span>
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
                                        <th>Ação</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // o motivo da variável total é somar todos os valores encontrados pelos ARRAYS MVOS
                                    // desta forma ele sempre irá somar os valores adicionados em cada posição do ARRAY

                                    $total = 0;
                                    for ($i=0; $i < count($movs); $i++) {
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
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExcluir<?= $i ?>">Excluir</a>
                                                <form action="consultar_movimento.php" method="post">
                                                    <input type="hidden" name="idMov" value="<?= $movs[$i]['id_movimento'] ?>">
                                                    <input type="hidden" name="idConta" value="<?= $movs[$i]['id_conta'] ?>">
                                                    <input type="hidden" name="tipo" value="<?= $movs[$i]['tipo_movimento'] ?>">
                                                    <input type="hidden" name="valor" value="<?= $movs[$i]['valor_movimento'] ?>">
                                                    <div class="panel-body">
                                                        <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title" id="myModalLabel">Você realmente deseja excluir este movimento?</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <span>Data do movimento:</span>
                                                                        <strong><?= $movs[$i]['data_movimento'] ?>.</strong>
                                                                        <br>
                                                                        <span>Tipo do movimento:</span>
                                                                        <strong><?= $movs[$i]['tipo_movimento'] == 1  ? 'Entrada' : 'Saída'  ?>.</strong>
                                                                        <br>
                                                                        <span>Categoria:</span>
                                                                        <strong><?= $movs[$i]['nome_categoria'] ?>.</strong>
                                                                        <br>
                                                                        <span>Empresa:</span>
                                                                        <strong><?= $movs[$i]['nome_empresa'] ?>.</strong>
                                                                        <br>
                                                                        <span>Conta:</span>
                                                                        <strong><?= $movs[$i]['agencia_conta'] ?> - Núm. <?= $movs[$i]['numero_conta'] ?>.</strong>
                                                                        <br>
                                                                        <span>Observação:</span>
                                                                        <strong><?= isset($movs[$i]['obs_movimento']) ? $movs[$i]['obs_movimento'] : ''?></strong>
                                                                        <br>
                                                                        
                                                                        
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Não, cancelar!</button>
                                                                            <button type="submit" class="btn btn-danger" name="btn_excluir">Sim, excluir!</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
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
        <?php } ?>
        </div>
        <!-- /. PAGE INNER  -->
    </div>

</body>

</html>