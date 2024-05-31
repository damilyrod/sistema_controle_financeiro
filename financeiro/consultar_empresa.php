<?php
require_once './DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once './DAO/EmpresaDAO.php';


$dao = new EmpresaDAO();
$empresas = $dao->ConsultarEmpresa();

// var_dump($empresas);

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
                        <h2>Consultar Empresas</h2>
                        <h5>Consulte todas as suas empresas aqui.</h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
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
                                                <th>Nome da empresa</th>
                                                <th>Telefone/WhatsApp</th>
                                                <th>Endereço</th>
                                                <th>Ação</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($empresas as $item) {  ?>
                                            <tr class="odd gradeX">
                                                <td><?= $item['nome_empresa']?></td>
                                                <td><?= $item['telefone_empresa']?></td>
                                                <td><?= $item['endereco_empresa']?></td>
                                                <td>
                                                    <a href="alterar_empresa.php?cod=<?= $item['id_empresa'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
        </div>
    </div>

</body>

</html>