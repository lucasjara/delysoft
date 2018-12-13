<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 13-12-2018
 * Time: 0:57
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
        $this->load->model("/repartidor/repartidor_model");
        $data["elemento_modulo"] = "Listado de pedidos";
        //var_dump($data["usuarios"]);
        $this->layout->setLayout('plantilla_menu_repartidor');
        $this->layout->view('vista',$data);
        //$this->output->enable_profiler();
    }
}