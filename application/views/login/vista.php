<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 06-05-2018
 * Time: 0:25
 */
?>
<!-- ========== MENU ========== -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand active" style="color:white;">Delysoft</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/inicio">Inicio</a></li>
            <li><a href="/login">Login</a></li>
            <li><a href="/registro">Registro</a></li>
        </ul>
    </div>
</nav>
<!-- ========== LOGIN ========== -->
<section id="contact" name="contact"></section>
<div id="f">
    <div class="container">
        <div class="row">
            <h3>LOGIN</h3>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form class="contact-form" role="form" method="POST"
                      action="/configuracion/base/login_sistema">
                    <div class="form-group">
                        <label for="contact-name"><span class="text-danger">*</span>Usuario</label>
                        <input type="text" name="usuario" class="form-control" id="usuario"
                               placeholder="Ingrese Usuario"
                               data-rule="maxlen:255" data-msg="Porfavor ingresar menos de 255 caracteres.">
                        <div class="validate"></div>
                    </div>
                    <div class="form-group">
                        <label for="contact-name"><span class="text-danger">*</span>Contraseña</label>
                        <input type="password" name="password" class="form-control" id="password"
                               placeholder="Ingrese Contraseña"
                               data-rule="maxlen:255" data-msg="Porfavor ingresar menos de 255 caracteres.">
                        <div class="validate"></div>
                    </div>
                    <div class="loading"><img
                                src="<?php echo base_url('/public/minimal/lib/php-mail-form/loading.gif') ?>"></div>
                    <div id="alerta_mensaje"></div>
                    <div class="form-send">
                        <button type="submit" class="btn btn-large" id="btn_login">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>