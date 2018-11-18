<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 18-09-2018
 * Time: 17:39
 */
?>
<link rel="stylesheet" href="<?php echo base_url('/public/css/Morris/morris.css') ?>">
<div style="margin:1%;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title pull-left"><p>Bienvenido al Sistema : <?= $usuario->NOMBRE ?></p></div>
            <div class="panel-title pull-right">
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
        </div>
        <?php if (isset($administracion_local)) { ?>
            <div class="row" style="padding-left: 2%;padding-right: 2%;">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title pull-left"><p>Pedidos Sin Asignar</p></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <a class="list-group-item"><input type="checkbox"
                                                                      class="form-check-input"> 5.
                                        <span style="text-decoration: none;"> <b>ZONA CENTRO</b>
                                            $ 5.000</span></a>
                                    <a class="list-group-item"><input type="checkbox"
                                                                      class="form-check-input"> 6.
                                        <span style="text-decoration: none;"> <b>ZONA CENTRO</b>
                                            $ 8.500</span></a>
                                    <a class="list-group-item"><input type="checkbox"
                                                                      class="form-check-input"> 7.
                                        <span style="text-decoration: none;"> <b>ZONA INACAP</b>
                                            $ 2.000</span></a>
                                    <a class="list-group-item"><input type="checkbox"
                                                                      class="form-check-input"> 8.
                                        <span style="text-decoration: none;"> <b>ZONA CASA</b>
                                            $ 20.000</span></a>
                                    <a class="list-group-item"><input type="checkbox"
                                                                      class="form-check-input"> 9.
                                        <span style="text-decoration: none;"><b>ZONA CENTRO</b>
                                            $ 7.000</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title pull-left"><p>Repartidores Disponibles</p></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <a class="list-group-item"> <b> Lmmans</b>
                                        <button style="text-align: center;" class="btn btn-primary btn-large">
                                            Asignar
                                        </button>
                                    </a>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title pull-left"><p>Estado Repartidores</p></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <a class="list-group-item">
                                        <span style="text-decoration: none;"> <b>Lmanns</b>
                                            En pedido 5</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title pull-left"><p>Ultimos Mensajes Telefono</p></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <a class="list-group-item">
                                        <span style="text-decoration: none;"> <b>Ljara:</b>
                                            ¿Porque la demora en el pedido 5?</span></a>
                                    <a class="list-group-item">
                                        <span style="text-decoration: none;"> <b>Lmmans:</b>
                                            llena la bencinera</span></a>
                                    <a class="list-group-item">

                                    <span style="text-decoration: none;"> <b>Lmmans:</b>
                                           Adjunto una foto.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer" style="text-align: center;">Administracion Local</div>
                </div>
            </div>
            <div class="row" style="padding-left: 1%;padding-right: 1%;">
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="grafico_tiempo"></div>
                        </div>
                        <div class="panel-footer" style="text-align: center;">Historico Cantidad de Pedidos Delivery
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="grafico_char_zonas"></div>
                        </div>
                        <div class="panel-footer" style="text-align: center;">Cantidad Pedidos por Zona</div>
                    </div>
                </div>
            </div>
        <?php } ?>
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
<script src="<?php echo base_url('/public/graficos/morris.min.js') ?>"></script>
<script src="<?php echo base_url('/public/graficos/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('/public/js/administrativo/inicio/script.js') ?>"></script>
