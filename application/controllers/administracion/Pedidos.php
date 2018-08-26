<?php

/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 26-08-2018
 * Time: 15:31
 */
class Pedidos extends CI_Controller
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

    public function obtener_listado_pedidos()
    {
        $mensaje = new stdClass();
        $this->load->model('/administracion/pedidos_model');
        if (validarUsuario(false)) {
            $datos = $this->pedidos_model->obtener_listado_pedidos();
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

    public function agregar_pedidos()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_pedido('agregar');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/pedidos_model', 'pedidos_model');
                $descripcion = $this->input->post('descripcion');
                $this->pedidos_model->ingresar_pedidos($descripcion);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Pedidos Modificado Correctamente';
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

    public function ver_detalle_pedido()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_pedido('detalle_pedido');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/pedidos_model');
                $id = $this->input->post('id');
                $mensaje->encabezado = $this->pedidos_model->obtener_encabezado_pedido($id);
                $mensaje->detalle = $this->pedidos_model->obtener_detalle_pedido($id);
                $mensaje->respuesta = 'S';
                $mensaje->data = 'Pedidos Modificado Correctamente';
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

    public function cambiar_estado_pedidos()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_pedido('estado');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/pedidos_model');
                $id = $this->input->post('id');
                $perfil = $this->input->post('estado');
                if ($perfil == 'S') {
                    $this->pedidos_model->cambia_estado_pedidos($id, 'N');
                    $mensaje->respuesta = 'S';
                } elseif ($perfil == 'N') {
                    $this->pedidos_model->cambia_estado_pedidos($id, 'S');
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
        $respuesta = "<button class='btn btn-primary btn-xs btn_detalle' type='button' data-id=" . $data['ID'] . " " .
            " data-activo='" . $data['ACTIVO'] . "' ><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></button>";
        if ($data['ACTIVO'] == 'S') {
            $respuesta .= " <button class='btn btn-success btn-xs btn_estado' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='glyphicon glyphicon-ok-circle' aria-hidden='true'></span></button>";
        } else {
            $respuesta .= " <button class='btn btn-danger btn-xs btn_estado' type='button' data-id=" . $data['ID'] . " data-activo=" . $data['ACTIVO'] . "><span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span></button>";
        }
        return $respuesta;
    }
}