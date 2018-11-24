<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 14-01-2018
 * Time: 20:40
 */
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delysoft</title>
    <link rel="shortcut icon" href="<?php echo base_url('/public/img/icon.png') ?>">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/public/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/select2/dist/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/select_bootstrap/dist/select2-bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/select_bootstrap/dist/select2-bootstrap.min.css') ?>"
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css"/>
    <!-- Carga Inicial por carga de plantilla-->
    <script src="<?php echo base_url('/public/js/jquery.js') ?>"></script>
</head>
<body style="background-color: #222222;">
<!-- ========== MENU ========== -->
<nav class="navbar navbar-inverse" style="background-color: #1A1A1A; margin-bottom: 0%;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand active" style="color:white;">Delysoft</a>
        </div>
    </div>
</nav>

<!-- contenedor centro -->
<div class="container-fluid" style="padding: 0px;">
    <div class="col-md-2 col-sm-12 col-xs-12 col-lg-2" style="padding-left: 0px;">
        <div class="sidebar-nav" style="height:100%;">
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".sidebar-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="visible-xs navbar-brand">Menu</span>
                </div>
                <div class="navbar-collapse collapse sidebar-navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a>Menu</a></li>
                        <?php
                        if (isset($rutas)) {?>
                            <?php foreach ($rutas as $ruta) { ?>
                                <li><a href="<?= $ruta->URL ?>"><?= $ruta->NOMBRE ?></a></li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
            <style>
                @media (min-width: 768px) {
                    .sidebar-nav .navbar .navbar-collapse {
                        padding: 0;
                        max-height: none;
                    }

                    .sidebar-nav .navbar ul {
                        float: none;
                        display: block;
                    }

                    .sidebar-nav .navbar li {
                        float: none;
                        display: block;
                    }

                    .sidebar-nav .navbar li a {
                        padding-top: 12px;
                        padding-bottom: 12px;
                    }
                }
            </style>
        </div>
    </div>
    <div class="col-md-10 col-sm-12 col-xs-12 col-lg-10">
        <div class="panel panel-default" style="margin-top: 1%;">
            <?php echo $content_for_layout; ?>
        </div>
    </div>
</div>

<!-- fin contenedor centro -->
</body>
<style>
    .select2 {
        width: 100% !important;
    }

    .dataTables_filter {
        width: 50%;
        float: right;
        text-align: right;
    }
</style>
<!-- Inicio Modal Generico -->
<div class="modal fade" id="modal_generico" tabindex="-1"
     role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h3 id="titulo_modal_generico"></h3>
            </div>
            <div class="modal-body">
                <h4 id="modal_generico_body"></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Generico -->
<script src="<?php echo base_url('/public/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('/public/js/datatables.js') ?>"></script>
<script src="<?php echo base_url('/public/js/integracion_datatables.js') ?>"></script>
<script src="<?php echo base_url('/public/select2/dist/js/select2.full.js') ?>"></script>
</html>
