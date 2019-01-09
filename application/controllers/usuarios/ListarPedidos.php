<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 02-12-2018
 * Time: 3:26
 */

class ListarPedidos extends CI_Controller
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
        //$this->load->model("/usuarios/usuarios_model");
        $data["elemento_modulo"] = "Historial de pedidos";
        //var_dump($data["usuarios"]);
        $this->layout->setLayout('plantilla_menu_usuario');
        $this->layout->view('vista',$data);
        //$this->output->enable_profiler();
    }
}