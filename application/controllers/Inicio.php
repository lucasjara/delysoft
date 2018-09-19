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
        $this->layout->setLayout("plantilla");
        $this->layout->view('vista');
    }
    public function login_sistema(){
        $this->session->id_usuario = null;
        $mensaje = new stdClass();
        $usuario = $this->input->post('usuario');
        $password = $this->input->post('password');
        $this->load->model("/administracion/Usuarios_model");
        $obj_user = new Usuarios_model();
        $user = $obj_user->obtener_id_usuario($usuario,$password);
        if ($user != null){
            $this->session->id_usuario = $user;
            $mensaje->respuesta = 'S';
            $mensaje->data = 'Usuario OK';
        }else{
            $mensaje->respuesta = 'N';
            $mensaje->data = 'Usuario no encontrado';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }
}