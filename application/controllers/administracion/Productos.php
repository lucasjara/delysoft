<?php

/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 17-09-2018
 * Time: 1:51
 */
class Productos extends CI_Controller
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
        $this->layout->setLayout('plantilla');
        $this->layout->view('vista');
    }

    public function obtener_listado_productos()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/productos_model');
        if (validarUsuario(false)) {
            $datos = $this->productos_model->obtener_listado_productos();
            for ($i = 0; $i < count($datos); $i++) {
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

    public function agregar_productos()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_producto('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/productos_model', 'productos_model');
                $descripcion = $this->input->post('descripcion');
                $nombre = $this->input->post('nombre');
                $precio = $this->input->post('precio');
                $id_local = $this->input->post('local');
                $this->productos_model->ingresar_productos($descripcion,$nombre,$precio,$id_local);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Productos Modificado Correctamente';
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

    public function editar_productos()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_producto('editar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/productos_model');
                $id = $this->input->post('id');
                $descripcion = $this->input->post('descripcion');
                $nombre = $this->input->post('nombre');
                $precio = $this->input->post('precio');
                $id_local = $this->input->post('local');
                $this->productos_model->editar_productos($id, $descripcion,$nombre,$precio,$id_local);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Productos Modificado Correctamente';
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

    public function cambiar_estado_productos()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_producto('estado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/productos_model');
                $id = $this->input->post('id');
                $perfil = $this->input->post('estado');
                if ($perfil == 'S') {
                    $this->productos_model->cambia_estado_productos($id, 'N');
                    $mensaje->respuesta = 'S';
                } elseif ($perfil == 'N') {
                    $this->productos_model->cambia_estado_productos($id, 'S');
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
        $respuesta = "<button class='btn btn-primary btn-xs btn_editar' type='button' " .
            " data-id=" . $data['ID'] . " " .
            " data-descripcion='" . $data['DESCRIPCION'] . "' " .
            " data-nombre='" . $data['NOMBRE'] . "' " .
            " data-precio='" . $data['PRECIO'] . "' " .
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
        return $respuesta;
    }
}