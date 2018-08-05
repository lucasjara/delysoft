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
    <title>Sistema Base</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/public/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/select2/dist/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/select_bootstrap/dist/select2-bootstrap.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/select_bootstrap/dist/select2-bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/css/datatables.css') ?>">
    <!-- Carga Inicial por carga de plantilla-->
    <script src="<?php echo base_url('/public/js/jquery.js') ?>"></script>
</head>
<body>
<!-- comienzo banner -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div name="banner" style="color: white; height: 75px;background: linear-gradient(to right,#1F4661 , #04BBBF); ">
            <div class="row">
                <div class="col-md-10 col-lg-10 col-xs-12 col-sm-12" style="margin-left: 1%;">
                    <h1>Sistema Base Creacion Otros Sistemas</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fin banner -->
<br>
<!-- contenedor centro -->
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <?php echo $content_for_layout; ?>
        <div class="clearfix"></div>
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
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
<script src="<?php echo base_url('/public/select2/dist/js/select2.min.js') ?>"></script>
</html>

