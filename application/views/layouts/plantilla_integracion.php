<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 17-11-2018
 * Time: 22:35
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 25-10-2018
 * Time: 23:44
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Delysoft</title>
    <link rel="shortcut icon" href="<?php echo base_url('/public/img/icon.png') ?>" >
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="<?php echo base_url('/public/minimal/img/favicon.png') ?>" rel="icon">
    <link href="<?php echo base_url('/public/minimal/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,300,700|EB+Garamond" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="<?php echo base_url('/public/minimal/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="<?php echo base_url('/public/minimal/lib/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="<?php echo base_url('/public/minimal/css/style.css') ?>" rel="stylesheet">

    <!-- =======================================================
      Template Name: Minimal
      Template URL: https://templatemag.com/minimal-bootstrap-template/
      Author: TemplateMag.com
      License: https://templatemag.com/license/
    ======================================================= -->
</head>
<body data-spy="scroll" data-offset="0" data-target="#theMenu" style="background-color: #1A1A1A;">
<?php echo $content_for_layout; ?>
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
<!-- JavaScript Libraries -->
<script src="<?php echo base_url('/public/minimal/lib/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('/public/minimal/lib/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('/public/minimal/lib/php-mail-form/validate.js') ?>"></script>
<script src="<?php echo base_url('/public/minimal/lib/easing/easing.min.js') ?>"></script>

<!-- Template Main Javascript File -->
<script src="<?php echo base_url('/public/minimal/js/main.js') ?>"></script>
<script src="<?php echo base_url('/public/js/inicio/script_tarreo.js') ?>"></script>
</html>

