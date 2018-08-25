<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 06-05-2018
 * Time: 0:25
 */
?>
<div class="row">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title pull-left">CREADOR GENERICO CRUD</div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-1 control-label"
                       for="titulos">Titulos:</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                           id="titulos" name="titulos"
                           placeholder="Ejem: Usuarios"
                           value=""/>
                </div>
                <label class="col-sm-1 control-label"
                       for="titulos">Controlador:</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                           id="controlador"
                           name="controlador"
                           placeholder="Ejem: Usuarios"
                           value=""/>
                </div>
                <label class="col-sm-1 control-label"
                       for="titulos">Modelo:</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                           id="modelo" name="modelo"
                           placeholder="Ejem: usuarios_model"
                           value=""/>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <label class="col-sm-1 control-label"
                       for="titulos">Alias Modelo:</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                           id="alias" name="alias"
                           placeholder="Ejem: usuarios_model"
                           value=""/>
                </div>
                <label class="col-sm-1 control-label"
                       for="titulos">Tabla:</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                           id="tabla" name="tabla"
                           placeholder="Ejem: tb_usuario"
                           value=""/>
                </div>
                <label class="col-sm-1 control-label"
                       for="helper">Helper:</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control"
                           id="helper" name="helper"
                           placeholder="Ejem: Nombre Helper Validacion"
                           value=""/>
                </div>
                <div class="clearfix"></div>
            </div>
            <button id="btn_generar_mantenedor"
                    class="btn btn-success">GENERAR
                ADMINISTRATIVO
            </button>
        </div>
        <div class="panel panel-default">
            <div class="contenedor_oculto_mensaje"></div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#menu1"
                                          data-toggle="tab">HTML</a>
                    </li>
                    <li><a href="#menu2"
                           data-toggle="tab">CSS</a></li>
                    <li><a href="#menu3"
                           data-toggle="tab">JS</a></li>
                    <li><a href="#menu4" data-toggle="tab">CONTROLADOR</a>
                    </li>
                    <li><a href="#menu5" data-toggle="tab">MODELO</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="menu1"
                         class="tab-pane fade in active">
                        <br>
                        <p>Nombre sugerido: vista.php</p>
                        <pre>
                            <code id="contenedor_html">

                            </code>
                        </pre>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <br>
                        <p>Nombre sugerido: estilo.css</p>
                        <pre>
                            <code id="contenedor_css">

                            </code>
                        </pre>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <br>
                        <p>Nombre sugerido: script.js</p>
                        <pre>
                            <code id="contenedor_js">

                            </code>
                        </pre>
                    </div>
                    <div id="menu4" class="tab-pane fade">
                        <br>
                        <p id="texto_controlador">Nombre:</p>
                        <pre>
                            <code id="contenedor_controlador">

                            </code>
                        </pre>
                    </div>
                    <div id="menu5" class="tab-pane fade">
                        <br>
                        <p id="texto_modelo">Nombre:</p>
                        <pre>
                            <code id="contenedor_modelo">

                            </code>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Agregar / Editar Usuario -->
<script src="<?php echo base_url('/public/js/administracion/generico/script.js') ?>"></script>