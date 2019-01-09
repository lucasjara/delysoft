<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 13-12-2018
 * Time: 1:42
 */

class Registro extends CI_Controller
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
        $this->load->model("/repartidor/Repartidor_Model");
        $data["elemento_modulo"] = "Registro Repartidores";
        //var_dump($data["usuarios"]);
        $this->layout->setLayout('plantilla_menu_repartidor');
        $this->layout->view('vista',$data);
        //$this->output->enable_profiler();

    }
/*
    public function registrarRepartidor()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        // falta agregar el metodo validarUsuario
        if (true) {
            $validator = form_usuario('agregar');
            if ($validator->respuesta == 'S') {

                $this->load->model('/repartidor/repartidor_model', 'repartidorModel');
                $nombre= $this->input->post('nombre');
                $usuario = $this->input->post('usuario');
                $correo = $this->input->post('correo');
                $password = $this->input->post('password');
                $this->repartidor_model->registrar_repartidor($nombre,$usuario,$password,$correo);

                $mensaje->respuesta = "S";
                $mensaje->data = "Repartidor Registrado Correctamente";
            } else {
                $mensaje->respuesta = "N";
                $mensaje->data = $validator->mensaje;
            }
        } else {
            $mensaje->respuesta = "N";
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($mensaje));
    }
*/
}