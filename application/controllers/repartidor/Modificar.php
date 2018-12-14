<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 13-12-2018
 * Time: 1:01
 */

class Modificar extends CI_Controller
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
        //modificar el id por uno de repartidor
        $user_id = 14;
        $data["elemento_modulo"] = "Mis datos de Repartidor";
        $data["usuarios"] = $this->repartidor_model->obtener_repartidor($user_id)[0];
        //var_dump($data["usuarios"]);
        $this->layout->setLayout('plantilla_menu_repartidor');
        $this->layout->view('vista', $data);
        //$this->output->enable_profiler();

    }

    public function editarRepartidor()
    {
        $mensaje = new stdClass();
        $this->load->helper('array_utf8');
        //fata validacion

        if (true) {
            $validator = form_usuario('editar');
            if ($validator->respuesta == 'S') {
                if($this->validarRepartidor()=='S')
                {
                    //cambios por repartidor
                    $this->load->model('/repartidor/repartidor_model');
                    $id = $this->input->post('id');
                    $usuario = $this->input->post('usuario');
                    $nombre = $this->input->post('nombre');
                    $correo = $this->input->post('correo');
                    $password = $this->input->post('password');
                    $this->repartidor_model->editar_repartidor($id, $usuario, $nombre, $correo, $password);
                    $mensaje->respuesta = "S";
                    $mensaje->data = "Repartidor Modificado Correctamente";
                }else
                {
                    $mensaje->respuesta="N";
                    $mensaje->data = "Contraseña no Valido";
                }
            } else {
                $mensaje->respuesta = "N";
                $mensaje->data = validation_errors();
            }
        } else {
            $mensaje->respuesta = "N";
            $mensaje->data = 'No se pudo procesar la solicitud. Intente recargar la pagina.';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array_utf8_encode($mensaje)));
    }

    private function validarRepartidor()
    {
        $mensaje;
        $this->load->helper('array_utf8');
        $this->load->model('/repartidor/repartidor_model');
        $id = $this->input->post('id');
        $password = $this->input->post('password');
        $bd_pass = $this->repartidor_model->valida_password($id)[0];
        //var_dump($bd_pass);
        if($bd_pass->PASSWORD == $password)
        {
            $mensaje ="S";
        }else{
            $mensaje = "N";
        }
        return $mensaje;
    }
}