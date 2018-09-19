<?php
/**
 * Created by PhpStorm.
 * User: Lucas
 * Date: 19-09-2018
 * Time: 12:42
 */

class Mapas  extends CI_Controller
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
        $id_usuario = $this->session->id_usuario;
        if ($id_usuario != null) {
            $this->load->model("/administracion/locales_model");
            $id_local = $this->session->id_local;
            $this->layout->setLayout('plantilla');
            $this->layout->view('vista');
        } else {
            redirect('/inicio/');
        }
    }
}