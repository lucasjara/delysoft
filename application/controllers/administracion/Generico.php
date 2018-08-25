<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 25-08-2018
 * Time: 14:40
 */

class Generico extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'array_utf8', 'validaciones', 'form_validator');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model("/administracion/perfiles_model");
        $data["perfiles"] = $this->perfiles_model->obtener_perfiles();
        $this->layout->setLayout("plantilla");
        $this->layout->view('vista', $data);
    }

    public function generar_mantenedor()
    {
        $resultados = new stdClass();
        $resultados->html = $this->formato_html();
        $resultados->js = $this->formato_js();
        $resultados->modelo = $this->formato_modelos();
        $resultados->controlador = $this->formato_controlador();
        $resultados->respuesta = 'S';
        $this->output->set_content_type('application/json')->set_output(json_encode(($resultados)));
    }
    private function formato_controlador(){
        $titulo = $this->input->post('titulos');
        $tabla = $this->input->post('tabla');
        $alias = $this->input->post('alias');
        $modelo = $this->input->post('modelo');
        $controlador = $this->input->post('controlador');
        $helper = $this->input->post('helper');
        $caracter ="$";
        $formato = "
        class $controlador extends CI_Controller
        {
            public function __construct()
            {
                parent::__construct();
                $caracter+this->load->helper('url', 'array_utf8', 'validaciones', 'form_validator');
                $caracter+this->load->library('session');
                $caracter+this->load->library('form_validation');
            }

            public function index()
            {
                $caracter+this->layout->setLayout('plantilla');
                $caracter+this->layout->view('vista');
            }

            public function obtener_listado_$titulo()
            {
                $caracter+mensaje = new stdClass();
                $caracter+this->load->model('/administracion/$modelo');
                if (validarUsuario(false)) {
                    $caracter+datos = $caracter+this->$alias&->obtener_listado_$titulo();
                    for ($caracter+i = 0; $caracter+i < count($caracter+datos); $caracter+i++) {
                        $caracter+datos[$caracter+i]['ACCIONES'] = $caracter+this->formato_acciones($caracter+datos[$caracter+i]);
                        $caracter+datos[$caracter+i]['ACTIVO'] = $caracter+this->formato_activo($caracter+datos[$caracter+i]['ACTIVO']);
                    }
                    $caracter+mensaje->data = $caracter+datos;
                    $caracter+mensaje->respuesta = 'S';
                } else {
                    $caracter+mensaje->respuesta = 'No hay mano';
                }
                $caracter+this->output->set_content_type('application/json')->set_output(json_encode($caracter+mensaje));
            }

            public function agregar_$titulo()
            {
                $caracter+mensaje = new stdClass();
                $caracter+this->load->helper('array_utf8');
                if (validarUsuario(true)) {
                    $caracter+validator = $helper('agregar');
                    if ($caracter+validator->respuesta == 'S') {
                        $caracter+this->load->model('/administracion/$modelo', '$alias');
                        $caracter+descripcion = $caracter+this->input->post('descripcion');
                        $caracter+this->$alias&->ingresar_$titulo($caracter+descripcion);
                        $caracter+mensaje->respuesta = 'S';
                        $caracter+mensaje->data = '$titulo Modificado Correctamente';
                    } else {
                        $caracter+mensaje->respuesta = 'N';
                        $caracter+mensaje->data = $caracter+validator->mensaje;
                    }
                } else {
                    $caracter+mensaje->respuesta = 'N';
                    $caracter+mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
                }
                $caracter+this->output->set_content_type('application/json')->set_output(json_encode($caracter+mensaje));
            }

            public function editar_$titulo()
            {
                $caracter+mensaje = new stdClass();
                $caracter+this->load->helper('array_utf8');
                if (validarUsuario(true)) {
                    $caracter+validator = $helper('editar');
                    if ($caracter+validator->respuesta == 'S') {
                        $caracter+this->load->model('/administracion/$modelo');
                        $caracter+id = $caracter+this->input->post('id');
                        $caracter+descripcion = $caracter+this->input->post('descripcion');
                        $caracter+this->$alias&->editar_$titulo($caracter+id, $caracter+descripcion);
                        $caracter+mensaje->respuesta = 'S';
                        $caracter+mensaje->data = '$titulo Modificado Correctamente';
                    } else {
                        $caracter+mensaje->respuesta = 'N';
                        $caracter+mensaje->data = validation_errors();
                    }
                } else {
                    $caracter+mensaje->respuesta = 'N';
                    $caracter+mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
                }
                $caracter+this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($caracter+mensaje)));
            }

            public function cambiar_estado_$titulo()
            {
                $caracter+mensaje = new stdClass();
                $caracter+this->load->helper('array_utf8');
                if (validarUsuario(true)) {
                    $caracter+validator = $helper('estado');
                    if ($caracter+validator->respuesta == 'S') {
                        $caracter+this->load->model('/administracion/$modelo');
                        $caracter+id = $caracter+this->input->post('id');
                        $caracter+perfil = $caracter+this->input->post('estado');
                        if ($caracter+perfil == 'S') {
                            $caracter+this->$alias&->cambia_estado_$titulo($caracter+id, 'N');
                            $caracter+mensaje->respuesta = 'S';
                        } elseif ($caracter+perfil == 'N') {
                            $caracter+this->$alias&->cambia_estado_$titulo($caracter+id, 'S');
                            $caracter+mensaje->respuesta = 'S';
                        } else {
                            $caracter+mensaje->respuesta = 'N';
                            $caracter+mensaje->data = 'Error formato estado';
                        }
                    } else {
                        $caracter+mensaje->respuesta = 'N';
                        $caracter+mensaje->data = $caracter+validator->mensaje;
                    }
                } else {
                    $caracter+mensaje->respuesta = 'N';
                    $caracter+mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
                }
                $caracter+this->output->set_content_type('application/json')->set_output(json_encode($caracter+mensaje));
            }
            ";
        $formato .="
            private function formato_activo($caracter+respuesta)
            {
                if ($caracter+respuesta === 'S') {
                    $caracter+respuesta = &'''<button class='btn btn-success btn-xs' type='button'>ACTIVO</button>&''';
                } else {
                    $caracter+respuesta = &'''<button class='btn btn-danger btn-xs' type='button'>INACTIVO</button>&''';
                }
                return $caracter+respuesta;
            }
            private function formato_acciones($caracter+data)
            {
                $caracter+respuesta = &'''<button class='btn btn-primary btn-xs btn_editar' type='button' data-id=&''' . $caracter+data['ID'] . &''' &''' .
                    &''' data-descripcion=&''' . $caracter+data['DESCRIPCION'] . &''' &'''. $caracter+data['ACTIVO'] . &''' ><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>\";
                if ($caracter+data['ACTIVO'] == 'S') {
                    $caracter+respuesta .= &''' <button class='btn btn-success btn-xs btn_estado' type='button' data-id=&''' . $caracter+data['ID'] . &''' data-activo=&''' . $caracter+data['ACTIVO'] . &'''><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>&''';
                } else {
                    $caracter+respuesta .= &''' <button class='btn btn-danger btn-xs btn_estado' type='button' data-id=&''' . $caracter+data['ID'] . &''' data-activo=&''' . $caracter+data['ACTIVO'] . &'''><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>&''';
                }
                return $caracter+respuesta;
            }
    }
";
        $formato= str_replace("$+", "$", $formato);
        $formato= str_replace("&-", "-", $formato);
        $formato= str_replace("&'''", "\"", $formato);
        /*

        }";
        */
        return $formato;
    }
    private function formato_modelos(){
        $titulo = $this->input->post('titulos');
        $tabla = $this->input->post('tabla');
        $alias = $this->input->post('alias');
        $caracter ="$";
        $formato = "
        class $alias extends CI_Model
        {
            public function obtener()
            {
                $caracter+this->db->select('*')
                    ->from('$tabla');
                $caracter+query = $caracter+this->db->get();
                return $caracter+query->result();
            }
            public function obtener_listado_$titulo()
            {
                $caracter+this->db->select('
                            $titulo.ID,
                            $titulo.DESCRIPCION,
                            $titulo.ACTIVO
                ')
                ->from('$tabla $titulo');
                $caracter+query = $caracter+this->db->get();
                return $caracter+query->result_array();
            }
            public function ingresar_$titulo($caracter+descripcion)
            {
                $caracter+this->db->set('DESCRIPCION', $caracter+descripcion);
                $caracter+this->db->insert('$tabla');
                return $caracter+this->db->insert_id();
            }
            public function cambia_estado_$titulo($caracter+id,$caracter+estado)
            {
                $caracter+this->db->set('ACTIVO', $caracter+estado);
                $caracter+this->db->where('ID', $caracter+id);
                return $caracter+this->db->update('$tabla');
            }
            public function editar_$titulo($caracter+id, $caracter+descripcion)
            {
                $caracter+this->db->set('DESCRIPCION', $caracter+descripcion);
                $caracter+this->db->where('ID', $caracter+id);
                return $caracter+this->db->update('$tabla');
            }
        }";
        $formato= str_replace("$+", "$", $formato);
        return $formato;
    }
    private function formato_js()
    {
        $titulo = $this->input->post('titulos');
        $formato = "
$(document).ready(function () {
    // Variables Globales
    var tabla = $('#tabla_$titulo')
    var btn_agregar = $('#btn_agregar_$titulo')
    var modal_alerta_agregar_editar = $('#modal_alerta_agregar_editar')
    var mdl_agregar_editar = $('#modal_agregar_editar_$titulo')
    var mdl_titulo_agregar_editar = $('#titulo_agregar_editar_$titulo')
    var mdl_btn_agregar = $('#btn_agregar_modal')
    var mdl_btn_editar = $('#btn_editar_modal')
    var mdl_descripcion = $('#descripcion')
    var mdl_id_edit = $('#id_modificar')
    // Fin Variables Globales
    // Carga Inicial Web
    var table = tabla.DataTable({
        'language': {
            'url': '/delysoft/public/Spanish.json',
        },
        'ajax': {
            'url': '/delysoft/administracion/$titulo/obtener_listado_$titulo',
            'datatype': 'json',
            'dataSrc': 'data',
            'type': 'post',
        },
        'columns': [
            {'data': 'ID'},
            {'data': 'DESCRIPCION'},
            {'data': 'ACCIONES'},
        ],
    })
    // Fin Carga Inicial Web
    // Eventos
    btn_agregar.on('click', function () {
        limpieza_modal()
        mdl_btn_agregar.show()
        mdl_titulo_agregar_editar.text('Agregar $titulo Sistema')
        mdl_agregar_editar.modal('show')
    })
    tabla.on('click', '.btn_editar', function () {
        limpieza_modal()
        mdl_btn_editar.show()
        mdl_titulo_agregar_editar.text('Editar $titulo Sistema')
        // Carga de datos modal Editar
        mdl_id_edit.val($(this).attr('data-id'))
        mdl_descripcion.val($(this).attr('data-descripcion'))
        mdl_agregar_editar.modal('show')
    })
    // Agregar $titulo
    mdl_btn_agregar.on('click', function () {
        var array = {
            'descripcion': mdl_descripcion.val()
        }
        var request = envia_ajax('/delysoft/administracion/$titulo/agregar_$titulo', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                mdl_agregar_editar.modal('hide')
                table.ajax.reload();
            }
            else {
                modal_alerta_agregar_editar.html(data.data)
                modal_alerta_agregar_editar.addClass('alert alert-danger')
            }
        })
    })
    // Editar $titulo
    mdl_btn_editar.on('click', function () {
        var array = {
            'id': mdl_id_edit.val(),
            'descripcion': mdl_descripcion.val(),
        }
        var request = envia_ajax(
            '/delysoft/administracion/$titulo/editar_$titulo', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                mdl_agregar_editar.modal('hide')
                table.ajax.reload()
            }
            else {
                modal_alerta_agregar_editar.html(data.data)
                modal_alerta_agregar_editar.addClass('alert alert-danger')
            }
        })
    })
    // Cambio Estado $titulo
    tabla.on('click', '.btn_estado', function () {
        var array = {
            'id': $.trim($(this).attr('data-id')),
            'estado': $(this).attr('data-activo'),
        }
        var request = envia_ajax(
            '/delysoft/administracion/$titulo/cambiar_estado_$titulo', array)
        request.fail(function () {
            $('#modal_generico_body').html('Error al enviar peticion porfavor recargue la pagina')
            $('#modal_generico').modal('show')
        })
        request.done(function (data) {
            if (data.respuesta == 'S') {
                table.ajax.reload()
            }
            else {
                $('#modal_generico_body').html(data.data)
                $('#modal_generico').modal('show')
            }
        })
    })
    // Fin Eventos
    // Funciones
    function envia_ajax(url, data) {
        var variable = $.ajax({
            url: url,
            method: 'POST',
            data: data,
            'dataSrc': 'data',
            dataType: 'json',
        })
        return variable
    }

    function limpieza_modal() {
        mdl_descripcion.val('')
        modal_alerta_agregar_editar.html('')
        modal_alerta_agregar_editar.removeClass('alert alert-danger')
        mdl_btn_agregar.hide()
        mdl_btn_editar.hide()
    }

    // Fin Funciones
});";
        return $formato;
    }

    private function formato_html()
    {
        $titulo = $this->input->post('titulos');
        $formato = "
<div class='row'>
    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <div class='panel-title pull-left'>ADMINISTRACION $titulo</div>
            <div class='pull-right'>
                <button type='submit' class='btn btn-success btn-xs' title='Agregar' id='btn_agregar_$titulo'><span
                            class='glyphicon glyphicon-plus'></span><b> agregar $titulo</b></button>
            </div>
            <div class='clearfix'></div>
        </div>
        <div class='panel-body'>
            <table id='tabla_$titulo' class='table table-responsive'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>DESCRIPCION</th>
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
<div class='modal fade' id='modal_agregar_editar_$titulo' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title' id='titulo_agregar_editar_$titulo'></h4>
            </div>
            <div class='modal-body'>
                <div id='modal_alerta_agregar_editar'></div>
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
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>
</div>
<script src=\"<?php echo base_url('/public/js/administracion/$titulo/script.js') ?>\"></script>
<!-- Fin Modal Agregar / Editar  -->";
        return $formato;
    }
}