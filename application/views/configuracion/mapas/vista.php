<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19-09-2018
 * Time: 12:55
 */
?>
<style type="text/css">
    #map {
        width: 100%;
        height: 800px;
    }
</style>
<div class="row" style="margin-left: 1%;margin-right: 1%;margin-top: 1%;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title pull-left"><p>CONFIGURAR ZONAS DE TRABAJO</p></div>
            <div class="panel-title pull-right">
                <button class="btn btn-primary" id="btn_agregar_zonas"><p class="glyphicon glyphicon-plus"></p> AGREGAR
                    ZONA
                    MAPA
                </button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="panel-title pull-left"><p>ZONAS DE TRABAJO</p></div>
                            <div class="panel-title pull-right">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div id="demo" class="collapse">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="panel-title pull-left"><p>ZONAS DISPONIBLES</p></div>
                            <div class="panel-title pull-right">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-striped" id="tabla_zonas_local">
                                <thead>
                                <tr>
                                    <th>SELECCIONAR</th>
                                    <th>NOMBRE ZONA</th>
                                    <th>ACCIONES</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Zona-->
<div class='modal fade' id='modal_agregar_editar_zonas' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title' id='titulo_agregar_editar_zonas'></h4>
            </div>
            <div class='modal-body'>
                <div id='modal_alerta_agregar_editar'></div>
                <div class='form-group'>
                    <label class='control-label col-sm-2 col-sm-offset-2' for='nombre'>Nombre:</label>
                    <div class='col-sm-6'>
                        <input type='text' class='form-control' id='nombre' name='nombre' value=''>
                    </div>
                    <div class='clearfix'></div>
                </div>
                <div class='form-group'>
                    <label class='control-label col-sm-2 col-sm-offset-2' for='descripcion'>Descripcion:</label>
                    <div class='col-sm-6'>
                        <input type='text' class='form-control' id='descripcion' name='Descripcion' value=''>
                    </div>
                    <div class='clearfix'></div>
                </div>
                <input type='hidden' name='id_edit' id='id_modificar'>
            </div>
            <div class='clearfix'></div>
            <div class='modal-footer'>
                <button type='submit' id='btn_agregar_modal' class='btn btn-primary'>Agregar</button>
                <button type='submit' id='btn_editar_modal' class='btn btn-primary'>Editar</button>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class='modal fade' id='modal_agregar_productos' role='dialog'>
    <div class='modal-dialog modal-lg'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title' id='titulo_agregar_productos_zonas'></h4>
            </div>
            <div class='modal-body'>
                <div id='modal_alerta_productos_zona'></div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Agregar</a></li>
                    <li><a data-toggle="tab" href="#menu1">Vincular</a></li>
                    <li><a data-toggle="tab" href="#menu2">Editar</a></li>
                </ul>
                <div class="col-md-10 col-md-offset-1">
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <br>
                            <div class="well well-sm">
                                <h4 style="text-align: center;">Formulario Registro</h4>
                                <form action="" id="formulario_productos_modal">
                                    <div class='form-group'>
                                        <label class='control-label col-sm-2 col-sm-offset-1' for='nom'>Nombre:</label>
                                        <div class='col-sm-8'>
                                            <input type='text' class='form-control' id='mdl_nom' name='nom' value=''
                                                   placeholder="Nombre del Producto">
                                        </div>
                                        <div class='clearfix'></div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='control-label col-sm-2 col-sm-offset-1'
                                               for='desc'>Descripcion:</label>
                                        <div class='col-sm-8'>
                                            <input type='text' class='form-control' id='mdl_desc' name='desc' value=''
                                                   placeholder="Descripción breve del producto">
                                        </div>
                                        <div class='clearfix'></div>
                                    </div>
                                    <div class="form-group">
                                        <label class='control-label col-sm-2 col-sm-offset-1'
                                               for='precio'>Precio:</label>
                                        <div class='col-sm-8'>
                                            <input type='number' class='form-control' id='mdl_precio' name='precio'
                                                   value='' placeholder="Precio del Producto">
                                        </div>
                                        <div class='clearfix'></div>
                                    </div>
                                    <div class="form-group">
                                        <div class="pull-right">
                                            <button class="btn btn-primary" type="button" id="btn_agregar_producto"><p
                                                        class="glyphicon glyphicon-plus"></p>
                                                AGREGAR PRODUCTO
                                            </button>
                                            <button type="reset" class="btn btn-info"><p
                                                        class="glyphicon glyphicon-file"></p> LIMPIAR
                                            </button>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <h2 style="text-align: center;">Vincular Productos</h2>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h2 style="text-align: center;">Formulario Editar</h2>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
                <input type='hidden' name='id_zona' id='id_zona'>
                <table class="table table-responsive table-striped" id="tabla_productos_zona" style="width: 100%">
                    <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>PRECIO</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class='clearfix'></div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Zona-->
<script src="<?php echo base_url('/public/js/configuracion/mapas/script.js') ?>"></script>
<script src="<?php echo base_url('/public/js/configuracion/mapas/mapa.js') ?>"></script>