<?php

require_once './DAO/UtilDAO.php';
if(isset($_GET['close']) && $_GET['close'] == '1'){
   UtilDAO::Deslogar(); 
}



?>



<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">

            <li>
                <a href="meus_dados.php"><i class="fa fa-user fa-3x"></i>Meus Dados</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-pencil-square fa-3x"></i>Categoria<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_categoria.php">Nova Categoria</a>
                    </li>
                    <li>
                        <a href="consultar_categoria.php">Consultar Categoria</a>
                    </li>
                </ul>
            </li>
            <li>
            <li>
                <a href="#"><i class="fa fa-building-o fa-3x"></i>Empresa<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_empresa.php"></i>Nova Empresa</a>
                    </li>
                    <li>
                        <a href="consultar_empresa.php"></i> Consultar Empresa</a>
                    <li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-home fa-3x"></i>Conta<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_conta.php"></i>Nova Conta</a>
                    </li>
                    <li>
                        <a href="consultar_conta.php"></i>Consultar Conta</a>
                    </li>
                </ul>
            </li>
            <li>
            <li>
                <a href="#"><i class="fa fa-dollar fa-3x"></i>Movimento<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="realizar_movimento.php"></i>Realizar Movimento</a>
                    </li>
                    <li>
                        <a href="consultar_movimento.php"></i>Consultar Movimento</a>
                    </li>
                </ul>
            </li>
            <li>
            <li>
            <li>
                <a href="index.php?close=1"><i class="fa fa-power-off fa-3x"></i>Sair</a>
            </li>
        </ul>
    </div>

</nav>