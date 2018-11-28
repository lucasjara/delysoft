<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 25-08-2018
 * Time: 23:03
 */
?>
<div style="margin:1%;">
    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class='panel-title pull-left'>Administración Sistema de Perfiles</div>
            <div class='pull-right'>
                <button type='submit' class='btn btn-success btn-xs' title='Agregar' id='btn_agregar_perfiles'><span
                            class='glyphicon glyphicon-plus'></span><b> Agregar Perfiles</b></button>
            </div>
            <div class='clearfix'></div>
        </div>
        <div class='panel-body'>
            <table id='tabla_perfiles' class='table table-responsive'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
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
<div class='modal fade' id='modal_agregar_editar_perfiles' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title' id='titulo_agregar_editar_perfiles'></h4>
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
<!-- Modal Asignar Permisos  -->
<div class='modal fade' id='modal_agregar_editar_permisos_perfil' role='dialog'>
    <div class='modal-dialog modal-lg'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Listado de Permisos Perfil</h4>
            </div>
            <div class='modal-body'>
                <form class="form-inline">
                    <div class="form-group">
                        <label for="permisos">Permiso:</label>
                        <select id="select_permisos">
                            <?php if (isset($permisos)) { ?>
                                <?php foreach ($permisos as $permiso) { ?>
                                    <option value="<?= $permiso->ID ?>"><?= $permiso->NOMBRE ?></option>
                                <?php } ?>
                            <?php } else {
                                echo "<option> NINGUN PERMISO ACTIVO</option>";
                            } ?>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" id="btn_agregar_permiso" style="margin-top: 2%;">Agregar</button>
                    <div class="clearfix"></div>
                </form>
                <hr>
                <table id='tabla_permisos_perfil' class='table table-responsive' style="width: 100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="clearfix"></div>
                <input type='hidden' id='id_perfil_edit'>
            </div>
            <div class='clearfix'></div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/public/js/administracion/perfiles/script.js') ?>"></script>
<!-- Fin Modal Agregar / Editar  -->
