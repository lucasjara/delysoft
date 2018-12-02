<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 18-09-2018
 * Time: 17:37
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
        $this->load->model("/inicio_model");
        $this->load->model("/administracion/usuarios_model");
        $this->load->model("/administracion/locales_model");
        $id_usuario = $this->session->id_usuario;
        if ($id_usuario != null) {
            $data["usuario"] = $this->usuarios_model->obtener_info_usuario($id_usuario)[0];
            $data["elemento_modulo"] = "Seguimiento Pedidos Sistema";
            $this->layout->setLayout('plantilla_menu');
            $this->layout->view('vista', $data);
        } else {
            redirect('/login');
        }
    }

    public function obtener_ubicacion_repartidores()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        $id_usuario = $this->session->id_usuario;
        if ($id_usuario != null) {
            $this->load->model("/administracion/usuarios_model");
            $this->load->model("/administracion/locales_model");
            $id_local = $this->session->id_local;
            $datos = $this->locales_model->obtener_ubicacion_pedidos_local($id_local);
            if ($datos != null) {
                for ($i = 0; $i < count($datos); $i++) {
                    $datos[$i]->COLOR = $this->formato_color($i);
                    $datos[$i]->COLOR_MOTO = $this->formato_color_moto($i);
                }
                $mensaje->respuesta = "S";
                $mensaje->data = $datos;
            } else {
                $mensaje->respuesta = "N";
                $mensaje->data = "No existen pedidos activos en el local";
            }
        } else {
            $mensaje->respuesta = "N";
            $mensaje->data = "No se pudo procesar la solicitud. Intente recargar la pagina.";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }

    private function formato_color_moto($i)
    {
        switch ($i) {
            case 0:
                $i = "https://www.infest.cl/public/icon/scooter-red.png";
                break;
            case 1:
                $i = "https://www.infest.cl/public/icon/scooter-green.png";
                break;
            case 2:
                $i = "https://www.infest.cl/public/icon/scooter-yellow.png";
                break;
            default:
                $i = "https://www.infest.cl/public/icon/scooter-blue.png";
                break;
        }
        return $i;
    }

    private function formato_color($i)
    {
        switch ($i) {
            case 0:
                $i = "red-circle.png";
                break;
            case 1:
                $i = "grn-circle.png";
                break;
            case 2:
                $i = "ylw-circle.png";
                break;
            default:
                $i = "ltblu-circle.png";
                break;
        }
        return $i;
    }
}