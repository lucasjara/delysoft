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
        $id_usuario = $this->session->id_usuario;
        if ($id_usuario != null) {
            $data["usuario"] = $this->usuarios_model->obtener_info_usuario($id_usuario)[0];
            // Comprobar si esta configurado el local
            $flag = $this->locales_model->comprobar_local_configurado($id_usuario);
            if ($flag != null) {
                $data["administracion_local"] = true;
            }else{
                $data["configuracion_local"] = true;
            }
            $this->layout->setLayout('plantilla');
            $this->layout->view('vista', $data);
        } else {
            redirect('/Inicio/');
        }
    }
}