<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 12:51
 */
?>
<div class='row'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class='panel-title pull-left'>ADMINISTRACION ZONAS</div>
            <div class='pull-right'>
                <button type='submit' class='btn btn-success btn-xs' title='Agregar' id='btn_agregar_zonas'><span
                            class='glyphicon glyphicon-plus'></span><b> AGREGAR ZONAS</b></button>
            </div>
            <div class='clearfix'></div>
        </div>
        <div class='panel-body'>
            <table id='tabla_zonas' class='table table-responsive'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>LOCAL</th>
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
                <div class="form-group">
                    <label class="control-label col-sm-2 col-sm-offset-2" for="local">Local:</label>
                        <div class="col-sm-6">
                            <select name="local" id="local">
                                <?php if (is_array($locales)) {
                                    foreach ($locales as $local) {
                                        echo "<option value='" . $local['ID'] . "'>" . $local['NOMBRE'] . "</option>";
                                    }
                                } ?>
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
                <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/public/js/administracion/zonas/script.js') ?>"></script>
<!-- Fin Modal Agregar / Editar  -->