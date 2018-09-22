<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19-09-2018
 * Time: 12:42
 */

class Mapas extends CI_Controller
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
        $id_usuario = $this->session->id_usuario;
        if ($id_usuario != null) {
            $this->load->model("/administracion/locales_model");
            $id_local = $this->session->id_local;
            $this->layout->setLayout('plantilla2');
            $this->layout->view('vista');
        } else {
            redirect('/inicio/');
        }
    }

    public function agregar_zona_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_zonas('agregar_zona_personalizado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/zonas_model', 'zonas_model');
                $nombre = $this->input->post('nombre');
                $descripcion = $this->input->post('descripcion');
                $id_local = $this->session->id_local;
                $this->zonas_model->ingresar_zonas($descripcion, $nombre, $id_local);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Zona Agregada Correctamente';
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
    public function editar_zona_local()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_zonas('editar_zona_personalizado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/zonas_model');
                $id = $this->input->post('id');
                $descripcion = $this->input->post('descripcion');
                $nombre = $this->input->post('nombre');
                $id_local = $this->session->id_local;
                $this->zonas_model->editar_zonas($id, $descripcion, $nombre, $id_local);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Zona Modificado Correctamente';
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

    public function obtener_listado_zonas_local()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/zonas_model', 'zonas_model');
        if (validarUsuario(false)) {
            $id_local = $this->session->id_local;
            $datos = $this->zonas_model->obtener_listado_zona_local($id_local);
            for ($i = 0; $i < count($datos); $i++) {
                $datos[$i]['CUADRO'] = $this->formato_cuadro($datos[$i]);
                $datos[$i]['ACCIONES'] = $this->formato_acciones($datos[$i]);
                $datos[$i]['ACTIVO'] = $this->formato_activo($datos[$i]['ACTIVO']);
            }
            $mensaje->data = $datos;
            $mensaje->respuesta = 'S';
        } else {
            $mensaje->respuesta = 'No hay mano';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }

    private function formato_cuadro($respuesta)
    {
        $respuesta = "<input type='checkbox' name='check' style='width: 18px; height: 18px;'>";
        return $respuesta;
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
            " data-descripcion='" . $data['DESCRIPCION'] . "' data-nombre='" . $data['NOMBRE'] . "' data-local='" . $data['ID_LOCAL'] . "' data-activo='" . $data['ACTIVO'] . "' ><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>";
        if ($data['ACTIVO'] == 'S') {
            $respuesta .= " <button class='btn btn-success btn-xs btn_estado' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
        } else {
            $respuesta .= " <button class='btn btn-danger btn-xs btn_estado' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>";
        }
        return $respuesta;
    }
}