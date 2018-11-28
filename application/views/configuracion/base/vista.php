<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 16-09-2018
 * Time: 16:57
 */
?>
<div style="margin:1%;">
    <div class="card">
        <div class="card-body">
            <div style="margin-left: 1%;margin-right: 1%;">
                <!-- Configurar Local-->
                <div class="row">
                    <div class="card" style="width: 100%;">
                        <div class="card-header" style="padding: 5px;">
                            <div class="float-left"><p><b>CONFIGURAR LOCAL</b></p></div>
                            <div class="float-right">
                                <button type="button" class="btn btn-primary" id="btn_confirmar_informacion">
                                    <span class="fa fa-plus-circle"></span>
                                    CONFIRMAR INFORMACION DELIVERY
                                </button>
                            </div>
                        </div>
                        <div class="card-body" id="contenido_local">
                            <div class="row">
                                <form action=""></form>
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
                <!-- Fin Configuracion Local -->
                <!-- Configurar Cargos-->
                <div class="row" style="margin-top: 1%;">
                    <div class="card" style="width: 100%;">
                        <div class="card-header" style="padding: 5px;">
                            <div class="float-left"><p><b>CONFIGURAR CARGOS - LOCAL</b></p></div>
                            <div class="float-right">
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
                                    &nbsp;
                                    <button class="btn btn-success" type="button" id="btn_agregar_cargo">
                                        <span class="fa fa-plus-circle"></span> AGREGAR
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body" id="contenido_cargo" style="width: 100%;">
                            <div id="contenido_cargos_local">
                                <table class="table table-striped table-bordered dt-responsive nowrap"
                                       id="tabla_cargos">
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
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Configuracion Productos -->
                <div class="row" style="margin-top: 1%;">
                    <div class="card" style="width: 100%;">
                        <div class="card-header" style="padding: 5px;">
                            <div class="float-left"><p><b>CONFIGURAR PRODUCTOS</b></p></div>
                            <div class="float-right">
                                <button class="btn btn-success" type="button" id="btn_agregar_productos"><span
                                            class="fa fa-plus-circle""></span> AGREGAR PRODUCTOS
                                </button>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <strong>Importante!</strong> Se recomienda configurar al menos un producto general.
                        </div>
                        <div class="card-body" id="contenido_producto">
                            <div style="margin-left: 1%;margin-right: 1%;width: 100%;">
                                <table class="table table-striped table-bordered dt-responsive nowrap"
                                       id="tabla_productos">
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
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar / Editar  -->
<div class='modal fade' id='modal_agregar_editar_productos' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4 class='modal-title' id='titulo_agregar_editar_productos'></h4>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <div class='modal-body' style="margin-left: 1%;margin-right: 1%;">
                <div id='modal_alerta_agregar_editar'></div>
                <div class='form-group'>
                    <label class='control-label' for='nombre'>Nombre:</label>
                    <input type='text' class='form-control' id='nombre' name='nombre' value=''>
                </div>
                <div class='form-group'>
                    <label class='control-label' for='descripcion'>Descripcion:</label>
                    <input type='text' class='form-control' id='descripcion' name='Descripcion' value=''>
                </div>
                <div class='form-group'>
                    <label class='control-label' for='precio'>Precio:</label>
                    <input type='number' class='form-control' id='precio' name='precio' value=''>
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
<script src="<?php echo base_url('/public/js/configuracion/base/script.js') ?>"></script>