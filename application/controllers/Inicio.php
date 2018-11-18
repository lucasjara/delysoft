<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 09-06-2018
 * Time: 23:04
 */

class Inicio extends CI_Controller
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
        $this->layout->setLayout("plantilla_landing");
        $this->layout->view('vista');
    }
}