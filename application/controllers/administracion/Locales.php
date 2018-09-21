<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 1:04
 */

class Locales extends CI_Controller
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
        if (validarUsuario(false)) {
            $this->load->model("/administracion/regiones_model");
            $this->load->model("/administracion/ciudades_model");
            $this->load->model("/administracion/usuarios_model");
            $data["regiones"] = $this->regiones_model->obtener_regiones();
            $data["ciudades"] = $this->ciudades_model->obtener_ciudades();
            $data["usuarios"] = $this->usuarios_model->obtener();
            $this->layout->setLayout('plantilla');
            $this->layout->view('vista', $data);
        }else{
            redirect('/inicio/');
        }
    }

    public function obtener_listado_locales()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/locales_model');
        if (validarUsuario(false)) {
            $datos = $this->locales_model->obtener_listado_locales();
            for ($i = 0; $i < count($datos); $i++) {
                $datos[$i]['ACCIONES'] = $this->formato_acciones($datos[$i]);
                $datos[$i]['ACTIVO'] = $this->formato_activo($datos[$i]['ACTIVO']);
            }
            $mensaje->data = $datos;
            $mensaje->respuesta = 'S';
        } else {
            $mensaje->respuesta = 'Errror al obtener listado';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function agregar_locales()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_locales('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/locales_model', 'locales_model');
                $descripcion = $this->input->post('descripcion');
                $nombre = $this->input->post('nombre');
                $region = $this->input->post('region');
                $ciudad = $this->input->post('ciudad');
                $this->locales_model->ingresar_locales($descripcion, $nombre, $region, $ciudad);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Locales Modificado Correctamente';
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function editar_locales()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_locales('editar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/locales_model');
                $id = $this->input->post('id');
                $descripcion = $this->input->post('descripcion');
                $nombre = $this->input->post('nombre');
                $region = $this->input->post('region');
                $ciudad = $this->input->post('ciudad');
                $this->locales_model->editar_locales($id, $descripcion, $nombre, $region, $ciudad);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Locales Modificado Correctamente';
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = validation_errors();
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }

    public function cambiar_estado_locales()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_locales('estado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/locales_model');
                $id = $this->input->post('id');
                $perfil = $this->input->post('estado');
                if ($perfil == 'S') {
                    $this->locales_model->cambia_estado_locales($id, 'N');
                    $mensaje->respuesta = 'S';
                } elseif ($perfil == 'N') {
                    $this->locales_model->cambia_estado_locales($id, 'S');
                    $mensaje->respuesta = 'S';
                } else {
                    $mensaje->respuesta = 'N';
                    $mensaje->data = 'Error formato estado';
                }
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    private function formato_activo($respuesta)
    {
        if ($respuesta === 'S') {
            $respuesta = "<button class='btn btn-success btn-xs' type='button'>ACTIVO</button>";
        } else {
            $respuesta = "<button class='btn btn-danger btn-xs' type='button'>INACTIVO</button>";
        }
        return $respuesta;
    }

    private function formato_acciones($data)
    {
        $respuesta = "<button class='btn btn-primary btn-xs btn_editar' type='button' data-id=" . $data['ID'] . " " .
            " data-descripcion='" . $data['DESCRIPCION'] . "'" .
            " data-nombre='" . $data['NOMBRE'] . "' " .
            " data-region='" . $data['ID_REGION'] . "' " .
            " data-ciudad='" . $data['ID_CIUDAD'] . "' " .
            " data-activo='" . $data['ACTIVO'] . "' >" .
            "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>";
        if ($data['ACTIVO'] == 'S') {
            $respuesta .= " <button class='btn btn-success btn-xs btn_estado' type='button' " .
                " data-id=" . $data['ID'] . " " .
                " data-activo=" . $data['ACTIVO'] . ">" .
                "<span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
        } else {
            $respuesta .= " <button class='btn btn-danger btn-xs btn_estado' type='button' " .
                " data-id=" . $data['ID'] . " " .
                " data-activo=" . $data['ACTIVO'] . ">" .
                "<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>";
        }
        $respuesta .= " <button class='btn btn-info btn-xs btn_detalle' type='button' " .
            " data-id='" . $data['ID'] . "'  " .
            " data-nombre='" . $data['NOMBRE'] . "' >" .
            "<span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></button>";
        return $respuesta;
    }

    // Ver Detalle Cargos Local
    public function ver_detalle_locales()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_locales('detalle');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/locales_model');
                $id = $this->input->post('id');
                $datos = $this->locales_model->obtener_cargos_locales($id);
                $flag = false;
                if ($datos != null){
                    foreach ($datos as $dato) {
                        if ($dato->ID_PERFIL === "4") {
                            $flag = true;
                        }
                    }
                }
                $mensaje->respuesta = 'S';
                if ($flag) {
                    $mensaje->data = $datos;
                } else {
                    $mensaje->data = null;
                }
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    public function agregar_encargado_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_local_usuario('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/locales_model');
                $id_local = $this->input->post('id');
                $usuario = $this->input->post('usuario');
                // No tiene ningun local pendiente de configurar
                $flag = $this->locales_model->comprobar_local_configurado($usuario);
                // Comprueba si es el primer local
                $flag_dos = $this->locales_model->comprobar_primer_local($usuario);
                if ($flag_dos == null || $flag != null){
                    $this->locales_model->agregar_encargado_local($id_local, $usuario);
                    $datos = $this->locales_model->obtener_cargos_locales($id_local);
                    $mensaje->respuesta = 'S';
                    $mensaje->data = $datos;
                }else{
                    $mensaje->respuesta = 'N';
                    $mensaje->data = "El Usuario Debe configurar un Local antes de poder ser asignado otro";
                }
            } else {
                $mensaje->respuesta = 'N';
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = 'N';
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }
}

 