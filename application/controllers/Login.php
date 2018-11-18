<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 17-11-2018
 * Time: 22:30
 */

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model("/inicio_model");
        $usuarios = $this->inicio_model->obtener();
        //$data["rutas"] = $this->inicio_model->obtener_rutas();
        $this->layout->setLayout("plantilla_integracion");
        $this->layout->view('vista');
    }
}