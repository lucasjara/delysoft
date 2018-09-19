<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 18-09-2018
 * Time: 17:39
 */
?>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title pull-left"><p>Bienvenido al Sistema : <?= $usuario->NOMBRE ?></p></div>
            <div class="panel-title pull-right"></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <?php if (isset($configuracion_local)) { ?>
                <div id="contenedor_configuracion">
                    <div class="alert alert-info">
                        <strong>Importante!</strong> se le fue asignado un local y no esta configurado todavia.
                    </div>
                    <div style="text-align: center;">
                        <form action="/configuracion/base" method="post" class="form-inline">
                            <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-cog"></span>
                                IR A
                                CONFIGURAR LOCAL
                            </button>
                        </form>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-cog"></span>
                            MODIFICAR INFORMACION PERSONAL
                        </button>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($administracion_local)) { ?>
                <div id="contenedor_configuracion">
                    <div class="alert alert-info">
                        <strong>Importante!</strong> se le fue asignado un local y no esta configurado todavia.
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
