<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19-08-2018
 * Time: 21:40
 */

class Usuarios extends CI_Controller
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
        $this->layout->setLayout("plantilla");
        $this->layout->view('vista');
    }
    public function obtener_listado_usuarios(){

        $this->load->model("/administracion/usuarios_model");
        $usuarios = $this->inicio_model->obtener();
    }
}