<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 16-09-2018
 * Time: 16:57
 */
?>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title pull-left"><p>CONFIGURACION</p></div>
            <div class="panel-title pull-right"></div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div style="margin-left: 1%;margin-right: 1%;">
                <!-- Configurar Local-->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding: 5px;">
                            <div class="panel-title pull-left"><p><b>CONFIGURAR LOCAL</b></p></div>
                            <div class="panel-title pull-right"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body" id="contenido_local">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label for="email">Nombre:</label>
                                        <input type="text" class="form-control" id="panel_nombre"
                                               value="<?= $local[0]->NOMBRE ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label for="email">Descripcion:</label>
                                        <input type="text" class="form-control" id="panel_descripcion"
                                               value="<?= $local[0]->DESCRIPCION ?>">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label for="region">Region:</label>
                                        <select name="region" id="panel_region">
                                            <?php if (is_array($regiones)) {
                                                foreach ($regiones as $region) {
                                                    if ($region['ID'] == $local[0]->ID_REGION) {
                                                        echo "<option selected value='" . $region['ID'] . "'>" . $region['DESCRIPCION'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $region['ID'] . "'>" . $region['DESCRIPCION'] . "</option>";
                                                    }
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad:</label>
                                        <select name="ciudad" id="panel_ciudad">
                                            <?php if (is_array($ciudades)) {
                                                foreach ($ciudades as $ciudad) {
                                                    if ($ciudad['ID'] == $local[0]->ID_CIUDAD) {
                                                        echo "<option selected value='" . $ciudad['ID'] . "'>" . $ciudad['DESCRIPCION'] . "</option>";
                                                    } else {
                                                        echo "<option value='" . $ciudad['ID'] . "'>" . $ciudad['DESCRIPCION'] . "</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Configurar Cargos-->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding: 5px;">
                            <div class="panel-title pull-left"><p><b>CONFIGURAR CARGOS - LOCAL</b></p></div>
                            <div class="panel-title pull-right">
                                <form class="form-inline" method="post">
                                    <div class="form-group">
                                        <select id="example1" style="width: 100%;">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="cargo" id="panel_cargo">
                                            <?php if (is_array($perfiles)) {
                                                foreach ($perfiles as $perfil) {
                                                    echo "<option value='" . $perfil->ID . "'>" . $perfil->NOMBRE . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div class="clearfix"></div>
                                    </div>
                                    <button class="btn btn-success" type="button" id="btn_agregar_cargo">AGREGAR
                                    </button>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body" id="contenido_cargo">
                            <div class="row" id="contenido_cargos_local" style="margin-left: 1%;margin-right: 1%;">
                                <table class="table table-responsive table-bordered table-striped" id="tabla_cargos">
                                    <thead>
                                    <tr>
                                        <th>NOMBRE</th>
                                        <th>USUARIO</th>
                                        <th>CARGO</th>
                                        <th>ESTADO</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (is_array($perfiles_local)) {
                                        foreach ($perfiles_local as $perfil_l) {
                                            echo "<tr>";
                                            echo "<td>" . $perfil_l->NOMBRE . "</td>";
                                            echo "<td>" . $perfil_l->USUARIO . "</td>";
                                            echo "<td>" . $perfil_l->PERFIL . "</td>";
                                            echo "<td>" . $perfil_l->ACTIVO . "</td>";
                                            echo "<td>" . $perfil_l->ACCIONES . "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Configuracion Productos -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="padding: 5px;">
                            <div class="panel-title pull-left"><p><b>CONFIGURAR PRODUCTOS</b></p></div>
                            <div class="panel-title pull-right">
                                <button class="btn btn-success" type="button" id="btn_agregar_productos"><span
                                            class="glyphicon glyphicon-plus"></span> AGREGAR PRODUCTOS
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body" id="contenido_producto">
                            <table class="table table-responsive table-bordered table-striped" id="tabla_productos">
                                <thead>
                                <tr>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>PRECIO</th>
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
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary" id="btn_confirmar_informacion"><span
                                        class="glyphicon glyphicon-ok"></span>
                                CONFIRMAR INFORMACION
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar / Editar  -->
<div class='modal fade' id='modal_agregar_editar_productos' role='dialog'>
    <div class='modal-dialog modal-lg'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title' id='titulo_agregar_editar_productos'></h4>
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
                <div class='form-group'>
                    <label class='control-label col-sm-2 col-sm-offset-2' for='precio'>Precio:</label>
                    <div class='col-sm-6'>
                        <input type='number' class='form-control' id='precio' name='precio' value=''>
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
<!-- Fin Modal Agregar / Editar  -->
<script src="<?php echo base_url('/public/js/configuracion/Base/script.js') ?>"></script>