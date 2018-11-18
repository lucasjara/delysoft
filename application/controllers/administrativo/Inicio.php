<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 18-09-2018
 * Time: 17:37
 */

class Inicio extends CI_Controller
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
        $this->load->model("/administracion/usuarios_model");
        $this->load->model("/administracion/locales_model");
        $this->load->model("/administracion/perfiles_model");
        $this->load->model("/inicio_model");
        $data["rutas"] = $this->inicio_model->obtener_rutas();
        $data["perfiles"] = $this->perfiles_model->obtener_perfiles();
        $id_usuario = $this->session->id_usuario;
        if ($id_usuario != null) {
            $data["usuario"] = $this->usuarios_model->obtener_info_usuario($id_usuario)[0];
            // Comprobar si esta configurado el local
            $flag = $this->locales_model->comprobar_local_configurado($id_usuario);
            if ($flag != null) {
                $data["administracion_local"] = true;
            } else {
                $data["configuracion_local"] = true;
            }
            $this->layout->setLayout('plantilla');
            $this->layout->view('vista', $data);
        } else {
            redirect('/inicio/');
        }
    }

    public function obtener_datos_usuario()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(false)) {
            $this->load->model('/administracion/usuarios_model');
            $id_usuario = $this->session->id_usuario;
            $mensaje->respuesta = "S";
            $mensaje->data = $this->usuarios_model->obtener_info_usuario($id_usuario)[0];
        } else {
            $mensaje->respuesta = "N";
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }

    public function editar_datos_usuario()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        if (validarUsuario(true)) {
            $validator = form_usuario('editar_administrativo');
            if ($validator->respuesta == 'S') {
                $this->load->model('/administracion/usuarios_model');
                $id = $this->input->post('id');
                $nombres = $this->input->post('nombre');
                $correo = $this->input->post('correo');
                $this->usuarios_model->editar_usuario_administrativo($id, $nombres, $correo);
                $mensaje->respuesta = "S";
            } else {
                $mensaje->respuesta = "N";
                $mensaje->data = validation_errors();
            }
        } else {
            $mensaje->respuesta = "N";
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }

    public function obtener_datos_grafico_tiempo()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        $this->load->model('/administracion/locales_model');
        $id_local = $this->session->id_local;
        $datos = $this->locales_model->obtener_historico_pedidos_local($id_local);
        $datos_bar = $this->locales_model->obtener_cantidad_pedidos_zona_local($id_local);
        if ($datos!= null){
            if (count($datos) >= 4){
                $mensaje->respuesta = "S";
                $mensaje->data = $datos;
                $mensaje->data_bar = $datos_bar;
            }else{
                $mensaje->respuesta = "N";
                $mensaje->data = "No cuenta con suficientes pedidos para mostrar graficos";
            }
        }else{
            $mensaje->respuesta = "N";
            $mensaje->data = "No han realizado Ningun Pedido al Local";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }
}