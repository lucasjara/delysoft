<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 23-11-2018
 * Time: 22:10
 */
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Delysoft</title>
    <!-- Icon Delysoft -->
    <link rel="shortcut icon" href="<?php echo base_url('/public/img/icon.png') ?>">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('/public/start_menu/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo base_url('/public/select2/dist/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/public/select2_bootstrap4/dist/select2-bootstrap4.css') ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css"/>
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet">
    <link href="<?php echo base_url('/public/start_menu/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('/public/start_menu/css/resume.min.css') ?>" rel="stylesheet">
    <!-- Carga Inicial por carga de plantilla-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- Datatable Bootstrap 4 -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <!-- JQUERY ALERT -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
</head>
<style>
    .select2-container {
        width: 100% !important;
    }
</style>
<nav class="navbar navbar-inverse" style="background-color: #1A1A1A; margin-bottom: 0%;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand active" style="color:white;">Delysoft - <?= $elemento_modulo ?></a>
        </div>
    </div>
</nav>
<body id="page-top">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Clarence Taylor</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2"
               src="<?php echo base_url('/public/start_menu/img/user.png') ?>" alt="">
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="/delysoft/usuarios/registro/">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="/delysoft/usuarios/listarpedidos/">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="/delysoft/usuarios/modificar/">Mis datos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#skills">CERRAR SESION</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid p-0">
    <?php echo $content_for_layout; ?>
</div>


<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url('/public/start_menu/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('/public/start_menu/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</body>
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
<!-- Inicio Modal Mod Perfil -->
<script src="<?php echo base_url('/public/select2/dist/js/select2.full.js') ?>"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
</html>
