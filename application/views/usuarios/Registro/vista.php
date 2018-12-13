<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 30-11-2018
 * Time: 23:57
 */
?>
<div class="row" style="margin-top:20px;">
<div class="col-md-3"></div>
<div class="col-md-6" style="margin:1%;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <form role="form">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" id="txt_nombre"
                           placeholder="Introduce un nombre">
                </div>
                <div class="form-group">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control" id="txt_usuario"
                           placeholder="Introduce un usuario">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control" id="txt_email"
                           placeholder="Introduce un email">
                </div>
                <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" class="form-control" id="txt_password"
                           placeholder="Contraseña">
                </div>
                <button type="button" class="btn btn-success" id="btn_guardar">Guardar</button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-3"></div>
</div>

<!-- Fin Modal Agregar / Editar Usuario -->
<script src="<?php echo base_url('/public/js/usuarios/registro/script.js') ?>"></script>
