<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 01-12-2018
 * Time: 19:12
 */?>

<div class="row" style="margin-top:20px;">
<div class="col-md-3"></div>
<div class="col-md-6" style="margin:1%;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <form role="form">
                <div id="modal_alerta_agregar_editar"></div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" id="txt_nombre"
                           placeholder="Introduce un nombre" value="<?= $usuarios->NOMBRE?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control" id="txt_usuario"
                           placeholder="Introduce un usuario" value="<?= $usuarios->USUARIO?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" id="txt_email"
                           placeholder="Introduce un email" value="<?= $usuarios->CORREO?>" disabled>
                </div>
                <div class="form-group">
                    <label for="">Ingrese su Contraseña para confirmar</label>
                    <button style="margin-left:10px;" class="btn btn-link well" href="#div_hide" id="btn_new_password" disabled>Nueva contraseña</button>
                    <input type="password" class="form-control" id="txt_password"
                           placeholder="Contraseña" disabled>
                </div>

                <div class="form-group well oculto" id="div_hide" >
                    <label for="">Ingrese una nueva Contraseña</label>
                    <input type="password" class="form-control" id="txt_new_password"
                           placeholder="Nueva Contraseña" >
                </div>
                <button type="button" class="btn btn-primary" id="btn_editar">Editar</button>
                <button type="button" class="btn btn-danger" id="btn_cancelar" disabled>Cancelar</button>
                <button type="button" class="btn btn-success" id="btn_guardar" disabled>Guardar</button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-3"></div>
</div>

<!-- Fin Modal Agregar / Editar Usuario -->
<script src="<?php echo base_url('/public/js/usuarios/modificar/script.js') ?>"></script>