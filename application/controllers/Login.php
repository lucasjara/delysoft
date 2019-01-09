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
        $id_usuario = $this->session->id_usuario;
        $id_perfil = $this->session->id_perfil;
        if ($id_usuario != null || $id_perfil != null) {
            switch ($id_perfil) {
                case "1":
                    redirect("/administracion/permisos", 'refresh');
                    break;
                case "3":
                    redirect("/usuarios/ListarPedidos", 'refresh');
                    break;
                case "4":
                    redirect("/administrativo/inicio", 'refresh');
                    break;
                case "5":
                    redirect("/repartidor/ListarPedidos", 'refresh');
                    break;
                default:
                    $this->layout->setLayout("plantilla_integracion");
                    $this->layout->view('vista');
                    break;
            }
        }else{
            $this->layout->setLayout("plantilla_integracion");
            $this->layout->view('vista');
        }
    }
}