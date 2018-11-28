<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 06-05-2018
 * Time: 0:25
 */
?>
<link rel="stylesheet" href="<?php echo base_url('/public/css/Morris/morris.css') ?>">
<div class="row">
    <div class="col-sm-12 col-xs-12 col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading" style="background-color:#00CCFF;">
                <div class="panel-title pull-left">Login al Sistema</div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <form action="/configuracion/base/login_sistema" method="post">
                        <div class="col-sm-12 col-xs-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" class="form-control" id="usuario" name="usuario"
                                       value="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       value="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12 col-lg-4 col-md-4">
                            <button type="submit" class="btn btn-primary" style="margin-top: 6%;" id="btn_login">
                                <span class="glyphicon glyphicon-ok glyphicon" style="color:greenyellow;"></span> LOGIN
                                SISTEMA
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <?php if (isset($rutas)) { ?>
                        <ul>
                            <?php foreach ($rutas as $ruta) { ?>
                                <li><a href="<?= $ruta->URL ?>"><?= $ruta->NOMBRE ?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
                <form id="formulario_web">

                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/public/graficos/morris.min.js') ?>"></script>
<script src="<?php echo base_url('/public/graficos/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('/public/js/inicio/script.js') ?>"></script>
