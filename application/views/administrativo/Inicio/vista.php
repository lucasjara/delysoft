<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 18-09-2018
 * Time: 17:39
 */
?>
<link rel="stylesheet" href="<?php echo base_url('/public/css/Morris/morris.css') ?>">
<div>
    <div class="card">
        <div class="card-header">
            <div class="float-left"><p>Bienvenido al Sistema : <?= $usuario->NOMBRE ?></p></div>
            <div class="float-right">
                <?php if (isset($administracion_local)) { ?>
                    <div id="contenedor_administracion">
                        <div class="float-right">
                            <form action="/configuracion/base" method="post" class="form-inline">
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit"><span
                                                class="fa fa-pen"></span>
                                        MODIFICAR INFORMACION LOCAL
                                    </button>
                                    &nbsp;
                                    <button class="btn btn-primary" type="button" id="btn_modificar_datos_usuario"><span
                                                class="fa fa-pen"></span>
                                        MODIFICAR INFORMACION PERSONAL
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
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
                <div class="row" id="contenedor_graficos" style="display: none;width: 100%;">
                    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="grafico_tiempo"></div>
                            </div>
                            <div class="card-footer" style="text-align: center;">Historico Cantidad de Pedidos Delivery
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="grafico_char_zonas"></div>
                            </div>
                            <div class="card-footer" style="text-align: center;">Total Obtenido por Zona</div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modal_agregar_editar_usuario">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titulo_agregar_editar_usuario"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal_alerta_agregar_editar"></div>
                <div class="form-group" style="margin-left: 1%;margin-right: 1%;">
                    <label class="control-label" for="nombres">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="">
                </div>
                <div class="form-group" style="margin-left: 1%;margin-right: 1%;">
                    <label class="control-label" for="correo">Correo:</label>
                    <input type="text" class="form-control" id="correo" name="correo" value="">
                </div>
                <input type="hidden" name="id_edit" id="id_modificar">
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_agregar_modal" class="btn btn-primary">Agregar</button>
                <button type="submit" id="btn_editar_modal" class="btn btn-primary">Editar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/public/graficos/morris.min.js') ?>"></script>
<script src="<?php echo base_url('/public/graficos/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('/public/js/administrativo/inicio/script.js') ?>"></script>
