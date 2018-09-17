<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 16-09-2018
 * Time: 16:55
 */

class Base extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'array_utf8', 'validaciones', 'form_validator');
        $this->load->library('session');
        $this->load->library('form_validation');
    }
    public function index(){
        $this->load->model("/administracion/regiones_model");
        $this->load->model("/administracion/ciudades_model");
        $this->load->model("/administracion/perfiles_model");
        $this->load->model("/administracion/locales_model");
        $data["regiones"] = $this->regiones_model->obtener_regiones();
        $data["ciudades"] = $this->ciudades_model->obtener_ciudades();
        $data["perfiles"] = $this->perfiles_model->obtener_perfiles_carga_inicial();
        // estatico valor local
        $datos_cargos_local = $this->locales_model->obtener_cargos_locales(1);

        $data["perfiles_local"] = $datos_cargos_local;
        $this->layout->setLayout('plantilla');
        $this->layout->view('vista',$data);
    }
}