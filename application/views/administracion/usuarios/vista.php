<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 06-05-2018
 * Time: 0:25
 */
?>
<div style="margin:1%;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title pull-left">Administracion Sistema de Usuarios</div>
            <div class="pull-right">
                <button type="submit" class="btn btn-success btn-xs" title="Agregar" id="btn_agregar_usuarios"><span
                            class="glyphicon glyphicon-plus"></span><b> Agregar Usuario</b></button>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <table id="tabla_usuarios" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>USUARIO</th>
                    <th>CORREO</th>
                    <th>ESTADO</th>
                    <th>PERFIL</th>
                    <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Agregar / Editar Usuario -->
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
                <div class="form-group">
                    <label class="control-label col-sm-2 col-sm-offset-2" for="perfil">Perfil:</label>
                    <div class="col-sm-6">
                        <select name="perfil" id="perfil">
                            <?php if (is_array($perfiles)) {
                                foreach ($perfiles as $perfil) {
                                    echo "<option value='" . $perfil['ID'] . "'>" . $perfil['NOMBRE'] . "</option>";
                                }
                            } ?>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2 col-sm-offset-2" for="usuario">Usuario:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="usuario" name="usuario" value="">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="contenedor_password">
                    <div class="form-group">
                        <label class="control-label col-sm-2 col-sm-offset-2" for="password">Contraseña:</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password" name="password" value="">
                        </div>
                        <div class="clearfix"></div>
                    </div>
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
<!-- Fin Modal Agregar / Editar Usuario -->
<script src="<?php echo base_url('/public/js/administracion/usuarios/script.js') ?>"></script>