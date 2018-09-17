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
                                        <input type="email" class="form-control" id="nombre">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label for="email">Descripcion:</label>
                                        <input type="email" class="form-control" id="descripcion">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label for="region">Region:</label>
                                        <select name="region" id="region">
                                            <?php if (is_array($regiones)) {
                                                foreach ($regiones as $region) {
                                                    echo "<option value='" . $region['ID'] . "'>" . $region['DESCRIPCION'] . "</option>";
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12 col-lg-3 col-md-3">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad:</label>
                                        <select name="ciudad" id="ciudad">
                                            <?php if (is_array($ciudades)) {
                                                foreach ($ciudades as $ciudad) {
                                                    echo "<option value='" . $ciudad['ID'] . "'>" . $ciudad['DESCRIPCION'] . "</option>";
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
                            <div class="panel-title pull-right"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body" id="contenido_cargo">
                            <div class="row" style="margin-left: 1%;margin-right: 1%;">
                                <div class="well" style="padding: 5px;">
                                    <div class="pull-right">
                                        <form class="form-inline" method="post">
                                            <div class="form-group">
                                                <select id="example1" style="width: 100%;">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <select name="cargo" id="cargo">
                                                    <?php if (is_array($perfiles)) {
                                                        foreach ($perfiles as $perfil) {
                                                            echo "<option value='" . $perfil->ID . "'>" . $perfil->NOMBRE . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="clearfix"></div>
                                            </div>
                                            <button class="btn btn-success" type="button">AGREGAR</button>
                                        </form>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
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
                                            echo "<td>" . $perfil_l->ESTADO . "</td>";
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
                            <div class="panel-title pull-right"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body" id="contenido_producto">
                            <div class="alert alert-info"><strong>Atencion!</strong> Es necesario agregar por lo
                                menos un producto para avanzar en la configuración.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-lg-12 col-md-12">
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary">CONFIRMAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/public/js/configuracion/Base/script.js') ?>"></script>