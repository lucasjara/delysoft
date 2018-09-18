<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 1:04
 */
?>
<div class='row'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class='panel-title pull-left'>ADMINISTRACION LOCALES</div>
            <div class='pull-right'>
                <button type='submit' class='btn btn-success btn-xs' title='Agregar' id='btn_agregar_locales'><span
                            class='glyphicon glyphicon-plus'></span><b> AGREGAR LOCALES</b></button>
            </div>
            <div class='clearfix'></div>
        </div>
        <div class='panel-body'>
            <table id='tabla_locales' class='table table-responsive'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>REGION</th>
                    <th>CIUDAD</th>
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
<!-- Modal Agregar / Editar  -->
<div class='modal fade' id='modal_agregar_editar_locales' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title' id='titulo_agregar_editar_locales'></h4>
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
                <div class="form-group">
                    <label class="control-label col-sm-2 col-sm-offset-2" for="region">Region:</label>
                    <div class="col-sm-6">
                        <select name="region" id="region">
                            <?php if (is_array($regiones)) {
                                foreach ($regiones as $region) {
                                    echo "<option value='" . $region['ID'] . "'>" . $region['DESCRIPCION'] . "</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2 col-sm-offset-2" for="ciudad">Ciudad:</label>
                    <div class="col-sm-6">
                        <select name="ciudad" id="ciudad">
                            <?php if (is_array($ciudades)) {
                                foreach ($ciudades as $ciudad) {
                                    echo "<option value='" . $ciudad['ID'] . "'>" . $ciudad['DESCRIPCION'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <input type='hidden' name='id_edit' id='id_modificar'>
            </div>
            <div class='clearfix'></div>
            <div class='modal-footer'>
                <button type='submit' id='btn_agregar_modal' class='btn btn-primary'>Agregar</button>
                <button type='submit' id='btn_editar_modal' class='btn btn-primary'>Editar</button>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Agregar / Editar  -->
<!-- Modal Ver Detalle Trabajadores -->
<div class='modal fade' id='modal_ver_detalle_locales' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title' id="titulo_modal_ver_detalle_locales"></h4>
            </div>
            <div class='modal-body'>
                <div id="contenedor_encargado_local">
                    <form class="form-inline" disabled="true" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="ciudad">Usuario:</label>
                            <div class="col-sm-6">
                                <select name="ciudad" id="usuario">
                                    <?php if (is_array($usuarios)) {
                                        foreach ($usuarios as $usuario) {
                                            echo "<option value='" . $usuario->ID . "'>" . $usuario->NOMBRE . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="btn_guardar_encargado" type="button">Guardar
                                    Encargado
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <input type='hidden' name='id_edit' id='id_mod_local'>
                    </form>
                </div>
                <br>
                <table id="tabla_cargos_local" class="table table-hover table-striped table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>USUARIO</th>
                        <th>CARGO</th>
                    </tr>
                    </thead>
                    <tbody id="contenedor_tabla_cargos_local">
                    </tbody>
                </table>
            </div>
            <div class='clearfix'></div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Ver Detalle Trabajadores -->
<script src="<?php echo base_url('/public/js/administracion/Locales/script.js') ?>"></script>

