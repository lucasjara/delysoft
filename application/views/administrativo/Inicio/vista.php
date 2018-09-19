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
                </div>
            <?php } ?>
            <?php if (isset($administracion_local)) { ?>
                <div id="contenedor_administracion">
                    <div class="pull-right">
                        <form action="/configuracion/base" method="post" class="form-inline">
                            <div class="form-group">
                                <button class="btn btn-success" type="submit"><span
                                            class="glyphicon glyphicon-cog"></span>
                                    MODIFICAR INFORMACION LOCAL
                                </button>
                                <button class="btn btn-primary" type="button" id="btn_modificar_datos_usuario"><span
                                            class="glyphicon glyphicon-cog"></span>
                                    MODIFICAR INFORMACION PERSONAL
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_agregar_editar_usuario" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="titulo_agregar_editar_usuario"></h4>
            </div>
            <div class="modal-body">
                <div id="modal_alerta_agregar_editar"></div>
                <div class="form-group">
                    <label class="control-label col-sm-2 col-sm-offset-2" for="nombres">Nombre:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nombre" name="nombre" value="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2 col-sm-offset-2" for="correo">Correo:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="correo" name="correo" value="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <input type="hidden" name="id_edit" id="id_modificar">
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer">
                <button type="submit" id="btn_agregar_modal" class="btn btn-primary">Agregar</button>
                <button type="submit" id="btn_editar_modal" class="btn btn-primary">Editar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/public/js/administrativo/inicio/script.js') ?>"></script>
