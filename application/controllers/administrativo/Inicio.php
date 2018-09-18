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
        $this->load->model("/administracion/locales_model");
        if ($this->session->id_usuario != null){
            $this->layout->setLayout('plantilla');
            $this->layout->view('vista');
        }else{
            redirect('/Inicio/');
        }
    }
}