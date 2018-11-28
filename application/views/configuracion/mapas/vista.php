<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19-09-2018
 * Time: 12:55
 */
?>
<style type="text/css">
    #map {
        width: 100%;
        height: 800px;
    }
</style>
<div class="row" style="margin-left: 1%;margin-right: 1%;margin-top: 1%;">
    <div class="card" style="width: 100%;">
        <div class="card-header">
            <div class="float-left"><p>CONFIGURAR ZONAS DE TRABAJO</p></div>
            <div class="float-right">
                <button type="button" class="btn btn-primary" id="btn_agregar_zonas"><span
                            class="fa fa-plus-circle"></span>
                    AGREGAR ZONA MAPA
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left"><p>ZONAS DISPONIBLES</p></div>
                            <div class="float-right">
                                <button class="btn btn-primary" id="btn_colapsar_mapa" data-toggle="collapse"
                                        data-target="#mapa_colapsado">
                                    <span class="fa fa-list-alt"></span>
                                    DESPLIEGUE
                                </button>
                            </div>
                        </div>
                        <div class="card-body collapse show" id="mapa_colapsado">
                            <table class="table table-responsive table-striped" id="tabla_zonas_local">
                                <thead>
                                <tr>
                                    <th>SELECCIONAR</th>
                                    <th>NOMBRE ZONA</th>
                                    <th>COLOR</th>
                                    <th>ACCIONES</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="contenedor_mapa" style="display: none;margin-left: 1%;">
            <div class="col-md-9 col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div id="demo" class="collapse">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="tabla_colores_zona">
                            <thead>
                            <tr>
                                <th>ZONAS</th>
                                <th>COLOR</th>
                            </tr>
                            </thead>
                            <tbody id="contenedor_zonas_colores_detalle">
                            <?php
                            if (isset($zonas_colores)) {
                                foreach ($zonas_colores as $zon_col) {
                                    echo "<tr data-id='$zon_col->ID'>";
                                    echo "<td>$zon_col->ZONA</td>";
                                    echo "<td>$zon_col->COLOR</td>";
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
    </div>
</div>
<!-- Modal Zona-->
<div class='modal fade' id='modal_agregar_editar_zonas' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4 class='modal-title' id='titulo_agregar_editar_zonas'></h4>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <div class='modal-body'>
                <div id='modal_alerta_agregar_editar'></div>
                <div class='form-group'>
                    <label class='control-label' for='nombre'>Nombre:</label>
                    <input type='text' class='form-control' id='nombre' name='nombre' value=''>
                </div>
                <div class='form-group'>
                    <label class='control-label' for='descripcion'>Descripcion:</label>
                    <input type='text' class='form-control' id='descripcion' name='Descripcion' value=''>
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
<div class='modal fade' id='modal_agregar_productos' role='dialog'>
    <div class='modal-dialog modal-lg'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h4 class='modal-title' id='titulo_agregar_productos_zonas'></h4>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <div class='modal-body'>
                <div id='modal_alerta_productos_zona'></div>
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home"
                                            data-num="1">Agregar</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1" data-num="2">Vincular</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu2" data-num="3"
                                            id="contenedor_editar_nav"
                                            style="display: none;">Editar</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade show active">
                        <div class="well well-sm" style="margin-top: 1%;">
                            <form action="" id="formulario_productos_modal">
                                <div class='form-group'>
                                    <label class='control-label' for='nom'>Nombre:</label>
                                    <input type='text' class='form-control' id='mdl_nom' name='nom' value=''
                                           placeholder="Nombre del Producto">
                                </div>
                                <div class='form-group'>
                                    <label class='control-label' for='desc'>Descripcion:</label>
                                    <input type='text' class='form-control' id='mdl_desc' name='desc' value=''
                                           placeholder="Descripción breve del producto">
                                </div>
                                <div class="form-group">
                                    <label class='control-label' for='precio'>Precio:</label>

                                    <input type='number' class='form-control' id='mdl_precio' name='precio'
                                           value='' placeholder="Precio del Producto">
                                </div>
                                <div class="form-group">
                                    <div class="float-right">
                                        <button class="btn btn-primary" type="button" id="btn_agregar_producto"><span
                                                    class="fa fa-plus-circle"></span>
                                            AGREGAR PRODUCTO
                                        </button>
                                        <button type="reset" class="btn btn-info limpiar_modal"><span
                                                    class="fa fa-trash"></span> LIMPIAR
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <div class="well well-sm" style="margin-top: 1%;">
                            <form>
                                <div class='form-group'>
                                    <label class='control-label' for='nom'>Producto:</label>
                                    <select id="select_productos_general">
                                        <?php
                                        if (isset($productos_general)) {
                                            echo "<option value='0' selected >Seleccionar</option>";
                                            for ($i = 0; $i < count($productos_general); $i++) {
                                                echo "<option value='" . $productos_general[$i]['ID'] . "'>" . $productos_general[$i]['NOMBRE'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value='sin_prod'>Sin productos Generales.</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div></div>
                                <div class="form-group">
                                    <div class="float-right">
                                        <button class="btn btn-primary" type="button" id="btn_vincular_producto"><span
                                                    class="fa fa-plus-circle"></span>
                                            VINCULAR PRODUCTO
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <div class="well well-sm" style="margin-top: 1%;">
                            <form action="" id="formulario_editar_productos_modal">
                                <div class='form-group'>
                                    <label class='control-label' for='nom'>Nombre:</label>
                                    <input type='text' class='form-control' id='mdl_nom_edit' name='nom' value=''
                                           placeholder="Nombre del Producto">
                                </div>
                                <div class='form-group'>
                                    <label class='control-label' for='desc'>Descripcion:</label>
                                    <input type='text' class='form-control' id='mdl_desc_edit' name='desc' value=''
                                           placeholder="Descripción breve del producto">
                                </div>
                                <div class="form-group">
                                    <label class='control-label' for='precio'>Precio:</label>

                                    <input type='number' class='form-control' id='mdl_precio_edit' name='precio'
                                           value='' placeholder="Precio del Producto">
                                </div>
                                <div class="form-group">
                                    <div class="float-right">
                                        <button class="btn btn-primary" type="button"
                                                id="btn_editar_producto_zona"><span
                                                    class="fa fa-plus-circle"></span>
                                            EDITAR PRODUCTO
                                        </button>
                                        <button type="reset" class="btn btn-info limpiar_modal"><span
                                                    class="fa fa-trash-o"></span> LIMPIAR
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <input type="hidden" id="id_edit_zona_producto">
                            </form>
                        </div>
                    </div>
                </div>
                <input type='hidden' name='id_zona' id='id_zona'>
                <hr style="margin-top: 1%;">
                <table class="table table-responsive w-100 d-block d-md-table" id="tabla_productos_zona">
                    <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>PRECIO</th>
                        <th>ESTADO</th>
                        <th>ACCIONES</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class='clearfix'></div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Zona-->
<script src="<?php echo base_url('/public/js/configuracion/mapas/script.js') ?>"></script>
<script src="<?php echo base_url('/public/js/configuracion/mapas/mapa.js') ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDp6WOLcXkuyv40roB6ejAjS6PXpEETAWs&libraries=drawing"
        async defer></script>