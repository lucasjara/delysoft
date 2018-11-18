<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 15:31
 */
?>
<div style="margin:1%;">
    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class='panel-title pull-left'>ADMINISTRACION PEDIDOS</div>
            <div class='clearfix'></div>
        </div>
        <div class='panel-body'>
            <table id='tabla_pedidos' class='table table-responsive'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>LOCAL</th>
                    <th>FECHA</th>
                    <th>ESTADO PEDIDO</th>
                    <th>TOTAL</th>
                    <th>USUARIO ENCARGADO</th>
                    <th>USUARIO SOLICITA</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Crear Pedido  -->
<div class='modal fade' id='modal_agregar_editar_pedidos' role='dialog'>
    <div class='modal-dialog modal-lg'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title' id='titulo_agregar_editar_pedidos'></h4>
            </div>
            <div class='modal-body'>
                <div id='modal_alerta_agregar_editar'></div>
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-md-3">
                        <label class="col-sm-2 control-label" for="id">ID: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" id="id" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-md-3 control-label" for="local">LOCAL: </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control input-sm" id="local" value="" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="col-sm-4 control-label" for="fecha">FECHA: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control input-sm" id="fecha" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-sm-5">
                        <label class="col-sm-6 control-label" for="estado_pedido">ESTADO PEDIDO: </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm" id="estado_pedido" value="" disabled>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-sm-3 control-label" for="numero_ip" style="padding-right: 0px;">IP: </label>
                        <div class="col-sm-9" style="padding-left: 0px;">
                            <input type="text" class="form-control input-sm" id="numero_ip" value="" disabled>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label class="col-sm-3 control-label" for="total">TOTAL: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" id="total" value="" disabled>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-sm-6">
                        <label class="col-sm-3 control-label" for="usuario_encargado">ENCARGADO: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" id="usuario_encargado" value="" disabled>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-3 control-label" for="usuario_solicita">SOLICITA: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" id="usuario_solicita" value="" disabled>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-right">
                            <button id="ver_detalle_tracking" class="btn btn-primary btn-xs">VER DETALLE TRACKING
                            </button>
                        </div>
                    </div>
                </div>
                <hr style="margin-top: 5px;">
                <div class="row">
                    <div class="col-sm-12">
                        <table id='tabla_detalle_pedido' class='table table-responsive table-striped' style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>PRODUCTO</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO</th>
                                <th>TOTAL</th>
                                <th>ESTADO</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type='hidden' name='id_edit' id='id_modificar'>
            </div>
            <div class='clearfix'></div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Crear Pedido  -->
<script src="<?php echo base_url('/public/js/administracion/pedidos/script.js') ?>"></script>
