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
                            <!--
                            <tr>
                                    <td><input type="checkbox" name="check"></td>
                                    <td>ZONA A</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                        <button class="btn btn-success btn-xs btn_producto" type="button"><span
                                                    class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="check"></td>
                                    <td>ZONA B</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                        <button class="btn btn-success btn-xs btn_producto" type="button"><span
                                                    class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="check"></td>
                                    <td>ZONA C</td>
                                    <td>
                                        <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                    class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                        </button>
                                        <button class="btn btn-success btn-xs btn_producto" type="button"><span
                                                    class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                            -->
                            <!--
                               <hr>
                               <h3>Detalle Zona A</h3>
                               <table class="table table-responsive table-striped table-bordered">
                                   <thead>
                                   <tr>
                                       <th>PRODUCTO</th>
                                       <th>PRECIO</th>
                                       <th>ACCIONES</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   <tr>
                                       <td>SUSHI 27 PIEZAS</td>
                                       <td>$8.500</td>
                                       <td>
                                           <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                       class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                           </button>
                                       </td>
                                   </tr>
                                   <tr>
                                       <td>SUSHI 36 PIEZAS</td>
                                       <td>$10.000</td>
                                       <td>
                                           <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                       class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                           </button>
                                       </td>
                                   </tr>
                                   <tr>
                                       <td>SUSHI 54 PIEZAS</td>
                                       <td>$13.000</td>
                                       <td>
                                           <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                       class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                           </button>
                                       </td>
                                   </tr>
                                   <tr>
                                       <td>SUSHI 63 PIEZAS</td>
                                       <td>$15.500</td>
                                       <td>
                                           <button class="btn btn-info btn-xs btn_detalle" type="button"><span
                                                       class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                           </button>
                                       </td>
                                   </tr>
                                   </tbody>
                               </table>
                               -->
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
<!-- Fin Modal Zona-->
<script src="<?php echo base_url('/public/js/configuracion/mapas/script.js') ?>"></script>
<script src="<?php echo base_url('/public/js/configuracion/mapas/mapa.js') ?>"></script>
